<?php
include_once __DIR__ . '/condition.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>BaronVerse</title>
    <link rel="icon" type="image/x-icon" href="/../BaronVerse/icons/TabLogo.png">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/BaronVerse/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;1,100;1,200;1,300;1,400&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/2be142051f.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script defer src="/../BaronVerse/jvscript/activepage.js"></script>
</head>
<body>
    <div class="navbar shadow-sm navbar-light navbar-expand-lg px-4 fixed-top" style="background-color: white">
        <a href="/../BaronVerse/admin/home.php" style="display:inline-flex; align-items:center;"  class="navbar-brand">
         <?php
            switch ($user['company']){
                case "Baron Group":
                    echo "<img src='/BaronVerse/icons/barongroup.png' height='40px'>";
                    break;
                case "Baron Method":
                    echo "<img src='/BaronVerse/icons/TabLogo.png' height='40px'>";
                    break;
                case "GHE":
                    echo "<img src='/BaronVerse/icons/GHE.png' height='40px'>";
                    break;
            }
            ?>
            <div style="padding-left:10px; font-weight:700; color: #5e9424; font-size:20px">Admin</div>
        </a>
        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse " id="menu">
            <ul class="navbar-nav ms-auto nav2">
                <li class="nav-item li-nav" style="margin:auto;">
                    <a href="/../BaronVerse/admin/home.php" class="linkpage">Home</a>
                </li>
                <li class="nav-item li-nav dashide" style="margin:auto; ">
                    <a href="dashboard.php" class="linkpage">Dashboard</a>
                </li>
                <li class="nav-item li-nav" style="margin:auto;">
                    <a href="/../BaronVerse/calendar/calendar.php" class="linkpage">Schedules</a>
                </li>
                <li class="nav-item li-nav" style="margin:auto;">
                    <a href="/../BaronVerse/admin/IThelpAdmin.php" class="linkpage">Help</a>
                </li>
                <li class="nav-item li-nav" style="margin:auto;">
                    <a href="/../BaronVerse/admin/files.php" class="linkpage">Files</a>
                </li>
                <div class="dropdown"  style="margin:auto;">
                    <button class="btn  dropdown-toggle" type="button" id="dropdownMenuButton1"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="<?php echo $user['profile_image']; ?>" class="rounded-circle" height="22" referrerpolicy="no-referrer"/>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="/../BaronVerse/logout.php">Logout</a></li>
                    </ul>
                </div>
            </ul>
        </div>
    </div>
    <!-- loading animation -->
    <div class="bg">
        <div class="lds-ellipsis">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
</body>
</html>
<!-- loading script -->
<script>
    setTimeout(function() {
        $(window).scrollTop(0);
        $(`.lds-ellipsis`).fadeToggle();
    }, 500);
</script>
<script>
    $(document).ready(function() {
        $('li-nav').click(function() {
            $("li-nav.active").removeClass("active");
            $(this).addClass('active');
        })
    });
</script>