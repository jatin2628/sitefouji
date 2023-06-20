<!DOCTYPE html>
<html>
<head>
  <title>Login Page</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
    }
    .container {
      max-width: 400px;
      margin: 0 auto;
      padding: 20px;
      background-color: #ffffff;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      margin-top: 50px;
    }
    h2 {
      text-align: center;
      color: #333333;
    }
    label {
      display: block;
      margin-bottom: 5px;
      color: #666666;
    }
    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border-radius: 3px;
      border: 1px solid #cccccc;
    }
    input[type="submit"] {
      background-color: #333333;
      color: #ffffff;
      padding: 10px 20px;
      border: none;
      border-radius: 3px;
      cursor: pointer;
      font-size: 16px;
    }
    input[type="submit"]:hover {
      background-color: #555555;
    }
    .forgot-password {
      text-align: center;
      margin-top: 10px;
      color: #666666;
    }
    .forgot-password a {
      color: #333333;
      text-decoration: none;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Login</h2>
    <form action="/api/login" method="POST">
    @csrf
      <label for="email">Email</label>
      <input type="email" id="email" name="email" required>

      <label for="password">Password</label>
      <input type="password" id="password" name="password" required>

      <input type="submit" value="Login">

    </form>
    <div class="forgot-password">
      <a href="/api/forgetPassword">Forgot password?</a>
    </div>
  </div>
</body>
</html>
