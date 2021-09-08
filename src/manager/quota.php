<!--checked-->
<?php
session_start();
// if not login, back to the index
if (!isset($_SESSION["isAdminLogin"])){
//    header('location:index.php');
    exit('Access denied');
}
require_once "../public_conn.php";
$sql_get_logs = "select operation,datetime,content,Id from log";
$res_get_logs = $conn->query($sql_get_logs);
$sql_get_reps = "SELECT Id,realname from reps";
$res_get_reps = $conn->query($sql_get_reps);

//get orders
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Quota</title>
    <link rel="stylesheet" type="text/css" href="../css/simple.css">
    <link rel='stylesheet' href='../css/bootstrap.min.css'>
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
    .form-horizontal .manager-radio{
        float: left;
        width: 20px;
        height: 20px;
        color: #555555;
        border-radius: 50%;
        position: relative;
        margin: 5px 0 0 5px;
        border: 2px solid #a0a0a0;
    }
    .form-horizontal .manager-radio label{
        width: 20px;
        height: 20px;
        position: absolute;
        top: 0;
        left: 0;
        cursor: pointer;
    }

    .form-horizontal .manager-radio label:after{
        content:"";
        width: 10px;
        height: 5px;
        position: absolute;
        top: 5px;
        left: 4px;
        border: 3px solid #a0a0a0;
        border-top: none;
        border-right: none;
        background: transparent;
        opacity: 0;
        -webkit-transform: rotate(-45deg);
        transform: rotate(-45deg);
    }
    .form-horizontal .manager-radio input[type=radio]{
        visibility: hidden;
    }
    .form-horizontal .manager-radio input[type=radio]:checked + label:after{
        opacity: 1;
    }
    .form-horizontal .btn-m{
        margin-left: 37%;
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
                <li><a href="summary.php">Summary</a></li>
                <li><a href="customers.php">Customers</a></li>
                <li><a href="representative.php">Representatives</a></li>
                <li><a href="assign.php">Assign</a></li>
                <li class="active"><a href="#">Quota<span class="sr-only">(current)</span></a></li>
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
                <span class="heading-manager glyphicon glyphicon-upload"></span>
                <span class="heading-manager">Grant Quota</span>
                <form class="form-horizontal" action="quotaSubmit.php" method="post">
                    <!-- choose operation type  -->
                    <div class ="form-group">
                        <div class="manager-radio">
                            <input id = "radio1" type="radio" name = "operation_type" value="1" checked = "checked" onchange="changeType(this.value);">
                            <label for="radio1"></label>
                        </div>
                        <span class="text A-font-manager">Sale Representative</span>
                        <div class="manager-radio">
                            <input id ="radio2" type="radio" name = "operation_type" value="2" onchange="changeType(this.value);">
                            <label for="radio2"></label>
                        </div>
                        <span class="text A-font-manager">Update quota (unsafe operation)</span>
                    </div>
                    <div class="form-group">
                        <label id = "hint" class="A-font-manager">Add quota</label>
                        <input type="text" class="form-control auto-color" id="inputPassword3" name="number1" placeholder="Quota_1">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control auto-color" id="inputPassword3" name="number2" placeholder="Quota_2">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control auto-color" id="inputPassword3" name="number3" placeholder="Quota_3">
                    </div>
                    <div class="form-group">
                        <label id = "hint" class="A-font-manager">Rep</label>
                        <select class="form-control" name = "rep">
                            <?php
                            while($v = mysqli_fetch_array($res_get_reps)){
                                echo "<option value=\"$v[0]\">$v[1]</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="keep-center btn-m btn-default btn-lg col-sm-3" name = "quotaSubmit" id="quotaSubmit" value="Add">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</body>
</html>
