<?php
require_once 'connect.php';
require_once 'utils.php';
if (isset($_POST['name'])) {
    $name = sanitize($_POST['name']);
    $image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $image = time() . '_' . $image;
    $description_stylist = sanitize($_POST['description']);

    try {
        $conn->begin_transaction();
        $sql = "INSERT INTO stylists(stylist_name, stylist_image, stylist_description) VALUES ('$name', '$image', '$description_stylist')";
        $res = $conn->query($sql);
        move_uploaded_file($image_tmp, 'uploads/' . $image);

        $conn->commit();
        header('Location: index.php');
    } catch (Exception $e) {
        echo $e->getMessage();
        $conn->rollback();
    }

}

$sql = "SELECT * FROM stylists";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $lst_stylist = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $lst_stylist = [];
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
    <h1 style="text-align: center;">ADD STYLISTS</h1>
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
                        <h5 class="mb-0">Add new Stylist</h5>
                    </div>
                    <div class="card-body">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form">
                                <label for="">Ten nha thiet ke: </label>
                                <input type="text" name="name" placeholder="Ten nha thiet ke" class="form-control mb-2">
                            </div>
                            <div class="form">
                                <label for="">Anh nha thiet ke: </label>
                                <input type="file" name="image" placeholder="Anh san pham" class="form-control mb-2">
                            </div>
                            <div class="form">
                                <label for="">Mo ta nha thiet ke: </label>
                                <input type="text" name="description" placeholder="Mo ta nha thiet ke" class="form-control mb-2">
                            </div>
                            <div class="form">
                                <button class="btn btn-primary mb-2">Them nha thiet ke</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Danh sach nha thiet ke</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-reponsive">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Anh</th>
                                    <th>Stylist</th>
                                    <th>Mo ta</th>
                                    <th>Cap nhat</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 0;
                                foreach ($lst_stylist as $stylist) :
                                    $i++;
                                ?>
                                    <tr>
                                        <td><?php echo $i ?></td>
                                        <td><img style="height: 50px;" src="/admin/uploads/<?php echo $stylist['stylist_image'] ?>"></td>
                                        <td><?php echo $stylist['stylist_name'] ?></td>
                                        <td><?php echo $stylist['stylist_description'] ?></td>
                                        <td><a href="updatest.php?id=<?php echo $stylist['id']; ?>" class="btn btn-warning me-2">Update</a>
                                            <a onclick="deleteSV(event)" href="delete_st.php?id=<?php echo $stylist['id']; ?>" class="btn btn-danger" id="btn-xoa">Delete</a>
                                        </td>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script>
        document.querySelectorAll('#btn-xoa').forEach(function(elm, index) {
            elm.addEventListener('click', function(e) {
                console.log(e);
                e.preventDefault();
                let url = e.target.href;
                let isDelete = confirm('Ban co muon xoa khong');
                if (isDelete === true) {
                    window.location.href = url;
                }
            });
        })
    </script>
</body>

</html>