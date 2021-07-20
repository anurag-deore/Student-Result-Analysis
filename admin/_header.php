<?php
session_start();
error_reporting(E_NOTICE && E_WARNING);

include '../path.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] != "admin") {
    header("location:" . HOME);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo ASSETS . 'dyp.png'; ?>" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="<?php echo STYLESHEETS . 'style.css'; ?>">
    <title><?php echo $title ?></title>
    <style>
        body {
            background-color: <?php echo $theme['secondary'] ?>;
            color: <?php echo $theme['text'] ?>;
        }

        .bi,
        .dropdown-toggle::after {
            color: <?php echo $theme['text'] ?>;
        }
    </style>
</head>

<body>
    <!-- Image and text -->
    <nav class="navbar navbar-light navbar-expand-lg shadow-sm" style="background-color: <?php echo $theme['primary'] ?>;">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?php echo ADMIN . 'dashboard.php'; ?>">
                <img src="<?php echo ASSETS . $theme['logo']; ?>" alt="" width="110" class="d-inline-block align-top">
            </a>
            <div class=" justify-content-end" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person h3"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg-end dropdown-menu-dark" aria-labelledby="navbarDropdownMenuLink">
                            <li class="dropdown-item-text">Logged in : <?php echo $_SESSION['name']; ?></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="<?php echo ADMIN . 'dashboard.php'; ?>">Dashboard</a></li>
                            <li><a class="dropdown-item" href="<?php echo ADMIN . 'profile.php'; ?>">Profile</a></li>
                            <li><a class="dropdown-item" href="<?php echo ADMIN . 'logout.php'; ?>">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- <div class="py-3 my-4"></div> -->