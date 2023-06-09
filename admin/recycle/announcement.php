<?php 
// header navbar
include_once __DIR__ . '/recyclehead.php';   
// 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <br>
    <div class="px-4">
        <div class="card-body">
            <div class="row">
                <div class="col-2 leftcont-user">
                    <div class="" style="">
                        <div class="title" style="padding: 20px 20px 0 20px;">
                            <h3 style=" font-weight: 600;">Category</h3>
                        </div>
                        <div class="card-body">
                            <div class="users-category">
                                <ul>
                                    <li class="users-li">
                                        <a href="recycle.php" class="">Users</a>
                                    </li>
                                    <li class="users-li">
                                        <a href="devices.php" class="">Devices</a>
                                    </li>
                                    <li class="users-li">
                                        <a href="usersdevice.php" class="">User's device</a>
                                    </li>
                                    <li class="users-li">
                                        <a href="pendingticket.php" class="">Pending Ticket</a>
                                    </li>
                                    <li class="users-li">
                                        <a href="announcement.php" class="users-a">Announcement</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="users-category">
                                <ul>
                                    <li class="users-li">
                                        <a class="" href=""></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-10 rightcont-user">
                    <div class="card border-0 cardshadow">
                        <ul class="header-card">
                            <li>
                                <h4 style=" font-weight: 600;">Users<h4>
                            </li>
                        </ul>
                        <hr>
                        <?php 
                            $select_user = "SELECT * 
                            FROM announcement 
                            JOIN users ON announcement.announce_user_id = users.id
                            JOIN department ON users.department = department.department_id
                            WHERE astatus = '0'
                            ORDER BY announce_date";
                            $user_info = mysqli_query($db_connection,$select_user);
                            if(mysqli_num_rows($user_info) > 0)
                            {
                    ?>
                        <div class="card-body table-responsive" style="height: 100%; overflow-y: auto;">
                            <table id="example" class="table table-sm ">
                                <thead class="table-success">
                                    <tr>
                                        <th class="col-1">User</th>
                                        <th class="col-1">Announcement</th>
                                        <th class="col-2">Department</th>
                                        <th class="col-2">Date</th>
                                        <th class="col-1" colsrow="2" style="text-align: center;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php 
                                        while ($row = mysqli_fetch_assoc($user_info))
                                        {
                                            ?>
                                        <td><?php echo $row['user_firstname'].' '.$row['user_lastname']; ?></td>
                                        <td>
                                            <div
                                                style=" overflow: hidden;display: -webkit-box;-webkit-line-clamp: 2; line-clamp: 2; -webkit-box-orient: vertical;">
                                                <?php echo $row['announce_post']; ?></div>
                                        </td>
                                        <td><?php 
                                     if($row['announce_depoption'] ==  $row['department_id'] ){
                                        echo $row['department_name'];
                                    }else{
                                        echo 'All Department';
                                    }
                                    ?></td>
                                        <td><?php echo  date("F d, Y", strtotime($row['announce_date']));?> &middot;
                                            <?php echo date("g:i a", strtotime($row['announce_date'])); ?></td>
                                        <td>
                                            <ul
                                                style="display: flex; justify-content: center; padding-left:0px; margin:0;">
                                                <li style="list-style: none; text-align: center;"><button type="button"
                                                        class="btn btn-success mx-1" data-bs-toggle="modal"
                                                        data-bs-target="#modaledit<?php echo $row['announcement_id']; ?>">Recover</button>
                                                </li>
                                                <li style="list-style: none; text-align: center;"><button type="button"
                                                        class="btn btn-danger mx-1" data-bs-toggle="modal"
                                                        data-bs-target="#modaldelete<?php echo $row['announcement_id']; ?>">Delete</button>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <!-- Update -->
                                    <div class="modal fade" id="modaledit<?php echo $row['announcement_id']; ?>"
                                        tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="/../BaronVerse/update.php" method="POST">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Recover Announcement</h5>
                                                    </div>
                                                    <div style="padding: 15px; ">
                                                        <div class="">
                                                            <div class="border-0 userhomecard">
                                                                <div class="card-body"
                                                                    style="padding-left:0; padding-right:0;">
                                                                    <div class="row profile-image">
                                                                        <div class="col-2"><img
                                                                                onerror="this.onerror=null; this.src='/../BaronVerse/icons/users.svg'"
                                                                                src="<?php echo $row['profile_image']; ?>"
                                                                                class="rounded-circle" height="40">
                                                                        </div>
                                                                        <div class="col-10">
                                                                            <ul class="cardheadertime">
                                                                                <li
                                                                                    style="font-weight: 600; font-size: 16px;">
                                                                                    <?php echo $row['user_firstname'].' '.$row['user_lastname']; ?>
                                                                                </li>
                                                                                <li style="color:Gray; font-size:11px;">
                                                                                    <?php echo  date("F d, Y", strtotime($row['announce_date']));?>
                                                                                    &middot;
                                                                                    <?php echo date("g:i a", strtotime($row['announce_date'])); ?>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                    <div style="padding: 15px; ">
                                                                        <?php echo $row['announce_post'];
                                                                             ?>
                                                                    </div>
                                                                    <?php
                                                                    $announcement_id = $row['announcement_id'];
                                                                    $select_file_format = "SELECT substring_index(announcement_photo,'.',-1) as format from `announcement` WHERE announcement_id = '$announcement_id'";
                                                                    $result_file_format = mysqli_query($db_connection, $select_file_format);
                                                                    $format_file = mysqli_fetch_assoc($result_file_format);
                                                                    $format_run = $format_file['format'];
                                                                    if(($format_run == 'mkv') || ($format_run == 'mp4') || ($format_run == 'mov') ){
                                                                        ?>
                                                                    <video class="video"
                                                                        style=" max-width: 100%;max-height: 100%;"
                                                                        controls>
                                                                        <source
                                                                            src="/../BaronVerse/imgupload/<?php echo $row['announcement_photo']; ?>"
                                                                            type="video/mp4">
                                                                        Sorry, your browser doesn't support the video
                                                                        element.
                                                                    </video>
                                                                    <?php
                                                                    }elseif(($format_run == 'jpg') || ($format_run == 'jpeg') || ($format_run == 'png') || ($format_run == 'gif')){
                                                                        ?>
                                                                    <div style="text-align:center;">
                                                                        <img onerror="this.onerror=null"
                                                                            src="/../BaronVerse/imgupload/<?php echo $row['announcement_photo']; ?>"
                                                                            style=" max-width: 100%;max-height: 100%;">
                                                                    </div>
                                                                    <?php
                                                                    }else{
                                                                        echo '';
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <input type="hidden" name="astatus" value="1">
                                                            <input type="hidden" name="announcement_id"
                                                                value="<?php echo $row['announcement_id']; ?>">
                                                            <button type="submit" name="recover_announcement"
                                                                class="btn btn-primary">Recover</button>
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!--  -->
                                    <!-- Delete -->
                                    <div class="modal fade" id="modaldelete<?php echo $row['announcement_id']; ?>"
                                        tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Are you sure you want to permanently delete
                                                        this record?</h5>
                                                </div>
                                                <form action="/../BaronVerse/delete.php" method="POST">
                                                    <div style="padding: 15px;" class="">
                                                        <div class="border-0 userhomecard">
                                                            <div class="card-body"
                                                                style="padding-left:0; padding-right:0;">
                                                                <div class="row profile-image">
                                                                    <div class="col-2"><img
                                                                            onerror="this.onerror=null; this.src='/../BaronVerse/icons/users.svg'"
                                                                            src="<?php echo $row['profile_image']; ?>"
                                                                            class="rounded-circle" height="40">
                                                                    </div>
                                                                    <div class="col-10">
                                                                        <ul class="cardheadertime">
                                                                            <li
                                                                                style="font-weight: 600; font-size: 16px;">
                                                                                <?php echo $row['user_firstname'].' '.$row['user_lastname']; ?>
                                                                            </li>
                                                                            <li style="color:Gray; font-size:11px;">
                                                                                <?php echo  date("F d, Y", strtotime($row['announce_date']));?>
                                                                                &middot;
                                                                                <?php echo date("g:i a", strtotime($row['announce_date'])); ?>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                                <div style="padding: 15px; ">
                                                                    <?php echo $row['announce_post'];
                                                                             ?>
                                                                </div>
                                                                <?php
                                                                $announcement_id = $row['announcement_id'];
                                                                $select_file_format = "SELECT substring_index(announcement_photo,'.',-1) as format from `announcement` WHERE announcement_id = '$announcement_id'";
                                                                $result_file_format = mysqli_query($db_connection, $select_file_format);
                                                                $format_file = mysqli_fetch_assoc($result_file_format);
                                                                $format_run = $format_file['format'];
                                                                if(($format_run == 'mkv') || ($format_run == 'mp4') || ($format_run == 'mov') ){
                                                                    ?>
                                                                <video class="video" style=" max-width: 100%;max-height: 100%;" controls>
                                                                    <source src="/../BaronVerse/imgupload/<?php echo $row['announcement_photo']; ?>" type="video/mp4">
                                                                    Sorry, your browser doesn't support the video element.
                                                                </video>
                                                                <?php
                                                                }elseif(($format_run == 'jpg') || ($format_run == 'jpeg') || ($format_run == 'png') || ($format_run == 'gif')){
                                                                    ?>
                                                                <div style="text-align:center;">
                                                                    <img onerror="this.onerror=null"
                                                                        src="/../BaronVerse/imgupload/<?php echo $row['announcement_photo']; ?>"
                                                                        style=" max-width: 100%;max-height: 100%;">
                                                                </div>
                                                                <?php
                                                                }else{
                                                                    echo '';
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <input type="hidden" name="announcement_photo"
                                                            value="<?php echo $row['announcement_photo']; ?>">
                                                        <input type="hidden" name="announcement_id"
                                                            value="<?php echo $row['announcement_id']; ?>">
                                                        <button type="submit" name="per_delete_announcement"
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
                                        }
                                    }else{
                                        echo "<div style='margin:auto; padding-bottom:20px;'>No Record</tr>";
                                    }
                                        ?>

                                </tbody>
                            </table>
                        </div>
                        <!--  -->
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <Br><Br>
    </div>

</body>

</html>