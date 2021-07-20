<?php
include './_header.php';
?>
<div class="container">
    <h3 class="my-3">Manage</h3>
    <div class="manageboard row">
        <div class="col-md-6 mb-3">
            <div class="card">
                <h5 class="card-title">
                    <i class="bi bi-person-lines-fill text-primary"></i>
                    <div class="count">
                        <span class="count--number text-primary">123</span>
                        <span class="count--title text-primary">Students added</span>
                    </div>
                </h5>
                <a href="manageStudents.php" class="moreInfo alert-primary ">
                    <span>Manage Students</span>
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="card">
                <h5 class="card-title">
                    <i class="bi bi-people text-dark"></i>
                    <div class="count">
                        <span class="count--number text-dark">12</span>
                        <span class="count--title text-dark">Faculties added</span>
                    </div>
                </h5>
                <a href="manageFaculty.php" class="moreInfo alert-dark">
                    <span>Manage Faculties</span>
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="card">
                <h5 class="card-title">
                    <i class="bi bi-journals text-danger"></i>
                    <div class="count">
                        <span class="count--number text-danger">20</span>
                        <span class="count--title text-danger">Subjects added</span>
                    </div>
                </h5>
                <a href="manageSubjects.php" class="moreInfo alert-danger">
                    <span>Manage Semester-Wise Subjects</span>
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="card">
                <h5 class="card-title">
                    <i class="bi bi-book text-success"></i>
                    <div class="count">
                        <span class="count--number text-success">8</span>
                        <span class="count--title text-success">Exams added</span>
                    </div>
                </h5>
                <a href="manageExams.php" class="moreInfo alert-success">
                    <span>Manage Exams Details</span>
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
    <hr>
    <h3 class="my-3">View</h3>
    <div class="dashboard row">
        <div class="col-md-6 mb-3">
            <div class="card gradient-1">
                <div class="card-body">
                    <img src="<?php echo ASSETS . 'circle.svg'; ?>" alt="" class="card-img-holder">
                    <h5 class="card-title">All Semester Grades</h5>
                    <p>View Results for all Semesters</p>
                    <i class="bi bi-chevron-right"></i>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="card gradient-2">
                <div class="card-body">
                    <img src="<?php echo ASSETS . 'circle.svg'; ?>" alt="" class="card-img-holder">
                    <h5 class="card-title">Subject Wise Result</h5>
                    <p>View Subject results for each Sem Exam</p>
                    <i class="bi bi-chevron-right"></i>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="card gradient-3">
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