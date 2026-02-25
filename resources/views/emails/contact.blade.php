<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
</head>
<body>
    <h2>New Contact Form Submission</h2>
    
    <p><strong>From:</strong> {{ $name }}</p>
    <p><strong>Email:</strong> {{ $email }}</p>
    <p><strong>Subject:</strong> {{ $subject }}</p>
    
    <hr>
    
    <p><strong>Message:</strong></p>
    <p>{{ $userMessage }}</p>
</body>
</html>
