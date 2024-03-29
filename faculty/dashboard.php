<?php
include './_header.php';
?>
<div class="dashboard container">
    <h3 class="my-3">Hi, <?php echo $_SESSION['name']; ?></h3>
    <div class="row">
        <div class="col-md-6 mb-3">
            <a href="<?php echo FACULTY . 'classwise.php'; ?>" class="card text-decoration-none gradient-1">
                <div class="card-body">
                    <img src="<?php echo ASSETS . 'circle.svg'; ?>" alt="" class="card-img-holder">
                    <h5 class="card-title">Classwise Result</h5>
                    <p>View CLasswise Results for Semesters</p>
                    <i class="text-light bi bi-chevron-right"></i>
                </div>
            </a>
        </div>
        <div class="col-md-6 mb-3">
            <a href="<?php echo FACULTY . 'subjectwise.php'; ?>" class="card text-decoration-none gradient-2">
                <div class="card-body">
                    <img src="<?php echo ASSETS . 'circle.svg'; ?>" alt="" class="card-img-holder">
                    <h5 class="card-title">Subject Wise Result</h5>
                    <p>View Subject results for each Sem Exam</p>
                    <i class="text-light bi bi-chevron-right"></i>
                </div>
            </a>
        </div>
        <div class="col-md-6 mb-3">
            <a href="<?php echo FACULTY . 'toppers.php'; ?>" class="card text-decoration-none gradient-3">
                <div class="card-body">
                    <img src="<?php echo ASSETS . 'circle.svg'; ?>" alt="" class="card-img-holder">
                    <h5 class="card-title">Get Toppers List</h5>
                    <p>Get Toppers List</p>
                    <i class="text-light bi bi-chevron-right"></i>
                </div>
            </a>
        </div>
        <div class="col-md-6 mb-3">
            <a href="<?php echo FACULTY . 'studentSearch.php'; ?>" class="card text-decoration-none gradient-4">
                <div class="card-body">
                    <img src="<?php echo ASSETS . 'circle.svg'; ?>" alt="" class="card-img-holder">
                    <h5 class="card-title">Search Student Data</h5>
                    <p>Get details for a student</p>
                    <i class="text-light bi bi-chevron-right"></i>
                </div>
            </a>
        </div>
    </div>
</div>
<?php
include './__footer.php';
?>