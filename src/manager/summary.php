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
if (isset($_POST['search'])) {
    $conn = new mysqli('localhost', 'root', 'root', 'cw2');
    $region = $_POST['region'];
    $time = $_POST['time'];
//initialization
    $total_mask = array(0, 0, 0);
    $total_a_mask = array(0, 0, 0);
    $total_revenues = 0;
    $total_anomaly_revenues = 0;
//get orders information
    if ($time == "Total") {
        $condition_time = "TRUE";
    } elseif ($time == "Last 7 days") {
        $condition_time = "TIMESTAMPDIFF(day,o.Date,CURRENT_TIMESTAMP) <= 7";
    } else {
        $condition_time = "TIMESTAMPDIFF(day,o.Date,CURRENT_TIMESTAMP) <= 30";
    }
    if ($region == "") {
        $condition_region = "TRUE";
    } else {
        $condition_region = "r.region ='" . $region . "'";
    }
//    orders
    $sql_get_orders = "select SUM(o.OrderNumber_1),SUM(o.OrderNumber_2),SUM(o.OrderNumber_3) from rep_order_relation as ro left join reps as r on r.Id=ro.repId left join orders as o on o.Id=ro.OrderId where $condition_region AND $condition_time AND o.IsFinished = 1";
    $sql_get_a_orders = "select SUM(o.OrderNumber_1),SUM(o.OrderNumber_2),SUM(o.OrderNumber_3) from rep_order_relation as ro left join reps as r on r.Id=ro.repId left join orders as o on o.Id=ro.OrderId where $condition_region AND $condition_time AND o.IsFinished = 2";
    $res_get_orders = $conn->query($sql_get_orders);
    $res_get_a_orders = $conn->query($sql_get_a_orders);
    $total_row = mysqli_fetch_array($res_get_orders);
    $total_mask = array(0+$total_row[0],0+$total_row[1],0+$total_row[2]);
    $total_a_row = mysqli_fetch_array($res_get_a_orders);
    $total_a_mask = array(0+$total_a_row[0],0+$total_a_row[1],0+$total_a_row[2]);
    // masks
    $sql_select_masks_info = "Select (Price-Cost) as revenue from masks";
    $res_select_masks_info = $conn->query($sql_select_masks_info);
    $masks1 = mysqli_fetch_array($res_select_masks_info);
    $masks2 = mysqli_fetch_array($res_select_masks_info);
    $masks3 = mysqli_fetch_array($res_select_masks_info);
    $mask_revenue = array($masks1[0],$masks2[0],$masks3[0]);
    $total_revenues = $total_mask[0] *  $mask_revenue[0] + $total_mask[1] *  $mask_revenue[1] + $total_mask[2] *  $mask_revenue[2];
    $total_anomaly_revenues =  $total_a_mask[0] *  $mask_revenue[0] + $total_a_mask[1] *  $mask_revenue[1] + $total_a_mask[2] *  $mask_revenue[2];
}
//get orders
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Summary</title>
    <link rel="stylesheet"href="../css/countrySelect.css">
    <link rel="stylesheet" type="text/css" href="../css/simple.css">
    <link rel='stylesheet' href='../css/bootstrap.min.css'>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/countrySelect.js"></script>
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
    .keep-center{
        margin-left: 20%;
    }
    .form-horizontal .btn-m{
        margin-left: 40%;
        font-size: 20px;
        color: #fff;
        background-color: #CCCCCC;
        border-radius: 30px;
        padding: 10px 30px;
        border: none;
        text-transform: capitalize;
        transition: all 0.5s ease 0s;
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
                <li class="active"><a href="#">Summary<span class="sr-only">(current)</span></a></li>
                <li><a href="customers.php">Customers</a></li>
                <li><a href="representative.php">Representatives</a></li>
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
                <span class="heading-manager glyphicon glyphicon-signal"></span>
                <span class="heading-manager">Summary</span>
                <form method = "post" class="form-horizontal">
                    <div class="form-group">
                        <label for="region" class="col-sm-5 control-label A-font-manager">Region:</label>
                        <div class="col-sm-3">
                            <input type="text" name="region" class="form-control" id="region" placeholder="Region">
                            <script>$("#region").countrySelect();</script>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="time" class="col-sm-5 control-label A-font-manager">Time:</label>
                        <div class="col-sm-3">
                            <select class= "form-control" name = "time">
                                <option>Last 7 days</option>
                                <option>Last 30 days</option>
                                <option>Total</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                            <input class=" btn-m btn-default btn-lg col-sm-2" type="submit" name="search" value = "search">
                    </div>
                    <br>
                </form>
                <?php
                if (isset($_POST['search'])) {
                    echo '<table class="table table-striped table-hover">
                    <thead class="A-font-manager" style="text-align: center">
                    <tr>
                        <th>Total N95</th>
                        <th>Total Surgical</th>
                        <th>Total N95 Surgical</th>
                        <th>Total Revenue</th>
                    </tr>
                    </thead>
                    <tbody>
                           <td>' . $total_mask[0] . '/' . $total_a_mask[0] . '</td>
                        <td>' . $total_mask[1] . '/' . $total_a_mask[1] . '</td>
                        <td>' . $total_mask[2] . '/' . $total_a_mask[2] . '</td>
                        <td>$' . $total_revenues . '/$' . $total_anomaly_revenues . '</td>
                    </tbody>
                    ';
                }
                ?>

                </div>
            </div>
        </div>
    </div>
</div>
</div>
</body>
</html>
