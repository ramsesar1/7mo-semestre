<?php
session_start();

if (!isset($_SESSION['api_token'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'] ?? '';
    $description = $_POST['description'] ?? '';
    $cover = $_FILES['cover']['tmp_name'] ?? '';
    $cover_name = $_FILES['cover']['name'] ?? '';
    $brand_id = '1';
    $categories = [3, 4];
    $tags = [3, 4];

    if (!empty($name) && !empty($description) && !empty($cover)) {
        $curl = curl_init();

        $file = new CURLFILE($cover, mime_content_type($cover), $cover_name);

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'name' => $name,
                'slug' => strtolower(str_replace(' ', '-', $name)),
                'description' => $description,
                'features' => 'Algunas características adicionales',
                'brand_id' => $brand_id,
                'cover' => $file,
                'categories[0]' => $categories[0],
                'categories[1]' => $categories[1],
                'tags[0]' => $tags[0],
                'tags[1]' => $tags[1],
            ),
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $_SESSION['api_token'],
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        $response = json_decode($response);

        if (isset($response->data)) {
            header("Location: Productos.php");
        } else {
            echo "Error: " . $response->message;
        }
    } else {
        echo "All fields are required.";
    }
} else {
    header("Location: Productos.php");
}
