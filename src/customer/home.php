<!--checked-->
<?php
session_start();
// if not login, back to the index
if (!isset($_SESSION["isLogin"])){
//    header('location:index.php');
    exit('Access denied');
}
//connection fails
include_once "../public_update.php";
require_once "../public_conn.php";
$username = $_SESSION['username'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
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
        <!-- Nothing for mobile, not in requirements -->
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
                <li class="active"><a href="#">Home<span class="sr-only">(current)</span></a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="masks.php">View Masks</a></li>
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
                <span class="heading glyphicon glyphicon-home"></span>
                <span class="heading">Welcome back, <?php echo $_SESSION['username']; ?>!</span>
                <p class="tutorial">To use this system, you can use the navigator at the top of the page.
                    <br>
                    <br>
                    <br>
                    <br>
                    <b>Home <span class="glyphicon glyphicon-home"></span></b>: Guide you how to use this system.
                    <br>
                    <br>
                    <b>Profile <span class="glyphicon glyphicon-user"></span></b>: View personal information and make changes.
                    <br>
                    <br>
                    <b>View Masks <span class="glyphicon glyphicon-info-sign"></span></b>: View mask types that you can purchase.
                    <br>
                    <br>
                    <b>Make an Order <span class="glyphicon glyphicon-plus"></span></b>: Add order to purchase masks.
                    <br>
                    <br>
                    <b>Order Details <span class="glyphicon glyphicon-check"></span></b>: Check details of finished and unfinished order.
                </p>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
