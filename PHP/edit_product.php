<?php
session_start();
include 'App/ProductController.php';

if (!isset($_SESSION['api_token'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new ProductController();
    $result = $controller->updateProduct($_POST);

    if (isset($result->code) && $result->code == 200) {
        $_SESSION['success_message'] = "Product updated successfully!";
    } else {
        $_SESSION['error_message'] = "Error updating product: " . 
            (isset($result->message) ? $result->message : 
            (isset($result->error) ? $result->error : "Unknown error"));
    }
}

header("Location: Productos.php");
exit();