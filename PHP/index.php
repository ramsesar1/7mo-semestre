<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f7f7f7;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 500px;
            width: 100%;
        }
        .login-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-top-left-radius: 8px;
            border-bottom-left-radius: 8px;
        }
        .logo-image {
            max-width: 100%;
            height: auto; 
            display: block;
            margin: 0 auto;
        }

        .login-content {
            display: flex;
        }
        @media (max-width: 768px) {
            .login-container {
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="row g-0">
            <div class="col-lg-6 col-md-12">
                <img src="images (9).jpeg" alt="Login Image" class="login-image">
            </div>
            <div class="col-lg-6 col-md-12 d-flex align-items-center">
                <div class="p-4 w-100">
                    <div class="text-center mb-4">
                        <img src="McDonalds-logo.png" alt="Logo" class="logo-image mb-2">
                        <h4>Sign into your account</h4>
                    </div>                        
                    <form method="POST" action="/AppPHP/auth">


                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
                            <div class="form-text">We'll never share your email with anyone else.</div>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
                            </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="checkMeOut">
                            <label class="form-check-label" for="checkMeOut">Check me out</label>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
