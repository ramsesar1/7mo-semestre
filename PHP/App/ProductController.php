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


    public function updateProduct($data) {
        if (!isset($_SESSION['api_token'])) {
            return ['error' => 'User not authenticated'];
        }
    
        $curl = curl_init();
        $formData = [
            'id' => $data['id'],
            'name' => $data['name'],
            'description' => $data['description']
        ];
    
        if (isset($_FILES['cover']) && $_FILES['cover']['size'] > 0) {
            $uploadDir = '/opt/lampp/temp/';
            $uploadFile = $uploadDir . basename($_FILES['cover']['name']);
            
            if (move_uploaded_file($_FILES['cover']['tmp_name'], $uploadFile)) {
                $formData['cover'] = new CURLFILE(realpath($uploadFile));
            }
        }
    
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_POSTFIELDS => http_build_query($formData),
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $_SESSION['api_token'],
                'Content-Type: application/x-www-form-urlencoded'
            ),
        ));
    
        $response = curl_exec($curl);
        curl_close($curl);
        
        return json_decode($response);
    }


    function deleteProduct($product)
    {
        $curl = curl_init();
    
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products/' . $product['id'],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'DELETE',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $_SESSION['api_token'],
            ),
        ));
    
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }
    






}