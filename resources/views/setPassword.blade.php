<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <style>
        body {
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h2 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        input {
            display: block;
            width: 100%;
            height: 40px;
            padding: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        button {
            display: block;
            width: 100%;
            height: 40px;
            font-size: 16px;
            font-weight: bold;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .flash-message {
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 10px 20px;
        border-radius: 5px;
        font-size: 16px;
        z-index: 9999;
    }

    .flash-success {
        background-color: #7ec699;
        color: #ffffff;
    }

    .flash-error {
        background-color: #ff6b6b;
        color: #ffffff;
    }
    </style>
</head>
<body>
    @if (session('success'))
        <div class="flash-message flash-success">
            {{ session('success') }}
        </div>
    @endif
    
    @if (session('error'))
        <div class="flash-message flash-error">
            {{ session('error') }}
        </div>
    @endif
    <form action="/setnewpassword" method="POST">
        @csrf
        <h2>Reset Password</h2>
        <input type="hidden" name="email" value="{{ $email }}">
        <input type="password" name="password" placeholder="Enter new password" required>
        <input type="password" name="password_confirmation" placeholder="Confirm new password" required>
        <button type="submit">Reset Password</button>
    </form>
    <script>
        // Add this JavaScript code in your HTML template or an external JS file
        setTimeout(function() {
            var flashMessages = document.getElementsByClassName('flash-message');
            for (var i = 0; i < flashMessages.length; i++) {
                flashMessages[i].style.display = 'none';
            }
        }, 3000);
    </script>
</body>
</html>
