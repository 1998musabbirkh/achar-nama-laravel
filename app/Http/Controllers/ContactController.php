<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;

class ContactController extends Controller
{
    public function submit(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        Mail::to('1998illegaldream@gmail.com') 
            ->send(new ContactFormMail($validatedData)); 
            

        return back()->with('success', 'Thank you for your message! We will be in touch shortly.');
    }
}