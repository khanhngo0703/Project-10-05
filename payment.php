<?php

include "shared/_header.php";
require_once 'admin/utils.php';

if (isset($_POST['payment'])) {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $order_date = date('Y-m-d H:i:s');

    $cart = [];
    if (isset($_SESSION['cart'])) {
        $cart = $_SESSION['cart'];
    }

    $sql = "INSERT INTO orders(fullname, email, phone_number, address, order_date) VALUES ('$fullname', '$email', '$phone', '$address', '$order_date')";
    $res = $conn->query($sql);

    $sql = "SELECT * FROM orders WHERE order_date = '$order_date'";
    $res = $conn->query($sql);
    $lst_order = $res->fetch_all(MYSQLI_ASSOC);

    foreach ($lst_order as $order) {
        $order_id = $order['id_order'];
    }


    foreach ($cart as $items) {
        $product_id = $items['id'];
        $num = $items['num'];
        $price = $items['price'];
        $sql = "INSERT INTO order_details(order_id, product_id, num_product, price_product) VALUES ('$order_id', '$product_id', '$num', '$price')";
        $result = $conn->query($sql);
    }

    unset($_SESSION['cart']);

    header('Location: complete.php');
    die();
}
?>
<form action="" method="post">
    <div>
        <div class="title-cart">
            <div>CART</div>
        </div>
        <table>
            <tr class="tieude">
                <th>STT</th>
                <th>IMAGE</th>
                <th>NAME</th>
                <th>QUANTITY</th>
                <th>UNIT PRICE</th>
                <th>INTO MONEY</th>
            </tr>
            <?php

            if (isset($_SESSION['cart'])) {
                $i = 0;
                $total_money = 0;
                foreach ($_SESSION['cart'] as $cart) {
                    $money = $cart['num'] * $cart['price'];
                    $total_money += $money;
                    $i++;
            ?>
                    <tr class="tieude">
                        <td><?php echo $i; ?></td>
                        <td>
                            <img class="picture" src="admin/uploads/<?php echo $cart['thumbnail']; ?>" alt="">
                        </td>
                        <td><?php echo $cart['product_name']; ?></td>
                        <td>
                            <?php echo $cart['num']; ?>
                        </td>
                        <td><?php echo number_format($cart['price'], 0, ',', '.') . 'đ'; ?></td>
                        <td><?php echo number_format($money, 0, ',', '.') . 'đ'; ?></td>

                    </tr>
                <?php
                }
                ?>
                <tr>
                    <td colspan="7">
                        <p>Total Money: <?php echo number_format($total_money, 0, ',', '.') . 'đ'; ?></p>
                        <div class="" style="clear: both;"></div>
                        <div class="card">
                            <div class="card-header">
                                <h3>Please fill in the information to pay for the order</h3>
                            </div>
                            <div class="card-body">
                                <div class="form">
                                    <label>Full Name: </label>
                                    <input type="text" required name="fullname" class="form-control mb-2">
                                </div>
                                <div class="form">
                                    <label>Email: </label>
                                    <input type="email" required name="email" class="form-control mb-2">
                                </div>
                                <div class="form">
                                    <label>Phone Number: </label>
                                    <input type="text" required name="phone" class="form-control mb-2">
                                </div>
                                <div class="form">
                                    <label>Address: </label>
                                    <input type="text" required name="address" class="form-control mb-2">
                                </div>
                            </div>
                        </div>
                        <button style="width: 33%; margin-left: 9px;" type="submit" class="btn btn-success" name="payment">Payment</button>

                    </td>
                </tr>

            <?php
            }
            ?>
        </table>
    </div>
</form>
<?php
include "shared/_footer-contact.php";
?>