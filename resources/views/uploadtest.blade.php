{{-- <!DOCTYPE html>
<html>
<head>
  <title>User Information and File Upload</title>
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
    }

    .header {
      background-color: #000;
      color: #fff;
      padding: 10px;
      text-align: center;
    }

    .container {
      margin: 20px;
      padding: 20px;
      background-color: #f7f7f7;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    h1, h2 {
      color: #333;
    }

    label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
    }

    input[type="file"],
    select,
    input[type="text"],
    input[type="submit"] {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      font-size: 14px;
      margin-bottom: 10px;
    }

    input[type="submit"] {
      background-color: #4CAF50;
      color: #fff;
      cursor: pointer;
    }

    input[type="submit"]:hover {
      background-color: #45a049;
    }

    .hidden {
      display: none;
    }

    button{
      background-color: #4CAF50;
      color: #fff;
      cursor: pointer;
      border: #f7f7f7;
      width: 100%;
      padding: 10px
l 
    }

    button:hover {
      background-color: #45a049;
    }
  </style>
</head>
<body>
  <div class="header">
    <h1>User Information</h1>
    <p>Welcome, {{$user->first_name. " ". $user->last_name}} !</p>
  </div>

  <div class="container">
    <h2>File Upload</h2>
    <form action="/upload" method="POST" enctype="multipart/form-data">
      @csrf
      <label for="file">Select a file:</label>
      <input type="file" name="files[]" id="file" required multiple>
      <br>
      <label for="folder">Select a folder:</label>
      <select name="folder" id="folder" onchange="toggleFields()">
        <option value="none">Select Folder</option>
        <option value="structured">Structured</option>
        <option value="unstructured">Unstructured</option>
      </select>
      <br>
      <div id="structuredFields" class="hidden">
        <label for="structuredField">Select a field:</label>
        <select name="structuredField" id="structuredField" onchange="handleStructuredFieldSelection()">
          <option value="none">Select Field</option>
          <option value="location">Location</option>
          <option value="designation">Designation</option>
        </select>
        <br>
        <label for="structuredValue" id="structuredValueLabel" class="hidden">Value:</label>
        <input type="text" name="structuredValue" id="structuredValue" class="hidden">
      </div>
      <br>
      <input type="submit" value="Upload">
    </form>

    <a href="/fileAccess"><button>Check Uploaded Data</button></a>
  </div>

  <script>
    function toggleFields() {
      const folder = document.getElementById("folder").value;
      const structuredFields = document.getElementById("structuredFields");
      const structuredField = document.getElementById("structuredField");
      const structuredValueLabel = document.getElementById("structuredValueLabel");
      const structuredValue = document.getElementById("structuredValue");

      if (folder === "structured") {
        structuredFields.classList.remove("hidden");
        structuredField.setAttribute("required", "required");
      } else {
        structuredFields.classList.add("hidden");
        structuredField.removeAttribute("required");
        structuredValueLabel.classList.add("hidden");
        structuredValue.classList.add("hidden");
        structuredValue.removeAttribute("required");
      }
    }

    function handleStructuredFieldSelection() {
      const structuredField = document.getElementById("structuredField").value;
      const structuredValueLabel = document.getElementById("structuredValueLabel");
      const structuredValue = document.getElementById("structuredValue");

      if (structuredField === "none") {
        structuredValueLabel.classList.add("hidden");
        structuredValue.classList.add("hidden");
        structuredValue.removeAttribute("required");
      } else {
        structuredValueLabel.classList.remove("hidden");
        structuredValue.classList.remove("hidden");
        structuredValue.setAttribute("required", "required");
        structuredValue.placeholder = "Enter " + structuredField.charAt(0).toUpperCase() + structuredField.slice(1);
      }
    }

  </script>
