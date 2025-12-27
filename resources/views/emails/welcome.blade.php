<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to MedNet</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 40px 20px;
            text-align: center;
        }
        .header h1 {
            color: white;
            margin: 0;
            font-size: 32px;
            font-weight: 600;
        }
        .header p {
            color: rgba(255, 255, 255, 0.9);
            margin: 10px 0 0 0;
            font-size: 16px;
        }
        .content {
            padding: 40px 30px;
        }
        .greeting {
            font-size: 24px;
            color: #667eea;
            margin-bottom: 20px;
            font-weight: 600;
        }
        .message {
            color: #555;
            font-size: 16px;
            line-height: 1.8;
            margin-bottom: 15px;
        }
        .features {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin: 30px 0;
        }
        .features h3 {
            color: #667eea;
            margin-top: 0;
            font-size: 18px;
        }
        .feature-item {
            display: flex;
            align-items: start;
            margin: 15px 0;
        }
        .feature-icon {
            color: #667eea;
            font-size: 20px;
            margin-right: 12px;
            margin-top: 2px;
        }
        .feature-text {
            color: #555;
            font-size: 15px;
        }
        .cta-button {
            display: inline-block;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 14px 32px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            margin: 20px 0;
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
        }
        .footer {
            background: #f8f9fa;
            padding: 30px;
            text-align: center;
            color: #777;
            font-size: 14px;
            border-top: 1px solid #e0e0e0;
        }
        .footer a {
            color: #667eea;
            text-decoration: none;
        }
        .signature {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e0e0e0;
            color: #777;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🎉 Welcome to MedNet! 🎉</h1>
            <p>Your trusted healthcare companion</p>
        </div>
        
        <div class="content">
            <div class="greeting">Hello {{ $user->name }}! 👋</div>
            
            <p class="message">
                Thank you for registering with <strong>samixshady's MedNet</strong>! We're absolutely thrilled to have you join our growing community of health-conscious individuals.
            </p>
            
            <p class="message">
                Your account has been successfully created, and you're now ready to explore everything MedNet has to offer. We're committed to making your healthcare journey as smooth and convenient as possible.
            </p>
            
            <div class="features">
                <h3>✨ What You Can Do With MedNet:</h3>
                
                <div class="feature-item">
                    <span class="feature-icon">💊</span>
                    <span class="feature-text"><strong>Browse Medicines:</strong> Access a comprehensive catalog of pharmaceutical products with detailed information and pricing.</span>
                </div>
                
                <div class="feature-item">
                    <span class="feature-icon">🛒</span>
                    <span class="feature-text"><strong>Quick & Easy Orders:</strong> Place orders seamlessly with our intuitive cart and quick-buy features.</span>
                </div>
                
                <div class="feature-item">
                    <span class="feature-icon">🎁</span>
                    <span class="feature-text"><strong>Exclusive Promotions:</strong> Stay updated with special offers and discounts on essential medicines.</span>
                </div>
                
                <div class="feature-item">
                    <span class="feature-icon">📦</span>
                    <span class="feature-text"><strong>Order Tracking:</strong> Monitor your orders in real-time from placement to delivery.</span>
                </div>
                
                <div class="feature-item">
                    <span class="feature-icon">🔒</span>
                    <span class="feature-text"><strong>Secure & Private:</strong> Your health information and transactions are protected with industry-standard security.</span>
                </div>
            </div>
            
            <center>
                <a href="{{ url('/') }}" class="cta-button">Start Shopping Now →</a>
            </center>
            
            <p class="message">
                If you have any questions, concerns, or feedback, please don't hesitate to reach out through our support system. We're here to help you every step of the way!
            </p>
            
            <p class="message">
                Here's to your health and wellbeing! 🌟
            </p>
            
            <div class="signature">
                <p>Warm regards,<br>
                <strong>The MedNet Team</strong><br>
                <em>Created with ❤️ by samixshady</em></p>
            </div>
        </div>
        
        <div class="footer">
            <p>This email was sent to <strong>{{ $user->email }}</strong></p>
            <p>© {{ date('Y') }} MedNet by samixshady. All rights reserved.</p>
            <p style="margin-top: 15px;">
                <a href="{{ url('/') }}">Visit Website</a> • 
                <a href="{{ url('/support') }}">Contact Support</a>
            </p>
        </div>
    </div>
</body>
</html>
