<?php
SESSION_START();
unset($_SESSION['manname']);
session_destroy();
echo "<br>";
echo "You are successfully Logged Out!";
echo "<br>";
header('location:../admin.php')
?>