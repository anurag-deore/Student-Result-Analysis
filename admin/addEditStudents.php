<?php
include './_header.php';
$error = NULL;
if (isset($_POST["addStudent"])) {
    $studentusername = mysqli_real_escape_string($conn, $_REQUEST['studentusername']);
    $studentname = mysqli_real_escape_string($conn, $_REQUEST['studentname']);
    $studentpassword = sha1(mysqli_real_escape_string($conn, $_REQUEST['studentpassword']));
    if (!empty($studentusername) && !empty($studentpassword) && !empty($studentname)) {

        $sql = "INSERT IGNORE INTO auth(username,password,name,usertype) 
        VALUES ('$studentusername','$studentpassword','$studentname','student')";
        $query = mysqli_query($conn, $sql);
        if ($query) {
            $insert_id = mysqli_insert_id($conn);
            if ($insert_id != '') {
                echo "INSERTED";
            } else {
                echo "ALREADY PRESENT";
            }
            echo "ALREADY PRESENT";
        }
    } else {
        $error =  "Please fill in the details completely.";
    }
}
?>
<div class="container mt-3">
    <h2 class="my-4">Add New Student</h2>
    <div class="row">
        <div class="col-12">
            <div class="card p-5 pt-4">
                <?php if (isset($error)) {
                    echo '
                    <div class="alert alert-danger alert-dismissible show" role="alert">
                        <strong>Error</strong>  -  ' . $error . '
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                } ?>
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="studentusername" class="form-label">Username</label>
                        <input type="text" name="studentusername" class="form-control" id="studentusername">
                    </div>
                    <div class="mb-3">
                        <label for="studentname" class="form-label">Name</label>
                        <input type="text" name="studentname" class="form-control" id="studentname">
                    </div>
                    <div class="mb-3">
                        <label for="studentpassword" class="form-label">Password</label>
                        <input type="password" name="studentpassword" value="12345" class="form-control" id="studentpassword">
                        <div id="studentpassword" class="form-text">Default Password : 12345</div>
                    </div>
                    <button type="submit" name="addStudent" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>