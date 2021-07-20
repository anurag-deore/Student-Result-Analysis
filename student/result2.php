<?php
$conn = mysqli_connect('localhost', 'root', '', 'resultanalysis');
include('_header.php');
session_start();
$username = $_SESSION['username'];
$examdate = $_GET['e_date'];
$sem = $_GET['sem'];
$seat_no = $_GET['seat_no'];
$subjects = array('SUBJECT1', 'SUBJECT2', 'SUBJECT3', 'SUBJECT4', 'SUBJECT5', 'SUBJECT6');
$k = [
    ['S1WMS', 'S1TMS', 'S1OMS', 'S1PMS'],
    ['S2WMS', 'S2TMS', 'S2OMS', 'S2PMS'],
    ['S3WMS', 'S3TMS', 'S3OMS', 'S3PMS'],
    ['S4WMS', 'S4TMS', 'S4OMS', 'S4PMS'],
    ['S5WMS', 'S5TMS', 'S5OMS', 'S5PMS'],
    ['S6WMS', 'S6TMS', 'S6OMS', 'S6PMS']
];



$result = mysqli_fetch_assoc(mysqli_query($conn, "Select * from student where E_DATE='$examdate' AND SEMESTER='$sem' AND SEAT_NO='$seat_no' AND ROLL_NO='$username';"));
switch ($result['BRANCH']) {
    case 'C':
        $result['BRANCH'] = 'COMPUTER ENGINEERING';
        break;
    case 'X':
        $result['BRANCH'] = 'ELECTRONICS AND TELECOMMUNICATION ENGINEERING';
        break;
    case 'T':
        $result['BRANCH'] = 'INFORMATION TECHNOLOGY ENGINEERING';
        break;
    case 'E':
        $result['BRANCH'] = 'ELECTRONICS ENGINEERING';
        break;
    case 'I':
        $result['BRANCH'] = 'INSTRUMENTATION ENGINEERING';
        break;
    default:
        # code...
        break;
}


?>
<style>
    @media print {

        nav,
        .navbar,
        button.btn {
            display: none;
        }
    }
</style>



<div class="card justify-content-center m-5 mt-4 mb-4">
    <table class="table table-striped m-0">
        <tbody>
            <?php echo "<tr>
                        <th scope='row'>NAME</th>
                        <td>" . $result['NAME'] . "</th>
                        
                </tr>
                <tr>
                        <th scope='row'>ROLL NO</th>
                        <td>" . $result['ROLL_NO'] . "</th>
                        
                </tr>
                <tr>
                        <th scope='row'>SEAT NO</th>
                        <td>" . $result['SEAT_NO'] . "</th>
                        
                </tr>
                <tr>
                <th scope='row'>EXAM DATE</th>
                <td>" . $result['E_DATE'] . "</th>
                
        </tr>
                <tr>
                        <th scope='row'>SEMESTER</th>
                        <td>" . $result['SEMESTER'] . "</th>
                        
                </tr>
                <tr>
                        <th scope='row'>BRANCH</th>
                        <td>" . $result['BRANCH'] . "</th>
                        
                </tr>
                <tr>
                        <th scope='row'>REMARK</th>
                        <td>" . $result['REMARKS'] . "</th>
                
                 </tr>";

            ?>
        </tbody>
    </table>
</div>
</div>


</div>
<div class="card justify-content-center m-5 mt-0 mb-3">
    <table class="table table-striped m-0">
        <thead>
            <tr>
                <th scope="col">SUBJECTS</th>
                <th scope="col">WRITTEN</th>
                <th scope="col">TERM WORK</th>
                <th scope="col">ORAL</th>
                <th scope="col">PRACTICAL</th>
            </tr>
        </thead>
        <tbody>
            <?php


            foreach ($k as $sub) {
                # code...

                # code...
                echo "<tr>
                    <th scope=\"row\">" . $subjects[array_search($sub, $k, true)] . "</th>
                    <td>" . $result[$sub[0]] . "</td>
                    <td>" . $result[$sub[1]] . "</td>
                    <td>" . $result[$sub[2]] . "</td>
                    <td>" . $result[$sub[3]] . "</td>";
            }

            ?>
        </tbody>
    </table>
</div>
</div>

<div class="container justify-content-center">
    <div class="d-grid gap-2 col-6 mx-auto mt-1">
        <button class="btn btn-primary" type="button" onclick="window.print()">Print Report Card</button>
    </div>
</div>
<?php
include('student/_footer.php');
?>