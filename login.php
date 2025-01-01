<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .login-page {
            width: 100%;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .logo {
            position: absolute;
            top: 20px;
            right: 20px;
            max-height: 50px;
            width: auto;
        }

        .form-right i {
            font-size: 100px;
        }

        .back-arrow {
            position: absolute;
            top: 20px;
            left: 20px;
            font-size: 1.5rem;
            color: #333;
            text-decoration: none;
        }

        .title-text {
            margin-bottom: 20px;
            font-size: 1.5rem;
            font-weight: bold;
            text-align: center;
        }

        label {
            font-weight: normal;
        }
    </style>
</head>

<body>
    <div class="login-page bg-light">
        <img src="Logo_PTBA_R3011.png" class="logo">

        <a href="index.html" class="back-arrow">
            <i class="bi bi-arrow-left"></i>
        </a>

        <div class="container">
            <div class="title-text">
                Welcome Back to Assist Me
            </div>
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="bg-white shadow rounded">
                        <div class="row">
                            <div class="col-md-7 pe-0">
                                <div class="form-left h-100 py-5 px-5">
                                    <form action="http://192.168.100.162:8081/ts/save_ticket.php" method="POST" class="row g-4">
                                        <div class="col-12">
                                            <label for="username">Email <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="bi bi-person-fill"></i></div>
                                                <input type="text" name="temail" id="temail" class="form-control" placeholder="Email" required>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="password">Password <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="bi bi-lock-fill"></i></div>
                                                <input type="password" name="tpwd" id="tpwd" class="form-control" placeholder="Password" required>
                                            </div>
                                        </div>

                                        <div class="col-12 text-center">
                                            <button type="submit" name="blogin" class="btn btn-primary px-4 mt-4">Login</button>
                                        </div>

                                        <div class="col-12 text-center mt-2">
                                            <p>Don't have an account? <a href="register.html" class="text-primary">Sign Up</a></p>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="col-md-5 ps-0 d-none d-md-block">
                                <div class="form-right h-100 bg-primary text-white text-center pt-5">
                                    <i class="bi-key-fill"></i>
                                    <h2 class="fs-1">Login User</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</
