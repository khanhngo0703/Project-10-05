<?php
session_start();
require_once 'connect.php';

$sql = "SELECT * from contact_info";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $lst_contact = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $lst_contact = [];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</head>

<body>
    <h1 style="text-align: center;">ORDER MANAGEMENT</h1>
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="bg-dark col-auto col-md-2 min-vh-100">
                <div class="bg-dark p-2">
                    <a href="" class="d-flex text-decoration-none mt-1 align-items-center text-white">
                        <span class="fs-4 d-none d-sm-inline">SideMenu</span>
                    </a>
                    <ul class="nav nav-pills flex-column mt-4">
                        <li class="nav-item">
                            <a href="index.php" class="nav-link text-white">
                                <i class="fs-5 fa fa-guage"></i><span class="fs-4 d-none d-sm-inline">Products</span>
                            </a>
                        </li>                        
                        <li class="nav-item">
                            <a href="addprd.php" class="nav-link text-white">
                                <i class="fs-5 fa fa-table-list"></i><span class="fs-4 d-none d-sm-inline">Add Product</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="addnewcl.php" class="nav-link text-white">
                                <i class="fs-5 fa fa-grid-2"></i><span class="fs-4 d-none d-sm-inline">Collections</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="addnewst.php" class="nav-link text-white">
                                <i class="fs-5 fa fa-clipboard"></i><span class="fs-4 d-none d-sm-inline">Stylist</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="order_management.php" class="nav-link text-white">
                                <i class="fs-5 fa fa-clipboard"></i><span class="fs-4 d-none d-sm-inline">Order</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="contact_info.php" class="nav-link text-white">
                                <i class="fs-5 fa fa-clipboard"></i><span class="fs-4 d-none d-sm-inline">Contact Info</span>
                            </a>
                        </li>                         
                        <li class="nav-item">
                            <a href="login.php?logout=true" class="nav-link text-white">
                                <i class="fs-5 fa fa-users"></i><span class="fs-4 d-none d-sm-inline">Log Out</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-auto col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Danh sach don hang</h5>
                    </div>
                    <div class="card-body">                    
                        <table class="table table-reponsive">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Ten khach hang</th>
                                    <th>Email</th>
                                    <th>Message</th>                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($lst_contact as $contact) :
                                ?>
                                    <tr>
                                        <td><?php echo $contact['id_contact'] ?></td>
                                        <td><?php echo $contact['username_contact'] ?></td>
                                        <td><?php echo $contact['email_contact'] ?></td>
                                        <td><?php echo $contact['message_contact'] ?></td>                                        
                                    </tr>
                                <?php
                                endforeach;
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>