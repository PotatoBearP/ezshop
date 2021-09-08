<!--checked-->
<?php
session_start();
// if not login, back to the index
if (!isset($_SESSION["isLogin"])){
//    header('location:index.php');
    exit('Access denied');
}
require_once "../public_conn.php";
$username = $_SESSION['username'];
//Simulate server auto complete order (Since this is not deployed, I can't update per hour :(
$sql_get_info = "select passport,region,realname,email,phone_number from users where username = '$username'";
$result = $conn->query($sql_get_info);
$rows = mysqli_fetch_array($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="../css/countrySelect.css">
    <link rel="stylesheet" type="text/css" href="../css/simple.css">
    <link rel='stylesheet' href='../css/bootstrap.min.css'>
    <script type="text/javascript"></script>
</head>
<style>
    body{
        background-color: #CCCC33;
    }
</style>
<script type="text/javascript">
    function go_back() {
        window.location.href="index.php";
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
            <a class="navbar-brand" href="#">Woolin Auto SMS</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="home.php">Home<span class="sr-only">(current)</span></a></li>
                <li class="active"><a href="#">Profile<span class="sr-only">(current)</span></a></li>
                <li><a href="masks.php">View Masks</a></li>
                <li><a href="orderCreate.php">Make an Order</a></li>
                <li><a href="orderDetails.php">Order Details</a></li>
            </ul>
        </div>
    </div>
</nav>
<!---->
<div class="container keep-away-from-top">
    <div class="row">
        <div class="col-md-offset-2 col-md-8">
            <form action="updateInfo.php" method="post" class="form-horizontal">
                <span class="heading glyphicon glyphicon-user"></span>
                <span class="heading">Profile</span>
                <div class="form-group">
                    <label for="passport" class="col-sm-3 control-label A-font">PassPort:</label>
                    <div class="col-sm-8">
                        <input type="text" value = "<?php echo $rows[0]?>"name="passport" class="form-control" id="Passport" placeholder="PassPort">
                    </div>
                </div>
                <div class="form-group">
                    <label for="realname" class="col-sm-3 control-label A-font">RealName:</label>
                    <div class="col-sm-8">
                        <input type="text" value = "<?php echo $rows[2]?>" name="realname" class="form-control" id="RealName" placeholder="RealName">
                    </div>
                </div>
                <div class="form-group">
                    <label for="Email" class="col-sm-3 control-label A-font">Email:</label>
                    <div class="col-sm-8">
                        <input type="email" value = "<?php echo $rows[3]?>" name="email" class="form-control" id="Email" placeholder="example@xxx.com">
                    </div>
                </div>
                <div class="form-group">
                    <label for="phoneNumber" class="col-sm-3 control-label A-font">Phone:</label>
                    <div class="col-sm-8">
                        <input type="text" value = "<?php echo $rows[4]?> "name="phone" class="form-control" id="Phone" placeholder="Phone">
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit"  name="update" value="Update" class="btn-l keep-center btn-default ">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
