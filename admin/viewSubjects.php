<?php
include './_header.php';
$delmsg = "";
if (isset($_POST['delete'])) {
    $id = $_POST["delete"];
    $t = mysqli_query($conn, "DELETE FROM subjects WHERE id = '$id'");
    if ($t) {
        $delmsg = '<div class="alert alert-danger w-100"> Subject Deleted</div> ';
        header("Refresh:0");
    }
}
if (isset($_GET['sem'])) {
    $sem = $_GET["sem"];
    $br = $_GET["br"];
    $query = "SELECT * FROM subjects WHERE semester = '$sem'  AND branch = '$br' ";
    $p = mysqli_query($conn, $query);
    $html_table = '
    <table class="content-table" border=1 cellspacing=0>
        <thead>
            <tr>
                <th>Subject</th>
                <th>Code</th>
                <th>Theory</th>
                <th>Term work</th>
                <th>IA</th>
                <th>Practical</th>
                <th>Oral</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>';
    $num = mysqli_num_rows($p);
    if ($num <= 0) {
        $html_table .= '<tr class="text-center" ><th colspan="8">No Subjects Added</th></tr>';
    } else {
        while ($row = mysqli_fetch_assoc($p)) {
            $html_table .= '
            <tr class="active-row">
                <td>' . $row["sub_name"] . '</td>
                <td>' . $row["sub_code"] . '</td>
                <td>' . $row["termWork"] . '</td>
                <td>' . $row["theory"] . '</td>
                <td>' . $row["IA"] . '</td>
                <td>' . $row["practical"] . '</td>
                <td>' . $row["oral"] . '</td>
                <td class="d-flex justify-content-around">
                    <a href="' . ADMIN . 'addSubject.php/?br=' . $_GET['br'] . '&sem=' . $_GET['sem'] . '&modify=' . $row['id'] . '" class="btn alert-primary rounded-pill">Modify</a>
                    <form action=""  method="POST">
                        <input type="hidden" name="delete" value="' . $row["id"] . '">
                        <button type="submit" class="btn alert-danger rounded-pill">Delete</button>
                    </form>
                </td>
            </tr>
        ';
        }
    }
    $html_table .= '
    </tbody>
    </table>';
}
?>
<style>
    .content-table {
        border-collapse: collapse;
        margin: 25px 0;
        width: 100%;
        border-radius: 5px 5px 0 0;
        overflow: hidden;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        padding-right: 800px;
    }

    .content-table thead tr {
        background-color: #3b47f0;
        color: #ffffff;
        text-align: left;
        font-weight: bold;
    }

    .content-table th,
    .content-table td {
        padding: 12px 15px;

    }

    .content-table tbody tr {
        border-bottom: 1px solid #dddddd;
    }

    .content-table tbody tr:nth-of-type(even) {
        background-color: #fff;
        grid-template-rows: 100px;
    }

    .content-table tbody tr:last-of-type {
        border-bottom: 2px solid #4a63f3;
    }

    /* 
    .content-table tbody tr.active-row {
        font-weight: bold;
        color: #4a63f3;
    } */
</style>

<div class="container">
    <?php echo '<a href="' . ADMIN . 'addSubject.php/?br=' . $_GET['br'] . '&sem=' . $_GET['sem'] . '" class="btn btn-primary float-end">Add Subject</a>'; ?>

    <h3 class="my-3"><?php echo $branchName[$_GET['br']] . " Engg - Sem " . $_GET['sem'] . " subjects "; ?></h3>
    <?php echo $html_table; ?>
</div>
<?php
include './_footer.php';
?>