<?php
include_once __DIR__ . '/../usercondition.php';  
?>
<?php 
        date_default_timezone_set('Asia/Manila');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>BaronVerse</title>
    <link rel="icon" type="image/x-icon" href="/../BaronVerse/icons/TabLogo.png">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- style CSS -->
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
    <!--  -->
</head>

<body>
    <!-- modal popup Add -->
    <div class="modal fade" id="addannounce" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="/../BaronVerse/add.php" method="POST" enctype="multipart/form-data" onsubmit="showLoading()">
                    <div class="modal-header">
                        <h5 class="modal-title" style="margin:auto;">Create Announcement</h5>
                    </div>
                    <br>
                    <div class="row profile-image">
                        <div class="col-2"><img onerror="this.onerror=null; this.src='/../BaronVerse/icons/users.svg'"
                                src="<?php echo $user['profile_image']; ?>" class="rounded-circle" height="40"></div>
                        <div class="col-10">
                            <ul class="cardheadertime">
                                <li style="font-weight: 600; font-size: 16px;">
                                    <?php echo $user['user_lastname'].' '.$user['user_firstname']; ?></li>
                                <li style="color:Gray; font-size:11px;">
                                    <select class="dropdownstyle" name="announce_depoption">
                                        <option value="<?php echo $user['department'] ?>">My Department</option>
                                        <option value="Baron Group">Baron Group</option>
                                        <option value="Baron Method">Baron Method</option>
                                        <option value="GHE">GHE</option>
                                        <option value="All">Public</option>
                                    </select>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" name="announce_user_id" value="<?php echo $user['id']; ?>"
                                class="form-control" required />
                        </div>
                        <div class="form-group">
                            <div class="form-outline">
                                <textarea class="form-control" name="announce_post" placeholder="Add something..."
                                    id="textAreaExample2" rows="8"></textarea>
                            </div>
                        </div>
                        <br>
                        <div>
                            <input type="file" name="image" class="inputdes" onchange="fileSelected()">
                            <div id="progressBarContainer" style="display:none;">
                                <br>
                                <img src="../icons/loading.gif" height="20" alt="">
                                <span id="progressText">Uploading...</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="announce_date" value=" <?php echo  date('Y-m-d H:i:s');?>"
                                class="form-control" required />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="announce_user" class="btn btn-primary">Post</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--  -->
    <!-- header Navbar -->
    <div class="navbar shadow-sm navbar-light navbar-expand-lg px-4 fixed-top" style="background-color: white">
        <a href="home.php" style="display:inline-flex; align-items:center;" class="navbar-brand">
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
            <div style="padding-left:10px; font-weight:700; color: #5e9424; font-size:20px">
                <?php
                $select_user_dep = $user['department'];
                $get_depart = mysqli_query($db_connection, "SELECT * FROM `department` WHERE `department_id`='$select_user_dep'");
                $depart_dis = mysqli_fetch_assoc($get_depart);
                if($depart_dis){
                    echo $depart_dis['department_name'];
                }
            ?>
            </div>
        </a>
        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse  collapse " id="menu">
            <ul class="navbar-nav ms-auto nav2">
                <li class="nav-item li-nav" style="margin:auto;">
                    <a href="home.php" class="linkpage">Home</a>
                </li>
                <li class="nav-item li-nav" style="margin:auto;">
                    <a href="calendar.php" class="linkpage">Schedules</a>
                </li>
                <li class="nav-item li-nav" style="margin:auto;">
                    <a href="qanda.php" class="linkpage">Help</a>
                </li>
                <li class="nav-item li-nav" style="margin:auto;">
                    <a href="file.php" class="linkpage">Files</a>
                </li>
                <div class="dropdown" style="margin:auto;">
                    <button class="btn  dropdown-toggle" type="button" id="dropdownMenuButton1"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="<?php echo $user['profile_image']; ?>" class="rounded-circle" height="22">
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">

                        <li><a class="dropdown-item" href="/../BaronVerse/logout.php">Logout</a></li>
                    </ul>
                </div>
            </ul>
        </div>
    </div>
    <!-- loading animation -->
    <div class="bg-user">
        <div class="lds-ellipsis-user">
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
        $(`.lds-ellipsis-user`).fadeToggle();
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
<script>
    function showLoading() {
        document.getElementById("progressBarContainer").style.display = "block";
    }

    function fileSelected() {
        var progressBar = document.getElementById("progressBar");
        var progressText = document.getElementById("progressText");
        progressBar.value = 0;
        progressText.innerText = "Uploading...";
    }
</script>