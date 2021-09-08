<!--checked-->
<?php
session_start();
// if not login, back to the index
if (!isset($_SESSION["isLogin"])){
//    header('location:index.php');
    exit('Access denied');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Masks</title>
    <link type="text/css" rel="styleSheet"  href="../css/main.css" />
    <link rel="stylesheet" type="text/css" href="../css/simple.css">
    <link rel='stylesheet' href='../css/bootstrap.min.css'>
</head>
<style>
    body{
        background-color: #CCCC33;
    }
</style>
<body>
<!--navigator-->
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Woolin Auto SMS</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li ><a href="home.php">Home</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li class="active"><a href="#">View Masks<span class="sr-only">(current)</span></a></li>
                <li><a href="orderCreate.php">Make an Order</a></li>
                <li><a href="orderDetails.php">Order Details</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="logout.php">Log Out</a></li>
            </ul>
        </div>
    </div>
</nav>
<!---->
<div class="container keep-away-from-top">
    <div class="row">
        <div class="col-md-offset-1 col-md-10">
            <div class="form-horizontal">
                <span class="heading glyphicon glyphicon-info-sign"></span>
                <span class="heading">N95 respirator<img class = "masks-disp" src="../img/n.jpg"></span>
                <span class="heading">Surgical mask<img class = "masks-disp" src="../img/s.png"></span>
                <span class="heading">N95 surgical respirator<img class = "masks-disp" src="../img/ns.jpg"></span>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
