<?php
$db_connection = mysqli_connect("localhost","root","","baronverse");
if(mysqli_connect_errno()){
    echo "Connection Failed".mysqli_connect_error();
    exit;
}
?>