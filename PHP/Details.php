<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detalle del Producto</title>
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
      .main-content {
        flex-grow: 1;
        padding: 20px;
      }
    </style>
  </head>
  <body>
    <!-- Sidebar -->
    <div class="sidebar text-white p-3">
      <h2>Sidebar</h2>
      <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link text-white" href="#">Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="#">Productos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="#">Clientes</a>
        </li>
      </ul>
    </div>

    <div class="main-content">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">Navbar</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="index.html">Inicio</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Enlace</a>
              </li>
            </ul>
          </div>
          <form class="d-flex">
            <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Buscar">
            <button class="btn btn-outline-success" type="submit">Buscar</button>
          </form>
        </div>
      </nav>

      <h1>Detalle del Producto</h1>
      <div class="card mb-3">
        <div class="row g-0">
          <div class="col-md-4">
            <img src="https://via.placeholder.com/150" class="img-fluid rounded-start" alt="Producto">
          </div>
          <div class="col-md-8">
            <div class="card-body">
              <h5 class="card-title">Nombre del Producto</h5>
              <p class="card-text">$100.00 MXN</p>
              <p class="card-text">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Culpa veritatis voluptate hic, quasi eum velit odit molestiae neque soluta, sapiente at enim odio optio earum quidem a quae, nulla sit!</p>
              <button class="btn btn-primary">Comprar ahora</button>
              <button class="btn btn-secondary">Añadir al carrito</button>
            </div>
          </div>
        </div>
      </div>

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Historial de pedidos</h5>
          <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">First</th>
                <th scope="col">Last</th>
                <th scope="col">Handle</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
              </tr>
              <tr>
                <th scope="row">2</th>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@fat</td>
              </tr>
              <tr>
                <th scope="row">3</th>
                <td colspan="2">Larry the Bird</td>
                <td>@twitter</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
