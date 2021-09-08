<!--checked-->
<?php
require_once "../public_conn.php";
$content = $_POST['reason'];
$number = $_POST['number'];
$sql_insert = "insert into log (operation,datetime,content) values('Apply $number Quota',current_timestamp,'$content')";
$res_insert = $conn->query($sql_insert);
if ($res_insert) {
    echo '<script>alert(\'Apply successes\');window.location="home.php";</script>';
} else {
    echo "<script>alert('Apply fails, try again later.');history.go(-1);</script>";
}
