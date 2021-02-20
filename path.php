<?php
define("HOME", '/studentResultAnalysis/');
define("ASSETS", HOME . 'assets/');
define("COMPONENTS", HOME . 'components/');
define("PAGES", HOME . 'pages/');
define("STYLESHEETS", HOME . 'stylesheets/');
define("STUDENT", HOME . 'student/');
define("FACULTY", HOME . 'faculty/');


$_SESSION['theme'] = 'light';
$_SESSION['theme'] == 'dark' ?
    $theme = array(
        "primary" => "#000000",
        "secondary" => "#343434",
        "text" => "#ffffff",
        "logo" => "l1.png"
    ) :
    $theme = array(
        "primary" => "#FFFFFF",
        "secondary" => "#F6F6FF",
        "text" => "#000000",
        "logo" => "l0.png"
    );

function db_connect()
{
    $connection = mysqli_connect("localhost", "root", "", "resultanalysis");
    confirm_db_connect();
    return $connection;
}

function db_disconnect($connection)
{
    if (isset($connection)) {
        mysqli_close($connection);
    }
}

function db_escape($connection, $string)
{
    return mysqli_real_escape_string($connection, $string);
}

function confirm_db_connect()
{
    if (mysqli_connect_errno()) {
        $msg = "Database connection failed: ";
        $msg .= mysqli_connect_error();
        $msg .= " (" . mysqli_connect_errno() . ")";
        exit($msg);
    }
}

function confirm_result_set($result_set)
{
    if (!$result_set) {
        exit("Database query failed.");
    }
}

$conn = db_connect();