</body>
</html>
 --}}

 {{-- <!DOCTYPE html>
<html>
<head>
  <title>User Information and File Upload</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      padding: 0;
      font-family: 'Poppins', Arial, sans-serif;
    }

    .header {
      background-color: #000;
      color: #fff;
      padding: 10px;
      text-align: center;
      display: flex;
      justify-content: space-between;
    }

    .header h1 {
      margin: 0;
    }

    .profile {
      display: flex;
      align-items: center;
    }

    .profile-img {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      object-fit: cover;
      margin-right: 10px;
    }

    .container {
      display: flex;
      margin: 20px;
      padding: 20px;
      background-color: #f7f7f7;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .container h2 {
      color: #333;
      margin-top: 0;
    }

    label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
    }

    input[type="file"],
    select,
    input[type="text"],
    input[type="submit"] {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      font-size: 14px;
      margin-bottom: 10px;
    }

    input[type="submit"] {
      background-color: #4CAF50;
      color: #fff;
      cursor: pointer;
    }

    input[type="submit"]:hover {
      background-color: #45a049;
    }

    .hidden {
      display: none;
    }

    button {
      background-color: #4CAF50;
      color: #fff;
      cursor: pointer;
      border: #f7f7f7;
      width: 100%;
      padding: 10px;
    }

    button:hover {
      background-color: #45a049;
    }
    .username{
      margin-right: 50px
    }
  </style>
</head>
<body>
  <div class="header">
    <h1>User Information</h1>
    <div class="profile">
      <img class="profile-img" src="images/profile.avif" alt="Profile Image">
      <p class="username">{{$user->first_name. " ". $user->last_name}}</p>
      <button class="wallet-button">Wallet</button>
    </div>
  </div>

  <div class="container">
    <div class="profile-info">
      <!-- Add your user profile information here -->
    </div>
    <div class="upload-form">
      <h2>File Upload</h2>
      <form action="/upload" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="file">Select a file:</label>
        <input type="file" name="files[]" id="file" required multiple>
        <br>
        <label for="folder">Select a folder:</label>
        <select name="folder" id="folder" onchange="toggleFields()">
          <option value="none">Select Folder</option>
          <option value="structured">Structured</option>
          <option value="unstructured">Unstructured</option>
        </select>
        <br>
        <div id="structuredFields" class="hidden">
          <label for="structuredField">Select a field:</label>
          <select name="structuredField" id="structuredField" onchange="handleStructuredFieldSelection()">
            <option value="none">Select Field</option>
            <option value="location">Location</option>
            <option value="designation">Designation</option>
          </select>
          <br>
          <label for="structuredValue" id="structuredValueLabel" class="hidden">Value:</label>
          <input type="text" name="structuredValue" id="structuredValue" class="hidden">
        </div>
        <br>
        <input type="submit" value="Upload">
      </form>
      <a href="/fileAccess"><button>Check Uploaded Data</button></a>
    </div>
  </div>

  <script>
    function toggleFields() {
      const folder = document.getElementById("folder").value;
      const structuredFields = document.getElementById("structuredFields");
      const structuredField = document.getElementById("structuredField");
      const structuredValueLabel = document.getElementById("structuredValueLabel");
      const structuredValue = document.getElementById("structuredValue");

      if (folder === "structured") {
        structuredFields.classList.remove("hidden");
        structuredField.setAttribute("required", "required");
      } else {
        structuredFields.classList.add("hidden");
        structuredField.removeAttribute("required");
        structuredValueLabel.classList.add("hidden");
        structuredValue.classList.add("hidden");
        structuredValue.removeAttribute("required");
      }
    }

    function handleStructuredFieldSelection() {
      const structuredField = document.getElementById("structuredField").value;
      const structuredValueLabel = document.getElementById("structuredValueLabel");
      const structuredValue = document.getElementById("structuredValue");

      if (structuredField === "none") {
        structuredValueLabel.classList.add("hidden");
        structuredValue.classList.add("hidden");
        structuredValue.removeAttribute("required");
      } else {
        structuredValueLabel.classList.remove("hidden");
        structuredValue.classList.remove("hidden");
        structuredValue.setAttribute("required", "required");
        structuredValue.placeholder = "Enter " + structuredField.charAt(0).toUpperCase() + structuredField.slice(1);
      }
    }

  </script>
</body>
</html> --}}


