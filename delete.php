<?php
$con = mysqli_connect("localhost", "root", "", "aptitude");
if (isset($_GET["id"])) {
    $id= $_GET["id"];
    $sql = "DELETE FROM `main` WHERE `main`.`id` =$id ";
    mysqli_query($con, $sql);
    echo $sql;
    header("location:index.php");
}
?>