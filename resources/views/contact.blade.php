<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Information</title>
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            flex-direction: column;
        }

        .contact-container {
            text-align: center;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .username-box, .phone-box {
            background-color: #f1f1f1;
            padding: 10px;
            border-radius: 8px;
            margin-top: 10px;
        }

        .phone-box button {
            cursor: pointer;
        }

        .link-box {
            background-color: #3498db;
            padding: 10px;
            border-radius: 8px;
        }

        a {
            color: #fff;
            text-decoration: none;
            display: block;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="contact-container">
        <h1>Contact Information</h1>
        <p>We are online [24/7]</p>
        <br></br>
        <div class="username-box">
            <p><strong>Username:</strong> {{ $username }}</p>
        </div>
        <div class="phone-box">
            <p><strong>Phone Number:</strong> {{ $phoneNumber }}</p>
            <button onclick="copyToClipboard('{{ $phoneNumber }}')">Copy to Clipboard</button>
        </div>
    </div>

    <div class="link-box">
        <a href="{{ route('home') }}">Go back to Home</a>
    </div>

    <script>
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text);
            alert('Phone number copied to clipboard!');
        }
    </script>
</body>
</html>
