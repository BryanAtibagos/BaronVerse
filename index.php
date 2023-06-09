<?php
require 'google-api/vendor/autoload.php';   
require 'config.php';
if(isset($_SESSION['login_id'])){
header('Location: /../BaronVerse/index.php');
exit;
}
$client = new Google_Client();
$client->setClientId('111101461275-2clj0cou43rdmmamiom95658i6tvjup4.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri('http://localhost/BaronVerse/index.php');
$client->addScope("email");
$client->addScope("profile");
if(isset($_GET['code'])):
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    if(!isset($token["error"])){
        $client->setAccessToken($token['access_token']);
        // getting profile information
        $google_oauth = new Google_Service_Oauth2($client);
        $google_account_info = $google_oauth->userinfo->get();
        // Storing data into database
        $id = mysqli_real_escape_string($db_connection, $google_account_info->id);
        $firstname = mysqli_real_escape_string($db_connection, trim($google_account_info->given_name));
        $lastname = mysqli_real_escape_string($db_connection, trim($google_account_info->family_name));
        $email = mysqli_real_escape_string($db_connection, $google_account_info->email);
        $profile_pic = mysqli_real_escape_string($db_connection, $google_account_info->picture);
        $get_user = mysqli_query($db_connection, "SELECT * FROM `users` WHERE `email`='$email' AND `verify_status`='1' AND `ustatus`='1' LIMIT 1 ");
        if(mysqli_num_rows($get_user) == 0){
            $_SESSION['status'] = "Sorry, You Are Not Allowed to Access This Page";
            header('Location: /../BaronVerse/index.php');
            exit; 
        }else{
            if(mysqli_num_rows($get_user) > 0){
                $user = mysqli_fetch_assoc($get_user);
                if($user['department']=='4'){
                    $_SESSION['login_id'] = $id; 
                    $insert = mysqli_query($db_connection, "UPDATE `users` SET `google_id`='$id',`profile_image`='$profile_pic' WHERE `email`='$email' AND `verify_status`='1' AND `ustatus`='1' ");
                    header('Location: /BaronVerse/admin/home.php');
                }else{
                    $_SESSION['login_id'] = $id; 
                    $insert = mysqli_query($db_connection, "UPDATE `users` SET `google_id`='$id',`profile_image`='$profile_pic' WHERE `email`='$email' AND `verify_status`='1' AND `ustatus`='1' ");
                    header('Location: /BaronVerse/user/home.php');
                }
            }else{
                echo "Sign up failed!(Something went wrong).";
            }
        }
    }
    else{
        header('Location: /../BaronVerse/index.php');
        exit;
    }
else: 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;1,100;1,200;1,300;1,400&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="icons/TabLogo.png">
    <title>Login</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <script src="https://kit.fontawesome.com/2be142051f.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body style="background-color:rgb(235, 237, 237);">
<?php 
if (isset($_SESSION['status'])){
?>
<div class="alert alert-success alert-dismissible">
  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
<?php echo $_SESSION['status']; ?>
</div>
<?php
  unset($_SESSION['status']);
}
?>
    <div class="" >
        <div class="row"  style=" height: 100vh">
            <div class="col-sm-6 login-background-cover">
                <div class="p-5 text-center shadow-1-strong rounded mb-5 text-black login-background-filter ">
                    <img src="icons/logo.png">
                    <div class="login-text">
                        <br>
                        <div style="color: #5D9424; font-size: 3.3vh">
                            TRANSFORM YOUR HEALTH THROUGH
                        </div>
                        <div style="color: #292A7C; font-size: 3.3vh">
                            THE HEALING POWER OF FOOD
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 align-self-center d-flex justify-content-center">
                <div class="" style="width: 55%">
                    <form>
                        <h2 class="login-title">Welcome to BaronVerse</h2>
                        <h5 class="login-des">Access all relevant links, documents, and important information needed</h5>
                        <Br>
                        <div class="Signin-btn d-flex justify-content-center">
                            <a href="<?php echo $client->createAuthUrl(); ?>">
                                <button type="button" class="btn btn-danger" style="width: 180px;"><i class="fa-brands fa-google"></i>   Login with Gmail</button>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php endif; ?>