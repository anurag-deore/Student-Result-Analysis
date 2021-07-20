<?php
include './_header.php';
?>
<style>
    .wrapper {
        margin: 20px auto;
        padding: 20px;
        border: 1px solid lightgray;
        border-radius: 4px;
        background-color: white;
        box-shadow: 1px 1px 2px rgba(0, 0, 0, 0.125);
    }

    .wrapper .title {
        font-size: 20px;
        font-weight: 700;
        margin-bottom: 15px;
        color: #4242f0;
        text-transform: uppercase;
    }

    .wrapper .form {
        width: 100%;
    }

    .wrapper .form .input_field {
        margin-bottom: 15px;
        display: flex;
        align-items: center;
    }

    .wrapper .form .input_field label {

        margin-right: 10px;
        font-size: 20px;
    }

    .wrapper .form .input_field .input {
        width: 100%;
        outline: none;
        border: 1px solid #d5dbd9;
        font-size: 15px;
        padding: 8px 10px;
        border-radius: 3px;
        transition: all 0.3s ease;
    }

    .wrapper .form .input_field .input:focus {
        border: 1px solid #477de2;
    }

    .wrapper .form .input_field .btn {
        width: 100%;
        padding: 8px 10px;
        font-size: 15px;
        border: 0;
        background: #477de2;
        color: #fff;
        cursor: pointer;
        border-radius: 2px;
        outline: none;
    }

    .wrapper .form .input_field .btn:hover {
        background: #4e93ec;
    }
</style>
</head>
<?php
if (isset($_GET['modify'])) {
    $modify_id = $_GET['modify'];
    $insert = "SELECT * FROM  subjects WHERE id='$modify_id' LIMIT 1";
    $res = mysqli_query($conn, $insert);
    $oldVal = null;
    while ($row = mysqli_fetch_assoc($res)) {
        $oldVal = array(
            "semester" => $row['semester'],
            "sub_name" => $row['sub_name'],
            "sub_code" => $row['sub_code'],
            "termWork" => $row['termWork'],
            "theory" => $row['theory'],
            "IA" => $row['IA'],
            "practical" => $row['practical'],
            "sub_number" => $row['sub_number'],
            "oral" => $row['oral'],
        );
    }
}

if (isset($_POST['semester'])) {
    if (isset($_POST['modify_post'])) {
        // header('Location: viewSubjects.php');
        $branch = $branchShortNameReverse[$_POST['branch']];
        $semester = $_POST['semester'];
        $sub_name = $_POST['sub_name'];
        $sub_code = $_POST['sub_code'];
        $termWork = $_POST['termWork'];
        $theory = $_POST['theory'];
        $IA = $_POST['IA'];
        $practical = $_POST['practical'];
        $sub_number = $_POST['sub_number'];
        $oral = $_POST['oral'];
        $update = "UPDATE subjects SET 
        sub_code = '$sub_code',
        sub_name = '$sub_name',
        branch = '$branch',
        termWork = '$termWork',
        theory = '$theory',
        IA = '$IA',
        practical = '$practical',
        oral = '$oral',
        semester = '$semester',
        sub_number = '$sub_number' WHERE id = '$modify_id'";
        $res = mysqli_query($conn, $update);
        if ($res) {
            echo '<div class="alert alert-info"><i class="bi bi-check2-circle h3 me-3"></i> Data UPDATED Successfully</div> ';
            echo "<script>window.location.href='" . ADMIN . "viewSubjects.php/?br=" . $_GET['br'] . "&sem=" . $_GET['sem'] . "';</script>";
            exit;
        }
    } else {
        $branch = $branchShortNameReverse[$_POST['branch']];
        $semester = $_POST['semester'];
        $sub_name = $_POST['sub_name'];
        $sub_code = $_POST['sub_code'];
        $termWork = $_POST['termWork'];
        $theory = $_POST['theory'];
        $IA = $_POST['IA'];
        $practical = $_POST['practical'];
        $sub_number = $_POST['sub_number'];
        $oral = $_POST['oral'];
        $insert = "INSERT INTO 
    subjects (sub_code, sub_name, branch, termWork, theory, IA, practical, oral, semester,sub_number) 
    VALUES ('$sub_code','$sub_name','$branch','$termWork','$theory','$IA','$practical','$oral','$semester','$sub_number')";
        $res = mysqli_query($conn, $insert);
        if ($res) {
            echo '<div class="alert alert-info"> <i class="bi bi-check2-circle h3 me-3"></i> Data Added Successfully</div> ';
            echo "<script>window.location.href='" . ADMIN . "viewSubjects.php/?br=" . $_GET['br'] . "&sem=" . $_GET['sem'] . "';</script>";
            exit;
        }
    }
}
?>

<body>
    <div class="container">
        <h3 class="my-3">Add New Subject</h3>
        <div class="wrapper">
            <div class="title">SUBJECT DETAILS</div>
            <form action="" method="POST">
                <div class="form-group row mb-3">
                    <label class="control-label col-sm-2">Semester</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" value="<?php echo  $_GET['sem']; ?>" name="semester" readonly placeholder="Semester">
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label class="control-label col-sm-2">Branch</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Branch" name="branch" value="<?php echo  $branchShortName[$_GET['br']]; ?>" readonly>
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label class="control-label col-sm-2">Subject Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="sub_name" <?php echo ($oldVal != null ? "value='" . $oldVal["sub_name"] . "'" : null) ?> placeholder="Enter Subject Name">
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label class="control-label col-sm-2">Subject Number</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="sub_number" <?php echo ($oldVal != null ? "value='" . $oldVal["sub_number"] . "'" : null) ?> placeholder="Enter Subject Number">
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label class="control-label col-sm-2">Subject Code</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="sub_code" <?php echo ($oldVal != null ? "value='" . $oldVal["sub_code"] . "'" : null) ?> placeholder="Code">
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label class="control-label col-sm-2">Term work Marks</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" name="termWork" <?php echo ($oldVal != null ? "value='" . $oldVal["termWork"] . "'" : null) ?> placeholder="Enter Term work marks">
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label class="control-label col-sm-2">Theory Marks</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" name="theory" <?php echo ($oldVal != null ? "value='" . $oldVal["theory"] . "'" : null) ?> placeholder="Enter Theory marks">
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label class="control-label col-sm-2">IA Marks</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" name="IA" <?php echo ($oldVal != null ? "value='" . $oldVal["IA"] . "'" : null) ?> placeholder="Enter IA marks">
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label class="control-label col-sm-2">Practical Marks</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" name="practical" <?php echo ($oldVal != null ? "value='" . $oldVal["practical"] . "'" : null) ?> placeholder="Enter Practical marks">
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label class="control-label col-sm-2">Oral Marks</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" name="oral" <?php echo ($oldVal != null ? "value='" . $oldVal["oral"] . "'" : null) ?> placeholder="Enter Oral marks">
                    </div>
                </div>
                <?php if ($oldVal != null) { ?> <input type="hidden" name="modify_post" value="$modify_id"> <?php } ?>
                <div class="row form-group">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
    <?php
    include './_footer.php';
    ?>