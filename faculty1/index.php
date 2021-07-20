<?php
session_start();
error_reporting(E_NOTICE && E_WARNING);

include '../path.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] != "student") {
    header("location:" . HOME);
} else {
    header("location:" . FACULTY . 'dashboard.php');
}
