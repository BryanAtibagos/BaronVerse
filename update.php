<?php 
session_start();
ob_start();
include ('db.php');

if(isset($_POST['update'])){
    $id = $_POST['id'];
    $user_type = $_POST['user_type'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $department = $_POST['department'];
    $company = $_POST['company'];

    $query = "UPDATE `users` SET `user_firstname`='$firstname',`user_lastname`='$lastname',`department`='$department',`user_type`='$user_type',`company`='$company' WHERE id='$id'";
    $query_run = mysqli_query($db_connection, $query);
    if($query_run)
    {
        $_SESSION['status_success'] = "Data Updated";
        header('Location: /../BaronVerse/admin/users.php');
        session_write_close();
        exit;
    }
    else{
        $_SESSION['status_failed'] = "Data Not Updated";
        header('Location: /../BaronVerse/admin/users.php');
        session_write_close();
        exit;
    }
}
?>

<!-- update all device -->
<?php
if(isset($_POST['update_device'])){
    $device_id = $_POST['device_id'];
    $unit_id = $_POST['unit_id'];
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $processor = $_POST['processor'];
    $ram = $_POST['ram'];
    $storage = $_POST['storage'];
    $device_category = $_POST['device_category'];
    $add_more_details = $_POST['add_more_details'];

    $query = "UPDATE `devices` SET `brand`='$brand',`unit_id`='$unit_id',`model`='$model',`processor`='$processor',`ram`='$ram',`storage`='$storage',`device_category`='$device_category',`add_more_details`='$add_more_details' WHERE device_id='$device_id'";
    $query_run = mysqli_query($db_connection, $query);
    if($query_run)
    {
        $_SESSION['status_success'] = "Data Updated";
        header('Location: /../BaronVerse/admin/devices/devices.php');
        session_write_close();
        exit;
    }
    else{
        $_SESSION['status_failed'] = "Data Not Updated";
        header('Location: /../BaronVerse/admin/devices/devices.php');
        session_write_close();
        exit;
    }
}
?>

<!-- update users device -->
<?php
if(isset($_POST['update_users_device'])){
    $users_device_id = $_POST['users_device_id'];
    $id_user = $_POST['id_user'];
    $id_device = $_POST['id_device'];
    $ud_deployed = $_POST['ud_deployed'];
    $ud_returned = $_POST['ud_returned'];

    $query = "UPDATE `users_device` SET `users_id`='$id_user',`udevice_id`='$id_device',`ud_deployed`='$ud_deployed',`ud_returned`='$ud_returned'  WHERE users_device_id='$users_device_id' ";
    $query_run = mysqli_query($db_connection, $query);
    if($query_run)
    {
        $_SESSION['status_success'] = "Data Updated";
        header('Location: /../BaronVerse/admin/usersdevice/usersdevice.php');
        session_write_close();
        exit;
    }
    else{
        $_SESSION['status_failed'] = "Data Not Updated";
        header('Location: /../BaronVerse/admin/usersdevice/usersdevice.php');
        session_write_close();
        exit;
    }
}
?>

<!-- update ticket -->
<?php
if(isset($_POST['update_ticket'])){
    $ticket_id = $_POST['ticket_id'];
    $ticket_status = $_POST['ticket_status'];

    $query = "UPDATE `ticket` SET `ticket_status`='$ticket_status' WHERE ticket_id='$ticket_id' ";
    $query_run = mysqli_query($db_connection, $query);
    if($query_run)
    {
        $_SESSION['status_success'] = "Data Updated";
        header('Location: /../BaronVerse/admin/ticket/ticketall.php');
        session_write_close();
        exit;
    }
    else{
        $_SESSION['status_failed'] = "Data Not Updated";
        header('Location: /../BaronVerse/admin/ticket/ticketall.php');
        session_write_close();
        exit;
    }
}
?>

<!-- update link -->
<?php
if(isset($_POST['update_link'])){
    $link_id = $_POST['link_id'];
    $link_reference = $_POST['link_reference'];
    $link_name = $_POST['link_name'];

    $query = "UPDATE `link` SET `link_reference`='$link_reference', `link_name`='$link_name' WHERE link_id='$link_id' ";
    $query_run = mysqli_query($db_connection, $query);
    if($query_run)
    {
        $_SESSION['status_success'] = "Data Updated";
        header('Location: /../BaronVerse/admin/dashboard.php');
        session_write_close();
        exit;
    }
    else{
        $_SESSION['status_failed'] = "Data Not Updated";
        header('Location: /../BaronVerse/admin/dashboard.php');
        session_write_close();
        exit;
    }
}
?>

<!-- update link user-->
<?php
if(isset($_POST['update_link_user'])){
    $link_id = $_POST['link_id'];
    $link_reference = $_POST['link_reference'];
    $link_name = $_POST['link_name'];

    $query = "UPDATE `link` SET `link_reference`='$link_reference', `link_name`='$link_name' WHERE link_id='$link_id' ";
    $query_run = mysqli_query($db_connection, $query);
    if($query_run)
    {
        $_SESSION['status_success'] = "Data Updated";
        header('Location: /../BaronVerse/user/file.php');
        session_write_close();
        exit;
    }
    else{
        $_SESSION['status_failed'] = "Data Not Updated";
        header('Location: /../BaronVerse/user/file.php');
        session_write_close();
        exit;
    }
}
?>

<!-- announcement -->
<?php 
function compressImage($source, $destination, $quality) { 
    // Get image info 
    $imgInfo = getimagesize($source); 
    $mime = $imgInfo['mime']; 
    // Create a new image from file 
    switch($mime){ 
        case 'image/jpeg': 
            $image = imagecreatefromjpeg($source); 
            break; 
        case 'image/png': 
            $image = imagecreatefrompng($source); 
            break; 
        case 'image/gif': 
            $image = imagecreatefromgif($source); 
            break; 
        default: 
            $image = imagecreatefromjpeg($source); 
    } 
    // Save image 
    imagejpeg($image, $destination, $quality); 
    // Return compressed image 
    return $destination; 
}
function convert_filesize($bytes, $decimals = 2) { 
    $size = array('B','KB','MB','GB','TB','PB','EB','ZB','YB'); 
    $factor = floor((strlen($bytes) - 1) / 3); 
    return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$size[$factor]; 
}
?>

<?php
// add announce 
if(isset($_POST['update_announce_btn'])){
    $announcement_id = $_POST['announcement_id'];
    $announce_depoption = $_POST['announce_depoption'];
    $announce_user_id = $_POST['announce_user_id'];
    $announce_post = str_replace("'","\'",$_POST['announce_post']);
}
?>
<?php
$announcement_id = $_POST['announcement_id'];
$announce_depoption = $_POST['announce_depoption'];
$announce_user_id = $_POST['announce_user_id'];
$announce_post = str_replace("'","\'",$_POST['announce_post']);
// File upload path 
$uploadPath = "imgupload/"; 
// If file upload form is submitted 
if(isset($_POST["update_announce_btn"])){
    // Check whether user inputs are empty 
    if(!empty($_FILES["image"]["name"])) { 
        // File info 
        $fileName = uniqid() . '_' . basename($_FILES["image"]["name"]); // add uniqid to the filename
        $imageUploadPath = $uploadPath . $fileName; 
        $fileType = pathinfo($imageUploadPath, PATHINFO_EXTENSION); 
         
        // Allow certain file formats 
        $allowTypes = array('jpg','png','jpeg','gif'); 
        if(in_array($fileType, $allowTypes)){ 
            // Image temp source and size 
            $imageTemp = $_FILES["image"]["tmp_name"]; 
            $imageSize = convert_filesize($_FILES["image"]["size"]); 
             
            // Compress size and upload image 
            $compressedImage = compressImage($imageTemp, $imageUploadPath, 20); 
             
            if($compressedImage){ 
                $query = "UPDATE `announcement` SET `announce_post`='$announce_post', `announcement_photo`='$fileName', `announce_depoption`='$announce_depoption' WHERE announcement_id='$announcement_id' ";
                $query_run = mysqli_query($db_connection, $query);
                if($query_run)
                {
                    $compressedImageSize = filesize($compressedImage); 
                    $compressedImageSize = convert_filesize($compressedImageSize); 
                    $_SESSION['status_success'] = "Upload Successful";
                    header('Location: /../BaronVerse/admin/home.php');
                    session_write_close();
                }
                else{
                    $_SESSION['status_failed'] = "Upload Failed!";
                    header('Location: /../BaronVerse/admin/home.php');
                    session_write_close();
                    exit;
                }
            }else{ 
                $_SESSION['status_failed'] = "Image compress failed!";
                header('Location: /../BaronVerse/admin/home.php');
                session_write_close();
            } 
        }else{ 
            $_SESSION['status_failed'] = "Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.";
            header('Location: /../BaronVerse/admin/home.php');
            session_write_close();
        } 
    }else{ 
        $query ="UPDATE `announcement` SET `announce_post`='$announce_post', `announcement_photo`='$fileName', `announce_depoption`='$announce_depoption' WHERE announcement_id='$announcement_id' ";
                $query_run = mysqli_query($db_connection, $query);
                if($query_run)
                {
                    $compressedImageSize = filesize($compressedImage); 
                    $compressedImageSize = convert_filesize($compressedImageSize); 
                    $_SESSION['status_success'] = "Update Successful";
                    header('Location: /../BaronVerse/admin/home.php');
                    session_write_close();
                    exit;
                }
                else{
                    $_SESSION['status_failed'] = "Update Failed!";
                    header('Location: /../BaronVerse/admin/home.php');
                    session_write_close();
                    exit;
                }
    } 
}


if(isset($_POST['user_update_announce_btn'])){
    $announcement_id = $_POST['announcement_id'];
    $announce_depoption = $_POST['announce_depoption'];
    $announce_user_id = $_POST['announce_user_id'];
    $announce_post = str_replace("'","\'",$_POST['announce_post']);
}
?>
<?php
$announcement_id = $_POST['announcement_id'];
$announce_depoption = $_POST['announce_depoption'];
$announce_user_id = $_POST['announce_user_id'];
$announce_post = str_replace("'","\'",$_POST['announce_post']);
// File upload path 
$uploadPath = "imgupload/"; 
// If file upload form is submitted 
if(isset($_POST["user_update_announce_btn"])){
    // Check whether user inputs are empty 
    if(!empty($_FILES["image"]["name"])) { 
        // File info 
        $fileName = uniqid() . '_' . basename($_FILES["image"]["name"]); // add uniqid to the filename
        $imageUploadPath = $uploadPath . $fileName; 
        $fileType = pathinfo($imageUploadPath, PATHINFO_EXTENSION); 
         
        // Allow certain file formats 
        $allowTypes = array('jpg','png','jpeg','gif'); 
        if(in_array($fileType, $allowTypes)){ 
            // Image temp source and size 
            $imageTemp = $_FILES["image"]["tmp_name"]; 
            $imageSize = convert_filesize($_FILES["image"]["size"]); 
             
            // Compress size and upload image 
            $compressedImage = compressImage($imageTemp, $imageUploadPath, 20); 
             
            if($compressedImage){ 
                $query = "UPDATE `announcement` SET `announce_post`='$announce_post', `announcement_photo`='$fileName', `announce_depoption`='$announce_depoption' WHERE announcement_id='$announcement_id' ";
                $query_run = mysqli_query($db_connection, $query);
                if($query_run)
                {
                    $compressedImageSize = filesize($compressedImage); 
                    $compressedImageSize = convert_filesize($compressedImageSize); 
                    $_SESSION['status_success'] = "Upload Successful";
                    header('Location: /../BaronVerse/user/home.php');
                    session_write_close();
                }
                else{
                    $_SESSION['status_failed'] = "Upload Failed!";
                    header('Location: /../BaronVerse/user/home.php');
                    session_write_close();
                    exit;
                }
            }else{ 
                $_SESSION['status_failed'] = "Image compress failed!";
                header('Location: /../BaronVerse/user/home.php');
                session_write_close();
            } 
        }else{ 
            $_SESSION['status_failed'] = "Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.";
            header('Location: /../BaronVerse/user/home.php');
            session_write_close();
        } 
    }else{ 
        $query ="UPDATE `announcement` SET `announce_post`='$announce_post', `announcement_photo`='$fileName', `announce_depoption`='$announce_depoption' WHERE announcement_id='$announcement_id' ";
                $query_run = mysqli_query($db_connection, $query);
                if($query_run)
                {
                    $compressedImageSize = filesize($compressedImage); 
                    $compressedImageSize = convert_filesize($compressedImageSize); 
                    $_SESSION['status_success'] = "Update Successful";
                    header('Location: /../BaronVerse/user/home.php');
                    session_write_close();
                    exit;
                }
                else{
                    $_SESSION['status_failed'] = "Update Failed!";
                    header('Location: /../BaronVerse/user/home.php');
                    session_write_close();
                    exit;
                }
    } 
}
?>
<!-- // update department  -->
<?php
if(isset($_POST['update_depart'])){
    $department_name = $_POST['department_name'];
    $department_id = $_POST['department_id'];
    $query = "UPDATE `department` SET `department_name`='$department_name' WHERE department_id='$department_id' ";
    $query_run = mysqli_query($db_connection, $query);
    if($query_run)
    {
        $_SESSION['status_success'] = "Data Updated";
        header('Location: /../BaronVerse/admin/dashboard.php');
        session_write_close();
        exit;
    }
    else{
        $_SESSION['status_failed'] = "Data Not Updated";
        header('Location: /../BaronVerse/admin/dashboard.php');
        session_write_close();
        exit;
    }
}
?>
<!-- update Product Question -->
<?php
if(isset($_POST['update_product_question'])){
    $product_question_id = $_POST['product_question_id'];
    $pq_question = $_POST['pq_question'];
    $pq_answer = $_POST['pq_answer'];
    $pq_tags = $_POST['pq_tags'];

    $query = "UPDATE `product_question` SET `pq_question`='$pq_question',`pq_answer`='$pq_answer',`pq_tags`='$pq_tags' WHERE product_question_id='$product_question_id' ";
    $query_run = mysqli_query($db_connection, $query);
    if($query_run)
    {
        $_SESSION['status_success'] = "Product Question Updated";
         header('Location: /../BaronVerse/admin/qanda.php');
        session_write_close();
        exit;
    }
    else{
        $_SESSION['status_failed'] = "Product Question Not Updated";
         header('Location: /../BaronVerse/admin/qanda.php');
        session_write_close();
        exit;
    }
}

//--------------------------------------------------- recover ----------------------------------------------------//

// user
if(isset($_POST['recover_user'])){
    $ustatus = $_POST['ustatus'];
    $id = $_POST['id'];

    $query = "UPDATE `users` SET `ustatus`='$ustatus' WHERE id='$id'";
    $query_run = mysqli_query($db_connection, $query);
    if($query_run)
    {
        $_SESSION['status_success'] = "Data Recovered";
        header('Location: /../BaronVerse/admin/recycle/recycle.php');
        session_write_close();
        exit;
    }
    else{
        $_SESSION['status_failed'] = "Data Not Recovered";
        header('Location: /../BaronVerse/admin/recycle/recycle.php');
        session_write_close();
        exit;
    }
}
// device
if(isset($_POST['recover_device'])){
    $dstatus = $_POST['dstatus'];
    $id = $_POST['id'];

    $query = "UPDATE `devices` SET `dstatus`='$dstatus' WHERE device_id='$id'";
    $query_run = mysqli_query($db_connection, $query);
    if($query_run)
    {
        $_SESSION['status_success'] = "Data Recovered";
        header('Location: /../BaronVerse/admin/recycle/devices.php');
        session_write_close();
        exit;
    }
    else{
        $_SESSION['status_failed'] = "Data Not Recovered";
        header('Location: /../BaronVerse/admin/recycle/devices.php');
        session_write_close();
        exit;
    }
}

// users device
if(isset($_POST['recover_users_device'])){
    $udstatus = $_POST['udstatus'];
    $users_device_id = $_POST['users_device_id'];

    $query = "UPDATE `users_device` SET `udstatus`='$udstatus' WHERE users_device_id='$users_device_id'";
    $query_run = mysqli_query($db_connection, $query);
    if($query_run)
    {
        $_SESSION['status_success'] = "Data Recovered";
        header('Location: /../BaronVerse/admin/recycle/usersdevice.php');
        session_write_close();
        exit;
    }
    else{
        $_SESSION['status_failed'] = "Data Not Recovered";
        header('Location: /../BaronVerse/admin/recycle/usersdevice.php');
        session_write_close();
        exit;
    }
}

// ticket
if(isset($_POST['recover_ticket'])){
    $tstatus = $_POST['tstatus'];
    $ticket_id = $_POST['ticket_id'];

    $query = "UPDATE `ticket` SET `tstatus`='$tstatus' WHERE ticket_id='$ticket_id'";
    $query_run = mysqli_query($db_connection, $query);
    if($query_run)
    {
        $_SESSION['status_success'] = "Data Recovered";
        header('Location: /../BaronVerse/admin/recycle/pendingticket.php');
        session_write_close();
        exit;
    }
    else{
        $_SESSION['status_failed'] = "Data Not Recovered";
        header('Location: /../BaronVerse/admin/recycle/pendingticket.php');
        session_write_close();
        exit;
    }
}

// announcement
if(isset($_POST['recover_announcement'])){
    $astatus = $_POST['astatus'];
    $announcement_id = $_POST['announcement_id'];

    $query = "UPDATE `announcement` SET `astatus`='$astatus' WHERE announcement_id='$announcement_id'";
    $query_run = mysqli_query($db_connection, $query);
    if($query_run)
    {
        $_SESSION['status_success'] = "Data Recovered";
        header('Location: /../BaronVerse/admin/recycle/announcement.php');
        session_write_close();
        exit;
    }
    else{
        $_SESSION['status_failed'] = "Data Not Recovered";
        header('Location: /../BaronVerse/admin/recycle/announcement.php');
        session_write_close();
        exit;
    }
}
ob_end_flush();
?>