{{-- <!DOCTYPE html>
<html>
<head>
  <title>User Information and File Upload</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      padding: 0;
      font-family: 'Poppins', Arial, sans-serif;
    }

    .header {
      background-color: #000;
      color: #fff;
      padding: 10px;
      text-align: center;
      display: flex;
      justify-content: space-between;
    }

    .header h1 {
      margin: 0;
    }

    .profile {
      display: flex;
      align-items: center;
    }

    .profile-img {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      object-fit: cover;
      margin-right: 10px;
    }

    .container {
      display: flex;
      margin: 20px;
      padding: 20px;
      background-color: #f7f7f7;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .container h2 {
      color: #333;
      margin-top: 0;
    }

    label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
    }

    input[type="file"],
    select,
    input[type="text"],
    input[type="submit"] {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      font-size: 14px;
      margin-bottom: 10px;
    }

    input[type="submit"] {
      background-color: #4CAF50;
      color: #fff;
      cursor: pointer;
    }

    input[type="submit"]:hover {
      background-color: #45a049;
    }

    .hidden {
      display: none;
    }

    button {
      background-color: #4CAF50;
      color: #fff;
      cursor: pointer;
      border: #f7f7f7;
      width: 100%;
      padding: 10px;
    }

    button:hover {
      background-color: #45a049;
    }

    .username {
      margin-right: 50px
    }

    .toggle-profile {
      flex-grow: 1;
      padding: 10px;
      background-color: #f7f7f7;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .toggle-profile.hidden {
      display: none;
    }
  </style>
</head>
<body>
  <div class="header">
    <h1>User Information</h1>
    <div class="profile">
      <a onclick="toggleProfile()"><img class="profile-img" src="images/profile.avif" alt="Profile Image"></a>
      <p class="username">{{$user->first_name. " ". $user->last_name}}</p>
      <button class="wallet-button"><a href="/fileAccess">Wallet</a></button>
    </div>
  </div>

  <div class="container">
    <div class="profile-info">
      <!-- Add your user profile information here -->
    </div>
    <div class="toggle-profile hidden">
      <!-- Toggle profile content goes here -->
    </div>
    <div class="upload-form">
      <h2>File Upload</h2>
      <form action="/upload" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="file">Select a file:</label>
        <input type="file" name="files[]" id="file" required multiple>
        <br>
        <label for="folder">Select a folder:</label>
        <select name="folder" id="folder" onchange="toggleFields()">
          <option value="none">Select Folder</option>
          <option value="structured">Structured</option>
          <option value="unstructured">Unstructured</option>
        </select>
        <br>
        <div id="structuredFields" class="hidden">
          <label for="structuredField">Select a field:</label>
          <select name="structuredField" id="structuredField" onchange="handleStructuredFieldSelection()">
            <option value="none">Select Field</option>
            <option value="location">Location</option>
            <option value="designation">Designation</option>
          </select>
          <br>
          <label for="structuredValue" id="structuredValueLabel" class="hidden">Value:</label>
          <input type="text" name="structuredValue" id="structuredValue" class="hidden">
        </div>
        <br>
        <input type="submit" value="Upload">
      </form>
      
    </div>
  </div>

  <script>
    function toggleFields() {
      const folder = document.getElementById("folder").value;
      const structuredFields = document.getElementById("structuredFields");
      const structuredField = document.getElementById("structuredField");
      const structuredValueLabel = document.getElementById("structuredValueLabel");
      const structuredValue = document.getElementById("structuredValue");

      if (folder === "structured") {
        structuredFields.classList.remove("hidden");
        structuredField.setAttribute("required", "required");
      } else {
        structuredFields.classList.add("hidden");
        structuredField.removeAttribute("required");
        structuredValueLabel.classList.add("hidden");
        structuredValue.classList.add("hidden");
        structuredValue.removeAttribute("required");
      }
    }

    function handleStructuredFieldSelection() {
      const structuredField = document.getElementById("structuredField").value;
      const structuredValueLabel = document.getElementById("structuredValueLabel");
      const structuredValue = document.getElementById("structuredValue");

      if (structuredField === "none") {
        structuredValueLabel.classList.add("hidden");
        structuredValue.classList.add("hidden");
        structuredValue.removeAttribute("required");
      } else {
        structuredValueLabel.classList.remove("hidden");
        structuredValue.classList.remove("hidden");
        structuredValue.setAttribute("required", "required");
        structuredValue.placeholder = "Enter " + structuredField.charAt(0).toUpperCase() + structuredField.slice(1);
      }
    }

    function toggleProfile() {
      const toggleProfile = document.querySelector('.toggle-profile');
      toggleProfile.classList.toggle('hidden');
    }
  </script>
</body>
</html> --}}


