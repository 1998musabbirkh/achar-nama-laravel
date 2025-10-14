<div>
    <h1>New Contact Inquiry</h1>
    <p>You have received a new message from your website contact form.</p>

    <ul>
        <li><strong>Name:</strong> {{ $data['name'] }}</li>
        <li><strong>Email:</strong> {{ $data['email'] }}</li>
    </ul>

    <h2>Message:</h2>
    <p>{{ $data['message'] }}</p>
    
    <hr>
    <p>Sent via your application contact page.</p>
</div>