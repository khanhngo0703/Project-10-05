<?php
require_once 'connect.php';
require_once 'utils.php';

if (isset($_GET['id'])) {
    $id = sanitize($_GET['id']);
    try {
        $conn->begin_transaction();
        $sql = "DELETE FROM products WHERE collection_id = $id";
        $conn->query($sql);
        $conn->commit();
    } catch (Exception $e) {
        echo $e->getMessage();
        $conn->rollback();
    }
    try {
        $conn->begin_transaction();
        $sql = "DELETE FROM collections WHERE id = $id";
        $conn->query($sql);
        $conn->commit();
        header('Location: addnewcl.php');
    } catch (Exception $e) {
        echo $e->getMessage();
        $conn->rollback();
    }
}