{{-- <!DOCTYPE html>
<html>
<head>
  <title>User Information and File Upload</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      padding: 0;
      font-family: 'Poppins', Arial, sans-serif;
    }

    .header {
      background-color: #000;
      color: #fff;
      padding: 10px;
      text-align: center;
      display: flex;
      justify-content: space-between;
    }

    .header h1 {
      margin: 0;
    }

    .profile {
      display: flex;
      align-items: center;
    }

    .profile-img {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      object-fit: cover;
      margin-right: 10px;
    }

    .container {
      display: flex;
      margin: 20px;
      padding: 20px;
      background-color: #f7f7f7;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .container h2 {
      color: #333;
      margin-top: 0;
    }

    label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
    }

    input[type="file"],
    select,
    input[type="text"],
    input[type="submit"] {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      font-size: 14px;
      margin-bottom: 10px;
    }

    input[type="submit"] {
      background-color: #4CAF50;
      color: #fff;
      cursor: pointer;
    }

    input[type="submit"]:hover {
      background-color: #45a049;
    }

    .hidden {
      display: none;
    }

    button {
      background-color: #4CAF50;
      color: #fff;
      cursor: pointer;
      border: #f7f7f7;
      width: 100%;
      padding: 10px;
    }

    button:hover {
      background-color: #45a049;
    }

    .username {
      margin-right: 50px
    }

    .toggle-profile {
      flex-grow: 1;
      padding: 10px;
      background-color: #f7f7f7;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .toggle-profile.hidden {
      display: none;
    }
  </style>
</head>
<body>
  <div class="header">
    <h1>User Information</h1>
    <div class="profile">
      <a onclick="toggleProfile()"><img class="profile-img" src="images/profile.avif" alt="Profile Image"></a>
      <p class="username">{{$user->first_name. " ". $user->last_name}}</p>
      <button class="wallet-button"><a href="/fileAccess">Wallet</a></button>
    </div>
  </div>

  <div class="container">
    <div class="profile-info">
      <!-- Add your user profile information here -->
    </div>
    <div class="toggle-profile hidden">
      <!-- Toggle profile content goes here -->
    </div>
    <div class="upload-form">
      <h2>File Upload</h2>
      <form action="/upload" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="file">Select a file:</label>
        <input type="file" name="files[]" id="file" required multiple>
        <br>
        <label for="folder">Select a folder:</label>
        <select name="folder" id="folder" onchange="toggleFields()">
          <option value="none">Select Folder</option>
          <option value="structured">Structured</option>
          <option value="unstructured">Unstructured</option>
        </select>
        <br>
        <div id="structuredFields" class="hidden">
          <div id="locationField" class="hidden">
            <label for="location">Location:</label>
            <input type="text" name="location" id="location">
          </div>
          <div id="designationField" class="hidden">
            <label for="designation">Designation:</label>
            <input type="text" name="designation" id="designation">
          </div>
        </div>
        <br>
        <input type="submit" value="Upload">
      </form>
    </div>
  </div>

  <script>
    function toggleFields() {
      const folder = document.getElementById("folder").value;
      const structuredFields = document.getElementById("structuredFields");
      const locationField = document.getElementById("locationField");
      const designationField = document.getElementById("designationField");

      if (folder === "structured") {
        structuredFields.classList.remove("hidden");
        locationField.classList.remove("hidden");
        designationField.classList.remove("hidden");
      } else {
        structuredFields.classList.add("hidden");
        locationField.classList.add("hidden");
        designationField.classList.add("hidden");
      }
    }

    function toggleProfile() {
      const toggleProfile = document.querySelector('.toggle-profile');
      toggleProfile.classList.toggle('hidden');
    }
  </script>
</body>
</html> --}}

