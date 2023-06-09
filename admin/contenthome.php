<?php 
        date_default_timezone_set('Asia/Manila');
        function get_time_ago($time){
            $time_difference=time()-$time;
            if($time_difference < 1) { return ' 1 second ago';}
            $condition=array(
                12*30*24*60*60 => 'year',
                30*24*60*60 => 'month',
                24*60*60 => 'day',
                60*60 => 'hr',
                60 => 'min',
                1 => 'sec'
            );
            foreach($condition as $sec => $str)
            {
                $d=$time_difference /$sec;
                if($d >= 1){
                    $t=round($d);
                    return $t.' '.$str.($t >1 ? 's' : ' ').' ago';
                }
            }
        }
?>
<?php 
include_once __DIR__ . '/../../BaronVerse/config.php';
$id = $_SESSION['login_id'];
$get_user = mysqli_query($db_connection, "SELECT * FROM `users` WHERE `google_id`='$id' AND `department`='4' AND `ustatus`='1'  ");
$user = mysqli_fetch_assoc($get_user);
if(isset($_POST["limit"], $_POST["start"])){
            $user_dep = $user['department'];
            $select_announce = "SELECT * 
            FROM announcement 
            JOIN users ON announcement.announce_user_id = users.id
            WHERE astatus = '1'
            ORDER BY announce_date DESC LIMIT ".$_POST['start'].", ".$_POST["limit"]."";
            $announce_info = mysqli_query($db_connection,$select_announce);
                if(mysqli_num_rows($announce_info) > 0)
                {
                    while ($announce_row = mysqli_fetch_assoc($announce_info))
                    {
?>
<!-- content here -->
<div class=" mx-3 my-4 border-0 userhomecard">
    <div class="card-body">
        <div class="row profile-image">
            <div class="col-2"><img onerror="this.onerror=null; this.src='/../BaronVerse/icons/users.svg'"
                    src="<?php echo $announce_row['profile_image']; ?>" class="rounded-circle" height="40">
            </div>
            <div class="col-10">
                <ul class="cardheadertime">
                    <li style="font-weight: 600; font-size: 16px;">
                        <?php echo $announce_row['user_firstname'].' '.$announce_row['user_lastname']; ?>
                    </li>
                    <li style="color:Gray; font-size:11px;">
                        <?php
                                if($announce_row['announce_depoption'] == "All"){
                                    ?>
                        <i class="fa-solid fa-user-group" style="font-size:9px; padding-right:4px;"></i>&middot;
                        <?php
                                }else{
                                    ?>
                        <i class="fa-solid fa-user-large" style="font-size:9px; padding-right:4px;"></i>&middot;
                        <?php
                                }
                                ?>
                        <?php echo date("F d, Y g:i a", strtotime($announce_row['announce_date']));?> &middot;
                        <?php echo get_time_ago(strtotime($announce_row['announce_date'])); ?></li> 
                </ul>
                <?php 
                                if($user['id'] == $announce_row['announce_user_id']){
                                    ?>
                <div class="dropstart" style="text-align:end;">
                    <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-ellipsis-vertical"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li><button type="button" class="btn w-100 btn-light" style="text-align:start;"
                                data-bs-toggle="modal"
                                data-bs-target="#modaledit<?php echo $announce_row['announcement_id']; ?>">Edit</button>
                        </li>
                        <li><button type="button" class="btn w-100 btn-light" style="text-align:start;"
                                data-bs-toggle="modal"
                                data-bs-target="#modaldelete<?php echo $announce_row['announcement_id']; ?>">Delete</button>
                        </li>
                    </ul>
                </div>
                <!-- modal popup edit -->
                <div class="modal fade" id="modaledit<?php echo $announce_row['announcement_id']; ?>" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="/../BaronVerse/update.php" method="POST" enctype="multipart/form-data">
                                <div class="modal-header">
                                    <h5 class="modal-title" style="margin:auto;">Edit Announcement</h5>
                                </div>
                                <br>
                                <div class="row profile-image">
                                    <div class="col-2"><img
                                            onerror="this.onerror=null; this.src='/../BaronVerse/icons/users.svg'"
                                            src="<?php echo $user['profile_image']; ?>" class="rounded-circle"
                                            height="40"></div>
                                    <div class="col-10">
                                        <ul class="cardheadertime">
                                            <li style="font-weight: 600; font-size: 16px;">
                                                <?php echo $user['user_lastname'].' '.$user['user_firstname']; ?>
                                            </li>
                                            <li style="color:Gray; font-size:11px;">
                                                <select class="dropdownstyle" name="announce_depoption">
                                                    <?php 
                                                                if($announce_row['announce_depoption'] == "All"){
                                                                    ?>
                                                    <option hidden selected value="All">Public</option>
                                                    <option value="<?php echo $announce_row['announce_depoption']; ?>">
                                                        My Department</option>
                                                    <?php
                                                                    }else{
                                                                    ?>
                                                    <option hidden selected
                                                        value="<?php echo $announce_row['announce_depoption'];?>">
                                                        My Department</option>
                                                    <option value="All">Public</option>
                                                    <?php
                                                                    }
                                                                    ?>

                                                </select>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <input type="hidden" name="announcement_id"
                                            value="<?php echo $announce_row['announcement_id']; ?>" class="form-control"
                                            required />
                                    </div>
                                    <div class="form-group">
                                        <div class="form-outline">
                                            <textarea class="form-control" name="announce_post"
                                                value="<?php echo $announce_row['announce_post']; ?>"
                                                placeholder="Add something..." id="textAreaExample2"
                                                rows="8"><?php echo $announce_row['announce_post']; ?></textarea>
                                        </div>
                                    </div>
                                    <br>
                                    <div>
                                        <input type="file" name="image" class="inputdes">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" name="update_announce_btn"
                                        class="btn btn-primary">Update</button>
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!--  -->
                <!-- Delete -->
                <div class="modal fade" id="modaldelete<?php echo $announce_row['announcement_id']; ?>" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" style="margin:auto;">Delete Announcement</h5>
                            </div>
                            <form action="/../BaronVerse/delete.php" method="POST">
                                <div class="modal-header">
                                    <h5 class="modal-title">Are you sure you want to delete
                                        this?</h5>
                                </div>
                                <div class="modal-footer">
                                    <input type="hidden" name="astatus" value="0">
                                    <input type="hidden" name="announcement_photo"
                                        value="<?php echo $announce_row['announcement_photo']; ?>">
                                    <input type="hidden" name="announcement_id"
                                        value="<?php echo $announce_row['announcement_id']; ?>">
                                    <button type="submit" name="delete_announcement"
                                        class="btn btn-danger">Delete</button>
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!--  -->
<?php
                                }else{

                                }
?>
            </div>
        </div>
        <div style="padding: 15px; ">
            <?php echo $announce_row['announce_post'];
                            ?>
        </div>
<?php
        $announcement_id = $announce_row['announcement_id'];
        $select_file_format = "SELECT substring_index(announcement_photo,'.',-1) as format from `announcement` WHERE announcement_id = '$announcement_id'";
        $result_file_format = mysqli_query($db_connection, $select_file_format);
        $format_file = mysqli_fetch_assoc($result_file_format);
        $format_run = $format_file['format'];
        if(($format_run == 'mkv') || ($format_run == 'mp4') || ($format_run == 'mov') ){
            ?>
        <video class="video" style=" max-width: 100%;max-height: 100%;" controls>
            <source src="/../BaronVerse/imgupload/<?php echo $announce_row['announcement_photo']; ?>" type="video/mp4">
            Sorry, your browser doesn't support the video element.
        </video>
<?php
        }elseif(($format_run == 'jpg') || ($format_run == 'jpeg') || ($format_run == 'png') || ($format_run == 'gif')){
?>
        <div style="text-align:center;">
            <img onerror="this.onerror=null"
                src="/../BaronVerse/imgupload/<?php echo $announce_row['announcement_photo']; ?>"
                style=" max-width: 100%;max-height: 100%;">
        </div>
<?php
        }else{
            echo '';
        }
?>
    </div>
</div>
<?php
    }
    }}
?>
<script>
    var videos = document.getElementsByClassName("video");
    for (var i = 0; i < videos.length; i++) {
        videos[i].addEventListener("play", function() {
            // Pause all other videos
            for (var j = 0; j < videos.length; j++) {
                if (videos[j] !== this) {
                    videos[j].pause();
                }
            }
        }, true);
    }
</script>