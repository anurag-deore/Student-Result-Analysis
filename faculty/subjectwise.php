<?php
include './_header.php';
$table_html = "";
$chartData = array();
$allsubData = array();
$individualSubdata = array();
$bgColArray = [
    ['#FF663390', '#FFB39980', '#FF33FF80', '#FFFF9980', '#00B3E680',],
    ['#FF338090', '#CCCC0080', '#66E64D80', '#4D80CC80', '#9900B380',],
    ['#66664D90', '#991AFF80', '#E666FF80', '#4DB3FF80', '#1AB39980',],
    ['#80B30090', '#80990080', '#E6B3B380', '#6680B380', '#66991A80',],
    ['#E6B33390', '#3366E680', '#99996680', '#99FF9980', '#B34D4D80',],
    ['#FF99E690', '#CCFF1A80', '#FF1A6680', '#E6331A80', '#33FFCC80',],
];
$borderColArray = [
    ['#FF6633', '#FFB399', '#FF33FF', '#FFFF99', '#00B3E6',],
    ['#FF3380', '#CCCC00', '#66E64D', '#4D80CC', '#9900B3',],
    ['#66664D', '#991AFF', '#E666FF', '#4DB3FF', '#1AB399',],
    ['#80B300', '#809900', '#E6B3B3', '#6680B3', '#66991A',],
    ['#E6B333', '#3366E6', '#999966', '#99FF99', '#B34D4D',],
    ['#FF99E6', '#CCFF1A', '#FF1A66', '#E6331A', '#33FFCC',],
];
if (isset($_GET['branch'])) {
    $branch = $_GET['branch'];
    $semester = $_GET['sem'];
    $e_date = $_GET['e_date'];
    $html_table = '
    <table class="table table-bordered table-striped  ">
        <thead class="table-primary">
            <tr class="">
                <th class="">Subject</th>
                <th class="">Appeared</th>
                <th class="">Above 48</th>
                <th class="">Between 32 - 48</th>
                <th class="">Pass</th>
                <th class="">Fail</th>
                <th class="">Percentage</th>
            </tr>
        </thead>
    ';
    $sqlsub = "SELECT * FROM subjects where BRANCH='$branch' AND SEMESTER='$semester' ORDER BY sub_name ASC LIMIT 5";
    $ressub = $conn->query($sqlsub);
    $subjects = ["Subject 1", "Subject 2", "Subject 3", "Subject 4", "Subject 5"];
    $subcode = ["Sub1", "Sub2", "Sub3", "Sub4", "Sub5"];
    $sub = 0;
    while ($w = $ressub->fetch_assoc()) {
        $subjects[$sub] = $w["sub_name"];
        $subcode[$sub] = $w["sub_code"];
        $sub++;
    }
    $sub = 1;
    while ($sub <= 5) {
        $pass = 0;
        $fail = 0;
        $between_32n48 = 0;
        $above_48 = 0;
        $appeared = 0;
        $attribute = "S" . $sub . "WMS";
        $sql1 = "SELECT $attribute FROM student where BRANCH='$branch' AND SEMESTER='$semester' AND NOT $attribute='ABS' and E_DATE='$e_date' ";
        $res1 = $conn->query($sql1);
        $appeared =  $res1->num_rows;
        while ($row = $res1->fetch_assoc()) {
            $marks = (int)($row["$attribute"]);
            if ($marks > 48) {
                $above_48 += 1;
            } elseif ($marks > 32 && $marks <= 48) {
                $between_32n48 += 1;
            }
            if ($marks >= 32) {
                $pass += 1;
            }
        }
        $fail = $appeared - $pass;
        $pass_percent = ($pass / $appeared) * 100;
        array_push($allsubData, $pass_percent);
        // $a = 'subject' . $sub;
        $individualSubdata[$sub] = array(
            "labels" => ["Above 48", "Between 32-48", "Below 32(Fail)"],
            "marks" => [$above_48, $between_32n48, $fail],
            "name" => $subjects[$sub - 1],
            "colors" => $bgColArray[$sub - 1],
        );
        $html_table .= '
        <tbody class="">
            <tr class="">
            <td class="">' . $subjects[$sub - 1] . '</td>
            <td class="">' . $appeared . '</td>
            <td class="">' . $above_48 . '</td>
            <td class="">' . $between_32n48 . '</td>
            <td class="">' . $pass . '</td>
            <td class="">' . $fail . '</td>
            <td class="">' . round($pass_percent, 2) . ' %</td>
            </tr>
            </tbody>
            ';
        $sub++;
    }
    $html_table .= '</table>';
}
?>
<style>
    canvas {
        /* background-color: lightgrey; */
        margin: 20px;
    }
</style>

