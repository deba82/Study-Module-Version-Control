<?php
if (isset($_POST["Savelist"])){
    $Savelist=$_POST["Savelist"];
    $con = mysqli_connect("localhost", "root", "", "aptitude");
    $sql= "INSERT INTO `completed` (`id`, `list`, `Time`) VALUES (NULL, '$Savelist', current_timestamp())" ;
    $res1=mysqli_query($con,$sql)   ;
    $sql= "SELECT * FROM `options` where heading='Completed Questions'";
    $res2 = mysqli_query($con, $sql);
    if(mysqli_num_rows($res2)>0){
        $result=mysqli_fetch_assoc($res2);
        if($result['value']==""){
            $separator="";
        }
        else{
            $separator = ",";
        }
        $value=$result['value'].$separator.$Savelist;
        $sql= "UPDATE `options` SET `value` = '$value' WHERE `options`.`id` = 1";
        $res2 = mysqli_query($con, $sql); 
    }
    if($res1==1 && $res2==1){
        echo "1";
    }
}
?>