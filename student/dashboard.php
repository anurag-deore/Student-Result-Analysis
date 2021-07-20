<?php
include './_header.php';
$namearr = explode(" ", $_SESSION['name']);
$email = strtolower(substr($namearr[0], 0, 3)) . "." . strtolower(substr($namearr[1], 0, 3)) . ".rt" . substr($_SESSION['username'], 0, 2) . "@rait.ac.in";

$result = mysqli_fetch_aLL(mysqli_query($conn, "Select * from student where ROLL_NO='$_SESSION[username]';"), MYSQLI_ASSOC);
?>
<div class="container">
    <h3 class="my-3">Hi, <?php echo $namearr[1] . " " . $namearr[0]; ?></h3>
    <hr>
    <h4 class="mb-3 mt-3"> Your Results </h4>
    <div class="cstyle row">
        <?php foreach ($result as $r) { ?>
            <div class="col-md-6 mb-5">
                <a href="result2.php?e_date=<?php echo $r['E_DATE']; ?>&sem=<?php echo $r['SEMESTER']; ?>&seat_no=<?php echo $r['SEAT_NO']; ?>" style="text-decoration: none;color:inherit;">
                    <div class="card">
                        <div class="card-body" style="background-color: <?php if ($r['SUB_CODE'] == 'ALL') {
                                                                            echo "#3ddc97";
                                                                        } else {
                                                                            echo "#e15554";
                                                                        }
                                                                        ?>; color: white;">
                            <h5>Exam Date : <?php echo $r['E_DATE'] ?></h5>
                            <h5>Semester : <?php echo $r['SEMESTER'] ?></h5>
                            <h6>Seat No : <?php echo $r['SEAT_NO'] ?></h6>
                            <h6>Attempt : <?php if ($r['SUB_CODE'] == 'ALL') {
                                                echo "Regular";
                                            ?><h6>Subject Code : ALL</h6>
                                <?php
                                            } else {
                                                echo "KT"; ?>
                            </h6>

                            <h6>KT Subject Code : <?php for ($i = 0; $i < strlen($r['SUB_CODE']); $i++) {
                                                        echo $r['SUB_CODE'][$i] . "   ";
                                                    } ?></h6>
                        <?php } ?>
                        </div>
                        <div class="card-header">
                            <h6 style="display:inline-block;">View Result</h6>
                            <span><i class="bi bi-chevron-right" style="float: right;color:black"></i></span>
                        </div>
                    </div>
                </a>
            </div>
        <?php } ?>
    </div>

    <?php
    include './__footer.php';
    ?>