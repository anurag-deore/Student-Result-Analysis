<?php
$severname='localhost';
$user='root';
$password='';
$dbname='resultanalysis';

$conn=mysqli_connect($severname,$user,$password,$dbname);

if($conn)
{
    echo "";
}
else{
    echo "connection to database failed";
}

?>