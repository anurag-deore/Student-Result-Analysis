<?php
define("HOME", '/studentResultAnalysis/');
define("ASSETS", HOME . 'assets/');
define("STYLESHEETS", HOME . 'stylesheets/');
define("STUDENT", HOME . 'student/');
define("FACULTY", HOME . 'faculty/');
define("ADMIN", HOME . 'admin/');

//theme set to light by default for testing purpose.
$_SESSION['theme'] = 'light';

//check theme and set theme in session variable
$_SESSION['theme'] == 'dark' ?
    $theme = array(
        "primary" => "#212121",
        "secondary" => "#323232",
        "text" => "#ffffff",
        "logo" => "l0.png"
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


$semMap = array(
    1 => "I", 2 => "II",
    3 => "III", 4 => "IV",
    5 => "V", 6 => "VI",
    7 => "VII", 8 => "VIII"
);
$yearMap = array(
    1 => "First Year", 2 => "First Year",
    3 => "Second Year", 4 => "Second Year",
    5 => "Third Year", 6 => "Third Year",
    7 => "Final Year", 8 => "Final Year"
);
$yearNumMap = array(
    1 => "I", 2 => "I",
    3 => "II", 4 => "II",
    5 => "III", 6 => "III",
    7 => "IV", 8 => "IV"
);
$branchFromRoll = array(
    "CE" => "C",
    "IT" => "T",
    "EE" => "E",
    "ET" => "X",
    "IN" => "I",
);
$branchName =  array(
    "C" => "Computer",
    "T" => "Information Technology",
    "I" => "Instrumentation",
    "E" => "Electronics",
    "X" => "Electronics and Telecommunication"
);
$branchShortName =  array(
    "C" => "Computer",
    "T" => "IT",
    "E" => "Electronics",
    "X" => "EXTC",
    "I" => "Instrumentation"
);
$branchShortNameReverse =  array(
    "Computer" => "C",
    "IT" => "T",
    "Instrumentation" => "I",
    "Electronics" => "E",
    "EXTC" => "X",
);
$shiftMap = array(1 => "First", 2 => "Second");

function get_available_years($conn)
{
    $exam_years_array = [];
    $r = mysqli_query($conn, "SELECT DISTINCT(E_DATE) FROM student");
    while ($j = mysqli_fetch_assoc($r)) {
        $exam_years_array[] = $j["E_DATE"];
    }
    $r = mysqli_query($conn, "SELECT DISTINCT(E_DATE) FROM final_year");
    while ($j = mysqli_fetch_assoc($r)) {
        $exam_years_array[] = $j["E_DATE"];
    }
    return $exam_years_array;
}
get_available_years($conn);
