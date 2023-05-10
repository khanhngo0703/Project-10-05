<?php
require_once './connect.php';
require_once 'utils.php';
$errors = [];
if(isset($_POST['updatecl'])) {
    $name_cl = isset($_POST['name_cl']) ? sanitize($_POST['name_cl']) : '';

    if (count($errors) === 0) {
        $id = sanitize($_GET['id']);

        try {
            $conn->begin_transaction();
            $sql = "UPDATE collections SET collection_name = '$name_cl' WHERE id = $id";
            $res = $conn->query($sql);
            $conn->commit();
        } catch (Exception $e) {
            echo $e->getMessage();
            $conn->rollback();
        }
    }
}
if (isset($_GET['id'])) {
    $id = sanitize($_GET['id']);
    $sql = "SELECT * FROM collections WHERE id = $id";
    $res = $conn->query($sql);

    if ($res) {
        $current_cl = $res->fetch_assoc();

        if ($current_cl === null) {
            header('Location: index.php');
        }
    }
} else {
    header('Location: index.php');
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
    <h1 style="text-align: center;">UPDATE COLLECTIONS</h1>
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
                        <h5 class="mb-0">Update Collection</h5>
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            <input type="text" name="name_cl" placeholder="Ten bo suu tap" class="form-control mb-2" value="<?php echo $current_cl['collection_name']; ?>">
                            <input type="submit" name="updatecl" value="Update Collection" class="form-control mb-2 btn btn-warning">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>