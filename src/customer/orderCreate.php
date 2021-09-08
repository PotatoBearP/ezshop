<!--checked-->
<?php
include_once "../public_update.php";
session_start();
if (!isset($_SESSION["isLogin"])){
    header('location:../index.php');
    exit('Access denied');
}
//   Get user region
$userId = $_SESSION["userid"];
require_once "../public_conn.php";
$sql_get_region = "SELECT region from users where Id = '$userId'";
$res_get_region = $conn->query($sql_get_region);
$region = mysqli_fetch_array($res_get_region)[0];
//   find local reps
$sql_get_reps = "SELECT Id,realname from reps where region = '$region'";
$res_get_reps = $conn->query($sql_get_reps);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order</title>
    <link rel="stylesheet" href="../css/countrySelect.css">
    <link rel="stylesheet" type="text/css" href="../css/simple.css">
    <link rel='stylesheet' href='../css/bootstrap.min.css'>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/countrySelect.js"></script>
    <script type="text/javascript"></script>
    <script>
        function back() {
            window.location.href="home.php";
        }
    </script>
    <style>
        body{
           background-color: #CCCC33;;
        }
        .keep-center-order{
            margin-left: 45%;
        }
        .hint{
            text-align: left;
            font-family: Tahoma,Arial;
            font-size: 20px;
            line-height: 22px;
            color: #c4c4c4;
            margin-left: 19%;
            margin-top: 50px;
        }
    </style>
</head>
<body>
<!--navigator-->
<nav class="navbar navbar-default">
    <div class="container-fluid">
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
                <li><a href="masks.php">View Masks</a></li>
                <li class="active"><a href="#">Make an Order<span class="sr-only">(current)</span></a></li>
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
        <div class="col-md-offset-0 col-md-13">
            <form action="orderAdd.php" method="post" class="form-horizontal">
                <span class="heading glyphicon glyphicon-plus"></span>
                <span class="heading">Order</span>
                <div class="form-group">
                    <div class="form-inline col-md-4">
                        <label for="m1" class="col-sm-3 control-label A-font">N95:</label>
                        <div class="col-sm-1">
                            <input type="text" name="m1" class="form-control" id="Mask1" placeholder="0">
                        </div>
                    </div>
                    <div class="form-inline col-md-4">
                        <label for="m2" class="col-sm-4 control-label A-font">Surgical:</label>
                        <div class="col-sm-1">
                            <input type="text" name="m2" class="form-control" id="Mask2" placeholder="0">
                        </div>
                    </div>
                    <div class="form-inline col-md-4">
                        <label for="m3" class="col-sm-2 control-label A-font">N95 Surg:</label>
                        <div class="col-sm-1">
                            <input type="text" name="m3" class="form-control" id="Mask3" placeholder="0">
                        </div>
                    </div>
                </div>
                <p class="hint">Remind: too large order may be rejected, 100 ~ 1000 masks is reasonable number.
                </p>
                <span class="heading">Information</span>
                <div class="form-group">
                        <label for="address" class="col-sm-3 control-label A-font">Address:</label>
                        <div class="col-md-7">
                            <input type="text" name="address" class="form-control" id="Address" placeholder="Address">
                        </div>
                </div>
                <div class="form-group">
                    <label for="rep" class="col-sm-3 control-label A-font">Reps:</label>
                    <div class="col-md-3">
                    <select class="form-control " name = "rep">
                        <?php
                        while ($v = mysqli_fetch_array($res_get_reps)){
                            echo "<option value=\"$v[0]\">$v[1]</option>";
                        }
                        ?>
                    </select>
                    </div>
                    <p class="hint">You can only choose the local representative.
                    </p>
                </div>
                <div class="form-group">
                    <button type="submit" name="submit" value="Submit" class="btn-l keep-center-order btn-default ">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>