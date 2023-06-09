<?php 
session_start();
ob_start();
include ('db.php');

//  user delete
if(isset($_POST['delete'])){
    $ustatus = $_POST['ustatus'];
    $id = $_POST['id'];

    $query = "UPDATE `users` SET `ustatus`='$ustatus' WHERE id='$id'";
    $query_run = mysqli_query($db_connection, $query);
    if($query_run)
    {
        $_SESSION['status_success'] = "Data Deleted";
        header('Location: /../BaronVerse/admin/users.php');
        session_write_close();
        exit;
    }
    else{
        $_SESSION['status_failed'] = "Data Not Deleted";
        header('Location: /../BaronVerse/admin/users.php');
        session_write_close();
        exit;
    }
}
?>
<!-- delete device -->
<?php 
if(isset($_POST['delete_device'])){
    $device_id = $_POST['device_id'];
    $dstatus = $_POST['dstatus'];

    $query = "UPDATE `devices` SET `dstatus`='$dstatus' WHERE device_id='$device_id'";
    $query_run = mysqli_query($db_connection, $query);
    if($query_run)
    {
        $_SESSION['status_success'] = "Data Deleted";
        header('Location: /../BaronVerse/admin/devices/devices.php');
        session_write_close();
        exit;
    }
    else{
        $_SESSION['status_failed'] = "Data Not Deleted";
        header('Location: /../BaronVerse/admin/devices/devices.php');
        session_write_close();
        exit;
    }
}
?>

<!-- delete users device -->
<?php 
if(isset($_POST['delete_udevice'])){
    $users_device_id = $_POST['users_device_id'];
    $udstatus = $_POST['udstatus'];

    $query = "UPDATE `users_device` SET `udstatus`='$udstatus' WHERE users_device_id='$users_device_id'";
    $query_run = mysqli_query($db_connection, $query);
    if($query_run)
    {
        $_SESSION['status_success'] = "Data Deleted";
        header('Location: /../BaronVerse/admin/usersdevice/usersdevice.php');
        session_write_close();
        exit;
    }
    else{
        $_SESSION['status_failed'] = "Data Not Deleted";
        header('Location: /../BaronVerse/admin/usersdevice/usersdevice.php');
        session_write_close();
        exit;
    }
}
?>

<!-- delete ticket -->
<?php 
if(isset($_POST['delete_ticket'])){
    $ticket_id = $_POST['ticket_id'];
    $tstatus = $_POST['tstatus'];

    $query = "UPDATE `ticket` SET `tstatus`='$tstatus' WHERE ticket_id='$ticket_id'";
    $query_run = mysqli_query($db_connection, $query);
    if($query_run)
    {
        $_SESSION['status_success'] = "Data Deleted";
        header('Location: /../BaronVerse/admin/ticket/ticketall.php');
        session_write_close();
        exit;
    }
    else{
        $_SESSION['status_failed'] = "Data Not Deleted";
        header('Location: /../BaronVerse/admin/ticket/ticketall.php');
        session_write_close();
        exit;
    }
}
?>

<!-- delete announcement -->
<?php 
if(isset($_POST['delete_announcement'])){
    $announcement_id = $_POST['announcement_id'];
    $astatus = $_POST['astatus'];

    $query = "UPDATE `announcement` SET `astatus`='$astatus' WHERE announcement_id='$announcement_id'";
    $query_run = mysqli_query($db_connection, $query);
    if($query_run)
    {
        $_SESSION['status_success'] = "Announcement Deleted";
         header('Location: /../BaronVerse/admin/home.php');
        session_write_close();
        exit;
    }
    else{
        $_SESSION['status_failed'] = "Announcement Not Deleted";
         header('Location: /../BaronVerse/admin/home.php');
        session_write_close();
        exit;
    }
}
?>
<!-- delete user announcement -->
<?php 
if(isset($_POST['user_delete_announcement'])){
    $announcement_id = $_POST['announcement_id'];
    $astatus = $_POST['astatus'];

    $query = "UPDATE `announcement` SET `astatus`='$astatus' WHERE announcement_id='$announcement_id'";
    $query_run = mysqli_query($db_connection, $query);
    if($query_run)
    {
        $_SESSION['status_success'] = "Announcement Deleted";
         header('Location: /../BaronVerse/user/home.php');
        session_write_close();
        exit;
    }
    else{
        $_SESSION['status_failed'] = "Announcement Not Deleted";
         header('Location: /../BaronVerse/user/home.php');
        session_write_close();
        exit;
    }
}
?>


