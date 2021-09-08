<!--checked-->
<!--checked tag tell me what page is modified to the cslinux environment, just ignore them-->
<?php
// update information of order
require_once "public_update.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/simple.css">
    <link rel='stylesheet' href='css/bootstrap.min.css'>
    <style>
        body {
            background-color: #CCCC33;
        }
    </style>
</head>
<body>
<div class="System-title">
    Woolin Auto
</div>
<div class="container keep-away-from-top">
    <div class="row">
        <div class="col-md-offset-2 col-md-8">
            <form action="login.php" method="post" class="form-horizontal">
                <span class="heading glyphicon glyphicon-globe"></span>
                <span class="heading">Log In</span>
                <div class="form-group">
                    <input type="text" class="form-control auto-color" id="inputEmail3" name="username" placeholder="Username">
                    <i class="fa fa-user"></i>
                </div>
                <div class="form-group help">
                    <input type="password" class="form-control auto-color" id="inputPassword3" name="password" placeholder="Password">
                    <i class="fa fa-lock"></i>
                    <a href="#" class="fa fa-question-circle"></a>
                </div>

                <div class="form-group">
                    <div class="main-checkbox">
                        <input type="checkbox" value="None" id="checkbox1" name="remember"/>
                        <label for="checkbox1"></label>
                    </div>
                    <span class="text A-font">Remember me</span>

                    <button type="submit"  name="login" value="Login"class="btn btn-default btn-lg">login</button>
                </div>
            </form>
            <div class="hint">
                <span class="A-font hint">No Account?</span>
                <a href="register.html" class="A-font ref">Register</a>
                <br/>
                <br/>
                <a href="admin.php" class="A-font admin">Admin</a>
                <br>
            </div>
        </div>
    </div>
</div>
</body>
</html>
