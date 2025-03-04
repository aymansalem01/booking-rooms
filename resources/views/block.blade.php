<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Blocked</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .message-container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px #7c5cc5;
            text-align: center;
            max-width: 400px;
            width: 100%;
        }

        h2 {
            color: #e74c3c;
        }

        p {
            color: #333;
            margin: 20px 0;
        }

        .back-btn {
            background-color: #7c5cc5;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
            cursor: pointer;
        }

        .back-btn:hover {
            background-color: #540f5e;
        }
    </style>
</head>
<body>

<div class="message-container">
    <h2>Account Blocked</h2>
    <p>Your account has been blocked. Please contact the administration for further assistance.</p>
    <a href="{{route('log')}}" class="back-btn">Back to Login</a>
</div>

</body>
</html>