{{-- 
<!DOCTYPE html>
<html>
<head>
  <title>User Information and File Upload</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      padding: 0;
      font-family: 'Poppins', Arial, sans-serif;
    }

    .header {
      background-color: #000;
      color: #fff;
      padding: 10px;
      text-align: center;
      display: flex;
      justify-content: space-between;
    }

    .header h1 {
      margin: 0;
    }

    .profile {
      display: flex;
      align-items: center;
    }

    .profile-img {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      object-fit: cover;
      margin-right: 10px;
    }

    .container {
      display: flex;
      margin: 20px;
      padding: 20px;
      background-color: #f7f7f7;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .container h2 {
      color: #333;
      margin-top: 0;
    }

    label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
    }

    input[type="file"],
    select,
    input[type="text"],
    input[type="submit"] {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      font-size: 14px;
      margin-bottom: 10px;
    }

    input[type="submit"] {
      background-color: #4CAF50;
      color: #fff;
      cursor: pointer;
    }

    input[type="submit"]:hover {
      background-color: #45a049;
    }

    .hidden {
      display: none;
    }

    button {
      background-color: #4CAF50;
      color: #fff;
      cursor: pointer;
      border: #f7f7f7;
      width: 100%;
      padding: 10px;
    }

    button:hover {
      background-color: #45a049;
    }

    .username {
      margin-right: 50px
    }

    .toggle-profile {
      flex-grow: 1;
      padding: 10px;
      background-color: #f7f7f7;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .toggle-profile.hidden {
      display: none;
    }

    .example-file-icon {
      display: none;
      margin-left: 5px;
    }

    .example-file-text {
      margin-top: 5px;
      font-size: 12px;
    }
  </style>
</head>
<body>
  <div class="header">
    <h1>User Information</h1>
    <div class="profile">
      <a onclick="toggleProfile()"><img class="profile-img" src="images/profile.avif" alt="Profile Image"></a>
      <p class="username">{{$user->first_name. " ". $user->last_name}}</p>
      <button class="wallet-button"><a href="/fileAccess">Wallet</a></button>
    </div>
  </div>

  <div class="container">
    <div class="profile-info">
      <!-- Add your user profile information here -->
    </div>
    <div class="toggle-profile hidden">
      <!-- Toggle profile content goes here -->
    </div>
    <div class="upload-form">
      <h2>File Upload</h2>
      <form action="/upload" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="file">Select a file:</label>
        <input type="file" name="files[]" id="file" required multiple>
        <br>
        <label for="folder">Select a folder:</label>
        <div class="folder-container">
          <select name="folder" id="folder" onchange="toggleFields()">
            <option value="none">Select Folder</option>
            <option value="structured">Structured</option>
            <option value="unstructured">Unstructured</option>
          </select>
          <span class="example-file-icon" id="exampleFileIcon" title="Example File">&#9432;</span>
        </div>
        <span class="example-file-text" id="exampleFileText">(Example file: example.csv)</span>
        <br>
        <div id="structuredFields" class="hidden">
          <div id="locationField" class="hidden">
            <label for="location">Location:</label>
            <input type="text" name="location" id="location">
          </div>
          <div id="designationField" class="hidden">
            <label for="designation">Designation:</label>
            <input type="text" name="designation" id="designation">
          </div>
        </div>
        <br>
        <input type="submit" value="Upload">
      </form>
    </div>
  </div>

  <script>
    function toggleFields() {
      const folder = document.getElementById("folder").value;
      const structuredFields = document.getElementById("structuredFields");
      const locationField = document.getElementById("locationField");
      const designationField = document.getElementById("designationField");
      const exampleFileIcon = document.getElementById("exampleFileIcon");
      const exampleFileText = document.getElementById("exampleFileText");

      if (folder === "structured") {
        structuredFields.classList.remove("hidden");
        locationField.classList.remove("hidden");
        designationField.classList.remove("hidden");
        exampleFileIcon.style.display = "inline-block";
        exampleFileText.style.display = "inline-block";
      } else {
        structuredFields.classList.add("hidden");
        locationField.classList.add("hidden");
        designationField.classList.add("hidden");
        exampleFileIcon.style.display = "none";
        exampleFileText.style.display = "none";
      }
    }

    function toggleProfile() {
      const toggleProfile = document.querySelector('.toggle-profile');
      toggleProfile.classList.toggle('hidden');
    }
  </script>
</body>
</html>
 --}}

 <!DOCTYPE html>
