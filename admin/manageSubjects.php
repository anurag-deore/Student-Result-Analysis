<?php
include './_header.php';
?>
<div class="container">
    <h3 class="my-3">Manage Subjects for all Semesters</h3>
    <hr>
    <div class="card p-4 mb-3">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <?php
            foreach ($branchShortName as $key => $value) {
                echo '
                <li class="nav-item rounded" role="presentation">
                    <button class="nav-link ' . ($value == "Computer" ? "active" : "") . '" id="' . $value . '-tab" data-bs-toggle="tab" data-bs-target="#' . $value . '" type="button" role="tab" aria-controls="' . $value . '" aria-selected="true">' . $value . '</button>
                </li>';
            }
            ?>
        </ul>
        <div class="tab-content" id="myTabContent">
            <?php
            foreach ($branchShortName as $key => $value) {
                echo '  <div class="tab-pane fade show p-3 ' . ($value == "Computer" ? "active" : "") . '" id="' . $value . '" role="tabpanel" aria-labelledby="' . $value . '-tab">
                        <h4 class="py-3">' . $value . ' Engineering</h4>
                        <div class="row g-3" >';
                for ($i = 3; $i < 9; $i++) {
                    echo ($i % 2 != 0 ? ' <span class="text-muted" style="font-size:20px;">' . $yearMap[$i] . '</span> ' : '');
                    echo '  <div class="col-6">
                                <a href="viewSubjects.php/?br=' . $key . '&sem=' . $i . '" class="text-decoration-none">
                                    <div class="btn btn-outline-primary w-100 text-start p-3" style="cursor:pointer;">
                                            <span class="h6"> Semester  - ' . $semMap[$i] . '</span>
                                    </div>
                                </a>
                            </div>';
                }
                echo '</div>
                    </div>';
            }
            ?>
        </div>
    </div>
</div>
<?php
include './_footer.php';
?>