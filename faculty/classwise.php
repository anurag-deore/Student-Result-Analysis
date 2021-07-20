<?php
include './_header.php';
$table_html = "";
$chartData = array();
if (isset($_GET['branch'])) {
    $branch = $_GET['branch'];
    $semDate = $_GET['sem'];
    if (strlen($branch) <= 0 || strlen($semDate) <= 0 || in_array($branch, array("C", "I", "T", "E", "X")) == false) {
        $table_html = '<div class="alert alert-danger mb-0">Invalid Input. Please fill carefully.</div>';
    } else {
        $table_html = ' 	
    <table class="text-center table table-bordered">
        <tr class="table-info">
            <th><h5>Class</h5></th>
            <th><h5>Semester</h5></th>
            <th><h5>Appeared</h5></th>
            <th><h5>Distinction</h5></th>
            <th><h5>First class </h5></th>
            <th><h5>Second class</h5></th>
            <th><h5>Total pass</h5></th>
            <th><h5>Failed</h5></th>
            <th><h5>Total Pass %</h5></th>
        </tr>';
        // NOTE : Loop for each semester i.e. 2,3,4,5,6 and query for each 
        $shifts = ($branch == "I" || $branch == "T") ? 1 : 2;
        for ($i = 3; $i < 7; $i++) {
            $m = 1;
            if ((preg_match("/MAY/i", $semDate) != false and $i % 2 == 0) || (preg_match("/NOV/i", $semDate) != false and $i % 2 != 0)) {
                while ($m <= $shifts) {
                    $grade_o = 0;
                    $grade_a = 0;
                    $grade_b = 0;
                    $grade_c = 0;
                    $grade_d = 0;
                    $grade_e = 0;
                    $totalPass = 0;
                    $appeared = 0;
                    $sql = "SELECT C_SG_TOTAL,REMARKS FROM student where BRANCH='$branch' and E_DATE='$semDate' and SEMESTER='$i' and shift='$m'";
                    $res = mysqli_query($conn, $sql);
                    $appeared = mysqli_num_rows($res);
                    while ($row = mysqli_fetch_assoc($res)) {
                        $marks = (int)($row['C_SG_TOTAL']);
                        $cgpi = (($marks * 100 / 750) - 11) / 7.25;
                        if ($cgpi >= 9.5) $grade_o += 1;
                        if ($cgpi >= 8.5 and $cgpi < 9.5) $grade_a += 1;
                        if ($cgpi >= 7.5 and $cgpi < 8.5) $grade_b += 1;
                        if ($cgpi >= 6.5 and $cgpi < 7.5) $grade_c += 1;
                        if ($cgpi >= 5.5 and $cgpi < 6.5) $grade_d += 1;
                        if ($cgpi >= 4.5 and $cgpi < 5.5) $grade_e += 1;
                        if ($row['REMARKS'] == 'P') $totalPass += 1;
                    }
                    $fail = $appeared - $totalPass;
                    $pass_percent = $totalPass * 100 / $appeared;
                    $startCol = $m == 1 ? ("<td rowspan=" . $shifts * 3 . ">" . $yearMap[$i]) . "</td>" : ("");
                    $table_html .= '
                <tr>' . $startCol . '
                    <td rowspan="3">(SEM ' . $semMap[$i] . ') <br>' . $shiftMap[$m] . ' Shift</td>
				    <td rowspan="3">' . $appeared . '</td>
				    <td> Grade O:' . $grade_o . '</td>
				    <td rowspan="3">Grade C:' . $grade_c . '</td>
				    <td> Grade D:' . $grade_d . '</td>
				    <td rowspan="3">' . $totalPass . '</td>
				    <td rowspan="3">' . $fail . '</td>
                    <td rowspan="3">' . round($pass_percent, 2) . '</td>
                </tr>
                <tr>
                    <td>Grade A:' . $grade_a . '</td>
                    <td>Grade E:' . $grade_e . '</td>
                </tr>
                <tr>
                    <td>Grade B:' . $grade_b . '</td>
                    <td></td>
                </tr>
                ';
                    $chartData[$yearNumMap[$i]][$shiftMap[$m]] = array(
                        "year" => $yearMap[$i],
                        "shift" => $shiftMap[$m] . " Shift",
                        "grade_o" => $grade_o,
                        "grade_a" => $grade_a,
                        "grade_b" => $grade_b,
                        "grade_c" => $grade_c,
                        "grade_d" => $grade_d,
                        "grade_e" => $grade_e,
                        "total" => $appeared,
                        "totalPass" =>  $totalPass,
                        "totalFail" =>  $fail,
                    );
                    $m += 1;
                }
            }
        }
        $m = 1;
        for ($i = 7; $i <= 8; $i++) {
            if ((preg_match("/MAY/i", $semDate) != false and $i % 2 == 0) || (preg_match("/NOV/i", $semDate) != false and $i % 2 != 0)) {
                while ($m <= $shifts) {
                    $grade_o = 0;
                    $grade_a = 0;
                    $grade_b = 0;
                    $grade_c = 0;
                    $grade_d = 0;
                    $grade_e = 0;
                    $totalPass = 0;
                    $appeared = 0;
                    $sql3 = "SELECT TOTAL,REMARK FROM final_year WHERE SHIFT ='$m' AND BRANCH='$branch' AND SEMESTER='$i' AND  E_DATE ='$semDate'";
                    $res3 = mysqli_query($conn, $sql3);
                    $appeared = mysqli_num_rows($res3);
                    while ($row3 = mysqli_fetch_assoc($res3)) {
                        $marks = (int)($row3['TOTAL']);
                        $cgpi = (($marks * 100 / 750) - 11) / 7.25;
                        if ($cgpi >= 9.5) $grade_o += 1;
                        if ($cgpi >= 8.5 and $cgpi < 9.5) $grade_a += 1;
                        if ($cgpi >= 7.5 and $cgpi < 8.5) $grade_b += 1;
                        if ($cgpi >= 6.5 and $cgpi < 7.5) $grade_c += 1;
                        if ($cgpi >= 5.5 and $cgpi < 6.5) $grade_d += 1;
                        if ($cgpi >= 4.5 and $cgpi < 5.5) $grade_e += 1;
                        if ($row3['REMARK'] == 'P') $totalPass += 1;
                    }
                    $fail = $appeared - $totalPass;
                    $pass_percent = $totalPass * 100 / $appeared;
                    $chartData[$yearNumMap[$i]][$shiftMap[$m]] = array(
                        "year" => $yearMap[$i],
                        "shift" => $shiftMap[$m] . " Shift",
                        "grade_o" => $grade_o,
                        "grade_a" => $grade_a,
                        "grade_b" => $grade_b,
                        "grade_c" => $grade_c,
                        "grade_d" => $grade_d,
                        "grade_e" => $grade_e,
                        "total" => $appeared,
                        "totalPass" =>  $totalPass,
                        "totalFail" =>  $fail,
                    );
                    $startCol = $m == 1 ? ("<td rowspan=" . $shifts * 3 . ">" . $yearMap[$i]) . "</td>" : ("");
                    $table_html .= '
                <tr>' . $startCol . '
                    <td rowspan="3">(SEM ' . $semMap[$i] . ') <br>' . $shiftMap[$m] . ' Shift</td>
				    <td rowspan="3">' . $appeared . '</td>
				    <td> Grade O:' . $grade_o . '</td>
				    <td rowspan="3">Grade C:' . $grade_c . '</td>
				    <td> Grade D:' . $grade_d . '</td>
				    <td rowspan="3">' . $totalPass . '</td>
				    <td rowspan="3">' . $fail . '</td>
                    <td rowspan="3">' . round($pass_percent, 2) . '</td>
                </tr>
                <tr>
                    <td >Grade A:' . $grade_a . '</td>
                    <td >Grade E:' . $grade_e . '</td>
                </tr>
                <tr>
                    <td >Grade B:' . $grade_b . '</td>
                    <td></td>
                </tr>
                ';
                    $m += 1;
                }
            }
        }

        $table_html .= "</tr></table>";
    }
}

