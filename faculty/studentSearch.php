<?php
include('_header.php');
include('connection.php');
?>
<div class="container mt-5">
    <form method="POST" action="">
        <div class="mb-3">
            <label for="studentSearch" class="form-label">Roll Number</label>
            <input type="input" class="form-control" id="studentSearch" name="search" aria-describedby="searchHelp">
            <div id="searchHelp" class="form-text">Enter Student's RollNo.</div>
        </div>

        <div class="mb-3">
            <label for="studentSearch" class="form-label">SELECT SEMESTER</label>
            <select class="form-select" id="studentSearch" name="selectSem" describedby="searchHelp2">
                <option value="1">SEMESTER 1</option>
                <option value="2">SEMESTER 2</option>
                <option value="3">SEMESTER 3</option>
                <option value="4">SEMESTER 4</option>
                <option value="5">SEMESTER 5</option>
                <option value="6">SEMESTER 6</option>
                <option value="7">SEMESTER 7</option>
                <option value="8">SEMESTER 8</option>
            </select>
            <div id="searchHelp2" class="form-text">Enter Required Semester</div>
        </div>

        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
    <hr>

    <?php
    $k = [
        ['S1WMS', 'S1TMS', 'S1OMS', 'S1PMS'],
        ['S2WMS', 'S2TMS', 'S2OMS', 'S2PMS'],
        ['S3WMS', 'S3TMS', 'S3OMS', 'S3PMS'],
        ['S4WMS', 'S4TMS', 'S4OMS', 'S4PMS'],
        ['S5WMS', 'S5TMS', 'S5OMS', 'S5PMS'],
        ['S6WMS', 'S6TMS', 'S6OMS', 'S6PMS']
    ];
    if (isset($_POST['submit'])) {
        $student = $_POST['search'];
        $selectSem = $_POST['selectSem'];
        $branch = $branchFromRoll[substr($student,2,2)];
        $sqlsub = "SELECT * FROM subjects where BRANCH='$branch' AND SEMESTER='$selectSem' ORDER BY sub_name ASC LIMIT 5";
        $ressub = $conn->query($sqlsub);
        
        $subjects = ["Subject 1", "Subject 2", "Subject 3", "Subject 4", "Subject 5","Subject 6"];
        $sub = 0;
        while ($w = $ressub->fetch_assoc()) {
            $subjects[$sub] = $w["sub_name"];
            $sub++;
        }
        $result = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * from student where ROLL_NO='$student' AND SUB_CODE='ALL' AND SEMESTER='$selectSem';"));
    ?>
        <div class="card mt-3 shadow">
            <table class="table table-bordered m-0">
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
                        <th scope='row'>SEMESTER</th>
                        <td>" . $result['SEMESTER'] . "</th>
                        
                </tr>
                <tr>
                        <th scope='row'>BRANCH</th>
                        <td>" . $branchName[$result['BRANCH']] . "</th>
                        
                </tr>
                <tr>
                        <th scope='row'>REMARK</th>
                        <td>" . $result['REMARKS'] . "</th>
                
                 </tr>";

                    ?>
                </tbody>
            </table>
        </div>

        <div class="card justify-content-center mt-3 mb-5 shadow">
            <table class="table table-bordered m-0">
                <thead class="table-primary">
                    <tr>
                        <th class="col-4">SUBJECTS</th>
                        <th class="col-2">Theory</th>
                        <th class="col-2">Term Work</th>
                        <th class="col-2">Oral</th>
                        <th class="col-2">Practical</th>
                    </tr>
                </thead>
                <tbody>
                <?php


                foreach ($k as $sub) {
                    echo "<tr>
                    <th scope=\"row\">" . $subjects[array_search($sub, $k, true)] . "</th>
                    <td>" . $result[$sub[0]] . "</td>
                    <td>" . $result[$sub[1]] . "</td>
                    <td>" . $result[$sub[2]] . "</td>
                    <td>" . $result[$sub[3]] . "</td>";
                }
            }
                ?>
                </tbody>
            </table>
        </div>
</div>

<?php
include '_footer.php';
?>