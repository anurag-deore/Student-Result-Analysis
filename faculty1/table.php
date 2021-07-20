<?php
include("connection.php");
error_reporting(0);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
   <table border="1">
       <tr>
       <th>Class</th>
       <th>Semester</th>
       <th>Appeared</th>
       <th>Distinction</th>
       <th>Ist Class</th>
       <th>IInd Class</th>
       <th>Total Pass</th>
       <th>Failed</th>
       <th>Total%</th>
       </tr>
       <tr>
           <th scope="row" rowspan="6">SE</td>
           <td rowspan="3">III</td>
           <td rowspan="3"><?php 
           echo "".mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) FROM student WHERE SEMESTER = '$selected' AND BRANCH = '$branch' AND SUB_CODE = 'ALL' AND SHIFT='$shift' AND NOT(REMARKS LIKE '%NULL%' OR REMARKS = 'ABS');"))['COUNT(*)']."";

           ?>
           </td>
           <td>GRADEO</td>
           <td rowspan="3">GRADE C</td>
           <td rowspan="2">GRADE D</td>
           <td rowspan="3">ff</td>
           <td rowspan="3">ff</td>
           <td rowspan="3">ff</td>
       </tr>
       <tr>
           <td>Grade A</td>
       </tr>
        <tr>
            <td>GRADE B</td>
            <td>GRADE E</td>
        </tr>
        <tr>
            <td rowspan="3">III</td>
           <td rowspan="3">143</td>
           <td>GRADEO</td>
           <td rowspan="3">GRADE C</td>
           <td rowspan="2">GRADE D</td>
           <td rowspan="3">ff</td>
           <td rowspan="3">ff</td>
           <td rowspan="3">ff</td>
        </tr>
        <tr>
           <td>Grade A</td>
       </tr>
        <tr>
            <td>GRADE B</td>
            <td>GRADE E</td>
        </tr>
        <tr>
           <th scope="row" rowspan="6">SE</td>
           <td rowspan="3">III</td>
           <td rowspan="3">143</td>
           <td>GRADE O</td>
           <td rowspan="3">GRADE C</td>
           <td rowspan="2">GRADE D</td>
           <td rowspan="3">ff</td>
           <td rowspan="3">ff</td>
           <td rowspan="3">ff</td>
       </tr>
       <tr>
           <td>Grade A</td>
       </tr>
        <tr>
            <td>GRADE B</td>
            <td>GRADE E</td>
        </tr>
        <tr>
            <td rowspan="3">III</td>
           <td rowspan="3">143</td>
           <td>GRADEO</td>
           <td rowspan="3">GRADE C</td>
           <td rowspan="2">GRADE D</td>
           <td rowspan="3">ff</td>
           <td rowspan="3">ff</td>
           <td rowspan="3">ff</td>
        </tr>
        <tr>
           <td>Grade A</td>
       </tr>
        <tr>
            <td>GRADE B</td>
            <td>GRADE E</td>
        </tr>
        <tr>
            <th scope="row" rowspan="6">BE</th>
            <td rowspan="6">VII</td>
            <td rowspan="6">227</td>
            <td rowspan="2">GRADE O</td>
            <td rowspan="6">GRADE C</td>
            <td rowspan="3">GRADE D</td>
            <td rowspan="6">225</td>
            <td rowspan="6">2</td>
            <td rowspan="6">99</td>
        </tr>
        <tr>
        </tr>
        <tr>
            <td rowspan="2">GRADE A</td>
        </tr>
        <tr>
            <td rowspan="3">GRADE E</td>
        </tr>
        <tr>
            <td rowspan="2">GRADE B</td>
        </tr>
   </table>

</body>
</html>