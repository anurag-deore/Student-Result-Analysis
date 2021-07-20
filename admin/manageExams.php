<?php
include './_header.php';
?>
<style>
    .content-table {
        border-collapse: collapse;
        margin: 25px auto;
        width: 100%;
        border-radius: 5px 5px 0 0;
        overflow: hidden;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        padding-right: 800px;
    }

    .content-table thead tr {
        background-color: #3b47f0;
        color: #ffffff;
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
    <a href="addExamResult.php" class="btn btn-primary float-end">Add Result File</a>
    <h3 class="my-3">Exam Results Added </h3>
    <table class="content-table text-center" border=1 cellspacing=0>
        <thead>
            <tr>
                <th>Exam Date</th>
                <th>Added on</th>
            </tr>
        </thead>
        <tbody>
            <tr class="active-row">
                <td>May 2018</td>
                <td>12-03-2021</td>
            </tr>
            <tr>
                <td>Nov 2018</td>
                <td>12-03-2021</td>
            </tr>
            <tr>
                <td>May 2019</td>
                <td>12-03-2021</td>
            </tr>
            <tr>
                <td>Nov 2019</td>
                <td>12-03-2021</td>
            </tr>
            <tr>
                <td>May 2020</td>
                <td>12-03-2021</td>
            </tr>
        </tbody>
    </table>
</div>
<?php
include './_footer.php';
?>