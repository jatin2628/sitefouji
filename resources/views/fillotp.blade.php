<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Enter OTP for Verification</title>
    <style>
        body {
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 40px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h3 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .form-control {
            width: 100%;
            height: 40px;
            padding: 8px;
            font-size: 14px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .form-group button {
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

        .loader {
            display: none;
            border: 4px solid #f3f3f3;
            border-top: 4px solid #3498db;
            border-radius: 50%;
            width: 16px;
            height: 16px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
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
    <div class="container">
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
        <h3>Enter OTP for Verification</h3>
        <form class="form-horizontal" action="check_otp" method="post">
            @csrf
            <div class="form-group">
                @isset($email)
                <input type="hidden" name="email" value="{{$email}}">
                @endisset
                <label for="otp">OTP:</label>
                <input type="text" id="otp" class="form-control" name="otp" required>
            </div>
            <div class="form-group">
                <button type="submit">Verify</button>
            </div>
        </form>
        <center>
            <div class="loader"></div>
        </center>
    </div>
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