<!-- // ----------------------------------------  permanently delete ------------------------------------------------------------ // -->
<!-- delete q and a -->
<?php 
if(isset($_POST['pq_delete'])){
    $product_question_id = $_POST['product_question_id'];
    $pq_status = $_POST['pq_status'];

    $query = "UPDATE `product_question` SET `pq_status`='$pq_status' WHERE product_question_id='$product_question_id'";
    $query_run = mysqli_query($db_connection, $query);
    if($query_run)
    {
        $_SESSION['status_success'] = "Product Question Deleted";
         header('Location: /../BaronVerse/admin/qanda.php');
        session_write_close();
        exit;
    }
    else{
        $_SESSION['status_failed'] = "Product Question Not Deleted";
         header('Location: /../BaronVerse/admin/qanda.php');
        session_write_close();
        exit;
    }
}
?>
<!-- delete depart -->
<?php
if(isset($_POST['delete_depart'])){
    $department_id = $_POST['department_id'];
    $query = "DELETE FROM `department` WHERE department_id='$department_id'";
    $query_run = mysqli_query($db_connection, $query);
    if($query_run)
    {
        $_SESSION['status_success'] = "Data Deleted";
        header('Location: /../BaronVerse/admin/dashboard.php');
        session_write_close();
        exit;
    }
    else{
        $_SESSION['status_failed'] = "Data Not Deleted";
        header('Location: /../BaronVerse/admin/dashboard.php');
        session_write_close();
        exit;
    }
}
?>
<!-- delete link -->
<?php 
if(isset($_POST['delete_link'])){
    $link_id = $_POST['link_id'];

    $query = "DELETE FROM `link` WHERE link_id='$link_id'";
    $query_run = mysqli_query($db_connection, $query);
    if($query_run)
    {
        $_SESSION['status_success'] = "Data Deleted";
        header('Location: /../BaronVerse/admin/dashboard.php');
        session_write_close();
        exit;
    }
    else{
        $_SESSION['status_failed'] = "Data Not Deleted";
        header('Location: /../BaronVerse/admin/dashboard.php');
        session_write_close();
        exit;
    }
}
?>
<!-- delete users -->
<?php 
if(isset($_POST['per_delete_user'])){
    $id = $_POST['id'];

    $query = "DELETE FROM `users` WHERE id='$id'";
    $query_run = mysqli_query($db_connection, $query);
    if($query_run)
    {
        $_SESSION['status_success'] = "Data Deleted";
          header('Location: /../BaronVerse/admin/recycle/recycle.php');
        session_write_close();
        exit;
    }
    else{
        $_SESSION['status_failed'] = "Data Not Deleted";
          header('Location: /../BaronVerse/admin/recycle/recycle.php');
        session_write_close();
        exit;
    }
}
?>
<!-- delete link user -->
<?php 
if(isset($_POST['delete_link_user'])){
    $link_id = $_POST['link_id'];

    $query = "DELETE FROM `link` WHERE link_id='$link_id'";
    $query_run = mysqli_query($db_connection, $query);
    if($query_run)
    {
        $_SESSION['status_success'] = "Data Deleted";
        header('Location: /../BaronVerse/user/file.php');
        session_write_close();
        exit;
    }
    else{
        $_SESSION['status_failed'] = "Data Not Deleted";
        header('Location: /../BaronVerse/user/file.php');
        session_write_close();
        exit;
    }
}
?>
<!-- delete device -->
<?php 
if(isset($_POST['per_delete_device'])){
    $device_id = $_POST['device_id'];

    $query = "DELETE FROM `Devices` WHERE device_id='$device_id'";
    $query_run = mysqli_query($db_connection, $query);
    if($query_run)
    {
        $_SESSION['status_success'] = "Data Deleted";
          header('Location: /../BaronVerse/admin/recycle/devices.php');
        session_write_close();
        exit;
    }
    else{
        $_SESSION['status_failed'] = "Data Not Deleted";
          header('Location: /../BaronVerse/admin/recycle/devices.php');
        session_write_close();
        exit;
    }
}
?>
<!-- delete device -->
<?php 
if(isset($_POST['per_delete_usersdevice'])){
    $users_device_id = $_POST['users_device_id'];

    $query = "DELETE FROM `users_device` WHERE users_device_id='$users_device_id'";
    $query_run = mysqli_query($db_connection, $query);
    if($query_run)
    {
        $_SESSION['status_success'] = "Data Deleted";
          header('Location: /../BaronVerse/admin/recycle/usersdevice.php');
        session_write_close();
        exit;
    }
    else{
        $_SESSION['status_failed'] = "Data Not Deleted";
          header('Location: /../BaronVerse/admin/recycle/usersdevice.php');
        session_write_close();
        exit;
    }
}
?>
<?php 
if(isset($_POST['per_delete_ticket'])){
    $ticket_id = $_POST['ticket_id'];

    $query = "DELETE FROM `ticket` WHERE ticket_id='$ticket_id'";
    $query_run = mysqli_query($db_connection, $query);
    if($query_run)
    {
        $_SESSION['status_success'] = "Data Deleted";
          header('Location: /../BaronVerse/admin/recycle/pendingticket.php');
        session_write_close();
        exit;
    }
    else{
        $_SESSION['status_failed'] = "Data Not Deleted";
          header('Location: /../BaronVerse/admin/recycle/pendingticket.php');
        session_write_close();
        exit;
    }
}
?>

