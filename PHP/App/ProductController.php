<?php
session_start();

class ProductController {
  public function getProducts() {
      if (!isset($_SESSION['api_token'])) {
          echo "User not authenticated. Please log in.";
          return;
      }

      $curl = curl_init();

      curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
          CURLOPT_HTTPHEADER => array(
              'Authorization: Bearer ' . $_SESSION['api_token'],  
          ),
      ));

      $response = curl_exec($curl);
      curl_close($curl);

      $response = json_decode($response);

      if (isset($response->data)) {
          return $response->data; 
      } else {
          echo "Fallo en obtener productos";
      }
  }

  public function getProductBySlug($slug) {
    if (!isset($_SESSION['api_token'])) {
        echo "User not authenticated. Please log in.";
        return;
    }

        $curl = curl_init();
        $url = 'https://crud.jonathansoto.mx/api/products/' . urlencode($slug);

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $_SESSION['api_token'],  
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        $response = json_decode($response);
    //    var_dump($response);

        if (isset($response->data)) {
            return $response->data; 
        } else {
            echo "Fallo en obtener productos";
        }
    }

    public function addProduct() {
        if (!isset($_SESSION['api_token'])) {
            echo "User not authenticated. Please log in.";
            return;
        }
    
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $description = isset($_POST['description']) ? $_POST['description'] : '';
    
        if (!$name || !$description) {
            echo "All fields are required!";
            return;
        }
    
        $data = [
            'name' => $name,
            'description' => $description,
        ];
    
        $curl = curl_init();
    
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $_SESSION['api_token'],
                'Content-Type: application/json'
            ),
        ));
    
        $response = curl_exec($curl);
        curl_close($curl);
    
        $response = json_decode($response);
    
        if (isset($response->data)) {
            echo "Product added successfully!";
            header("Location: Productos.php"); 
            exit();
        } else {
            echo "Failed to add product.";
        }
    }











}