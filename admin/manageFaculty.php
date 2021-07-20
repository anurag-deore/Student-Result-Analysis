<?php
include './_header.php';
$query = mysqli_query($conn, "SELECT * FROM `auth` WHERE `usertype`='faculty'");
$id = 1;
?>
<div class="container mt-3">
    <a href="addEditStudents.php" class="btn btn-primary float-end">Add Faculty Member</a>
    <h2 class="my-4">Manage Faculty Members</h2>
    <div class="row">
        <div class="col-12 card p-4">
            <table class="cell-border hover" id="studentDetails">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Username</th>
                        <th>Name</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_array($query)) {
                        echo    '<tr>
                        <td>' . $id++ . '</td>
                        <td>' . $row['username'] . '</td>
                        <td>' . $row['name'] . '</td>
                        <td><button class="btn w-100 btn-block btn-outline-secondary">Edit</button></td>
                    </tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#studentDetails').DataTable();
    });
</script>