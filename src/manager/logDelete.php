<?php
session_start();
$id = $_GET['id'];
if ($id == 0) {
    header('Refresh:3;url=home.php');
    echo 'The order does not exist！';
    exit;
}
require_once "../public_conn.php";

$sql_delete = "delete from log where id = $id";
$res_delete = $conn->query($sql_delete);
if ($res_delete){
    echo '<script>history.go(-1);</script>';
}else{
    echo '<script>alert("Error");history.go(-1);</script>';
}
