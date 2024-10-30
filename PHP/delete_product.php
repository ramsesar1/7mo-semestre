<?php
session_start();

require_once 'App/ProductController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {

    $productController = new ProductController();
    
    $product = ['id' => $_POST['id']];
    
    $response = $productController->deleteProduct($product);

    $responseData = json_decode($response, true);

    if (isset($responseData['success']) && $responseData['success'] === true) {
        $_SESSION['success_message'] = "Product deleted successfully.";
    } else {
        $_SESSION['error_message'] = "Failed to delete the product.";
    }

    header('Location: /AppPHP/products');
    exit();
} else {
    $_SESSION['error_message'] = "Invalid request.";
    header('Location: /AppPHP/products');
    exit();
}
?>
