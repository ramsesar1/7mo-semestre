<?php
session_start();

if (!isset($_SESSION['api_token'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'] ?? '';
    $name = $_POST['name'] ?? '';
    $description = $_POST['description'] ?? '';
    $cover = $_FILES['cover']['tmp_name'] ?? '';
    $cover_name = $_FILES['cover']['name'] ?? '';

    if (!empty($id) && !empty($name) && !empty($description)) {
        $curl = curl_init();

        if (!empty($cover)) {
            $file = new CURLFile($cover, mime_content_type($cover), $cover_name);
            $data = [
                'name' => $name,
                'description' => $description,
                'cover' => $file
            ];
        } else {
            $data = [
                'name' => $name,
                'description' => $description
            ];
        }

        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products/' . $id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'PUT', 
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => [
                'Authorization: Bearer ' . $_SESSION['api_token']
            ],
        ]);

        $response = curl_exec($curl);

        if ($response === false) {
            echo 'Curl error: ' . curl_error($curl);
        } else {
            echo '<pre>Raw API Response: ' . htmlspecialchars($response) . '</pre>';

            $responseData = json_decode($response);

            if (json_last_error() === JSON_ERROR_NONE) {
                if (isset($responseData->success)) {
                    if ($responseData->success) {
                        header('Location: Productos.php'); 
                        exit();
                    } else {
                        echo 'Error: ' . ($responseData->message ?? "No message available.");
                    }
                } else {
                    echo 'Success property not found in response.';
                }
            } else {
                echo 'Response JSON could not be decoded: ' . json_last_error_msg();
            }
        }
        curl_close($curl);
    } else {
        echo 'All fields are required.';
    }
}
