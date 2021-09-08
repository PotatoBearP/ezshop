<?php
//public connection
$conn = new mysqli('localhost', 'root', 'root', 'cw2');
if ($conn->connect_error){
    echo 'connection fails';
    exit(0);
}
