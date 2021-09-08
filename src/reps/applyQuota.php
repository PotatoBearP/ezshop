<!--checked-->
<?php
session_start();
// if not login, back to the index
if (!isset($_SESSION["isAdminLogin"])){
//    header('location:index.php');
    exit('Access denied');
}
include_once "../public_update.php";
require_once "../public_conn.php";

$username = $_SESSION['repname'];
$sql_get_reps = "select quota_1,quota_2,quota_3 from reps where username = '$username'";
$res_get_reps = $conn->query($sql_get_reps);
$quota = mysqli_fetch_array($res_get_reps);
$quota_1 = $quota[0];
$quota_2 = $quota[1];
$quota_3 = $quota[2];
//get orders
$sql_get_order = "select SUM(o.OrderNumber_1),SUM(o.OrderNumber_2),SUM(o.OrderNumber_3) from user_order_relation as uo left join users as u on u.Id=uo.UserId left join orders as o on o.Id=uo.OrderId left join rep_order_relation as ro on ro.OrderId = o.Id left join reps as r on ro.RepId = r.Id where r.username = '$username'AND IsFinished = 1 ";
$result1 = $conn->query($sql_get_order);
$rows1 = mysqli_fetch_array($result1);
$total_1 = $rows1[0];
$total_2 = $rows1[1];
$total_3 = $rows1[2];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Quota</title>
    <link rel="stylesheet" type="text/css" href="../css/simple.css">
    <link rel='stylesheet' href='../css/bootstrap.min.css'>
</head>
<style>
    body{
        background-color: #CC9933;
    }
    .keep-center-bt{
        font-size: 20px;
        color: #fff;
        background: #CC9933;
        border-radius: 30px;
        padding: 15px 30px;
        border: none;
        text-transform: capitalize;
        transition: all 0.5s ease 0s;
        margin-left: 42%;
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
            <a class="navbar-brand" href="#">Representative Console</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="home.php">Home</a></li>
                <li><a href="transaction.php">Transaction</a></li>
                <li><a href="history.php">History</a></li>
                <li class="active"><a href="#">Apply Quota<span class="sr-only">(current)</span></a></li>
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
                <span class="heading-admin glyphicon glyphicon-send"></span>
                <span class="heading-admin">Application</span>
                <form action="logUpdate.php" method="post" class="form-horizontal">
                    <div class="form-group">
                        <label for="reason" class="col-sm-3 control-label A-font-admin">Number:</label>
                        <div class="col-sm-8 ">
                            <input type="number" name="number" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="reason" class="col-sm-3 control-label A-font-admin">Reason:</label>
                        <div class="col-sm-8 ">
                            <textarea type="textarea" name="reason" class="form-control" id="reason"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit"  name="apply" value="Apply" class="keep-center-bt btn-default col-sm-2">Apply</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
