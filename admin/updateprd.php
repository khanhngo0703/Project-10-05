<?php
require_once 'connect.php';
require_once 'utils.php';

$errors = [];

if (isset($_POST['updateprd'])) {
    $product = isset($_POST['product']) ? sanitize($_POST['product']) : '';
    $price = isset($_POST['price']) ? sanitize($_POST['price']) : '';
    $quantity = isset($_POST['quantity']) ? sanitize($_POST['quantity']) : '';
    $image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $image = time() . '_' . $image;
    $description = isset($_POST['description']) ? sanitize($_POST['description']) : '';
    $stylist_id = isset($_POST['stylist']) ? sanitize($_POST['stylist']) : '';
    $collection_id = isset($_POST['collection']) ? sanitize($_POST['collection']) : '';

    if (count($errors) === 0) {
        $id = sanitize($_GET['id']);

        try {
            $conn->begin_transaction();
            move_uploaded_file($image_tmp, 'uploads/' . $image);
            $sql = "UPDATE products SET product_name = '$product', price = '$price', thumbnail = '$image', description = '$description', collection_id = '$collection_id', stylist_id = '$stylist_id' WHERE id = $id";
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
    $sql = "SELECT * FROM products WHERE id = $id";
    $res = $conn->query($sql);

    if ($res) {
        $current_prd = $res->fetch_assoc();

        if ($current_prd === null) {
            header('Location: index.php');
        }
    }
} else {
    header('Location: index.php');
}

// get all stylist
$stylist_display = [];
try {
    $sql = "SELECT * FROM stylists";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $stylist_display = $result->fetch_all(MYSQLI_ASSOC);
    }
} catch (Exception $e) {
    echo $e->getMessage();
}

$collection_display = [];
try {
    $sql = "SELECT * FROM collections";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $collection_display = $result->fetch_all(MYSQLI_ASSOC);
    }
} catch (Exception $e) {
    echo $e->getMessage();
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
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Update Product</h5>
            </div>
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form">
                        <label for="">Ten san pham: </label>
                        <input type="text" name="product" placeholder="Ten san pham" class="form-control mb-2" value="<?php echo $current_prd['product_name']; ?>">
                    </div>
                    <div class="form">
                        <label for="">Gia san pham: </label>
                        <input type="text" name="price" placeholder="Gia san pham" class="form-control mb-2" value="<?php echo $current_prd['price']; ?>">
                    </div>
                    <div class="form">
                        <label for="">Anh san pham: </label>
                        <input type="file" name="image" placeholder="Anh san pham" class="form-control mb-2" value="<?php echo $current_prd['thumbnail']; ?>">
                    </div>
                    <div class="form">
                        <label for="">Mo ta san pham: </label>
                        <textarea name="description" class="form-control mb-2"><?php echo $current_prd['description']; ?></textarea>
                    </div>
                    <div class="form">
                        <label for="">Nha thiet ke san pham: </label>
                        <select name="stylist" class="form-control mb-2">
                            <?php
                            foreach ($stylist_display as $stylist) :
                            ?>
                                <option <?php echo $selected = ($current_prd['stylist_id'] === $stylist['id']) ? 'selected' : ''; ?> value="<?php echo $stylist['id'] ?>"><?php echo $stylist['stylist_name'] ?></option>
                            <?php
                            endforeach;
                            ?>
                        </select>
                        <a class="btn btn-primary" href="addnewst.php" id="themmon">Add Stylist</a>
                    </div>
                    <div class="form">
                        <label for="">Bo suu tap san pham: </label>
                        <select name="collection" class="form-control mb-2">
                            <?php
                            foreach ($collection_display as $collection) :
                            ?>
                                <option <?php echo $selected = ($current_prd['collection_id'] === $collection['id']) ? 'selected' : ''; ?> value="<?php echo $collection['id'] ?>"><?php echo $collection['collection_name'] ?></option>
                            <?php
                            endforeach;
                            ?>
                        </select>
                        <a class="btn btn-primary" href="addnewcl.php" id="themmon">Add Collection</a>
                    </div>
                    <div class="form">
                        <input type="submit" name="updateprd" value="Update Product" class="form-control mb-2 btn btn-warning">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('description');
    </script>
</body>

</html>