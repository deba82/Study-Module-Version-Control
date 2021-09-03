<?php
$con = mysqli_connect("localhost", "root", "", "aptitude");
if (isset($_GET["id"])) {
    $id= $_GET["id"];
    $sql= "UPDATE `main` SET `Status` = '0' WHERE `main`.`id` = $id";
    mysqli_query($con, $sql);
    echo $sql;
    header("location:index.php");
}
?>