<?php
include_once __DIR__ . 'header.php';    
include_once __DIR__ . '/../../IT/packageIT/tablepackage.php';
date_default_timezone_set('Asia/Manila'); 
?>

<!DOCTYPE html>
<html lang="en">

<body class="body">

    <!-- modal popup Add -->
    <div class="modal fade" id="addticket" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="/../BaronVerse/add.php" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Ticket</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <?php 
                                $select_user = "SELECT * 
                                FROM `devices` 
                                JOIN users_device
                                ON devices.device_id = users_device.udevice_id
                                JOIN users
                                ON users_device.users_id = users.id
                                WHERE users.google_id = '$id'";
                                $user_info = mysqli_query($db_connection,$select_user);
                                    if(mysqli_num_rows($user_info) > 0)
                                    {
                            ?>
                            <label>Device</label>
                            <select name="users_device_id" class="form-select" required>
                                <option hidden value=''>Select Device</option>
                                <?php 
                                    while ($rows = mysqli_fetch_assoc($user_info))
                                    {
                                    $users_device_id = $rows['users_device_id'];
                                    $user_name = $rows['brand'].' | '.$rows['model'];
                                    echo "<option  value='$users_device_id'>$user_name</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                        <label for="">Issue</label>
                            <div class="form-outline">
                                <textarea class="form-control" name="issue" placeholder="Add something..."
                                    id="textAreaExample2" rows="8"></textarea>
                            </div>
                        </div>
                                                <div class="form-group">
                            <input type="hidden" name="date" value=" <?php echo  date('Y-m-d H:i:s');?>"
                                class="form-control" required />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="ticket_add" class="btn btn-primary">Add</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--  -->
    <Br>
    <div class="px-4 contents">
        <div class="homepath">
            <ul class="homepathul">
                <li><a href="/../BaronVerse/IT/IThome.php">
                        <h2>Dashboard</h2>
                    </a></li>
                <li><i class="fa-solid fa-angle-right"></i></li>
                <li><a href="/../BaronVerse/IT/IThome.php">Home</a></li>
                <li><i class="fa-solid fa-angle-right"></i></li>
                <li><a href="/../BaronVerse/IT/usersdevice/ITUDeviceall.php"
                        style="color:#00a037; font-weight:500; font-size:20px;">Pending Tickets</a></li>
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
                <li><a href="/../BaronVerse/IT/IThomealluser.php">Users</a></li>
                <li><a href="/../BaronVerse/IT/devices/ITallDevices.php">Devices</a></li>
                <li><a href="/../BaronVerse/IT/usersdevice/ITUDeviceall.php">User's Device</a></li>
                <li><a href="/../BaronVerse/IT/ticket/ticketall.php" 
                        style="color:#00a037; font-weight:500; border-bottom:green solid 2px;">Pending Tickets</a></li>
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

</html>