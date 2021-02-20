<?php
include '../path.php';
$title = 'Login';

session_start();
$msg = "";
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] == "student") {
        header("location: " . STUDENT . "dashboard.php");
    } else {
        $msg = "Username or password is incorrect !";
    }
}
if (isset($_POST['login'])) {
    $usertype = 'student';
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $password = sha1($password);

    $stmt = $conn->prepare("SELECT * FROM auth WHERE username=? AND password=? AND usertype=?");
    $stmt->bind_param("sss", $username, $password, $usertype);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    session_regenerate_id();
    $_SESSION['username'] = $row['username'];
    $_SESSION['role'] = $row['usertype'];
    session_write_close();

    if ($result->num_rows == 1 && $_SESSION['role'] == "student") {
        header("location: " . STUDENT . "dashboard.php");
    } else {
        $msg = "Username or password is incorrect !";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo ASSETS . 'dyp.png'; ?>" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="<?php echo STYLESHEETS . 'style.css'; ?>">
    <title><?php echo $title ?></title>
    <style>
        html,
        body {
            height: 100%;
        }

        .card {
            border-radius: 10px;
        }

        .bgl {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .global-container {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #F6F6FF;
        }

        form {
            padding-top: 10px;
            font-size: 14px;
            margin-top: 30px;
        }

        .card-title {
            font-weight: 900;
        }

        .btn {
            font-size: 14px;
            margin-top: 20px;
        }

        .login-form {
            width: 500px;
            margin: 20px;
        }
    </style>
</head>

<body>
    <img src="<?php echo ASSETS . 'loginbg.svg'; ?>" alt="bgl" class="bgl">
    <div class="global-container">
        <div class="card shadow login-form">
            <div class="card-body p-4">
                <h3 class="card-title">Student Registration</h3>
                <hr>
                <div class="card-text">
                    <form class="row g-3 needs-validation" action="" method="POST" novalidate>
                        <div class="col-12">
                            <label for="usernameValidation" class="form-label">Roll No</label>
                            <input type="text" name="username" class="form-control" id="usernameValidation" required>
                            <div class="invalid-feedback">Cannot be empty</div>
                        </div>
                        <div class="col-12">
                            <label for="passwordValidation" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="passwordValidation" required>
                            <div class="invalid-feedback">Cannot be empty</div>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-outline-primary w-100" name="login" value="Login" type="submit">Log In</button>
                        </div>
                        <div class="col-12">
                            Back To <a href="<?php echo STUDENT . 'login.php'; ?>">Login</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        (function() {
            'use strict'
            var forms = document.querySelectorAll('.needs-validation')
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }
                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>

    <?php
    include './__footer.php';
    ?>