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

    <title>TOPPER LIST!</title>
    <style>
    .container{
        font-size : 20px;
        font-family : san serif;
    }

    body{
        background-color : #F6F6FF;
    }
    tr:nth-child(even) {
  background-color: #f2f2f2;
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
          <a class="nav-link active" aria-current="page" href="#">Semester wise Toppers</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Classwise Toppers</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Yearwise Toppers</a>
        </li>
      </ul>
      
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
        </nav>

  <div class="container" style="padding : 5%; margin : none;">
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
    <input class="btn btn-primary" type="submit" name="submit" value="Submit"/>
    </form>
    </div>
    <?php

    if($_POST['submit'])
    {
        $selected = $_POST['sem'];
        $branch = $_POST['branch'];
        $query = "SELECT ROLL_NO, NAME, SEMESTER, C_SG_TOTAL FROM student where SEMESTER = '$selected' AND SUB_CODE='ALL' AND BRANCH='$branch' ORDER BY CAST(C_SG_TOTAL AS INT) DESC LIMIT 5";
        $data = mysqli_query($conn,$query);
        $total = mysqli_num_rows($data);
        
        if($total!=0)
        {
            ?>
            <div class="container" style= "margin-top:none;">
            <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">ROLL_NO</th>
                        <th scope="col">NAME</th>
                        <th scope="col">SEMESTER</th>
                        <th scope="col">TOTAL MARKS</th>
                        </tr>
                    </thead>
                    <tbody>
                       
                <?php
                
                    while($result = mysqli_fetch_assoc($data))
                    {
                        echo "<tr>
                                <td>".$count."</td>
                                <td>".$result['ROLL_NO']."</td>
                                <td>".$result['NAME']."</td>
                                <td>".$result['SEMESTER']."</td>
                                <td>".$result['C_SG_TOTAL']."</td>
                              </tr> ";     
                    }
                    mysqli_free_result($result);
                ?>      </div>
                    </tbody>
            </table>
    <?php        
        }
        else
        {
            echo "NO RECORDS FOUND FOR SELECTED FIELD";
        }
    }
    mysqli_close($conn);
    ?>
       
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
    -->
  </body>
</html>
