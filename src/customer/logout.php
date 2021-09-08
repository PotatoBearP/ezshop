<!--checked-->
<?php
session_start();
unset($_SESSION['username']);
session_destroy();
echo "<script> alert(\"You are successfully Logged Out!\");window.location = '../index.php'</script>";
?>