<html>
<head>
  <title>User Information and File Upload</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      padding: 0;
      font-family: 'Poppins', Arial, sans-serif;
    }

    .header {
      background-color: #000;
      color: #fff;
      padding: 10px;
      text-align: center;
      display: flex;
      justify-content: space-between;
    }

    .header h1 {
      margin: 0;
    }

    .profile {
      display: flex;
      align-items: center;
    }

    .profile-img {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      object-fit: cover;
      margin-right: 10px;
    }

    .container {
      display: flex;
      margin: 20px;
      padding: 20px;
      background-color: #f7f7f7;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      justify-content: center;
    }

    .container h2 {
      color: #333;
      margin-top: 0;
    }

    label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
    }

    input[type="file"],
    select,
    input[type="text"],
    input[type="submit"] {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      font-size: 14px;
      margin-bottom: 10px;
    }

    input[type="submit"] {
      background-color: #4CAF50;
      color: #fff;
      cursor: pointer;
    }

    input[type="submit"]:hover {
      background-color: #45a049;
    }

    .hidden {
      display: none;
    }

    button {
      background-color: #4CAF50;
      color: #fff;
      cursor: pointer;
      border: #f7f7f7;
      width: 100%;
      padding: 10px;
    }

    button:hover {
      background-color: #45a049;
    }

    .username {
      margin-right: 50px
    }

    .toggle-profile {
      flex-grow: 1;
      padding: 10px;
      background-color: #f7f7f7;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .toggle-profile.hidden {
      display: none;
    }

    .example-file-icon {
      display: none;
      margin-left: 5px;
      cursor: pointer;
    }

    .example-file-text {
      margin-top: 5px;
      font-size: 12px;
    }

    .profile-form {
       display: none;
       padding: 20px;
       background-color: #f7f7f7;
       border-radius: 8px;
       box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
     }
 
     .profile-form.show {
       display: block;
       float: right;
       position: absolute;
       right: 0;
       top: 105px;
     }
 
    .profile-form label {
       display: block;
       margin-bottom: 5px;
       font-weight: bold;
     }
 
     .profile-form input[type="text"],
     .profile-form input[type="email"] {
       width: 100%;
       padding: 10px;
       border: 1px solid #ccc;
       border-radius: 4px;
       font-size: 14px;
       margin-bottom: 10px;
     }
 
     .profile-form button {
       background-color: #4CAF50;
       color: #fff;
       cursor: pointer;
       border: #f7f7f7;
       width: 100%;
       padding: 10px;
     }
 
     .profile-form button:hover {
       background-color: #45a049;
     }

    /* New CSS styles for pop-up */
    .modal {
      display: none;
      position: fixed;
      z-index: 1;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgba(0, 0, 0, 0.4);
    }

    .modal-content{
      background-color: #fefefe;
      margin: 10% auto;
      padding: 20px;
      border: 1px solid #888;
      width: 80%;
      max-width: 600px;
      border-radius: 8px;
    }

    .modal-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }

    .modal-header h2 {
      margin: 0;
    }

    .modal-close {
      cursor: pointer;
    }

    .modal-file-preview {
      width: 100%;
      height: 500px;
      border: 1px solid #ccc;
      margin-bottom: 20px;
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

    #avatarUpload {
      display: none;
    }
  </style>
