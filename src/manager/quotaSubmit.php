<?php
$id = $_POST['repId'];
$operation_type = $_POST['operation_type'];
$num1 = $_POST["number1"];
$num2 = $_POST["number2"];
$num3 = $_POST["number3"];
require_once "../public_conn.php";
if($operation_type == "1"){
    $sql_add = "update reps set quota_1 = (quota_1 + $num1),quota_2 = (quota_2 + $num2),quota_3 = (quota_3 + $num3) where Id = '$id'";
    $result = $conn->query($sql_add);
    if ($result) {
        echo '<script>alert(\'Add quota successes\');window.location="representative.php";</script>';
    } else {
        echo "<script>alert('Add quota fails, try again later.');history.go(-1);</script>";
    }
}else{
    $sql_update = "update reps set quota_1 = $num1,quota_2 = $num2,quota_3 = $num3 where Id = '$id'";
    $result = $conn->query($sql_update);
    if ($result) {
        echo '<script>alert(\'Update quota successes\');window.location="home.php";</script>';
    } else {
        echo "<script>alert('Update quota fails, try again later.');history.go(-1);</script>";
    }
}
