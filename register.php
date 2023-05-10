<?php
require_once "admin/connect.php";
require_once "admin/utils.php";
$errors = [];

if (isset($_POST['register'])) {
    $fullname = sanitize($_POST['Fullname']);
    $usersname = sanitize($_POST['Username']);
    $email = sanitize($_POST['Email']);
    $phonenumber = sanitize($_POST['PhoneNumber']);
    $password = sanitize($_POST['Password']);
    if (empty($fullname)) {
        array_push($errors, 'FullName cannot be left blank');
    }
    if (empty($usersname)) {
        array_push($errors, 'UserName cannot be left blank');
    }
    if (empty($email)) {
        array_push($errors, 'Email cannot be left blank');
    }
    if (empty($phonenumber)) {
        array_push($errors, 'PhoneNumber cannot be left blank');
    }
    if (empty($password)) {
        array_push($errors, 'Password cannot be left blank');
    }

    $sql = "select * from users where username='$usersname'";
    $res = $conn->query($sql);
    if ($res->num_rows > 0) {
        array_push($errors, 'Username is already exists');
    }

    if (count($errors) == 0) {
        $pass_sha1 = sha1($password);

        $sql = "insert into users (fullname,username,email,phone_number,password_hash) values ('$fullname','$usersname','$email','$phonenumber','$pass_sha1')";
        $res = $conn->query($sql);
        if ($res) {
            header("Location:login.php");
            exit();
        } else {
            array_push($errors, 'Registration failed');
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
    <title>Register</title>
</head>

<body>
    <div class="container">
        <div class="row align-items-center justify-content-center" style="height: 100vh;">
            <div class="col-0 col-md-3 col-lg-4">

            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-center">Registation</h2>
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            <input type="text" name="Fullname" class="form-control mb-2" placeholder="Fullname">
                            <input type="text" name="Username" class="form-control mb-2" placeholder="Username">
                            <input type="email" name="Email" class="form-control mb-2" placeholder="Email">
                            <input type="number" name="PhoneNumber" class="form-control mb-2" placeholder="PhoneNumber">
                            <input type="password" name="Password" class="form-control mb-2" placeholder="Password">
                            <div class="register-btn-wrap d-flex flex-wrap align-items-center justify-content-between">
                                <strong>Do you already have an account?<a href="login.php" style="color: brown;">Log in</a></strong>
                                <button type="submit" class="btn" name="register">Register</button>
                            </div>
                        </form>
                        <?php
                        if (count($errors) > 0) :
                            echo '<div class="alert alert-danger" role="alert">';
                            foreach ($errors as $error) :
                        ?>
                                <p><?php echo $error; ?></p>
                        <?php
                            endforeach;
                            echo '</div>';
                        endif;
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