</head>
<body>
  <div class="header">
    <h1>User Information</h1>
    <div class="profile">
      <a onclick="toggleProfile()"><img class="profile-img" @if ($user->avatar)
        src="{{ asset('images/' . $user->avatar) }}"
            
        @else
        src="{{ asset('images/' . 'profile.avif') }}"
        @endif alt="Profile Image"></a>
      <p class="username">{{$user->first_name. " ". $user->last_name}}</p>
      <button class="wallet-button"><a href="/fileAccess">Wallet</a></button>
    </div>
  </div>

  <div class="container">
    <div class="profile-info">
      <!-- Add your user profile information here -->
    </div>
    <div class="toggle-profile hidden">
      <!-- Toggle profile content goes here -->
    </div>
    <div class="upload-form">
      <h2>File Upload</h2>
      <form action="/upload" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="file">Select a file:</label>
        <input type="file" name="files[]" id="file" required multiple>
        <br>
        <label for="folder">Select a folder:</label>
        <div class="folder-container">
          <select name="folder" id="folder" onchange="toggleFields()">
            <option value="none">Select Folder</option>
            <option value="structured">Structured</option>
            <option value="unstructured">Unstructured</option>
          </select>
          <span class="example-file-icon" id="exampleFileIcon" title="Example File" onclick="openFilePreview()">&#9432;</span>
        </div>
        <span class="example-file-text" id="exampleFileText">(Example file: example.csv)</span>
        <br>
        <div id="structuredFields" class="hidden">
          <div id="locationField" class="hidden">
            <label for="location">Location:</label>
            <input type="text" name="location" id="location">
          </div>
          <div id="designationField" class="hidden">
            <label for="designation">Designation:</label>
            <input type="text" name="designation" id="designation">
          </div>
        </div>
        <br>
        <input type="submit" value="Upload">
      </form>
    </div>
  

  <div class="profile-form" id="profileForm">
    <h2>Profile Information</h2>
    
    <form action="/updateprofle" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="avatar" id="avatar" onclick="clickAvatar()">
        <img id="avatarImg" @if ($user->avatar)
    src="{{ asset('images/' . $user->avatar) }}"
        
    @else
    src="{{ asset('images/' . 'profile.avif') }}"
    @endif  alt="">
      </div>
      <label for="firstName">First Name:</label>
      <input type="text" id="firstName" name="first_name" value="{{$user->first_name}}">
      <label for="lastName">Last Name:</label>
      <input type="text" id="lastName" name="last_name" value="{{$user->last_name}}">
      <label for="email">Email:</label>
      <input type="email" id="email" name="email" value="{{$user->email}}">
      <label for="designation">Designation:</label>
      <input type="text" id="designation" name="designation" value="{{$user->designation ? $user->designation : " " }}">
      <label for="location">Location:</label>
      <input type="text" id="location" name="location" value="{{$user->location ? $user->location : " " }}">
    <input type="file" id="avatarUpload" name="avatar" accept="image/*" onchange="previewImage(event)">
      <button type="submit">Save</button>
    </form>

  </div>
  </div>

  <!-- New HTML code for pop-up -->
  <div id="filePreviewModal" class="modal">
    <div class="modal-content">
      <div class="modal-header">
        <h2>File Preview</h2>
        <span class="modal-close" onclick="closeFilePreview()">&times;</span>
      </div>
      <div class="modal-file-preview" id="filePreview"></div>
    </div>
  </div>

  <script>
    function toggleFields() {
     const folder = document.getElementById("folder").value;
      const structuredFields = document.getElementById("structuredFields");
      const locationField = document.getElementById("locationField");
      const designationField = document.getElementById("designationField");
      const exampleFileIcon = document.getElementById("exampleFileIcon");
      const exampleFileText = document.getElementById("exampleFileText");

      if (folder === "structured") {
        structuredFields.classList.remove("hidden");
        locationField.classList.remove("hidden");
        designationField.classList.remove("hidden");
        exampleFileIcon.style.display = "inline-block";
        exampleFileText.style.display = "inline-block";
      } else {
        structuredFields.classList.add("hidden");
        locationField.classList.add("hidden");
        designationField.classList.add("hidden");
        exampleFileIcon.style.display = "none";
        exampleFileText.style.display = "none";
      }
    }

    function toggleProfile() {
      const profileForm = document.getElementById("profileForm");
       profileForm.classList.toggle("show");
    }

    function toggleProfileForm() {
       const profileForm = document.getElementById("profileForm");
       profileForm.classList.toggle("show");
     }

    // New JavaScript code for pop-up functionality
    const filePreviewModal = document.getElementById("filePreviewModal");
    const filePreview = document.getElementById("filePreview");

    function openFilePreview() {
      filePreviewModal.style.display = "block";
      // Load the Excel file into the file preview element
      filePreview.innerHTML = '<iframe src="assets/test.pdf" frameborder="0" width="100%" height="100%"></iframe>';
    }

    function closeFilePreview() {
      filePreviewModal.style.display = "none";
      // Clear the file preview element when closing the pop-up
      filePreview.innerHTML = "";
    }

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

    const exampleFileText = document.getElementById("exampleFileText");
    const exampleFileIcon = document.getElementById("exampleFileIcon");

    exampleFileIcon.addEventListener("mouseenter", showExampleFile);
    exampleFileIcon.addEventListener("mouseleave", hideExampleFile);

    function showExampleFile() {
      exampleFileText.style.display = "inline-block";
    }

    function hideExampleFile() {
      exampleFileText.style.display = "none";
    }

    // Event listener for clicks outside the pop-up
    window.addEventListener("click", function(event) {
      if (event.target === filePreviewModal) {
        closeFilePreview();
      }
    });
  </script>
</body>
</html>
