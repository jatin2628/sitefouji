<!DOCTYPE html>
<html>
<head>
  <title>Registration Page</title>
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
    input[type="text"],
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
    .login-link {
      text-align: center;
      margin-top: 20px;
      color: #666666;
    }
    .login-link a {
      color: #333333;
      text-decoration: none;
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
    <h2>Registration</h2>
    <form action="/register" method="POST">
      @csrf
      <label for="firstname">First Name</label>
      <input type="text" id="firstname" name="first_name" required>

      <label for="lastname">Last Name</label>
      <input type="text" id="lastname" name="last_name" required>

      <label for="email">Email</label>
      <input type="email" id="email" name="email" required>

      <label for="password">Password</label>
      <input type="password" id="password" name="password" required>

      <input type="submit" value="Register">

    </form>
    <div class="login-link">
      Already have an account? <a href="/login">Login here</a>
    </div>
  </div>
  <script>
    // JavaScript code to show the pop-up message
    function showPopup(message, isSuccess) {
      var popup = document.createElement('div');
      popup.className = isSuccess ? 'popup success' : 'popup error';
      popup.textContent = message;
      document.body.appendChild(popup);

      setTimeout(function() {
        popup.remove();
      }, 3000);
    }
  </script>
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
