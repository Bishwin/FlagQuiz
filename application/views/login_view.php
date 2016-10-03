<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login</title>
  <meta charset="utf-8"> 
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <!-- Custom styles for this template -->
  <link href="../public/css/signin.css" rel="stylesheet">
  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!-- Latest compiled JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
<body>
  <div class="container">
    <div id ="login_form">
      
      <?php
        $attrs = array('class' => "form-signin");
        echo form_open('login/validate_credentials',$attrs);
        echo "<h2 class='form-signin-heading'>Please sign in</h2>";
        echo form_input('username', 'Username');
        echo form_password('password', '', 'placeholder="Password" class="password"');
        echo "<br>";
        echo form_submit('submit','Login');
        echo form_close();
      ?> 
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="../public/js/login.js" type="text/javascript"></script>
</body>
</html>
    