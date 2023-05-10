<?php
session_start();

require_once 'admin/connect.php';
require_once 'admin/utils.php';
// cong san pham
if (isset($_GET['cong'])) {
    $id = $_GET['cong'];
    $cart = [];
    if (isset($_SESSION['cart'])) {
        $cart = $_SESSION['cart'];
        for ($i = 0; $i < count($cart); $i++) {
            if ($cart[$i]['id'] == $id) {
                $cart[$i]['num'] += 1;
            }
        }
    }
    $_SESSION['cart'] = $cart;

    header('Location: cart.php');
}

// tru san pham
if (isset($_GET['tru'])) {
    $id = $_GET['tru'];
    $cart = [];
    if (isset($_SESSION['cart'])) {
        $cart = $_SESSION['cart'];
        for ($i = 0; $i < count($cart); $i++) {
            if ($cart[$i]['id'] == $id) {
                $cart[$i]['num'] -= 1;
                if ($cart[$i]['num'] <= 0) {
                    array_splice($cart, $i, 1);
                }
            }
        }
    }
    $_SESSION['cart'] = $cart;

    header('Location: cart.php');
}

// xoa 1 san pham
if (isset($_GET['xoa'])) {
    $id = $_GET['xoa'];
    $cart = [];
    if (isset($_SESSION['cart'])) {
        $cart = $_SESSION['cart'];
        for ($i = 0; $i < count($cart); $i++) {
            if ($cart[$i]['id'] == $id) {
                array_splice($cart, $i, 1);
            }
        }
    }
    $_SESSION['cart'] = $cart;

    header('Location: cart.php');
}



// xoa tat ca san pham
if (isset($_GET['xoaall']) && $_GET['xoaall'] == 1) {
    unset($_SESSION['cart']);
    header('Location: cart.php');
}

// them san pham vao gio hang
if (isset($_POST['addprd'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM products WHERE id = '$id'";
    $result = $conn->query($sql);
    $row = $result->fetch_all(MYSQLI_ASSOC);
    // $row = $result->fetch_assoc();
    if ($row) {
        $new_product = array(array(
            'product_name' => $row[0]['product_name'],
            'id' => $id,
            'num' => 1,
            'price' => $row[0]['price'],
            'thumbnail' => $row[0]['thumbnail']
        ));
        if (isset($_SESSION['cart'])) {
            $found = false;
            for ($i = 0; $i < count($_SESSION['cart']); $i++) {
                if ($_SESSION['cart'][$i]['id'] == $id) {
                    $_SESSION['cart'][$i]['num'] += 1;
                    $found = true;
                }
            }

            if ($found == false) {
                $_SESSION['cart'] = array_merge($_SESSION['cart'], $new_product);
            }
        } else {
            $_SESSION['cart'] = $new_product;
        }
    }
    header('Location: cart.php');
}
