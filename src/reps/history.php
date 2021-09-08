<!--checked-->
<?php
session_start();
// if not login, back to the index
if (!isset($_SESSION["isAdminLogin"])){
//    header('location:index.php');
    exit('Access denied');
}
include_once  "../public_update.php";
require_once "../public_conn.php";
$username = $_SESSION['repname'];

//get orders
$sql_get_order = "select o.Id,o.Date,o.OrderNumber_1,o.OrderNumber_2,o.OrderNumber_3,o.Address,u.username,o.IsFinished from user_order_relation as uo left join users as u on u.Id=uo.UserId left join orders as o on o.Id=uo.OrderId left join rep_order_relation as ro on ro.OrderId = o.Id left join reps as r on ro.RepId = r.Id where r.username = '$username'AND (IsFinished = 1 OR IsFinished = 2) ";
$result1 = $conn->query($sql_get_order);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>History</title>
    <link rel="stylesheet" type="text/css" href="../css/simple.css">
    <link rel='stylesheet' href='../css/bootstrap.min.css'>
</head>
<style>
    body{
        background-color: #CC9933;
    }
    th{
        text-align: center;
    }
    .T-Font{
        font-weight: bold;
        font-family: Tahoma,Arial;
        font-size: 17px;
        color: #826121;
    }
    .T-Font-sub{
        font-family: Tahoma,Arial;
        font-size: 14px;
        color: #826121;
    }
    .hint{
        text-align: left;
        font-family: Tahoma,Arial;
        font-size: 20px;
        line-height: 22px;
        color: #c4c4c4;
        margin-top: 50px;
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
            <a class="navbar-brand" href="#">Representative Console</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li ><a href="home.php">Home</a></li>
                <li ><a href="transaction.php">Transaction</a></li>
                <li class="active"><a href="#">History<span class="sr-only">(current)</span></a></li>
                <li><a href="applyQuota.php">Apply Quota</a></li>
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
                <span class="heading-admin glyphicon glyphicon-time"></span>
                <span class="heading-admin">History</span>
                <?php
                if (mysqli_num_rows($result1) == 0){
                    echo '<p class="A-font">Orders not found</p>';
                }else {
                    echo '<table class="table table-striped table-hover">
                <thead class="T-Font">
                    <tr>
                        <th>Order Id</th>
                        <th>Date</th>
                        <th>N95 Respirator</th>
                        <th>Surgical Mask</th>
                        <th>N95 Surgical Respirator</th>
                        <th>Address</th>
                        <th>Customer</th>
                    </tr>
                </thead>
                <tbody class="T-Font-sub">
                   ';
                    while ($value = mysqli_fetch_array($result1)) {
                        if ($value[7] == 1) {
                            echo '<tr>
                <td>' . $value[0] . '</td>
                <td>' . $value[1] . '</td>
                <td>' . $value[2] . '</td>
                <td>' . $value[3] . '</td>
                <td>' . $value[4] . '</td>
                <td>' . $value[5] . '</td>
                <td>' . $value[6] . '</td>
                    </tr>';
                        } else {
                            echo '<tr class="Abnormal">
                <td>' . $value[0] . '</td>
                <td>' . $value[1] . '</td>
                <td>' . $value[2] . '</td>
                <td>' . $value[3] . '</td>
                <td>' . $value[4] . '</td>
                <td>' . $value[5] . '</td>
                <td>' . $value[6] . '</td>
                    </tr>';
                        }
                    }
                    echo '</tbody>
                </table>';
                }
                ?>
                <p class="hint" style="text-align: center">They are finished transaction. No operation available.
                    <br>
                    <br>
                </p>
            </div>
        </div>
    </div>
</div>
</body>
</html>
