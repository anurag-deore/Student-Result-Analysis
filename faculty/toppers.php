<?php
include './_header.php';
?>
<div class="container">
    <h3 class="my-3">Toppers List</h3>
    <form class="row g-3" action="" method="GET">
        <div class="col-md-5">
            <label class="form-label">Select Branch</label>
            <select class="form-select" aria-label="Default select example" name="branch">
                <option value="" default>Choose Branch</option>
                <option value="C">COMPUTER</option>
                <option value="T">IT</option>
                <option value="E">ELECTRONICS</option>
                <option value="X">EXTC</option>
                <option value="I">INSTRUMENTATION</option>
            </select>
        </div>
        <div class="col-md-5">
            <label class="form-label">Select Semester</label>
            <select class="form-select" aria-label="Default select example" name="sem">
                <option value="" default>Choose Semester</option>
                <?php
                $exarr = get_available_years($conn);
                foreach ($exarr as $key => $value) {
                    echo "<option value='$value'>$value</option>";
                }
                ?>
            </select>
        </div>
        <div class="col-md-2 d-flex align-items-end">
            <input class="btn btn-primary w-100" type="submit" />
        </div>
    </form>
    <hr>
    <?php
    if (isset($_GET['sem'])) {
        $semDate = $_GET['sem'];
        $branch = $_GET['branch'];
        echo '<h3 class="pt-3 text-center">Department of ' . $branchName[$_GET["branch"]] . ' Engineering</h3>';

        for ($semNum = 3; $semNum < 7; $semNum++) {
            if ((preg_match("/MAY/i", $semDate) != false and $semNum % 2 === 0) || (preg_match("/NOV/i", $semDate) != false and $semNum % 2 !== 0)) {
                $query = "SELECT ROLL_NO, NAME, SEMESTER, C_SG_TOTAL FROM student where E_DATE = '$semDate' and SEMESTER = '$semNum' AND SUB_CODE='ALL' AND BRANCH='$branch' ORDER BY CAST(C_SG_TOTAL AS INT) DESC LIMIT 10";
                $data = mysqli_query($conn, $query);
                $total = mysqli_num_rows($data);
                $i = 1;
                if ($total != 0) {
    ?>
                    <div class="card my-4 px-3 pt-3 shadow d-flex flex-column align-items-center justify-content-center ">
                        <h5 class="alert-info p-2 mb-3 text-center rounded border w-100"> Semester <?php echo $semMap[$semNum]; ?> Toppers ( <?php echo $_GET['sem']; ?> )</h5>
                        <table class="table table-bordered text-center">
                            <thead class="table-secondary ">
                                <tr>
                                    <th scope="col">Rank #</th>
                                    <th scope="col">ROLL_NO</th>
                                    <th scope="col">NAME</th>
                                    <th scope="col">SEMESTER</th>
                                    <th scope="col">TOTAL MARKS</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($result = mysqli_fetch_assoc($data)) {
                                    echo "<tr>
                                <td>" . $i++ . "</td>
                                <td>" . $result['ROLL_NO'] . "</td>
                                <td>" . $result['NAME'] . "</td>
                                <td>" . $result['SEMESTER'] . "</td>
                                <td>" . $result['C_SG_TOTAL'] . "</td>
                              </tr> ";
                                }
                                mysqli_free_result($result);
                                ?>
                            </tbody>
                        </table>
                    </div>
                <?php
                } else {
                    echo "<p class='mt-3 shadow alert alert-info'>No Record Found for Sem $semMap[$semNum]</p>";
                }
            }
        }
        for ($semNum = 7; $semNum <= 8; $semNum++) {
            if ((preg_match("/MAY/i", $semDate) != false and $semNum % 2 === 0) || (preg_match("/NOV/i", $semDate) != false and $semNum % 2 !== 0)) {
                $query = "SELECT * FROM final_year where E_DATE = '$semDate' and SEMESTER = '$semNum' AND BRANCH='$branch' ORDER BY CAST(TOTAl AS INT) DESC LIMIT 10";
                $data = mysqli_query($conn, $query);
                $total = mysqli_num_rows($data);
                $i = 1;
                if ($total != 0) {
                ?>
                    <div class="card my-4 px-3 pt-3 shadow d-flex flex-column align-items-center justify-content-center ">
                        <h5 class="alert-info p-2 mb-3 text-center rounded border w-100"> Semester <?php echo $semMap[$semNum]; ?> Toppers ( <?php echo $_GET['sem']; ?> )</h5>
                        <table class="table table-bordered text-center">
                            <thead class="table-secondary ">
                                <tr>
                                    <th scope="col">Rank #</th>
                                    <th scope="col">ROLL_NO</th>
                                    <th scope="col">NAME</th>
                                    <th scope="col">SEMESTER</th>
                                    <th scope="col">TOTAL MARKS</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($result = mysqli_fetch_assoc($data)) {
                                    echo "<tr>
                                <td>" . $i++ . "</td>
                                <td>" . $result['Roll_No'] . "</td>
                                <td>" . $result['NAME'] . "</td>
                                <td>" . $result['SEMESTER'] . "</td>
                                <td>" . $result['TOTAL'] . "</td>
                              </tr> ";
                                }
                                mysqli_free_result($result);
                                ?>
                            </tbody>
                        </table>
                    </div>
    <?php
                } else {
                    echo "<p class='mt-3 shadow alert alert-info'>No Record Found for Sem $semMap[$semNum]</p>";
                }
            }
        }
    }
    mysqli_close($conn);
    ?>
</div>
<?php
include './_footer.php';
?>