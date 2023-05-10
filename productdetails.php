<?php
include "shared/_header.php";

$id = $_GET['id'];

$sql = "SELECT * FROM `products` p INNER JOIN collections c on p.collection_id = c.id INNER JOIN stylists s on p.collection_id = s.id WHERE p.id = $id;";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $lst_productdetails = $result->fetch_all(MYSQLI_ASSOC);
}

?>

<?php
foreach ($lst_productdetails as $productdetails) :
?>
    <div class="container">
        <div class="product_details_image">
            <img class="pic" src="admin/uploads/<?php echo $productdetails['thumbnail']; ?>">
        </div>
        <form action="addcart.php?id=<?php echo $id; ?>" method="post">
            <div>
                <div class="detail">
                    <h2><?php echo $productdetails['product_name']; ?></h2>
                </div>
                <div class="detail">
                    <p><strong>Product price:</strong> <?php echo number_format($productdetails['price'], 0, ',', '.') . 'đ'; ?></p>
                </div>                
                <div class="detail">
                    <p><strong>Design by:</strong> <?php echo $productdetails['stylist_name']; ?></p>
                </div>
                <div class="detail">
                    <p><strong>Collection:</strong> <?php echo $productdetails['collection_name']; ?></p>
                </div>
                <div class="detail">
                    <p><strong>Description:</strong> <?php echo $productdetails['description']; ?></p>
                </div>
                <div class="col-lg-3">
                    <div class="header_right">
                        <div class="header_right_auth">
                            <input type="submit" name="addprd" class="btn btn-warning" value="Add to Cart">
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>

<?php
endforeach;
?>

<?php
include "shared/_footer.php";
?>