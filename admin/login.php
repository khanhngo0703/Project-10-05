<?php
session_start();

require_once 'connect.php';


if (isset($_POST['loginadmin'])) {
  $username = $_POST['username'];
  $password = md5($_POST['password']);

  $sql = "SELECT * FROM admincp WHERE admin_username = '$username' AND admin_password = '$password'";
  $res = $conn->query($sql);

  if ($res->num_rows > 0) {
    $_SESSION['loginad'] = $username;
    header('Location: index.php');
  } else {
    echo 'Tai khoan hoac mat khau khong dung';
    header('Location: login.php');
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/styleadmin.css">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">

  <title>Login</title>
</head>

<body>
  <div class="wrapper">
    <span class="icon-close"><ion-icon name="close-outline"></ion-icon></span>
    <div class="form-box login">
      <h2>Login ADMIN</h2>
      <form action="" method="post">
        <div class="input-box">
          <span class="icon"><ion-icon name="mail-outline"></ion-icon> Username</span>
          <input type="text" name="username">
          <label for="Username"></label>
        </div>
        <div class="input-box">
          <span class="icon"><ion-icon name="lock-closed-outline"></ion-icon> Password</span>
          <input type="password" name="password">
          <label for="Password"></label>
        </div>
        <button type="submit" class="btn" name="loginadmin">Login</button>
      </form>
    </div>
  </div>
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>



<script src="https://code.jquery.com/jquery-3.6.0.js"></script>

</html>