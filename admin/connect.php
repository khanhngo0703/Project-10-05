<?php
$servername = "localhost";
$username = "root";
$password = "";

$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die("Connect failed: " . $conn->connect_error);
}

try {
    $sql = "CREATE DATABASE IF NOT EXISTS project1";

    $res = $conn->query($sql);
} catch (Exception $e) {
    echo "Error creating database" . $e->getMessage();
    die();
}

$conn->select_db("project1");

try {
    $sql = "CREATE TABLE IF NOT EXISTS collections (
        id INT NOT NULL AUTO_INCREMENT,
        collection_name VARCHAR(50) NOT NULL,
        PRIMARY KEY (id)
    )";

    $res = $conn->query($sql);
} catch (Exception $e) {
    echo "Error creating table" . $e->getMessage();
}

try {
    $sql = "CREATE TABLE IF NOT EXISTS stylists (
        id INT NOT NULL AUTO_INCREMENT,
        stylist_name VARCHAR(50) NOT NULL,
        stylist_image VARCHAR(100) NOT NULL,
        stylist_description TEXT NOT NULL,
        PRIMARY KEY (id)
    )";

    $res = $conn->query($sql);
} catch (Exception $e) {
    echo "Error creating table" . $e->getMessage();
}

try {
    $sql = "CREATE TABLE IF NOT EXISTS products (
        id INT NOT NULL AUTO_INCREMENT,
        product_name VARCHAR(50) NOT NULL,
        price FLOAT NOT NULL,
        thumbnail VARCHAR(100) NOT NULL,
        description TEXT NOT NULL,
        collection_id INT NOT NULL,
        stylist_id INT NOT NULL,
        PRIMARY KEY (id),
        FOREIGN KEY (collection_id) REFERENCES collections(id),
        FOREIGN KEY (stylist_id) REFERENCES stylists(id)
    )";

    $res = $conn->query($sql);
} catch (Exception $e) {
    echo "Error creating table" . $e->getMessage();
}

try {
    $sql = "CREATE TABLE IF NOT EXISTS admincp (
        id INT NOT NULL AUTO_INCREMENT,
        admin_username VARCHAR(50) NOT NULL,
        admin_password VARCHAR(50) NOT NULL,
        PRIMARY KEY (id)
    )";

    $res = $conn->query($sql);
} catch (Exception $e) {
    echo "Error creating table" . $e->getMessage();
}

try {
    $sql = "CREATE TABLE IF NOT EXISTS users (
        id INT NOT NULL AUTO_INCREMENT,
        fullname VARCHAR(50) NOT NULL,
        username VARCHAR(50) NOT NULL,
        email VARCHAR(50) NOT NULL,
        phone_number VARCHAR(50) NOT NULL,
        password_hash VARCHAR(50) NOT NULL,
        PRIMARY KEY (id)
    )";

    $res = $conn->query($sql);
} catch (Exception $e) {
    echo "Error creating table" . $e->getMessage();
}

try {
    $sql = "CREATE TABLE IF NOT EXISTS orders (
        id_order INT NOT NULL AUTO_INCREMENT,
        fullname VARCHAR(50) NOT NULL,
        email VARCHAR(50) NOT NULL,
        phone_number VARCHAR(50) NOT NULL,
        address VARCHAR(50) NOT NULL,
        order_date DATETIME NOT NULL,
        PRIMARY KEY (id_order)
    )";

    $res = $conn->query($sql);
} catch (Exception $e) {
    echo "Error creating table" . $e->getMessage();
}

try {
    $sql = "CREATE TABLE IF NOT EXISTS order_details (
        id_orderdetails INT NOT NULL AUTO_INCREMENT,
        order_id INT NOT NULL,
        product_id INT NOT NULL,
        num_product INT NOT NULL,
        price_product FLOAT NOT NULL,
        PRIMARY KEY (id_orderdetails),
        FOREIGN KEY (product_id) REFERENCES products(id),
        FOREIGN KEY (order_id) REFERENCES orders(id_order)
    )";

    $res = $conn->query($sql);
} catch (Exception $e) {
    echo "Error creating table" . $e->getMessage();
}

try {
    $sql = "CREATE TABLE IF NOT EXISTS contact_info (
        id_contact INT NOT NULL AUTO_INCREMENT,
        username_contact VARCHAR(50) NOT NULL,
        email_contact VARCHAR(50) NOT NULL, 
        message_contact TEXT NOT NULL,
        PRIMARY KEY (id_contact)
    )";

    $res = $conn->query($sql);
} catch (Exception $e) {
    echo "Error creating table" . $e->getMessage();
}
