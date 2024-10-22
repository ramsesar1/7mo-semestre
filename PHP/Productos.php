<?php
include 'App/ProductController.php';  

if (!isset($_SESSION['api_token'])) {
    header("Location: index.php");
    exit();
}

$controller = new ProductController();
$products = $controller->getProducts($_SESSION['api_token']);  
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Product Page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      display: flex;
    }
    .sidebar {
      width: 250px;
      height: 100vh;
      background-color: #343a40;
    }
    .sidebar .nav-link {
      color: white;
    }
    .sidebar .nav-link.active {
      background-color: #007bff;
    }
    .content {
      padding: 20px;
      width: 100%;
    }
    .navbar {
      margin-bottom: 20px;
    }
    .hidden {
      display: none; 
    }
  </style>
</head>
<body>
  <!-- Sidebar -->
  <div class="sidebar d-flex flex-column p-3">
    <h4 class="text-light">Sidebar</h4>
    <ul class="nav nav-pills flex-column mb-auto">
      <li class="nav-item">
        <a href="#" class="nav-link active" aria-current="page">Home</a>
      </li>
      <li>
        <a href="#" class="nav-link">Dashboard</a>
      </li>
      <li>
        <a href="#" class="nav-link">Orders</a>
      </li>
      <li>
        <a href="#" class="nav-link">Products</a>
      </li>
      <li>
        <a href="#" class="nav-link">Customers</a>
      </li>
    </ul>
    <hr>
    <div class="dropdown">
      <a href="#" class="d-flex align-items-center text-light text-decoration-none dropdown-toggle" data-bs-toggle="dropdown">
        <img src="https://via.placeholder.com/32" alt="mdo" class="rounded-circle me-2">
        <strong>mdo</strong>
      </a>
      <ul class="dropdown-menu dropdown-menu-dark">
        <li><a class="dropdown-item" href="#">Profile</a></li>
        <li><a class="dropdown-item" href="#">Settings</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item" href="#">Log out</a></li>
      </ul>
    </div>
  </div>

  <div class="content">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Navbar scroll</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
            </li>
          </ul>
          <form class="d-flex">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
          </form>
          <ul class="navbar-nav ms-3">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="https://via.placeholder.com/32" alt="Profile" class="rounded-circle">
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#">Profile</a></li>
                <li><a class="dropdown-item" href="#">Settings</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#">Logout</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <h3>Add Product</h3>
    <button id="toggleFormButton" class="btn btn-primary mb-3">Add Product</button>
    
    <div id="addProductForm" class="hidden">
      <form action="add_product.php" method="POST" class="mb-4">
        <div class="mb-3">
          <label for="productName" class="form-label">Product Name</label>
          <input type="text" class="form-control" id="productName" name="name" required>
        </div>
        <div class="mb-3">
          <label for="productDescription" class="form-label">Product Description</label>
          <textarea class="form-control" id="productDescription" name="description" required></textarea>
        </div>
        <div class="mb-3">
          <label for="productImage" class="form-label">Product Image URL</label>
          <input type="url" class="form-control" id="productImage" name="cover" required>
        </div>
        <button type="submit" class="btn btn-success">Confirm Add Product</button>
        <button type="button" id="cancelButton" class="btn btn-secondary">Cancel</button>
      </form>
    </div>

    <!-- Editar producto -->
    <div id="editProductForm" class="hidden">
      <form action="edit_product.php" method="POST" class="mb-4">
        <input type="hidden" id="editProductId" name="id">
        <div class="mb-3">
          <label for="editProductName" class="form-label">Product Name</label>
          <input type="text" class="form-control" id="editProductName" name="name" required>
        </div>
        <div class="mb-3">
          <label for="editProductDescription" class="form-label">Product Description</label>
          <textarea class="form-control" id="editProductDescription" name="description" required></textarea>
        </div>
        <div class="mb-3">
          <label for="editProductImage" class="form-label">Product Image URL</label>
          <input type="url" class="form-control" id="editProductImage" name="cover" required>
        </div>
        <button type="submit" class="btn btn-warning">Confirm Edit</button>
        <button type="button" id="cancelEditButton" class="btn btn-secondary">Cancel</button>
      </form>
    </div>
    
    <!-- Tarjetas de los productos -->
    <div class="row row-cols-1 row-cols-md-3 g-4">
      <?php
      foreach ($products as $product) {
          $name = $product->name; 
          $image = $product->cover; 
          $description = $product->description; 
          $id = $product->id; 
      ?>
      <div class="col">
        <div class="card h-100">
          <img src="<?php echo $image; ?>" class="card-img-top" alt="Product Image">
          <div class="card-body">
            <h5 class="card-title"><?php echo $name; ?></h5>
            <p class="card-text"><?php echo $description; ?></p>
            <a href="Details.php?slug=<?php echo urlencode($product->slug); ?>&id=<?php echo $id; ?>" class="btn btn-primary">View Details</a>
            <button class="btn btn-warning editButton" data-id="<?php echo $id; ?>" data-name="<?php echo $name; ?>" data-description="<?php echo $description; ?>" data-image="<?php echo $image; ?>">Edit</button>
            <form action="delete_product.php" method="POST" style="display:inline;">
              <input type="hidden" name="id" value="<?php echo $id; ?>">
              <button type="submit" class="btn btn-danger">Delete</button>
            </form>
          </div>
        </div>
      </div>
      <?php
      }
      ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      document.getElementById('toggleFormButton').addEventListener('click', function() {
        var form = document.getElementById('addProductForm');
        form.classList.toggle('hidden');
      });

      document.getElementById('cancelButton').addEventListener('click', function() {
        document.getElementById('addProductForm').classList.add('hidden');
      });

      document.getElementById('cancelEditButton').addEventListener('click', function() {
        document.getElementById('editProductForm').classList.add('hidden');
      });

      document.querySelectorAll('.editButton').forEach(button => {
        button.addEventListener('click', function() {
          var id = this.dataset.id;
          var name = this.dataset.name;
          var description = this.dataset.description;
          var image = this.dataset.image;

          document.getElementById('editProductId').value = id;
          document.getElementById('editProductName').value = name;
          document.getElementById('editProductDescription').value = description;
          document.getElementById('editProductImage').value = image;

          document.getElementById('editProductForm').classList.remove('hidden');
        });
      });
    </script>
  </div>
</body>
</html>