<!-- delete file -->
<?php 
if(isset($_POST['delete_file'])){
    $file_id = $_POST['file_id'];
    $file_uniq_name = $_POST['file_uniq_name'];
    $path = 'fileupload/'.$file_uniq_name;

    $query = "DELETE FROM `file` WHERE file_id='$file_id'";
    $query_run = mysqli_query($db_connection, $query);
    if($query_run)
    {
        if(!unlink($path)){
            $_SESSION['status_failed'] = "Data Not Deleted";
            header('Location: /../BaronVerse/admin/files.php');
            session_write_close();
            exit;
        }else{
            $_SESSION['status_success'] = "Data Deleted";
            header('Location: /../BaronVerse/admin/files.php');
            session_write_close();
            exit;
        }
    }
    else{
        $_SESSION['status_failed'] = "Data Not Deleted";
        header('Location: /../BaronVerse/admin/files.php');
        session_write_close();
        exit;
    }

}
?>

<!-- delete file user -->
<?php 
if(isset($_POST['user_delete_file'])){
    $file_id = $_POST['file_id'];
    $file_uniq_name = $_POST['file_uniq_name'];
    $path = 'fileupload/'.$file_uniq_name;

    $query = "DELETE FROM `file` WHERE file_id='$file_id'";
    $query_run = mysqli_query($db_connection, $query);
    if($query_run)
    {
        if(!unlink($path)){
            $_SESSION['status_failed'] = "Data Not Deleted";
            header('Location: /../BaronVerse/user/file.php');
            session_write_close();
            exit;
        }else{
            $_SESSION['status_success'] = "Data Deleted";
            header('Location: /../BaronVerse/user/file.php');
            session_write_close();
            exit;
        }
    }
    else{
        $_SESSION['status_failed'] = "Data Not Deleted";
        header('Location: /../BaronVerse/user/file.php');
        session_write_close();
        exit;
    }

}
?>

<!-- delete announcement -->
<?php
if(isset($_POST['per_delete_announcement'])){
    $announcement_id = $_POST['announcement_id'];
    $announcement_photo = $_POST['announcement_photo'];
    $path = 'imgupload/'.$announcement_photo;

    $query = "DELETE FROM `announcement` WHERE announcement_id='$announcement_id'";
    $query_run = mysqli_query($db_connection, $query);
    if($query_run)
    {
        if(!unlink($path)){
            $_SESSION['status_success'] = "Announcement Deleted";
             header('Location: /../BaronVerse/admin/recycle/announcement.php');
            session_write_close();
            exit;
        }else{
            $_SESSION['status_success'] = "Announcement Deleted";
             header('Location: /../BaronVerse/admin/recycle/announcement.php');
            session_write_close();
            exit;
        }
    }
    else{
        $_SESSION['status_failed'] = "Announcement Not Deleted";
        header('Location: /../BaronVerse/admin/recycle/announcement.php');
        session_write_close();
        exit;
    }
}
ob_end_flush();
?>