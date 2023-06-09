<?php
ob_start();
include_once __DIR__ . '/../BaronVerse/config.php';
$id = $_SESSION['login_id'];
$get_user = mysqli_query($db_connection, "SELECT * FROM `users` WHERE `google_id`='$id' AND `department`='4' AND `ustatus`='1'");
$user = mysqli_fetch_assoc($get_user);
if(!isset($_SESSION['login_id'])){
    header('Location: /../BaronVerse/index.php');
    exit;
}
if(mysqli_num_rows($get_user) > 0){
    $user = mysqli_fetch_assoc($get_user);
}
else{
    header('Location: /../BaronVerse/index.php');
    exit;
}
ob_end_clean();
?>
<?php
$get_user = mysqli_query($db_connection, "SELECT * FROM `users` WHERE `google_id`='$id'AND `department`='4' AND `ustatus`='1' ");
$user = mysqli_fetch_assoc($get_user);
$users_select_id = $user['id'];
?>
<!-- count all user -->
<?php 
$sql = "SELECT COUNT(*) as total_rows FROM users WHERE ustatus = '1'";
$result = mysqli_query($db_connection, $sql);
$row = mysqli_fetch_assoc($result);
$total_rows = $row['total_rows'];
?>
<!-- count all devices -->
<?php 
$sql_device = "SELECT COUNT(*) as total_device FROM devices  WHERE dstatus = '1'";
$result_devices = mysqli_query($db_connection, $sql_device);
$devices = mysqli_fetch_assoc($result_devices);
$total_devices = $devices['total_device'];
?>
<!--  -->
<!-- users device devices -->
<?php 
$sql_Udevices = "SELECT COUNT(*) as total_Udevice FROM users_device WHERE udstatus = '1'";
$result_Udevices = mysqli_query($db_connection, $sql_Udevices);
$Udevices = mysqli_fetch_assoc($result_Udevices);
$total_Udevices = $Udevices['total_Udevice'];
?>
<!--  -->
<!-- ticket -->
<?php 
$sql_ticket_dash = "SELECT COUNT(*) as total_ticket FROM ticket WHERE ticket_status = 'For repair' AND tstatus='1'";
$result_ticket_dash = mysqli_query($db_connection, $sql_ticket_dash);
$ticket_dash = mysqli_fetch_assoc($result_ticket_dash);
$total_ticket_dash = $ticket_dash['total_ticket'];
?>
<!--  -->
<!-- count word -->
<?php
$select_word = "SELECT COUNT(*) AS count_docs
FROM file
JOIN users
ON file.file_user = users.id
WHERE TRIM(file_name) LIKE '%docx' OR TRIM(file_name) LIKE '%doc' AND file_user = '$users_select_id';";
$result_word = mysqli_query($db_connection, $select_word);
$word = mysqli_fetch_assoc($result_word);
$selected_word = $word['count_docs']
?>
<!--  -->
<!-- count pdf -->
<?php
$select_pdf = "SELECT COUNT(*) AS count_pdf
FROM file
JOIN users
ON file.file_user = users.id
WHERE TRIM(file_name) LIKE '%pdf' AND file_user = '$users_select_id' ";
$result_pdf = mysqli_query($db_connection, $select_pdf);
$pdf = mysqli_fetch_assoc($result_pdf);
$selected_pdf = $pdf['count_pdf']
?>
<!--  -->
<!-- count excel -->
<?php
$select_xls = "SELECT COUNT(*) AS count_xls
FROM file
JOIN users
ON file.file_user = users.id
WHERE TRIM(file_name) LIKE '%xls' OR TRIM(file_name) LIKE '%xlsx' AND file_user = '$users_select_id';";
$result_xls = mysqli_query($db_connection, $select_xls);
$xls = mysqli_fetch_assoc($result_xls);
$selected_xls = $xls['count_xls']
?>
<!--  -->
<!-- count powerpoint -->
<?php
$select_ppt = "SELECT COUNT(*) AS count_ppt
FROM file
JOIN users
ON file.file_user = users.id
WHERE TRIM(file_name) LIKE '%ppt' OR TRIM(file_name) LIKE '%pptx' AND file_user = '$users_select_id';";
$result_ppt = mysqli_query($db_connection, $select_ppt);
$ppt = mysqli_fetch_assoc($result_ppt);
$selected_ppt = $ppt['count_ppt']
?>
<!--  -->
<!-- count other file -->
<?php
$select_other = "SELECT COUNT(*) AS count_other
FROM file
JOIN users
ON file.file_user = users.id
WHERE NOT TRIM(file_name) LIKE '%pdf' AND TRIM(file_name) LIKE '%xls' AND TRIM(file_name) LIKE '%xlsx' AND TRIM(file_name) LIKE '%ppt' AND TRIM(file_name) LIKE '%pptx' AND TRIM(file_name) LIKE '%doc' AND TRIM(file_name) LIKE '%docx';";
$result_other = mysqli_query($db_connection, $select_other);
$other = mysqli_fetch_assoc($result_other);
$selected_other = $other['count_other'];
?>