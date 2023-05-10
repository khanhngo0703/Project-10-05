<?php
include "shared/_header.php";

if(isset($_POST['timkiem'])) {
    $tukhoa = $_POST['tukhoa'];
}

$sql = "SELECT * FROM collections, products WHERE products.collection_id = collections.id AND products.product_name LIKE '%".$tukhoa."%'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $lst_product_search = $result->fetch_all(MYSQLI_ASSOC);
}
?>


<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3">
            <div class="header_logo">
                <a href="index.html">List Fashion</a>
            </div>
        </div>

        <div class="container">

            <div class="row property_gallery">

                <?php
                foreach ($lst_product_search as $product_search) :
                ?>

                    <div style="width: 25%;" class="col-lg-3 col-md-4 col-sm-6">
                        <div class="product_item">
                            <div class="product_item_pic">

                                <img src="admin/uploads/<?php echo $product_search['thumbnail']; ?>" alt="">

                                <div class="label new">New</div>
                                <ul class="product_hover">
                                    <li><a href="#"><i class="fa fa-arrows-alt"></i></a></li>
                                    <li><a href="#"><i class="fa-regular fa-heart"></i></a></li>
                                    <li><a href="productdetails.php?id=<?php echo $product_search['id']; ?>"><i class="fa-solid fa-cart-shopping"></i></a></li>
                                </ul>


                            </div>
                            <div class="product_item_text">

                                <h6><a href="#"><?php echo $product_search['product_name']; ?></a></h6>
                                <div class="product_price"><?php echo $product_search['price'] . 'đ'; ?></div>
                                <div class="rating">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                </div>


                            </div>
                        </div>

                    </div>


                <?php
                endforeach;
                ?>

            </div>


        </div>
    </div>
</div>
<?php
include "shared/_footer.php";
?>