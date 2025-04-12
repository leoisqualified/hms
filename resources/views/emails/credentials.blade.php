<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Account Credentials</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');
        
        body {
            font-family: 'Poppins', Arial, sans-serif;
            line-height: 1.6;
            color: #333333;
            background-color: #f7fafc;
            margin: 0;
            padding: 0;
        }
        
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        
        .email-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 30px 20px;
            text-align: center;
            color: white;
        }
        
        .email-header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }
        
        .email-body {
            padding: 30px;
        }
        
        .welcome-text {
            font-size: 18px;
            margin-bottom: 20px;
            color: #2d3748;
        }
        
        .credentials-box {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin: 25px 0;
            border-left: 4px solid #667eea;
        }
        
        .credentials-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .credentials-list li {
            margin-bottom: 12px;
            display: flex;
        }
        
        .credentials-list strong {
            min-width: 80px;
            display: inline-block;
            color: #4a5568;
        }
        
        .credentials-value {
            font-family: monospace;
            background: #edf2f7;
            padding: 4px 8px;
            border-radius: 4px;
            color: #2d3748;
        }
        
        .action-text {
            font-size: 16px;
            margin: 25px 0;
            color: #4a5568;
        }
        
        .login-button {
            display: inline-block;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-decoration: none;
            padding: 12px 24px;
            border-radius: 6px;
            font-weight: 500;
            margin: 15px 0;
            text-align: center;
        }
        
        .email-footer {
            text-align: center;
            padding: 20px;
            font-size: 12px;
            color: #718096;
            border-top: 1px solid #e2e8f0;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>Welcome to Our Team!</h1>
        </div>
        
        <div class="email-body">
            <p class="welcome-text">Your staff account has been successfully created. Below are your login credentials:</p>
            
            <div class="credentials-box">
                <ul class="credentials-list">
                    <li>
                        <strong>Email:</strong>
                        <span class="credentials-value">{{ $email }}</span>
                    </li>
                    <li>
                        <strong>Password:</strong>
                        <span class="credentials-value">{{ $password }}</span>
                    </li>
                </ul>
            </div>
            
            <p class="action-text">For security reasons, please log in and change your password immediately.</p>
            
            <div style="text-align: center;">
                <a href="{{ $loginUrl ?? '#' }}" class="login-button">Login to Your Account</a>
            </div>
            
            <p style="font-size: 14px; color: #718096; margin-top: 30px;">
                If you didn't request this account, please contact our support team immediately.
            </p>
        </div>
        
        <div class="email-footer">
            <p>&copy; {{ date('Y') }} Your Company Name. All rights reserved.</p>
        </div>
    </div>
</body>
</html>