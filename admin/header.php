<?php
include_once __DIR__ . '/../header.php';    
include_once 'packageIT/tablepackage.php';
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
                        <h5 class="modal-title">Add Account</h5>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="google_id" class="form-control" value="None">
                        <input type="hidden" name="profile_image" class="form-control" value="None">
                        <div class="form-group">
                            <label for="">Firstname</label>
                            <input type="text" name="firstname" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <label for="">Lastname</label>
                            <input type="text" name="lastname" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" name="email" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <label for="">User type</label>
                            <select class="form-select" name="user_type" aria-label="Default select example" required>
                                <option value="3" selected>User</option>
                                <option value="2">Admin</option>
                                <option value="1">Super Admin</option>
                            </select>
                            <div class="form-text" id="basic-addon4">A Super Admin can delete
                                all data</div>
                            <div class="form-text" id="basic-addon4">An admin cannot remove a
                                super admin.</div>
                        </div>
                        <div class="form-group">
                            <?php
                                $select_dep = "SELECT * 
                                FROM `department` WHERE dpstatus = '1'";
                                $dep_info = mysqli_query($db_connection,$select_dep);
                                    if(mysqli_num_rows($dep_info) > 0)
                                    {
                            ?>
                            <label>Department</label>
                            <select name="department" class="form-select" required>
                                <option hidden value=''>Select Department</option>
                                <?php 
                                    while ($rows = mysqli_fetch_assoc($dep_info))
                                    {
                                    $dep_id = $rows['department_id'];
                                    $dep_name = $rows['department_name'];
                                    echo "<option  value='$dep_id'>$dep_name</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Company</label>
                            <select class="form-select" name="company" aria-label="Default select example" required>
                            <option hidden value="" selected>Select Company</option>
                                <option value="Baron Group">Baron Group</option>
                                <option value="Baron Method">Baron Method</option>
                                <option value="GHE">GHE</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="register_btn" class="btn btn-primary">Add</button>
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
                <li><a href="/../BaronVerse/admin/users.php"
                        style="color:#00a037; font-weight:500; font-size:20px;">Users</a></li>
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
                <li><a href="/../BaronVerse/admin/users.php"
                        style="color:#00a037; font-weight:500; border-bottom:green solid 2px;">Users</a></li>
                <li><a href="/../BaronVerse/admin/devices/devices.php">Devices</a></li>
                <li><a href="/../BaronVerse/admin/usersdevice/usersdevice.php">User's Device</a></li>
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

</html>