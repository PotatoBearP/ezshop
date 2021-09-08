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
    $permission = $_POST['permission'];
    // if username or password is empty, refresh
    if (($username == '') || ($password == '')) {
        echo '<script>alert("Username or Password is empty");history.go(-1);</script>';
        exit(0);
    } else{
        require_once "public_conn.php";
            if($permission == 1){
                $sql_check = "select Id,username,password from reps where username = '$username'";
                //check if user exists
                $result = $conn->query($sql_check);
                $number = mysqli_num_rows($result);
                //exists
                if ($number) {
                    $row=mysqli_fetch_array($result);
                    if (md5($password) == $row[2]){
                        // correct username and password, store them in the session
                        $_SESSION['repname'] = $username;
                        $_SESSION['repid'] = $row[0];
                        $_SESSION['isAdminLogin'] = 1;
                        // when finished, redirect to the index page
                        header('location:reps/home.php');
                    }else{
                        // wrong username or password
                        echo '<script>alert("Username or Password is wrong");history.go(-1);</script>';
                        exit(0);
                    }
                } else {
                    echo '<script>alert("Username not found");history.go(-1);</script>';
                    exit(0);
                }
            }else{
                $sql_check = "select Id,username,password from managers where username = '$username'";
                //check if user exists
                $result = $conn->query($sql_check);
                $number = mysqli_num_rows($result);
                //exists
                if ($number) {
                    $row=mysqli_fetch_array($result);
                    if (md5($password) == $row[2]){
                        // correct username and password, store them in the session
                        $_SESSION['manname'] = $username;
                        $_SESSION['manid'] = $row[0];
                        $_SESSION['isAdminLogin'] = 1;
                        // when finished, redirect to the index page
                        header('location:manager/home.php');
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
}
?>