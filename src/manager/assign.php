<?php
session_start();
// if not login, back to the index
if (!isset($_SESSION["isAdminLogin"])){
//    header('location:index.php');
    exit('Access denied');
}
require_once "../public_conn.php";
$sql_get_orders = "select SUM(o.OrderNumber_1),SUM(o.OrderNumber_2),SUM(o.OrderNumber_3),u.realname from user_order_relation as uo left join users as u on u.Id=uo.UserId left join orders as o on o.Id=uo.OrderId group by u.username";
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
    <title>Assign</title>
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
<script>
    function changeType(value){
        if (value == 1){
            document.getElementById("hint").innerHTML = "Add quota:";
            document.getElementById("quotaSubmit").value = "Add";
        }else {
            document.getElementById("hint").innerHTML = "Update quota:";
            document.getElementById("quotaSubmit").value = "Update";
        }
    }
    function back() {
        window.location.href="manager.php";
    }
</script>
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
                <li><a href="representative.php">Representatives</a></li>
                <li class="active"><a href="#">Assign<span class="sr-only">(current)</span></a></li>
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
                <form action="repCreate.php" method="post" class="form-horizontal">
                    <span class="heading-manager glyphicon glyphicon-phone-alt"></span>
                    <span class="heading-manager">Assign</span>
                    <div class="form-group">
                        <label for="username" class="col-sm-3 control-label A-font-manager">UserName:</label>
                        <div class="col-sm-8">
                            <input type="text" name="username" class="form-control" id="Username" placeholder="UserName">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="text-left col-sm-3 control-label A-font-manager">PassWord:</label>
                        <div class="col-sm-8">
                            <input type="password" name="password" class="form-control" id="Password" placeholder="PassWord">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password2" class="col-sm-3 control-label A-font-manager">Confirm:</label>
                        <div class="col-sm-8">
                            <input type="password" name="password2" class="form-control" id="Password2" placeholder="Confirm">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="region" class="col-sm-3 control-label A-font-manager">Region:</label>
                        <div class="col-sm-3">
                            <input type="text" name="region" class="form-control" id="Region" placeholder="Region">
                            <!-- using country select plugin  -->
                            <script>$("#Region").countrySelect();</script>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="realname" class="col-sm-3 control-label A-font-manager">RealName:</label>
                        <div class="col-sm-8">
                            <input type="text" name="realname" class="form-control" id="RealName" placeholder="RealName">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Email" class="col-sm-3 control-label A-font-manager">Email:</label>
                        <div class="col-sm-8">
                            <input type="text" name="email" class="form-control" id="Email" placeholder="example@xxx.com">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="phoneNumber" class="col-sm-3 control-label A-font-manager">Phone:</label>
                        <div class="col-sm-8">
                            <input type="text" name="phone" class="form-control" id="Phone" placeholder="Phone">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="m1" class="col-sm-3 control-label A-font-manager">Quota:</label>
                        <div class="col-sm-8">
                            <input type="text" name="m1" class="form-control"  placeholder="N95">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="m2" class="col-sm-3 control-label A-font-manager"></label>
                        <div class="col-sm-8">
                            <input type="text" name="m2" class="form-control"  placeholder="Surgical">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="m3" class="col-sm-3 control-label A-font-manager"></label>
                        <div class="col-sm-8">
                            <input type="text" name="m3" class="form-control"  placeholder="N95 Surgical">
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit"  name="register" value="Register" class="keep-center btn-m btn-default btn-lg col-sm-3">Assign</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</body>
</html>
