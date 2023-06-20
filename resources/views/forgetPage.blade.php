<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forget Password</title>
    <style>
        body {
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
        }
        
        .container {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        .form-container {
            background-color: #ffffff;
            width: 350px;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        
        .form-title {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
        }
        
        .form-label {
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
        
        .btn {
            display: block;
            width: 100%;
            height: 40px;
            margin-top: 20px;
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
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <div class="container">
        <form action="forgetmail" method="post" class="form-container">
            @csrf
            <h2 class="form-title">Forget Password</h2>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" id="email" name="email" class="form-control" aria-describedby="emailHelp" required>
            </div>
            <button class="btn" id="login">Submit</button>
            <div class="loader" id="loader"></div>
        </form>
    </div>
</body>
</html>
