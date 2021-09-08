<!--checked-->
<?php
include_once "../public_update.php";
session_start();
// if not login, back to the index
if (!isset($_SESSION["isLogin"])){
//    header('location:index.php');
    exit('Access denied');
}
require_once "../public_conn.php";

$username = $_SESSION['username'];
$sql_get_order = "select o.Id,o.Date,o.OrderNumber_1,o.OrderNumber_2,o.OrderNumber_3,o.Address,r.realname,r.phone_number from user_order_relation as uo left join users as u on u.Id=uo.UserId left join orders as o on o.Id=uo.OrderId left join rep_order_relation as ro on ro.OrderId = o.Id left join reps as r on ro.RepId = r.Id where u.username = '$username'AND IsFinished = 0 ";
$result1 = $conn->query($sql_get_order);
$sql_get_finished_order = "select o.Id,o.Date,o.OrderNumber_1,o.OrderNumber_2,o.OrderNumber_3,o.Address,r.realname,r.phone_number from user_order_relation as uo left join users as u on u.Id=uo.UserId left join orders as o on o.Id=uo.OrderId left join rep_order_relation as ro on ro.OrderId = o.Id left join reps as r on ro.RepId = r.Id where u.username = '$username'AND IsFinished = 1 ";
$result2 = $conn->query($sql_get_finished_order);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link type="text/css" rel="styleSheet"  href="../css/main.css" />
    <link rel="stylesheet" type="text/css" href="../css/simple.css">
    <link rel='stylesheet' href='../css/bootstrap.min.css'>
</head>
<style>
    body{
        background-color: #CCCC33;
    }
    th{
        text-align: center;
    }
    .T-Font{
        font-weight: bold;
        font-family: Tahoma,Arial;
        font-size: 17px;
        color: #898901;
    }
    .T-Font-sub{
        font-family: Tahoma,Arial;
        font-size: 14px;
        color: #898901;
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
                <li><a href="home.php">Home<span class="sr-only">(current)</span></a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="masks.php">View Masks</a></li>
                <li><a href="orderCreate.php">Make an Order</a></li>
                <li class="active"><a href="#">Order Details<span class="sr-only">(current)</span></a></li>
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
        <div class="col-md-offset-0 col-md-13">
            <div class="form-horizontal">
                <span class="heading glyphicon glyphicon-edit">UnFinished</span>
                <?php
                if (mysqli_num_rows($result1) == 0){
                    echo '<p class="A-font">Orders not found</p>';
                }else{
                    echo  '<table class="table table-striped table-hover">
                <thead class="T-Font" style="border-color: #CCCC33;">
                    <tr>
                        <th>Order Id</th>
                        <th>Date</th>
                        <th>N95</th>
                        <th>Surgical</th>
                        <th>N95 Surgical</th>
                        <th>Address</th>
                        <th>Rep</th>
                        <th>Phone</th>
                        <th>Operation</th>
                    </tr>
                </thead>
                <tbody class="T-Font-sub">
                   ';
                    while ($value = mysqli_fetch_array($result1)){
                        echo '<tr>
            <td>'.$value[0].'</td>
            <td>'.$value[1].'</td>
            <td>'.$value[2].'</td>
            <td>'.$value[3].'</td>
            <td>'.$value[4].'</td>
            <td>'.$value[5].'</td>
            <td>'.$value[6].'</td>
            <td>'.$value[7].'</td>
            <td>
                <a href="orderDelete.php?id='.$value[0].'" onclick="return confirm(\'Do you want to delete the order?\');">Delete</a>&nbsp;
            </td> 
        </tr>';
                    }
                    echo '</tbody>
</table>';
                }
                ?>
                <span class="heading glyphicon glyphicon-check">IsFinished</span>
                <?php
                if (mysqli_num_rows($result2) == 0){
                    echo '<p class="A-font">Orders not found</p>';
                }else{
                    echo  '<table class="table table-striped table-hover">
                <thead class="T-Font">
                    <tr>
                       <th>Order Id</th>
                        <th>Date</th>
                        <th>N95</th>
                        <th>Surgical</th>
                        <th>N95 Surgical</th>
                        <th>Address</th>
                        <th>Rep</th>
                        <th>Phone</th>
                        <th>Operation</th>
                    </tr>
                </thead>
                <tbody class="T-Font-sub">
                   ';
                    while ($value = mysqli_fetch_array($result2)){
                        echo ' <tr>
            <td>'.$value[0].'</td>
            <td>'.$value[1].'</td>
            <td>'.$value[2].'</td>
            <td>'.$value[3].'</td>
            <td>'.$value[4].'</td>
            <td>'.$value[5].'</td>
            <td>'.$value[6].'</td>
            <td>'.$value[7].'</td>
            <td>
                None</a>&nbsp;
            </td> 
        </tr>';
                    }
                    echo '</tbody>
</table>';
                }
                ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>
