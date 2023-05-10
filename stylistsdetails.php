<?php
include "shared/_header.php";

$id = $_GET['id'];

$sql = "SELECT * FROM stylists INNER JOIN products ON stylists.id = products.stylist_id WHERE stylists.id = $id LIMIT 1;";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $lst_stylistsdetail = $result->fetch_all(MYSQLI_ASSOC);
}

$sql = "SELECT * FROM stylists INNER JOIN products ON stylists.id = products.stylist_id WHERE stylists.id = $id;";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $lst_stylistsdetails = $result->fetch_all(MYSQLI_ASSOC);
}
?>

<div class="container-fluid">

    <div class="row">

        <div class="col-lg-3">
            <div class="header_logo">
                <a href="#">Designer Info</a>
            </div>
        </div>
        <div class="container" style="justify-content: center;">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="section-title">
                        <h4>DESIGNER</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <?php
            foreach ($lst_stylistsdetail as $stylistsdetail) :
            ?>
                <div class="single-method col-4">
                    <img src="admin/uploads/<?php echo $stylistsdetail['stylist_image']; ?>">
                </div>

                <div class="Designer col-8">
                    <ul>
                        <li>
                            <h5>Thông tin của nhà Thiết kế:</h5>
                        </li> <br>
                        <li><?php echo $stylistsdetail['stylist_name']; ?></li> <br>
                        <li><?php echo $stylistsdetail['stylist_description']; ?></li> <br>
                    </ul>

                </div>
            <?php
            endforeach;
            ?>
        </div>


    </div>

</div>

<div class="bestseller">
    <h4 style="text-align: center;">LIST PRODUCT</h4>
    <div class="item">
        <div class="product_item row">
            <?php
            foreach ($lst_stylistsdetails as $stylistsdetails) :
            ?>
                <div class="all_item col-4">
                    <div class="product_item_pic">
                        <img src="admin/uploads/<?php echo $stylistsdetails['thumbnail']; ?>" alt="">

                    </div>
                    <div class="product_item_text">
                        <h6><?php echo $stylistsdetails['product_name']; ?></h6>
                        <div class="rating">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>
                    </div>
                </div>
            <?php
            endforeach;
            ?>

        </div>

    </div>
</div>

<?php
include "shared/_footer.php";
?>