?>
<style>
    canvas {
        /* background-color: lightgrey; */
        margin: 20px;
    }
</style>
<div class="container mb-3">
    <h3 class="my-3">Classwise Results</h3>
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
            <label class="form-label">Select Exam Date</label>
            <select class="form-select" aria-label="Default select example" name="sem">
                <option value="" default>Choose Date</option>
                <?php
                $exarr = get_available_years($conn);
                foreach ($exarr as $key => $value) {
                    echo "<option value='$value'>$value</option>";
                }
                ?>
            </select>
        </div>

        <div class="col-md-2 d-flex align-items-end">
            <input class="btn w-100 btn-primary" type="submit" />
        </div>
    </form>
    <hr>
    <?php if ($table_html != "") {; ?>
        <div class="card px-3 shadow-sm d-flex flex-column align-items-center justify-content-center ">
            <h3 class="pt-3 text-center">Department of <?php echo $branchName[$_GET['branch']] ?> Engineering</h3>
            <p class="text-muted pb-2"> <i><?php echo $_GET['sem'] ?> Exam Results</i></p>
            <?php echo $table_html; ?>
        </div>
        <?php
        foreach ($chartData as $yearKeys => $years) {

            if ($years["First"]["total"] == "") {
                echo '  <div class="col-12 my-3">
                            <div class="card card-body shadow-sm align-items-center justify-content-center">
                                <div class="alert text-center alert-warning mb-0 p-0 d-flex align-items-center justify-content-between">
                                    <span class="h4 d-flex p-3 rounded mb-0 bg-warning align-items-center justify-content-center">                                
                                        <i class="bi bi-exclamation-circle-fill" style="color:#FFF3CD;"></i> 
                                    </span>
                                    <span class="p-3">No Data found for ' . $years["First"]["year"] . '</div></span>
                            </div>
                        </div>';
            } else {
                echo '
                <div class="row mt-3">
                    <div class="col-12">
                        <div class="card mb-3 card-body shadow-sm">
                            <div class="d-flex justify-content-between align-items-center">
                                    <h3>' . $years["First"]["year"] . ' Analysis  |  ' . $_GET['sem'] . ' Exam </h3>
                                    <span class="alert-info p-1 px-2 rounded">' . $branchShortName[$_GET['branch']] . ' Engineering </span>
                            </div>
                        </div>
                    </div>';
                foreach ($years as $shiftKey => $shifts) {
                    $areTwo = count($years) == 1 ? false : true;
                    echo '
                <div class="' . ($areTwo == 1 ? "col-6" : "col-12") . '">
                <div class="card card-body shadow-sm">
                <p class="text-center" style="font-size:20px;"><b>' . $shifts["shift"] . '</b></p>
                 <ul class="nav nav-tabs mb-3 justify-content-cen ter" id="pills-tab" role="tablist">
                     <li class="nav-item" role="presentation">
                         <button class="nav-link active" id="pills-' . $yearKeys . $shiftKey . '-tab" data-bs-toggle="pill" data-bs-target="#pills-' . $yearKeys . $shiftKey . '" type="button" role="tab" aria-controls="pills-' . $yearKeys . $shiftKey . '" aria-selected="true">Radial Charts</button>
                     </li>
                     <li class="nav-item" role="presentation">
                         <button class="nav-link" id="pills-' . $yearKeys . $shiftKey . '1-tab" data-bs-toggle="pill" data-bs-target="#pills-' . $yearKeys . $shiftKey . '1" type="button" role="tab" aria-controls="pills-' . $yearKeys . $shiftKey . '1" aria-selected="false">Bar Chart</button>
                     </li>
                 </ul>
                 <div class="tab-content" id="pills-tabContent">
                     <div class="tab-pane fade show active" id="pills-' . $yearKeys . $shiftKey . '" role="tabpanel" aria-labelledby="pills-' . $yearKeys . $shiftKey . '-tab">
                         <div class="d-flex flex-row align-items-center justify-content-center">
                            <canvas width="' . ($areTwo ?  250 : 500) . '" height="300" id="pie' . $yearKeys . $shiftKey . '"></canvas>
                            <canvas width="' . ($areTwo ?  250 : 500) . '" height="300" id="pie' . $yearKeys . $shiftKey . '1"></canvas>
                         </div>
                     </div>
                     <div class="tab-pane fade" id="pills-' . $yearKeys . $shiftKey . '1" role="tabpanel" aria-labelledby="pills-' . $yearKeys . $shiftKey . '1-tab">
                         <div class="d-flex flex-row align-items-center justify-content-center">
                                <canvas width="' . ($areTwo ?  250 : 500) . '" height="300" id="bar' . $yearKeys . $shiftKey . '1"></canvas>
                                <canvas width="' . ($areTwo ?  250 : 500) . '" height="300" id="bar' . $yearKeys . $shiftKey . '"></canvas>
                         </div>
                     </div>
                 </div>
             </div>
             
             <script>
                var barOptions =  {responsive: false,plugins: {legend: {display: false}}};
                var pieOptions ={plugins: {legend: {display: true,position: "bottom",}},radius: ' . ($areTwo ?  70 : 100) . ',cutout: "0%",responsive: false,maintainAspectRatio: false};
                var ctx' . $yearKeys . $shiftKey . ' = document.getElementById("pie' . $yearKeys . $shiftKey . '").getContext("2d");
                var myChart = new Chart(ctx' . $yearKeys . $shiftKey . ', {
                    type: "doughnut",
                    data: {
                        labels: ["Grade O", "Grade A", "Grade B", "Grade C", "Grade D", "Grade E"],
                        datasets: [{
                            data: [' . $shifts["grade_o"] . ', ' . $shifts["grade_a"] . ', ' . $shifts["grade_b"] . ', ' . $shifts["grade_c"] . ', ' . $shifts["grade_d"] . ', ' . $shifts["grade_e"] . '],
                            hoverOffset: 10,
                            borderColor:["#fff", "#fff", "#fff", "#fff", "#fff", "#fff"], 
                            // borderColor:["#007bff", "#ba65ea", "#ff4dbb", "#ff5381", "#ff7a48", "#ffa600"], 
                            backgroundColor: ["#007bff", "#ba65ea", "#ff4dbb", "#ff5381", "#ff7a48", "#ffa600"], 
                            borderWidth: 2 // Specify bar border width
                        }],
                    },
                    options: pieOptions,
                });
                var ctx' . $yearKeys . $shiftKey . '2 = document.getElementById("pie' . $yearKeys . $shiftKey . '1").getContext("2d");
                var myChart2 = new Chart(ctx' . $yearKeys . $shiftKey . '2, {
                    type: "doughnut",
                    data: {
                        labels: ["Passed", "Failed"],
                        datasets: [{
                            data: [' . $shifts["totalPass"] . ', ' . $shifts["totalFail"] . '],
                            hoverOffset: 10, 
                            borderColor:["#fff", "#fff", "#fff", "#fff", "#fff", "#fff"], 
                            // borderColor:["#3ba1ec","#9db0f7","#d7c3fb","#ffdbff","#ffc1d9","#ffb298","#fcb752"],                             
                            backgroundColor: ["#3ba1ec","#9db0f7","#d7c3fb","#ffdbff","#ffc1d9","#ffb298","#fcb752"], 
                            borderWidth: 2 // Specify bar border width
                        }],
                    },
                    options: pieOptions,
                });

                var ctx' . $yearKeys . $shiftKey . '3 = document.getElementById("bar' . $yearKeys . $shiftKey . '").getContext("2d");
                var myChart3 = new Chart(ctx' . $yearKeys . $shiftKey . '3, {
                    type: "bar",
                    data: {
                        labels: ["Passed", "Failed"],
                        datasets: [{
                            // label: ["Passed", "Failed"],
                            data: [' . $shifts["totalPass"] . ', ' . $shifts["totalFail"] . '],
                            backgroundColor: ["#007bff80", "#ba65ea80", "#ff4dbb", "#ff5381", "#ff7a48", "#ffa600"],
                            borderColor: ["#007bff", "#ba65ea", "#ff4dbb", "#ff5381", "#ff7a48", "#ffa600"],
                            borderWidth: 1
                        }]
                    },
                    options: barOptions,
                });
                var ctx' . $yearKeys . $shiftKey . '4 = document.getElementById("bar' . $yearKeys . $shiftKey . '1").getContext("2d");
                var myChart4 = new Chart(ctx' . $yearKeys . $shiftKey . '4, {
                    type: "bar",
                    data: {
                        labels: ["Grade O", "Grade A", "Grade B", "Grade C", "Grade D", "Grade E"],
                        datasets: [{
                            label: "Grades",
                            data: [' . $shifts["grade_o"] . ', ' . $shifts["grade_a"] . ', ' . $shifts["grade_b"] . ', ' . $shifts["grade_c"] . ', ' . $shifts["grade_d"] . ', ' . $shifts["grade_e"] . '],
                            backgroundColor: ["#007bff90", "#ba65ea90", "#ff4dbb90", "#ff538190", "#ff7a4890", "#ffa60090"],
                            borderColor: ["#007bff", "#ba65ea", "#ff4dbb", "#ff5381", "#ff7a48", "#ffa600"],
                            borderWidth: 1
                        }]
                    },
                    options: barOptions,
                });
            </script>
            </div>';
                }
                echo '</div>';
            }

        ?>
    <?php }
    } ?>
</div>
<?php
include './_footer.php';
?>