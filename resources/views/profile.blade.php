<!DOCTYPE html>
<html>
<head>
  <title>Beautiful Profile Page</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 600px;
      margin: 40px auto;
      background-color: #fff;
      padding: 20px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    h1 {
      text-align: center;
    }

    .avatar {
      width: 150px;
      height: 150px;
      border-radius: 50%;
      margin: 20px auto;
      background-color: #ccc;
      background-position: center;
      background-size: cover;
      cursor: pointer;
      overflow: hidden;
    }

    .avatar img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .input-group {
      margin-bottom: 20px;
    }

    .input-group label {
      display: block;
      margin-bottom: 5px;
    }

    .input-group input {
      width: 100%;
      padding: 10px;
      font-size: 16px;
      border-radius: 5px;
      border: 1px solid #ccc;
    }

    .input-group textarea {
      width: 100%;
      padding: 10px;
      font-size: 16px;
      border-radius: 5px;
      border: 1px solid #ccc;
    }

    .input-group button {
      padding: 10px 20px;
      font-size: 16px;
      border-radius: 5px;
      border: none;
      background-color: #4caf50;
      color: #fff;
      cursor: pointer;
    }

    .input-group button:hover {
      background-color: #45a049;
    }

    /* Hide the file input */
    #avatarUpload {
      display: none;
    }
    
    .name-container {
      display: flex;
      gap: 10px;
    }
    
    .name-container input {
      flex: 1;
    }
    
    .bio-container {
      margin-top: 20px;
    }
  </style>
</head>
<body>
    <form action="/updateprofle" method="POST">
      @csrf
  <div class="container">
    <h1>Profile Page</h1>
    <div class="avatar" id="avatar" onclick="clickAvatar()">
      <img id="avatarImg" src="dummy-avatar.jpg" alt="">
    </div>
    <div class="input-group name-container">
      <div>
        <label for="firstName">First Name</label>
        <input type="text" id="firstName" placeholder="Enter your first name" name="first_name" value="{{$user->first_name}}">
      </div>
      <div>
        <label for="lastName">Last Name</label>
        <input type="text" id="lastName" placeholder="Enter your last name" name="last_name" value="{{$user->last_name}}">
      </div>
    </div>
    <div class="input-group">
      <label for="email">Email</label>
      <input type="email" id="email" placeholder="Enter your email" name="email" value="{{$user->email}}">
    </div>
    <div class="input-group">
      <label for="location">Location</label>
      <input type="text" id="location" placeholder="Enter your location" name="location">
    </div>
    <div class="input-group">
      <label for="designation">Designation</label>
      <input type="text" id="designation" placeholder="Enter your designation" name="designation">
    </div>
    <div class="input-group bio-container">
      <label for="bio">Bio</label>
      <textarea id="bio" placeholder="Enter your bio" name="bio"></textarea>
    </div>
    <div class="input-group">
      <button onclick="saveProfile()">Save</button>
    </div>
    <!-- The file input -->
    <input type="file" id="avatarUpload" name="avatar" accept="image/*" onchange="previewImage(event)">
  </div>
  </form>

  <script>
    
    function clickAvatar() {
      document.getElementById('avatarUpload').click();
    }

    function previewImage(event) {
      var file = event.target.files[0];
      var reader = new FileReader();

      reader.onload = function (event) {
        var avatarImg = document.getElementById('avatarImg');
        avatarImg.src = event.target.result;
      };

      reader.readAsDataURL(file);
    }
  </script>
</body>
</html>
