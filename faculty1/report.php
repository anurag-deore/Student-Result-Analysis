<?php
include('connection.php');
error_reporting(0);
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/0.2.0/Chart.min.js" type="text/javascript"></script>
    <title>REPORT</title>
    <style>
    .container{
        font-size : 20px;
        font-family : san serif;
    }

    body{
        background-color : #F6F6FF;
    }
    </style>
  </head>
  <body>

  <nav class="navbar navbar-light navbar-expand-lg shadow-sm" style="background-color: #F6F6FF;">
        <div class="container-fluid">
            <a class="navbar-brand" href="/Student-Result-Analysis-master\Student-Result-Analysis-master/faculty/dashboard.php">
                <img src="/Student-Result-Analysis-master\Student-Result-Analysis-master/assets/l0.png" alt="" width="110" class="d-inline-block align-top">
            </a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Semester wise Report</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Classwise Report</a>
        </li>
      
    </div>
            <div class=" justify-content-end" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person h3"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg-end dropdown-menu-dark" aria-labelledby="navbarDropdownMenuLink">
                            <li class="dropdown-item-text">Logged in : FC1234</li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="/Student-Result-Analysis-master\Student-Result-Analysis-master/faculty/dashboard.php">Dashboard</a></li>
                            <li><a class="dropdown-item" href="/Student-Result-Analysis-master\Student-Result-Analysis-master/faculty/profile.php">Profile</a></li>
                            <li><a class="dropdown-item" href="/Student-Result-Analysis-master\Student-Result-Analysis-master/faculty/logout.php">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
</nav><br/>

  <div class="container" style="padding = 5%;">
    <form action="" method="POST">
    Select Semester
    <select class="form-select" aria-label="Default select example" name="sem">
        <option value="" default>---SELECT---</option>
        <option value="1">SEMESTER 1</option>
        <option value="2">SEMESTER 2</option>
        <option value="3">SEMESTER 3</option>
        <option value="4">SEMESTER 4</option>
        <option value="5">SEMESTER 5</option>
        <option value="6">SEMESTER 6</option>
        <option value="7">SEMESTER 7</option>
        <option value="8">SEMESTER 8</option>
    </select><br/>
    Select Branch
    <select class="form-select" aria-label="Default select example" name="branch">
        <option value="" default>---SELECT---</option>
        <option value="C">COMPUTER</option>
        <option value="T">IT</option>
        <option value="E">ELECTRONICS</option>
        <option value="X">EXTC</option>
        <option value="I">INSTRUMENTATION</option>
        
    </select><br/>

    Select Shift
    <div class="form-check">
  <input class="form-check-input" type="radio" name="shift" id="flexRadioDefault1" value ="1">
  <label class="form-check-label" for="flexRadioDefault1">
    First Shift
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="shift" id="flexRadioDefault2" value = "2">
  <label class="form-check-label" for="flexRadioDefault2">
    Second Shift
  </label>
</div>
    <br/>
    <input class="btn btn-primary" type="submit" name="submit" value="Submit"/>
    </form>
    </div><br/>
    <?php

    if($_POST['submit'])
    {
        $selected = $_POST['sem'];
        $branch = $_POST['branch'];
        $shift = $_POST['shift'];
        $S = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) FROM student WHERE SEMESTER = '$selected' AND SUB_CODE = 'ALL' AND BRANCH = '$branch' AND SHIFT='$shift';"))['COUNT(*)'];
        $P = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) FROM student where SEMESTER = '$selected' AND branch = '$branch' AND SUB_CODE = 'ALL' AND SHIFT='$shift' AND (REMARKS LIKE '%P%' OR REMARKS LIKE '%RRLE%');"))['COUNT(*)'];
        $Q = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) FROM student WHERE SEMESTER = '$selected' AND BRANCH = '$branch' AND SUB_CODE = 'ALL' AND SHIFT='$shift' AND NOT(REMARKS LIKE '%NULL%' OR REMARKS = 'ABS');"))['COUNT(*)'];
        $R = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) FROM student where SEMESTER = '$selected' AND branch = '$branch' AND SUB_CODE = 'ALL' AND SHIFT='$shift' AND REMARKS='F';"))['COUNT(*)'];
        if($S==0)
        {
          
          echo "NO RECORD FOUND";
        
        }
        else
        {
            ?>
            <div class="container">
            <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">TOTAL STUDENTS</th>
                        <th scope="col">APPEARED</th>
                        <th scope="col">PASSED</th>
                        <th scope="col">FAILED</th>
                        <th scope="col">PERCENTAGE</th>
                        </tr>
                    </thead>
                    <tbody>
                       
                <?php
                    
                            echo "<tr>
                                <td>".$S."</td>
                                <td>".$Q."</td>
                                <td>".$P."</td>
                                <td>".$R."</td>
                                <td>".ROUND((($P/$S)*100),2)."</td>
                                </tr>";
                                mysqli_close($conn);
                                  
                                     
                     
          } }        ?> 
                     
                      </div>
                    </tbody>
            </table>

  </body>
</html>