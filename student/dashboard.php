<?php
include './_header.php';
?>
<div class="dashboard container">
    <h3 class="my-3">Hi, <?php echo $_SESSION['name']; ?></h3>
    <div class="row">
        <div class="col-md-6 mb-3">
            <div class="card gradient-teal-1">
                <div class="card-body">
                    <img src="<?php echo ASSETS . 'circle.svg'; ?>" alt="" class="card-img-holder">
                    <h5 class="card-title">All Semester Grades</h5>
                    <p>View Results for all Semesters</p>
                    <i class="bi bi-chevron-right"></i>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="card gradient-red-blue">
                <div class="card-body">
                    <img src="<?php echo ASSETS . 'circle.svg'; ?>" alt="" class="card-img-holder">
                    <h5 class="card-title">Subject Wise Result</h5>
                    <p>View Subject results for each Sem Exam</p>
                    <i class="bi bi-chevron-right"></i>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="card gradient-green-1">
                <div class="card-body">
                    <img src="<?php echo ASSETS . 'circle.svg'; ?>" alt="" class="card-img-holder">
                    <h5 class="card-title">Download Reports</h5>
                    <p>Get reports for your semester Exam</p>
                    <i class="bi bi-chevron-right"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include './__footer.php';
?>