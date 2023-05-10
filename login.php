<?php
session_start();
require_once 'admin/connect.php';
require_once "admin/utils.php";
$errors = [];
if (isset($_POST['login'])) {
    $email = sanitize($_POST['Email']);
    $pass = sha1($_POST['Password']);
    if (empty($email)) {
        array_push($errors, 'Email cannot be left blank');
    }
    if (empty($pass)) {
        array_push($errors, 'Password cannot be left blank');
    }
    if (count($errors) == 0) {
        $sql = "SELECT * FROM users WHERE email = '$email' AND password_hash = '$pass'";

        $res = $conn->query($sql);
        if ($res->num_rows > 0) {
            $_SESSION['loggedin'] = $email;
            header('Location: cart.php');
        } else {
            array_push($errors, 'Username or password is incorrect');
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style_register-login.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <title>Login</title>
</head>

<body>
    <div class="container">
        <div class="row align-items-center justify-content-center" style="height: 100vh;">
            <div class="col-0 col-md-3 col-lg-4">

            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-center">Login</h2>
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            <input type="email" name="Email" class="form-control mb-2" placeholder="Email">
                            <input type="password" name="Password" class="form-control mb-2" placeholder="Password">
                            <label><input type="checkbox" name="remember">Remember me</label>
                            <div class="register-btn-wrap d-flex flex-wrap align-items-center justify-content-between">
                                <strong>New to Fashion Shop?<a href="register.php" style="color: brown;">Register</a></strong>
                                <button type="submit" class="btn" name="login">Login</button>
                            </div>
                        </form>
                        <?php
                        if (count($errors) > 0) {
                            foreach ($errors as $error) {
                                echo '<p class="text-danger">' . $error . '</p>';
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>



<script src="https://code.jquery.com/jquery-3.6.0.js"></script>

</html>