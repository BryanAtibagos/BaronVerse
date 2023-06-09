<?php
session_start();
ob_start();
require_once __DIR__ . '/db.php';  
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
//Load Composer's autoloader
require 'vendor/autoload.php';
function sendemail_verify($firstname,$lastname,$email,$verify_token)
{
    $mail = new PHPMailer(true);
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'baronmethod.intranet@gmail.com';                     //SMTP username
    $mail->Password   = 'oqslnshcakautpfq';                               //SMTP password
    $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    //Recipients
    $mail->setFrom('baronmethod.intranet@gmail.com', 'Baron Method Intranet Admin');
    // $mail->addAddress('joe@example.net', 'Joe User');     //Add a recipient
    $mail->addAddress($email);               //Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');
    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
    //Content
    // <style>
    // .ii a[href] {
    //     color: #fff;
    // }
    // </style>
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Email Verification from BaronVerse';
    $mail_template = "
    <div height='100%' style='background-color: rgb(240, 240, 240); padding: 30px;  font-family: 'Poppins', sans-serif;'>
    <table width='28%' style='margin: auto; text-align: center; background-color: rgb(250, 253, 250);' cellspacing='0'
      cellpadding='0'>
      <tr>
        <td>
          <img src='https://i.pinimg.com/originals/bf/37/78/bf3778bd7e237a8b4dc04da1f99fa57f.png' alt='Banner Image' class='banner'>
        </td>
      </tr>
      <tr>
        <td style=' font-family: 'Poppins', sans-serif;'>
          <h3>You have Registered with BaronVerse</h3>
        </td>
      </tr>
      <tr>
        <td style=' font-family: 'Poppins', sans-serif;'>
          <p>Please click the button below to verify your email address.
          </p>
        </td>
      </tr>
      <tr>
      <td class='button'>
                      <a class='link' href='https://localhost/BaronVerse/verifytoken.php?token=$verify_token' target='_blank' style='text-decoration:none; padding:10px; background:#292A7C; color:white'>
                          Click Here             
                      </a>
                  </td>
      </tr>
      <tr>
        <td  style='color: gray; font-size: small; padding-top:10px; font-family: 'Poppins', sans-serif;'>
          <p><i>If you did
              not create an account, no further action is required.</i></p>
        </td>
      </tr>
    </table>
  </div>
    ";
    $mail->Body    = $mail_template;

    $mail->send();
    echo 'Message has been sent';
}
if(isset($_POST['register_btn'])){
    $firstname = $_POST['firstname'];
    $profile_image = $_POST['profile_image'];
    $google_id = $_POST['google_id'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $user_type = $_POST['user_type'];
    $department = $_POST['department'];
    $company = $_POST['company'];
    $verify_token= md5(rand());
    //email exist or not
    $check_email_query = "SELECT email FROM users WHERE email='$email' AND `ustatus`='1' LIMIT 1";
    $check_email_query_run = mysqli_query($db_connection, $check_email_query);
    if(mysqli_num_rows($check_email_query_run)  > 0){
        $_SESSION['status'] = "Email ID already Exists";
        header("Location: /../BaronVerse/admin/users.php");
        session_write_close();
    }
    else{
        // Insert User/ Registered User Data
        $query = "INSERT INTO `users`(`google_id`,`profile_image`,`user_firstname`,`user_lastname`,`email`,`verify_token`,`department`,`company`,`user_type`) VALUES('$google_id','$profile_image','$firstname','$lastname','$email','$verify_token','$department','$company','$user_type')";
        $query_run = mysqli_query($db_connection, $query);

        if($query_run){
            sendemail_verify("$firstname","$lastname","$email","$verify_token");
            $_SESSION['status_success'] = "Registration Success.! Please verify your Email address";
            header("Location: /../BaronVerse/admin/users.php");
            session_write_close();
        }else{
            $_SESSION['status_failed'] = "Registration Failed";
            header("Location: /../BaronVerse/admin/users.php");
            session_write_close();
        }
    }
}
?>

<?php
// add device
if(isset($_POST['add_device'])){
    $brand = $_POST['brand'];
    $unit_id = $_POST['unit_id'];
    $model = $_POST['model'];
    $processor = $_POST['processor'];
    $ram = $_POST['ram'];
    $storage = $_POST['storage'];
    $device_category = $_POST['device_category'];
    $add_more_details = $_POST['add_more_details'];
    $query = "INSERT INTO `devices`(`brand`, `unit_id`,`model`, `processor`, `ram`, `storage`, `device_category`, `add_more_details`) VALUES ('$brand','$unit_id','$model','$processor','$ram','$storage','$device_category','$add_more_details')";
    $query_run = mysqli_query($db_connection, $query);
    if($query_run)
    {
        $_SESSION['status_success'] = "Data Added";
        header('Location: /../BaronVerse/admin/devices/devices.php');
        session_write_close();
        exit;
    }
    else{
        $_SESSION['status_failed'] = "Data Not Added";
        header('Location: /../BaronVerse/admin/devices/devices.php');
        session_write_close();
        exit;
    }
}
?>
<?php
// add users device
if(isset($_POST['usersdevice_add'])){
    $id_user = $_POST['id_user'];
    $id_device = $_POST['id_device'];
    $ud_deployed = $_POST['ud_deployed'];
    $ud_returned = $_POST['ud_returned'];
    $ud_returned_date = "0000-00-00";
    $query = "INSERT INTO `users_device`(`users_id`, `udevice_id`, `ud_deployed`, `ud_returned`) VALUES ('$id_user','$id_device','$ud_deployed','$ud_returned_date')";
    $query_run = mysqli_query($db_connection, $query);
    if($query_run)
    {
        $_SESSION['status_success'] = "Data Added";
        header('Location: /../BaronVerse/admin/usersdevice/usersdevice.php');
        session_write_close();
        exit;
    }
    else{
        $_SESSION['status_failed'] = "Data Not Added";
        header('Location: /../BaronVerse/admin/usersdevice/usersdevice.php');
        session_write_close();
        exit;
    }
}
?>
<?php
// add department 
if(isset($_POST['add_depart'])){
    $department_name = $_POST['department_name'];
    $query = "INSERT INTO `department`(`department_name`) VALUES ('$department_name')";
    $query_run = mysqli_query($db_connection, $query);
    if($query_run)
    {
        $_SESSION['status_success'] = "Data Added";
        header('Location: /../BaronVerse/admin/dashboard.php');
        session_write_close();
        exit;
    }
    else{
        $_SESSION['status_failed'] = "Data Not Added";
        header('Location: /../BaronVerse/admin/dashboard.php');
        session_write_close();
        exit;
    }
}
?>
<?php
// add ticket device
if(isset($_POST['ticket_add'])){
    $users_device_id = $_POST['users_device_id'];
    $issue = $_POST['issue'];
    $date = $_POST['date'];
    $query = "INSERT INTO `ticket`(`t_users_device_id`, `issue`, `date`) VALUES ('$users_device_id','$issue','$date')";
    $query_run = mysqli_query($db_connection, $query);
    if($query_run)
    {
        $_SESSION['status_success'] = "Data Added";
        header('Location: /../BaronVerse/admin/ticket/ticketall.php');
        session_write_close();
        exit;
    }
    else{
        $_SESSION['status_failed'] = "Data Not Added";
        header('Location: /../BaronVerse/admin/ticket/ticketall.php');
        session_write_close();
        exit;
    }
}
?>

<?php
// add link 
if(isset($_POST['add_link'])){
    $link_user_id = $_POST['link_user_id'];
    $link_reference = $_POST['link_reference'];
    $link_name = $_POST['link_name'];
    $query = "INSERT INTO `link`(`link_name`, `link_reference`, `link_user_id`) VALUES ('$link_name','$link_reference','$link_user_id')";
    $query_run = mysqli_query($db_connection, $query);
    if($query_run)
    {
        $_SESSION['status_success'] = "Data Added";
        header('Location: /../BaronVerse/admin/dashboard.php');
        session_write_close();
        exit;
    }
    else{
        $_SESSION['status_failed'] = "Data Not Added";
        header('Location: /../BaronVerse/admin/dashboard.php');
        session_write_close();
        exit;
    }
}
?>
<?php
// add link user
if(isset($_POST['add_link_user'])){
    $link_user_id = $_POST['link_user_id'];
    $link_reference = $_POST['link_reference'];
    $link_name = $_POST['link_name'];
    $query = "INSERT INTO `link`(`link_name`, `link_reference`, `link_user_id`) VALUES ('$link_name','$link_reference','$link_user_id')";
    $query_run = mysqli_query($db_connection, $query);
    if($query_run)
    {
        $_SESSION['status_success'] = "Data Added";
        header('Location: /../BaronVerse/user/file.php');
        session_write_close();
        exit;
    }
    else{
        $_SESSION['status_failed'] = "Data Not Added";
        header('Location: /../BaronVerse/user/file.php');
        session_write_close();
        exit;
    }
}
?>



<?php
// add link 
if(isset($_POST['add_link'])){
    $link_user_id = $_POST['link_user_id'];
    $link_reference = $_POST['link_reference'];
    $link_name = $_POST['link_name'];
    $query = "INSERT INTO `link`(`link_name`, `link_reference`, `link_user_id`) VALUES ('$link_name','$link_reference','$link_user_id')";
    $query_run = mysqli_query($db_connection, $query);
    if($query_run)
    {
        $_SESSION['status_success'] = "Data Added";
        header('Location: /../BaronVerse/IT/IThome.php');
        session_write_close();
        exit;
    }
    else{
        $_SESSION['status_failed'] = "Data Not Added";
        header('Location: /../BaronVerse/IT/IThome.php');
        session_write_close();
        exit;
    }
}
?>

<?php
// add ticket device
if(isset($_POST['ithelpadd'])){
    $users_device_id_ithelp = $_POST['users_device_id_ithelp'];
    $issue_ithelp = $_POST['issue_ithelp'];
    $date = $_POST['date'];
    $query = "INSERT INTO `ticket`(`t_users_device_id`, `issue`, `date`) VALUES ('$users_device_id_ithelp','$issue_ithelp','$date')";
    $query_run = mysqli_query($db_connection, $query);
    if($query_run)
    {
        $_SESSION['status_success'] = "Data Added";
        header('Location: /../BaronVerse/user/ithelp.php');
        session_write_close();
        exit;
    }
    else{
        $_SESSION['status_failed'] = "Data Not Added";
        header('Location: /../BaronVerse/user/ithelp.php');
        session_write_close();
        exit;
    }
}
?>

<!-- upload files -->
<?php
if(isset($_POST['submit_file'])){
    $id = $_POST['id'];
    $file_array = $_FILES['file'];
    $file_count = count($file_array['name']);
    $allowed = array('doc', 'docx', 'pdf', 'txt', 'xls', 'ppt', 'pptx');
    for($i=0; $i<$file_count; $i++){
        $filename = $file_array['name'][$i];
        $file_tmp_name = $file_array['tmp_name'][$i];
        $file_size = $file_array['size'][$i];
        $file_error = $file_array['error'][$i];
        $file_type = $file_array['type'][$i];

        $fileExt = explode('.', $filename);
        $fileactualExt = strtolower(end($fileExt));

        if(in_array($fileactualExt, $allowed)){
            if($file_error === 0){
                if($file_size < 1000000){
                    $fileNameNew = uniqid('', true).".".$fileactualExt;
                    $filedestination = 'fileupload/'.$fileNameNew;
                    if(move_uploaded_file($file_tmp_name, $filedestination)){
                        $query = "INSERT INTO `file`(`file_name`,`file_user`,`file_size`,`file_uniq_name`) VALUES ('$filename','$id','$file_size','$fileNameNew')";
                        $query_run = mysqli_query($db_connection, $query);
                        if($query_run)
                        {
                            $_SESSION['status_success'] = "File Uploaded";
                            session_write_close();
                        }
                        else{
                            $_SESSION['status_failed'] = "File Not Uploaded";
                            session_write_close();
                        }
                    }
                }else{
                    $_SESSION['status_failed'] = "Your file is too big!";
                    session_write_close();
                }
            }else{
                $_SESSION['status_failed'] = "There was an error uploading your file";
                session_write_close();
            }
        }else{
            $_SESSION['status_failed'] = "You cannot upload files of this type!";
            session_write_close();
        }
    }
    header('Location: /../BaronVerse/admin/files.php');
    session_write_close();
    exit;
}
?>

<!-- upload files user -->
<?php
if(isset($_POST['user_submit_file'])){
    $id = $_POST['id'];
    $file_array = $_FILES['file'];
    $file_count = count($file_array['name']);
    $allowed = array('doc', 'docx', 'pdf', 'txt', 'xls', 'ppt', 'pptx');
    for($i=0; $i<$file_count; $i++){
        $filename = $file_array['name'][$i];
        $file_tmp_name = $file_array['tmp_name'][$i];
        $file_size = $file_array['size'][$i];
        $file_error = $file_array['error'][$i];
        $file_type = $file_array['type'][$i];

        $fileExt = explode('.', $filename);
        $fileactualExt = strtolower(end($fileExt));

        if(in_array($fileactualExt, $allowed)){
            if($file_error === 0){
                if($file_size < 1000000){
                    $fileNameNew = uniqid('', true).".".$fileactualExt;
                    $filedestination = 'fileupload/'.$fileNameNew;
                    if(move_uploaded_file($file_tmp_name, $filedestination)){
                        $query = "INSERT INTO `file`(`file_name`,`file_user`,`file_size`,`file_uniq_name`) VALUES ('$filename','$id','$file_size','$fileNameNew')";
                        $query_run = mysqli_query($db_connection, $query);
                        if($query_run)
                        {
                            header('Location: /../BaronVerse/user/file.php');
                            $_SESSION['status_success'] = "File Uploaded";
                            session_write_close();
                        }
                        else{
                            header('Location: /../BaronVerse/user/file.php');
                            $_SESSION['status_failed'] = "File Not Uploaded";
                            session_write_close();
                        }
                    }
                }else{
                    header('Location: /../BaronVerse/user/file.php');
                    $_SESSION['status_failed'] = "Your file is too big!";
                    session_write_close();
                }
            }else{
                header('Location: /../BaronVerse/user/file.php');
                $_SESSION['status_failed'] = "There was an error uploading your file";
                session_write_close();
            }
        }else{
            header('Location: /../BaronVerse/user/file.php');
            $_SESSION['status_failed'] = "You cannot upload files of this type!";
            session_write_close();
        }
    }
    header('Location: /../BaronVerse/user/file.php');
    session_write_close();
    exit;
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
// if(isset($_POST['announce_btn'])){
//     $announce_depoption = $_POST['announce_depoption'];
//     $announce_user_id = $_POST['announce_user_id'];
//     $announce_post = str_replace("'","\'",$_POST['announce_post']);
// }
?>

<!-- // add announce  -->
<?php
if(isset($_POST["announce_btn"])){
    $announce_depoption = $_POST['announce_depoption'];
    $announce_user_id = $_POST['announce_user_id'];
    $announce_date = $_POST['announce_date'];
    $announce_post = str_replace("'","\'",$_POST['announce_post']);
    // File upload path 
    $uploadPath = "imgupload/"; 
// If file upload form is submitted 
    // Check whether user inputs are empty 
    if(!empty($_FILES["image"]["name"])) { 
        // File info 
        $fileName = uniqid() . '_' . basename($_FILES["image"]["name"]); // add uniqid to the filename
        $imageUploadPath = $uploadPath . $fileName; 
        $fileType = pathinfo($imageUploadPath, PATHINFO_EXTENSION); 
         
        // Allow certain file formats 
        $allowTypes = array('jpg','png','jpeg','gif'); 
        $allowVideo = array('mp4','mov', 'mkv'); 
        if(in_array($fileType, $allowTypes)){ 
            // Image temp source and size 
            $imageTemp = $_FILES["image"]["tmp_name"]; 
            $imageSize = convert_filesize($_FILES["image"]["size"]); 
             
            // Compress size and upload image 
            $compressedImage = compressImage($imageTemp, $imageUploadPath, 20); 
             
            if($compressedImage){ 
                $query = "INSERT INTO `announcement`(`announce_user_id`, `announce_post`, `announce_date`, `announcement_photo`,  `announce_depoption`) VALUES ('$announce_user_id','$announce_post','$announce_date','$fileName','$announce_depoption')";
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
        }elseif(in_array($fileType, $allowVideo)){ 
            $maxFileSize = 50 * 1024 * 1024; //50 mb max
            if($_FILES["image"]["size"] < $maxFileSize){
            $imageTemp = $_FILES["image"]["tmp_name"]; 
            if(move_uploaded_file($imageTemp, $imageUploadPath)){
                $query = "INSERT INTO `announcement`(`announce_user_id`, `announce_post`, `announce_date`, `announcement_photo`,  `announce_depoption`) VALUES ('$announce_user_id','$announce_post','$announce_date','$fileName','$announce_depoption')";
                $query_run = mysqli_query($db_connection, $query);
                if($query_run)
                {
                      header('Location: /../BaronVerse/admin/home.php');
                    $_SESSION['status_success'] = "File Uploaded";
                    session_write_close();
                }
                else{
                      header('Location: /../BaronVerse/admin/home.php');
                    $_SESSION['status_failed'] = "File Not Uploaded";
                    session_write_close();
                }
            }
        }else{
            header('Location: /../BaronVerse/admin/home.php');
            $_SESSION['status_failed'] = "file is too big";
            session_write_close();
        }
        }else{
            $_SESSION['status_failed'] = "Sorry, only JPG, JPEG, PNG, GIF, MOV & MP4 files are allowed to upload.";
            header('Location: /../BaronVerse/admin/home.php');
            session_write_close();
        }
    }else{ 
        $query = "INSERT INTO `announcement`(`announce_user_id`,`announce_date`, `announce_post`,  `announce_depoption`) VALUES ('$announce_user_id','$announce_date','$announce_post','$announce_depoption')";
                $query_run = mysqli_query($db_connection, $query);
                if($query_run)
                {
                    $_SESSION['status_success'] = "Upload Successful";
                    header('Location: /../BaronVerse/admin/home.php');
                    session_write_close();
                    exit;
                }
                else{
                    $_SESSION['status_failed'] = "Upload Failed!";
                    header('Location: /../BaronVerse/admin/home.php');
                    session_write_close();
                    exit;
                }
    } 
}
?>

<?php
// add announce user
// if(isset($_POST['announce_user'])){
//     $announce_depoption = $_POST['announce_depoption'];
//     $announce_user_id = $_POST['announce_user_id'];
//     $announce_post = str_replace("'","\'",$_POST['announce_post']);
// }
?>
<?php
// If file upload form is submitted 
if(isset($_POST["announce_user"])){
    $announce_depoption = $_POST['announce_depoption'];
    $announce_user_id = $_POST['announce_user_id'];
    $announce_date = $_POST['announce_date'];
    $announce_post = str_replace("'","\'",$_POST['announce_post']);
    // File upload path 
    $uploadPath = "imgupload/"; 
    // Check whether user inputs are empty 
    if(!empty($_FILES["image"]["name"])) { 
        // File info 
        $fileName = uniqid() . '_' . basename($_FILES["image"]["name"]); // add uniqid to the filename
        $imageUploadPath = $uploadPath . $fileName; 
        $fileType = pathinfo($imageUploadPath, PATHINFO_EXTENSION); 
         
        // Allow certain file formats 
        $allowTypes = array('jpg','png','jpeg','gif'); 
        $allowVideo = array('mp4','mov', 'mkv'); 
        if(in_array($fileType, $allowTypes)){ 
            // Image temp source and size 
            $imageTemp = $_FILES["image"]["tmp_name"]; 
            $imageSize = convert_filesize($_FILES["image"]["size"]); 
             
            // Compress size and upload image 
            $compressedImage = compressImage($imageTemp, $imageUploadPath, 20); 
             
            if($compressedImage){ 
                $query = "INSERT INTO `announcement`(`announce_user_id`, `announce_post`,`announce_date`,  `announcement_photo`,  `announce_depoption`) VALUES ('$announce_user_id','$announce_post','$announce_date','$fileName','$announce_depoption')";
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
        }elseif(in_array($fileType, $allowVideo)){ 
            $maxFileSize = 50 * 1024 * 1024; //50 mb max
            if($_FILES["image"]["size"] < $maxFileSize){
            $imageTemp = $_FILES["image"]["tmp_name"]; 
            if(move_uploaded_file($imageTemp, $imageUploadPath)){
                $query = "INSERT INTO `announcement`(`announce_user_id`, `announce_post`, `announce_date`, `announcement_photo`,  `announce_depoption`) VALUES ('$announce_user_id','$announce_post','$announce_date','$fileName','$announce_depoption')";
                $query_run = mysqli_query($db_connection, $query);
                if($query_run)
                {
                     header('Location: /../BaronVerse/user/home.php');
                    $_SESSION['status_success'] = "File Uploaded";
                    session_write_close();
                }
                else{
                     header('Location: /../BaronVerse/user/home.php');
                    $_SESSION['status_failed'] = "File Not Uploaded";
                    session_write_close();
                }
            }
        }else{
           header('Location: /../BaronVerse/user/home.php');
            $_SESSION['status_failed'] = "file is too big";
            session_write_close();
        }
        }else{ 
            $_SESSION['status_failed'] = "Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.";
            header('Location: /../BaronVerse/user/home.php');
            session_write_close();
        } 
    }else{ 
          $query = "INSERT INTO `announcement`(`announce_user_id`,`announce_date`, `announce_post`,  `announce_depoption`) VALUES ('$announce_user_id','$announce_date','$announce_post','$announce_depoption')";
                $query_run = mysqli_query($db_connection, $query);
                if($query_run)
                {
                    $_SESSION['status_success'] = "Upload Successful";
                    header('Location: /../BaronVerse/user/home.php');
                    session_write_close();
                    exit;
                }
                else{
                    $_SESSION['status_failed'] = "Upload Failed!";
                    header('Location: /../BaronVerse/user/home.php');
                    session_write_close();
                    exit;
                }
    } 
}
?>

<?php
// add Product Question
if(isset($_POST['add_pq_btn'])){
    $pq_question = str_replace("'","\'",$_POST['pq_question']);
    $pq_answer = str_replace("'","\'",$_POST['pq_answer']);
    $pq_tags = $_POST['pq_tags'];
    $query = "INSERT INTO `product_question`(`pq_question`, `pq_answer`, `pq_tags`) VALUES ('$pq_question','$pq_answer','$pq_tags')";
    $query_run = mysqli_query($db_connection, $query);
    if($query_run)
    {
        $_SESSION['status_success'] = "Product Question Added";
        header('Location: /../BaronVerse/admin/qanda.php');
        session_write_close();
        exit;
    }
    else{
        $_SESSION['status_failed'] = "Product Question Not Added";
        header('Location: /../BaronVerse/admin/qanda.php');
        session_write_close();
        exit;
    }
}
ob_end_flush();
?>