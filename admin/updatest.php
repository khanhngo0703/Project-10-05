<?php
require_once 'connect.php';
require_once 'utils.php';
$errors = [];

if(isset($_POST['updatest'])) {
    $name_st = isset($_POST['name_st']) ? sanitize($_POST['name_st']) : '';
    $image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $image = time() . '_' . $image;
    $description_st = isset($_POST['description_st']) ? sanitize($_POST['description_st']) : '';

    if (count($errors) === 0) {
        $id = sanitize($_GET['id']);

        try {
            $conn->begin_transaction();
            move_uploaded_file($image_tmp, 'uploads/' . $image);
            $sql = "UPDATE stylists SET stylist_name = '$name_st', stylist_image = '$image', stylist_description = '$description_st' WHERE id = $id";
            $res = $conn->query($sql);
            $conn->commit();
        } catch (Exception $e) {
            echo $e->getMessage();
            $conn->rollback();
        }
        header('Location: addnewst.php');
    }
}
if (isset($_GET['id'])) {
    $id = sanitize($_GET['id']);
    $sql = "SELECT * FROM stylists WHERE id = $id";
    $res = $conn->query($sql);

    if ($res) {
        $current_st = $res->fetch_assoc();

        if ($current_st === null) {
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
    <h1 style="text-align: center;">UPDATE STYLISTS</h1>
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
                        <h5 class="mb-0">Update Stylist</h5>
                    </div>
                    <div class="card-body">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form">
                                <label for="">Ten nha thiet ke: </label>
                                <input type="text" name="name_st" placeholder="Ten nha thiet ke" class="form-control mb-2" value="<?php echo $current_st['stylist_name']; ?>">
                            </div>
                            <div class="form">
                                <label for="">Anh nha thiet ke: </label>
                                <input type="file" name="image" placeholder="Anh san pham" class="form-control mb-2">
                            </div>
                            <div class="form">
                                <label for="">Mo ta nha thiet ke: </label>
                                <input type="text" name="description_st" placeholder="Mo ta nha thiet ke" class="form-control mb-2" value="<?php echo $current_st['stylist_description']; ?>">
                            </div>
                            <div class="form">
                                <input type="submit" name="updatest" value="Update Stylist" class="form-control mb-2 btn btn-warning">
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</body>

</html>