<div class="container mb-3">
    <h3 class="my-3">Subjectwise Results</h3>
    <form class="row g-3" action="" method="GET">
        <div class="col-md-3">
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
        <div class="col-md-3">
            <label class="form-label">Select Semester</label>
            <select class="form-select" aria-label="Default select example" name="sem">
                <option value="" default>Choose Semester</option>
                <?php
                foreach ($semMap as $key => $value) {
                    echo ($key == 1 || $key == 2 ? "" : "<option value='$key'>$value</option>");
                }
                ?>
            </select>
        </div>
        <div class="col-md-3">
            <label class="form-label">Select Exam Date</label>
            <select class="form-select" aria-label="Default select example" name="e_date">
                <option value="" default>Choose Date</option>
                <?php
                $exarr = get_available_years($conn);
                foreach ($exarr as $key => $value) {
                    echo "<option value='$value'>$value</option>";
                }
                ?>
            </select>
        </div>

        <div class="col-md-3 d-flex align-items-end">
            <input class="btn w-100 btn-primary" type="submit" />
        </div>
    </form>
    <hr>
    <?php if ($html_table != "") { ?>
        <div class="card px-3 shadow-sm d-flex flex-column align-items-center justify-content-center ">
            <h3 class="pt-3 text-center">Department of <?php echo $branchName[$_GET['branch']] ?> Engineering</h3>
            <p class="text-muted pb-2"><i> <?php echo $_GET['e_date'] ?> Exam - Semester <?php echo $_GET['sem'] ?> - Subjectwise Analysis</i></p>
            <?php echo $html_table; ?>
        </div>
        <div class="card card-body mt-3 shadow-sm">
            <h4>Pass Percentage Analysis</h4>
            <div class="d-flex flex-row align-items-center justify-content-center">
                <canvas width="500" height="300" id="ctxbarsubj"></canvas>
            </div>
        </div>
        <script>
            var barOptions = {
                responsive: false,
                plugins: {
                    legend: {
                        display: false
                    }
                }
            };
            var ctxbarsubj = document.getElementById("ctxbarsubj").getContext("2d");
            var myChart3 = new Chart(ctxbarsubj, {
                type: "bar",
                data: {
                    labels: <?php echo json_encode($subcode); ?>,
                    datasets: [{
                        data: <?php echo json_encode($allsubData); ?>,
                        backgroundColor: ["#007bff80", "#ba65ea80", "#ff4dbb80", "#ff538180", "#ff7a4880", "#ffa60080"],
                        borderColor: ["#007bff", "#ba65ea", "#ff4dbb", "#ff5381", "#ff7a48", "#ffa600"],
                        borderWidth: 1
                    }]
                },
                options: barOptions,
            });
        </script>
        <div class="card card-body mt-3 shadow-sm">
            <div class="row">
                <?php for ($k = 0; $k < 5; $k++) { ?>

                    <?php echo ($k == 3 ? "<hr>" : ""); ?>
                    <div class="col-4 d-flex flex-column align-items-center justify-content-center text-center">
                        <h4><?php echo $subjects[$k]; ?></h4>
                        <canvas class="p-3 border rounded shadow" id="ctxbar<?php echo $k; ?>"></canvas>
                        <script>
                            var pieOptions = {
                                plugins: {
                                    legend: {
                                        display: true,
                                        position: "bottom",
                                    },
                                },
                                radius: 100,
                                cutout: "50%",
                                responsive: false,
                                maintainAspectRatio: false
                            };

                            var ctxbar<?php echo $k; ?> = document.getElementById("ctxbar<?php echo $k; ?>").getContext("2d");
                            var myChart<?php echo $k; ?> = new Chart(ctxbar<?php echo $k; ?>, {
                                type: "pie",
                                options: pieOptions,
                                data: {
                                    labels: <?php echo json_encode($individualSubdata[$k + 1]['labels']); ?>,
                                    datasets: [{
                                        hoverOffset: 10,
                                        data: <?php echo json_encode($individualSubdata[$k + 1]['marks']); ?>,
                                        backgroundColor: <?php echo json_encode($individualSubdata[$k + 1]['colors']); ?>,
                                        // borderColor: <?php echo json_encode($borderColArray[$k]); ?>,
                                        // borderColor: ["#037DF7", "#00F700", "#ff4dbb", "#ba65ea", "#ff4dbb", "#037DF7", "#00F700", "#ffa600"],
                                        borderColor: ["#fff", "#fff", "#fff", "#fff", "#fff", "#fff", "#fff", "#fff"],
                                        borderWidth: 2
                                    }]
                                },
                            });
                        </script>
                    </div>
                <?php } ?>
            </div>
        </div>
    <?php } ?>
</div>
<?php
include './_footer.php';
?>