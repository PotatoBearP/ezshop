<!--checked-->
<?php
include_once "../public_update.php";
session_start();
$userId = $_SESSION["userid"];
//Set html encoding = utf-8
header('Content-type:text/html; charset=utf-8');
//Get information of form
//For data safety, convention are made
$n1= strval(trim($_POST['m1']));
$n2= strval(trim($_POST['m2']));
$n3= strval(trim($_POST['m3']));
$addr= trim($_POST['address']);
$rep= $_POST['rep'];
if ($n1==0&&$n2==0&&$n3==0){
    echo '<script>alert("Please set at least one type");history.go(-1);</script>';
    exit(0);
}
if ($addr == ''){
    echo '<script>alert("Please enter your address");history.go(-1);</script>';
    exit(0);
}
require_once "../public_conn.php";

    $sql_insert = "insert into orders (Date,OrderNumber_1,OrderNumber_2,OrderNumber_3,Address,IsFinished) values(CURRENT_TIMESTAMP,$n1,$n2,$n3,\"$addr\",0)";
    $res_insert = $conn->query($sql_insert);
    $sql_id = "select LAST_INSERT_ID()";
    $res_id = $conn->query($sql_id);
    $ord_id = mysqli_fetch_array($res_id,MYSQLI_NUM)[0];
    $sql_insert_relation1 = "insert into user_order_relation (UserId,OrderId) values($userId,$ord_id)";
    $res_insert_relation1 = $conn->query($sql_insert_relation1);
    $sql_insert_relation2 = "insert into rep_order_relation (RepId,OrderId) values($rep,$ord_id)";
    $res_insert_relation2 = $conn->query($sql_insert_relation2);
    if ($res_insert&&$res_id&&$res_insert_relation1&&res_insert_relation2) {
        echo '<script>alert(\'Add successes\');window.location="home.php";</script>';
    } else {
        echo "<script>alert('Add fails, try again later.');history.go(-1);</script>";
    }

?>