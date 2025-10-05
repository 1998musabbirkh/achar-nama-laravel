<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function index(Request $request)
    {

        $filterStatus = $request->query('status');

        $query = Order::with('items')->latest();

        $validStatuses = ['pending', 'processing', 'shipped', 'delivered', 'cancelled'];

        if ($filterStatus && in_array($filterStatus, $validStatuses)) {

            $dbStatus = ($filterStatus === 'delivered' ? 'completed' : $filterStatus);

            $query->where('status', $dbStatus);
        }

        $orders = $query->paginate(20);

        return view('orders.index', compact('orders'));
    }

     public function track()
    {
        return view('orders.track_search');
    }

    public function trackDetails(Request $request)
    {
        $request->validate([
            'order_id' => 'required|numeric',
        ], [
            'order_id.required' => 'অনুগ্রহ করে অর্ডার আইডি প্রদান করুন।',
            'order_id.numeric' => 'অর্ডার আইডি অবশ্যই সংখ্যা হতে হবে।',
        ]);

        $order = Order::with('items.productVariant')->find($request->order_id);

        if (!$order) {
            return back()->withInput()->with('error', 'এই অর্ডার আইডি দিয়ে কোনো অর্ডার পাওয়া যায়নি।');
        }

        return view('orders.track_details', compact('order'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'variant_id' => 'required|exists:product_variants,id',
            'quantity' => 'required|integer|min:1|max:100',
            'customer_name' => 'required|string|max:255',
            'phone' => ['required', 'string', 'regex:/^(\+880|880)?[0-9]{10,11}$/'],
            'address' => 'required|string|max:500',
            'payment_method' => 'required|in:COD',
            'product_name_for_summary' => 'required|string|max:255',
        ], [
            'customer_name.required' => 'নাম অবশ্যই পূরণ করতে হবে।',
            'phone.required' => 'মোবাইল নম্বর অবশ্যই পূরণ করতে হবে।',
            'phone.regex' => 'সঠিক মোবাইল নম্বর দিন।',
            'address.required' => 'ডেলিভারি ঠিকানা অবশ্যই পূরণ করতে হবে।',
            'variant_id.required' => 'অনুগ্রহ করে পণ্যের ওজন নির্বাচন করুন।',
            'quantity.min' => 'পণ্যের সংখ্যা অবশ্যই ১ বা তার বেশি হতে হবে।',
        ]);


        $variant = ProductVariant::findOrFail($request->variant_id);
        $unit_price = $variant->sell_price ?? $variant->regular_price;
        $total_item_price = $unit_price * $request->quantity;

        DB::beginTransaction();

        try {
            $order = Order::create([
                'customer_name' => $request->customer_name,
                'phone' => $request->phone,
                'address' => $request->address,
                'total_price' => $total_item_price,
                'payment_method' => $request->payment_method ?? 'COD',
                'status' => 'pending',
            ]);

            $order->items()->create([
                'product_variant_id' => $variant->id,
                'product_name' => $request->product_name_for_summary . ' - ' . $variant->variant_name,
                'quantity' => $request->quantity,
                'price' => $unit_price,
            ]);

            DB::commit();

            return redirect()->route('order.success')->with('success', 'আপনার অর্ডার সফলভাবে সম্পন্ন হয়েছে!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Order creation failed: " . $e->getMessage(), ['request' => $request->all()]);

            return back()->withInput()->with('error', 'অর্ডার সম্পন্ন করতে সমস্যা হয়েছে। অনুগ্রহ করে আবার চেষ্টা করুন।');
        }
    }

    public function show(Order $order)
    {
        $order->load('items.productVariant');

        return view('orders.show', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled',
            'customer_name' => 'nullable|string|max:255',
            'phone' => ['nullable', 'string', 'regex:/^(\+880|880)?[0-9]{10,11}$/'],
            'address' => 'nullable|string|max:500',
            'quantity' => 'nullable|integer|min:1|max:100',
        ], [
            'status.required' => 'অর্ডারের অবস্থা অবশ্যই নির্বাচন করতে হবে।',
            'phone.regex' => 'সঠিক মোবাইল নম্বর দিন।',
            'quantity.min' => 'পণ্যের সংখ্যা অবশ্যই ১ বা তার বেশি হতে হবে।',
        ]);

        DB::beginTransaction();

        try {
            if ($request->filled('quantity') && $order->items->first()) {
                $item = $order->items->first();
                $new_quantity = $request->input('quantity');
                $unit_price = $item->price;
                $new_total_price = $unit_price * $new_quantity;
                $item->update(['quantity' => $new_quantity]);
                $order->total_price = $new_total_price;
            }

            $order->update([
                'status' => $request->status,
                'customer_name' => $request->customer_name ?? $order->customer_name,
                'phone' => $request->phone ?? $order->phone,
                'address' => $request->address ?? $order->address,
                'total_price' => $order->total_price,
            ]);

            DB::commit();

            return back()->with('success', 'অর্ডার সফলভাবে আপডেট হয়েছে!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Order update failed for ID {$order->id}: " . $e->getMessage(), ['request' => $request->all()]);

            return back()->withInput()->with('error', 'অর্ডার আপডেট করতে সমস্যা হয়েছে। অনুগ্রহ করে আবার চেষ্টা করুন।');
        }
    }

    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'অর্ডার সফলভাবে মুছে ফেলা হয়েছে।');
    }
}
