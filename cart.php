<?php

include "shared/_header.php";
require_once 'admin/utils.php';
?>

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
            <th>ACT</th>
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
                        <a href="addcart.php?tru=<?php echo $cart['id']; ?>"><i class="fa-solid fa-minus"></i></a>
                        <?php echo $cart['num']; ?>
                        <a href="addcart.php?cong=<?php echo $cart['id']; ?>"><i class="fa-solid fa-plus"></i></a>
                    </td>
                    <td><?php echo number_format($cart['price'], 0, ',', '.') . 'đ'; ?></td>
                    <td><?php echo number_format($money, 0, ',', '.') . 'đ'; ?></td>
                    <td>
                        <div class="col-md-3">
                            <div class="header_right">
                                <div class="header_right_auth">
                                    <a href="addcart.php?xoa=<?php echo $cart['id']; ?>"><button class="btn btn-warning">Delete</button></a>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            <?php
            }
            ?>
            <tr>
                <td colspan="7">
                    <p><strong>Total Money: </strong><?php echo number_format($total_money, 0, ',', '.') . 'đ'; ?></p>
                    <a style="float: right;" class="btn btn-warning" href="addcart.php?xoaall=1">Delete all</a>
                    <div class="" style="clear: both;"></div>
                    <?php
                    if (isset($_SESSION['loggedin'])) {
                    ?>
                        <a class="btn btn-success" href="payment.php">Đặt hàng</a>
                    <?php
                    } else {
                    ?>
                        <a class="btn btn-success" href="register.php">Đăng nhập để đặt hàng</a>
                    <?php
                    }
                    ?>
                </td>
            </tr>
        <?php
        } else {
        ?>
            <tr>
                <td>
                    <p>Gio hang trong!</p>
                </td>
            </tr>
        <?php
        }
        ?>
    </table>
</div>

<?php
include "shared/_footer-contact.php";
?>