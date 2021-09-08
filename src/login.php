<!--checked-->
<?php
session_start();
//Set html encoding = utf-8
header('Content-type:text/html; charset=utf-8');
// handler
if (isset($_POST['login'])) {
    // receive form information
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    // if username or password is empty, refresh
    if (($username == '') || ($password == '')) {
        echo '<script>alert("Username or Password is empty");history.go(-1);</script>';
        exit(0);
    } else{
require_once "public_conn.php";
            //connection successes
            $sql_check = "select Id,username,password from users where username = '$username'";
            //check if user exists
            $result = $conn->query($sql_check);
            $number = mysqli_num_rows($result);
            //exists
            if ($number) {
                $row=mysqli_fetch_array($result,MYSQLI_NUM);
                if (md5($password) == $row[2]){
                    // correct username and password, store them in the session
                    $_SESSION['username'] = $username;
                    $_SESSION['userid'] = $row[0];
                    $_SESSION['isLogin'] = 1;
                    // set cookie for auto login
                    if ($_POST['remember'] == "yes") {
                        setcookie('username', $username, time() + 7 * 24 * 60 * 60);
                        setcookie('code', md5($username . md5($password)), time() + 7 * 24 * 60 * 60);
                    } else {
                        // if not choose auto login, delete cookie
                        setcookie('username', '', time() - 999);
                        setcookie('code', '', time() - 999);
                    }
                    // when finished, redirect to the index page
                    header('location:customer/home.php');
                }else{
                    // wrong username or password
                    echo '<script>alert("Username or Password is wrong");history.go(-1);</script>';
                    exit(0);
                }
            } else {
                echo '<script>alert("Username not found");history.go(-1);</script>';
                exit(0);
            }
        }
}
?>