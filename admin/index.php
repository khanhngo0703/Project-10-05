<?php
session_start();
require_once 'connect.php';

if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = '';
}

if ($page == '' || $page == 1) {
    $begin = 0;
} else {
    $begin = ($page * 4) - 4;
}

$sql = "SELECT products.*, collection_name, stylist_name from products inner join collections on products.collection_id = collections.id inner join stylists on products.stylist_id = stylists.id LIMIT $begin, 4";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $lst_prd = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $lst_prd = [];
}

if (isset($_GET['logout']) && $_GET['logout'] == true) {
    session_destroy();
    header('Location: login.php');
}

if (!isset($_SESSION['loginad'])) {
    header('Location: login.php');
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
    <h1 style="text-align: center;">WELCOME TO ADMINCP</h1>
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
                        <h5 class="mb-0">Danh sach san pham</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-reponsive">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Anh</th>
                                    <th>Ten SP</th>
                                    <th>Gia</th>
                                    <th>Mo ta</th>
                                    <th>Collection</th>
                                    <th>Stylist</th>
                                    <th>Cap nhat</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($lst_prd as $prd) :
                                ?>
                                    <tr>
                                        <td><?php echo $prd['id'] ?></td>
                                        <td><img style="height: 50px;" src="uploads/<?php echo $prd['thumbnail'] ?>"></td>
                                        <td><?php echo $prd['product_name'] ?></td>
                                        <td><?php echo number_format($prd['price'], 0, ',', '.') . 'đ'; ?></td>
                                        <td><?php echo $prd['description'] ?></td>
                                        <td><?php echo $prd['collection_name'] ?></td>
                                        <td><?php echo $prd['stylist_name'] ?></td>
                                        <td><a href="updateprd.php?id=<?php echo $prd['id']; ?>" class="btn btn-warning me-2">Update</a>
                                            <a onclick="deleteSV(event)" href="deleteprd.php?id=<?php echo $prd['id']; ?>" class="btn btn-danger" id="btn-xoa">Delete</a>
                                        </td>
                                    </tr>
                                <?php
                                endforeach;
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
                <?php
                $sql = "SELECT products.*, collection_name, stylist_name from products inner join collections on products.collection_id = collections.id inner join stylists on products.stylist_id = stylists.id";
                $result = $conn->query($sql);
                $row_count = $result->num_rows;

                $trang = ceil($row_count / 4);
                ?>
                <nav aria-label="Page navigation example">
                    <ul style="width: 233px; margin: 0 auto;" class="pagination">
                        <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                        <?php
                        for ($i = 1; $i <= $trang; $i++) {

                        ?>
                            <li class="page-item"><a class="page-link" href="index.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                        <?php
                        }
                        ?>
                        <li class="page-item"><a class="page-link" href="#">Next</a></li>

                    </ul>
                </nav>
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