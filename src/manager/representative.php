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
$sql_get_orders = "select SUM(o.OrderNumber_1),SUM(o.OrderNumber_2),SUM(o.OrderNumber_3),r.realname from rep_order_relation as ro left join reps as r on r.Id=ro.RepId left join orders as o on o.Id=ro.OrderId where o.IsFinished = 1 group by r.username ";
$res_get_orders = $conn->query($sql_get_orders);

//get masks information
$sql_select_masks_info = "Select (Price-Cost) as revenue from masks";
$res_select_masks_info = $conn->query($sql_select_masks_info);
$masks1 = mysqli_fetch_array($res_select_masks_info);
$masks2 = mysqli_fetch_array($res_select_masks_info);
$masks3 = mysqli_fetch_array($res_select_masks_info);
//    orders
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Representatives</title>
    <link rel="stylesheet" type="text/css" href="../css/simple.css">
    <link rel='stylesheet' href='../css/bootstrap.min.css'>
</head>
<style>
    body{
        background-color: #CCCCCC;
    }
    .form-horizontal .heading-manager{
        color: #a0a0a0;
        display: block;
        font-size: 50px;
        font-weight: 700;
        padding: 20px 0;
        border-bottom: 1px solid #f0f0f0;
        margin-bottom: 10px;
    }
    .form-horizontal .tutorial-manager{
        text-align: left;
        font-family: Tahoma,Arial;
        font-size: 20px;
        line-height: 22px;
        color: #a0a0a0;
        margin-left: 25%;
        margin-top: 50px;
    }
    .A-font-manager{
        font-family: Tahoma,Arial;
        font-size: 20px;
        line-height: 22px;
        color: #a0a0a0;
    }
    th,td{
        text-align: center;
    }
    .A-font-manager-sub{
        font-family: Tahoma,Arial;
        font-size: 15px;
        line-height: 22px;
        color: #a0a0a0;
    }
    .hint-manager{
        font-family: Tahoma,Arial;
        font-size: 18px;
        line-height: 22px;
        color: grey;
    }
    .Abnormal{
        color: red !important;
        font-weight: bold !important;
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
            <a class="navbar-brand" href="#">Manager Monitor</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="home.php">Home</a></li>
                <li><a href="summary.php">Summary</a></li>
                <li><a href="customers.php">Customers</a></li>
                <li class="active"><a href="#">Representatives<span class="sr-only">(current)</span></a></li>
                <li><a href="assign.php">Assign</a></li>
                <li><a href="quota.php">Quota</a></li>
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
                <span class="heading-manager glyphicon glyphicon-user"></span>
                <span class="heading-manager">Representatives</span>
                <?php
                if (mysqli_num_rows($res_get_orders) == 0){
                    echo '<p class="A-font-Manager">Representative not found</p>';
                }else{
                    echo  '<table class="table table-striped table-hover">
                <thead class="A-font-manager" style="text-align: center">
                    <tr>
                    <th>RepName</th>
                        <th>N95</th>
                        <th>Surgical</th>
                        <th>N95 Surgical</th>
                        <th>Revenue from rep</th>
                    </tr>
                </thead>
                <tbody class="A-font-Manager-sub">
                   ';
                    while ($value = mysqli_fetch_array($res_get_orders)) {
                        echo '<tr">
                <td>' . $value[3] . '</td>
                <td>' . $value[0] . '</td>
                <td>' . $value[1] . '</td>
                <td>' . $value[2] . '</td>
                <td>$' . ($value[0]*$masks1[0]+$value[1]*$masks2[0]+$value[2]*$masks3[0]). '</td>
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
</div>
</body>
</html>
