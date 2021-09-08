<!--checked-->
<?php
include_once "../public_update.php";
session_start();
$u_id = $_SESSION["userid"];
$o_id = isset($_GET['id']) ? (integer)$_GET['id'] : 0;
if ($o_id == 0) {
    header('Refresh:3;url=home.php');
    echo 'The order does not exist！';
    exit;
}
require_once "../public_conn.php";
    //connection successes
    $sql_delete = "delete from orders where id = $o_id";
    $sql_delete_relation1 = "delete from user_order_relation where OrderId = $o_id";
    $sql_delete_relation2 = "delete from rep_order_relation where OrderId = $o_id";
    $res_delete = $conn->query($sql_delete);
    $res_delete_relation1 = $conn->query($sql_delete_relation1);
    $res_delete_relation2 = $conn->query($sql_delete_relation2);
    if ($res_delete&&$res_delete_relation1&&$res_delete_relation2){
        echo '<script>alert("Delete Success");history.go(-1);</script>';
    }else{
        echo '<script>alert("Delete Fail");history.go(-1);</script>';
    }

