<!--checked-->
<?php
session_start();
// no auto logging for security reason
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin</title>
    <link rel="stylesheet" type="text/css" href="css/simple.css">
    <link rel='stylesheet' href='css/bootstrap.min.css'>
    <style>
        body {
            background-color: #CC9933;
        }
    </style>
</head>
<body>
<div class="container keep-away-from-top">
    <div class="row">
        <div class="col-md-offset-2 col-md-8">
     <!--   Login form    -->
            <form action="adminLogin.php" method="post" class="form-horizontal">
                <span class="heading-admin glyphicon glyphicon-th"></span>
                <span class="heading-admin">Admin</span>
                <div class="form-group">
                    <input type="text" class="form-control auto-color" id="inputEmail3" name="username" placeholder="Username">
                    <i class="fa fa-user"></i>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control auto-color" id="inputPassword3" name="password" placeholder="Password">
                    <i class="fa fa-lock"></i>
                    <a href="#" class="fa fa-question-circle"></a>
                </div>
                <div class="form-group">
                    <div class="main-radio">
                    <input  type="radio" id="radio1" name="permission" value="1" checked="checked">
                        <label for="radio1"></label>
                    </div>
                    <span class="text A-font-admin">Sale Representative</span>
                    <div class="main-radio">
                    <input  type="radio" id="radio2" name="permission" value="2">
                        <label for="radio2"></label>
                    </div>
                    <span class="text A-font-admin">Manager</span>
                    <!--  For security reason, no remember function -->
                    <button type="submit"  name="login" value="Login" class="btn-admin btn-default btn-lg">login</button>
                    <!-- hint-->
                    <span class="text keep-away-from-top hint-admin">If you are sale representative and don't know password and username, please contact manager.</span>
                </div>
            </form>
            <div class="hint">
                <br/>
                <a href="index.php" class="A-font admin">Customer</a>
                <br>
            </div>
        </div>
    </div>
</div>
</body>
</html>
