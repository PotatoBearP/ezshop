<!--checked-->
<?php
session_start();
require_once "../public_conn.php";
// if not login, back to the index
if (!isset($_SESSION["isLogin"])){
//    header('location:index.php');
    exit('Access denied');
}
//Set html encoding = utf-8
header('Content-type:text/html; charset=utf-8');
//Get information of form
$region = $_POST['region'];
$realname = trim($_POST['realname']);
$email = trim($_POST['email']);
$phone = trim($_POST['phone']);
$passport = trim($_POST['passport']);
$username = $_SESSION['username'];
if ($realname == ''){
    echo '<script>alert("Please enter your name");history.go(-1);</script>';
    exit(0);
}
//Empty email
if ($email == ''){
    echo '<script>alert("Please enter your email");history.go(-1);</script>';
    exit(0);
}
//Empty phone
if ($phone == ''){
    echo '<script>alert("Please enter your phone number");history.go(-1);</script>';
    exit(0);
}
if ($passport == ''){
    echo '<script>alert("Please enter passport");history.go(-1);</script>';
    exit(0);
}

$sql_insert = "update users set realname ='$realname' ,phone_number ='$phone' ,email= '$email',passport= '$passport' where username = '$username'";
$res_insert = $conn->query($sql_insert);
if ($res_insert) {
    echo '<script>alert(\'Update successes\');window.location="home.php";</script>';
} else {
    echo "<script>alert('Update fails, try again later.');history.go(-1);</script>";
}
?>