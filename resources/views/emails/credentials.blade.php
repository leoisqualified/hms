<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Account Credentials</title>
</head>
<body>
    <h2>Welcome!</h2>
    <p>Your staff account has been created. Here are your login credentials:</p>
    <ul>
        <li><strong>Email:</strong> {{ $email }}</li>
        <li><strong>Password:</strong> {{ $password }}</li>
    </ul>
    <p>Please log in and change your password immediately.</p>
</body>
</html>
