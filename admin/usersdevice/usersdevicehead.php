<?php
require_once __DIR__ . '/../../header.php';
require_once '../packageIT/tablepackage.php';    
include '../../jvscript/datatables.php';
?>
<!DOCTYPE html>
<html lang="en">

<body class="body">
    <!-- modal popup Add -->
    <div class="modal fade" id="adduser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="/../BaronVerse/add.php" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Users device</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <?php 
                                $select_user = "SELECT * FROM users WHERE verify_status = '1' AND ustatus = '1' ";
                                $user_info = mysqli_query($db_connection,$select_user);
                                    if(mysqli_num_rows($user_info) > 0)
                                    {
                            ?>
                            <label>User</label>
                            <select name="id_user" class="form-select" required>
                                <option hidden value=''>Select User</option>
                                <?php 
                                    while ($rows = mysqli_fetch_assoc($user_info))
                                    {
                                    $id = $rows['id'];
                                    $user_name = $rows['user_firstname'].' '.$rows['user_lastname'];
                                    echo "<option  value='$id'>$user_name</option>";
                                    }
                                }
                                ?>
                            </select>
                            <label for="date-input1" >Deployed</label>
                            <input type="date" id="date-input1" name="ud_deployed" placeholder="yyyy-mm-dd"
                                style="width:100%; padding: 15px 10px 15px 10px; height:28px; border-radius:4px; border: 1px solid rgba(145, 145, 145, 0.511);">
                                <label for="date-input" >Returned</label>
                            <input type="date" id="date-input" name="ud_returned" placeholder="yyyy-mm-dd"
                                style="width:100%; padding: 15px 10px 15px 10px; height:28px; border-radius:4px; border: 1px solid rgba(145, 145, 145, 0.511);">
                        </div>
                        <div class="form-group">
                            <?php 
                                $select_user = "SELECT * FROM devices WHERE dstatus = '1' ";
                                $user_info = mysqli_query($db_connection,$select_user);
                                    if(mysqli_num_rows($user_info) > 0)
                                    {
                            ?>
                            <label>Device</label>
                            <select name="id_device" class="form-select" required>
                                <option hidden value=''>Select Device</option>
                                <?php 
                                    while ($rows = mysqli_fetch_assoc($user_info))
                                    {
                                    $id = $rows['device_id'];
                                    $user_name = $rows['brand'].' | '.$rows['model'];
                                    echo "<option  value='$id'>$user_name</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="usersdevice_add" class="btn btn-primary">Add</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--  -->
    <Br><br><br><br><br>
    <div class="px-4 contents">
        <div class="homepath">
            <ul class="homepathul">
                <li><a href="/../BaronVerse/admin/dashboard.php">
                        <h2>Dashboard</h2>
                    </a></li>
                <li><i class="fa-solid fa-angle-right"></i></li>
                <li><a href="/../BaronVerse/admin/usersdevice/usersdevice.php"
                        style="color:#00a037; font-weight:500; font-size:20px;">User's Device</a></li>
            </ul>
        </div>
        <Br><br>
        <!-- alert -->
        <div role="alert" id="message">
            <?php 
                 if(isset($_SESSION['status_success']))
                {
                    echo "<div class='alert alert-success' role='alert' style='position:absolute; right:20px;'><i class='fa-solid fa-circle-check px-2' style='font-size:20px;'></i>".$_SESSION['status_success']."</div>";
                    unset($_SESSION['status_success']);
                }elseif(isset($_SESSION['status_failed'])){
                    echo "<div class='alert alert-danger' role='alert' style='position:absolute; right:20px;'><i class='fa-solid fa-circle-xmark px-2' style='font-size:20px;'></i>".$_SESSION['status_failed']."</div>";
                    unset($_SESSION['status_failed']);
                }
            ?>
        </div>
        <br>
        <!--  -->

        <div class="dashboard-list">
            <ul class="dashboard-ul">
                <li><a href="/../BaronVerse/admin/users.php">Users</a></li>
                <li><a href="/../BaronVerse/admin/devices/devices.php">Devices</a></li>
                <li><a href="/../BaronVerse/admin/usersdevice/usersdevice.php"
                        style="color:#00a037; font-weight:500; border-bottom:green solid 2px;">User's Device</a></li>
                <li><a href="/../BaronVerse/admin/ticket/ticketall.php">Pending Tickets</a></li>
                <li>
                <?php
                    if ($user['user_type'] == '1'){
                        ?>
                         <a href="/../BaronVerse/admin/recycle/recycle.php">Recycle</a>
                        <?php
                    }else{
                        echo '';
                    }
                    ?>
                </li>
            </ul>
        </div>
    </div>
    <br>

</body>
<script>
    $(document).ready(function() {
        setTimeout(function() {
            $('#message').hide();
        }, 3000);
    })
</script>
<script>
    // Initialize datepicker
    $(function() {
        $("#datepicker").datepicker({
            dateFormat: 'yyyy-mm-dd'
        }).val();
    });
</script>

</html>