<!--checked-->
<?php
//Set html encoding = utf-8
header('Content-type:text/html; charset=utf-8');
//Get information of form
$username = $_POST['username'];
$password = $_POST['password'];
$repassword = $_POST['password2'];
$region = $_POST['region'];
$realname = trim($_POST['realname']);
$email = trim($_POST['email']);
$phone = trim($_POST['phone']);
$passport = trim($_POST['passport']);
//Empty username
if ($username == ''){
    echo '<script>alert("Please enter username");history.go(-1);</script>';
    exit(0);
}
//Empty realname
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
//Empty password
if ($password == ''){
    echo '<script>alert("Please enter password");history.go(-1);</script>';
    exit(0);
}
//Empty passport
if ($passport == ''){
    echo '<script>alert("Please enter passport");history.go(-1);</script>';
    exit(0);
}
//Validate password (compare with repassword)
//Wrong password
if ($password != $repassword){
    echo '<script>alert("Re-enter password is different");history.go(-1);</script>';
    exit(0);
}
//Right password, build connection
if($password == $repassword){
    require_once "public_conn.php";
        //connection successes
        $sql_check = "select username from users where username = '$username'";
        //check if user exists
        $result = $conn->query($sql_check);
        $number = mysqli_num_rows($result);
        //exists
        if ($number) {
            echo '<script>alert("user exists");history.go(-1);</script>';
            // not exist
        } else {
            $md5_password = md5($password);
            $sql_insert = "insert into users (username,realname,password,phone_number,region,email,passport) values('$username','$realname','$md5_password','$phone','$region','$email','$passport')";
            $res_insert = $conn->query($sql_insert);
            if ($res_insert) {
                echo '<script>alert(\'registration successes\');window.location="index.php";</script>';
            } else {
                echo "<script>alert('registration fails, try again later.');history.go(-1);</script>";
            }
        }
}else{
    echo "<script>alert('Wrong！'); history.go(-1);</script>";
}
?>