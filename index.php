<?php
session_start();
include 'path.php';
$title = 'Student Result Analysis';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="<?php echo ASSETS . 'dyp.png'; ?>" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="<?php echo STYLESHEETS . 'style.css'; ?>">
    <title><?php echo $title ?></title>
</head>

<body>
    <style>
        body {
            background-color: #F6F6FF;
        }

        .logo {
            position: fixed;
            top: 10px;
            left: 10px;
            width: fit-content;
            height: fit-content;
        }
        .container{
            height: 100vh;
        }
        .row{
            height: 100vh;
        }
        .container h2 {
            font-weight: 900;
            font-size: 4rem;
        }
        .container img {
            width: 100%;
            user-select: none;
        }
        .ft{
            font-family: "Gilroy";
        }
    </style>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 col-md-6 px-4 px-md-0">
                <h2 class="ft">Student Result Analysis</h2>
                <div class="mt-4 d-flex flex-column flex-md-row ">
                    <a href="<?php echo STUDENT . 'login.php'; ?>" class="rounded-pill mt-3 mt-md-0 me-0 me-md-3 btn btn-outline-primary">Student Login</a>
                    <a href="<?php echo FACULTY . 'login.php'; ?>" class="rounded-pill mt-3 mt-md-0 me-0 me-md-3 btn btn-outline-primary">Faculty Login</a>
                    <a href="<?php echo ADMIN . 'login.php'; ?>" class="rounded-pill mt-3 mt-md-0 me-0 me-md-3 btn btn-outline-primary">Admin Login</a>
                </div>
            </div>
            <div class="col d-none d-md-block">
                <img src="./assets/grade.png" alt="Bg">
            </div>
        </div>
    </div>
</body>

</html>