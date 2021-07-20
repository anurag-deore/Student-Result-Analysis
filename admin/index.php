<?php
session_start();
error_reporting(E_NOTICE && E_WARNING);

include '../path.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] != "admin") {
    header("location:" . HOME);
} else {
    header("location:" . ADMIN . 'dashboard.php');
}
