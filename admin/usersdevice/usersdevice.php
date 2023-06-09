<?php 
include_once 'usersdevicehead.php';
?>
<div class="px-4">
    <div class="card-body">
        <div class="row">
            <div class="col-2 leftcont-user">
                <div class="" style="">
                    <div class="title" style="padding: 20px 20px 0 20px;">
                        <h3 style=" font-weight: 600;">Users</h3>
                    </div>
                    <div class="card-body">
                        <?php 
                        $select_dep = "SELECT * FROM department WHERE dpstatus = '1'";
                        $dep_info = mysqli_query($db_connection, $select_dep);
                        if(mysqli_num_rows($dep_info) > 0)
                        {
                        ?>
                        <div class="users-category">
                            <ul>
                                <li class="users-li">
                                    <a href="usersdevice.php" class="
                                <?php
                                if(isset($_GET['userdevice']) == null){
                                    echo 'users-a';
                                }else{
                                    echo '';
                                }
                                ?>
                                ">All</a>
                                </li>
                            </ul>
                        </div>
                        <?php
                            while($dep_row = mysqli_fetch_assoc($dep_info)){

                        ?>
                        <div class="users-category">
                            <ul>
                                <li class="users-li">
                                    <a class="<?php 
                                    if(isset($_GET['userdevice'])){
                                    $ac_id = $_GET['userdevice'];
                                    if($ac_id == $dep_row['department_id']){
                                        echo 'users-a';
                                    }
                                   }?>"
                                        href="usersdevice.php?userdevice=<?php echo $dep_row['department_id']?>"><?php echo $dep_row['department_name']?></a>
                                </li>
                            </ul>
                        </div>
                        <?php
                        }
                        }else{
                          echo  '<div class="users-category">
                                    <ul>
                                        <li><a href="" class="users-a">No Record</a></li>
                                    </ul>
                                </div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-10 rightcont-user">
                <div class="card border-0 cardshadow">
                    <ul class="header-card">
                        <li>
                            <h4><?php 
                            if(isset($_GET['userdevice'])){
                                $ac_id = $_GET['userdevice'];
                                $select_user = "SELECT * FROM users JOIN department
                            ON users.department = department.department_id WHERE department = '$ac_id' AND ustatus= '1' GROUP BY department.department_id ";
                            $user_info = mysqli_query($db_connection,$select_user);
                            if(mysqli_num_rows($user_info) > 0)
                            {
                                while ($row = mysqli_fetch_assoc($user_info))
                                {
                                    ?>
                                <h4 style=" font-weight: 600;"><?php echo $row['department_name']; ?><h4>
                                        <?php
                                }
                            }
                            }else{
                                echo '<h4 style=" font-weight: 600;">All<h4>';
                            }
                            ?><h4>
                        </li>
                        <li><button type="button" style="background: #292A7C; color:white;" class="btn"
                                data-bs-toggle="modal" data-bs-target="#adduser">
                                <i class="fa-solid fa-plus"></i> Add User
                            </button></li>
                    </ul>
                    <hr>
                    <?php 
                      if(isset($_GET['userdevice'])){
                        $department_id = $_GET['userdevice'];
                 $select_device_users = "SELECT * 
                                        FROM users_device 
                                        JOIN users 
                                        ON users.id = users_device.users_id 
                                        JOIN devices 
                                        ON devices.device_id = users_device.udevice_id
                                        JOIN category
                                        ON devices.device_category = category.category_id
                                        JOIN department
                                        ON users.department = department.department_id
                                        WHERE department = '$department_id'
                                        AND udstatus = '1'
                                        ";
                  $user_info = mysqli_query($db_connection,$select_device_users);
                    if(mysqli_num_rows($user_info) > 0)
                    {
                    ?>
                    <div class="card-body table-responsive" style="height: 100%; overflow-y: auto;">
                        <table id="example" class="table table-sm ">
                            <thead class="table-success">
                                <tr>
                                    <th class="col-1">ID</th>
                                    <th class="col-2">User</th>
                                    <th class="col-3">Device</th>
                                    <th class="col-2">Category</th>
                                    <th class="col-1">Deployed</th>
                                    <th class="col-1">Returned</th>
                                    <th class="col-2">Department</th>
                                    <th class="col-1" colsrow="2" style="text-align: center;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php 
                                        while ($row = mysqli_fetch_assoc($user_info))
                                        {
                                            ?>
                                    <td><?php echo $row['users_device_id']; ?></td>
                                    <td><?php echo $row['user_firstname'].' '.$row['user_lastname']; ?></td>
                                    <td><?php echo $row['brand'].' '.$row['model']; ?></td>
                                    <td><?php echo $row['category_name']; ?></td>
                                    <td><?php 
                                                if($row['ud_deployed'] == '0000-00-00'){
                                                    echo '*';
                                                }else{
                                                echo date("F d, Y", strtotime($row['ud_deployed'])); }?></td>
                                    <td><?php 
                                                if($row['ud_returned'] == '0000-00-00'){
                                                    echo '*';
                                                }else{
                                                echo date("F d, Y", strtotime($row['ud_returned'])); }?></td>
                                    <td><?php echo $row['department_name']; ?></td>
                                    <td>
                                        <ul style="display: flex; justify-content: center; padding-left:0px; margin:0;">
                                            <li style="list-style: none; text-align: center;"><button type="button"
                                                    class="btn btn-light mx-1" data-bs-toggle="modal"
                                                    data-bs-target="#modaledit<?php echo $row['users_device_id']; ?>"><i
                                                        class="fa-solid fa-pen-to-square "></i></button></li>
                                            <li style="list-style: none; text-align: center;"><button type="button"
                                                    class="btn btn-light mx-1" data-bs-toggle="modal"
                                                    data-bs-target="#modaldelete<?php echo $row['users_device_id']; ?>"><i
                                                        class="fa-solid fa-trash"></i></button></li>
                                        </ul>
                                    </td>
                                </tr>
                                <!-- Update -->
                                <div class="modal fade" id="modaledit<?php echo $row['users_device_id']; ?>"
                                    tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="/../BaronVerse/update.php" method="POST">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Users device</h5>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label>User</label>
                                                        <select name="id_user" class="form-select" required>
                                                            <?php
                                                             ?>
                                                            <option hidden selected value='<?php echo $row['id']; ?>'>
                                                                <?php echo $row['user_firstname'].' '.$row['user_lastname']; ?>
                                                            </option>
                                                            <?php 
                                                            $select_udevice = "SELECT * FROM users WHERE verify_status = '1' ";
                                                            $user_info_d = mysqli_query($db_connection,$select_udevice);
                                                                if(mysqli_num_rows($user_info_d) > 0)
                                                                {
                                                        ?>
                                                            <?php 
                                                                while ($rows_userd = mysqli_fetch_assoc($user_info_d))
                                                                {
                                                                $id_userd = $rows_userd['id'];
                                                                $user_names = $rows_userd['user_firstname'].' '.$rows_userd['user_lastname'];
                                                                echo "<option  value='$id_userd'>$user_names</option>";
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <label for="date-input1" >Deployed</label>
                                                                <input type="date" id="date-input1" name="ud_deployed" value="<?php echo $row['ud_deployed']; ?>" placeholder="yyyy-mm-dd"
                                                                    style="width:100%; padding: 15px 10px 15px 10px; height:28px; border-radius:4px; border: 1px solid rgba(145, 145, 145, 0.511);">
                                                                <label for="date-input" >Returned</label>
                                                                <input type="date" id="date-input" name="ud_returned" value="<?php echo $row['ud_returned']; ?>" placeholder="yyyy-mm-dd"
                                                                    style="width:100%; padding: 15px 10px 15px 10px; height:28px; border-radius:4px; border: 1px solid rgba(145, 145, 145, 0.511);">
                                                    <div class="form-group">
                                                        <label>Device</label>
                                                        <select name="id_device" class="form-select" required>
                                                            <?php
                                                             ?>
                                                            <option hidden selected
                                                                value='<?php echo $row['device_id']; ?>'>
                                                                <?php echo $row['brand'].' '.$row['model']; ?></option>
                                                            <?php 
                                                            $select_udevice = "SELECT * FROM devices ";
                                                            $user_info_device = mysqli_query($db_connection,$select_udevice);
                                                                if(mysqli_num_rows($user_info_device) > 0)
                                                                {
                                                        ?>
                                                            <?php 
                                                                while ($row_device = mysqli_fetch_assoc($user_info_device))
                                                                {
                                                                $id_device = $row_device['device_id'];
                                                                $name_device = $row_device['brand'].' '.$row_device['model'];
                                                                echo "<option  value='$id_device'>$name_device</option>";
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <input type="hidden" name="users_device_id"
                                                        value="<?php echo $row['users_device_id']; ?>">
                                                    <button type="submit" name="update_users_device"
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
                                <div class="modal fade" id="modaldelete<?php echo $row['users_device_id']; ?>"
                                    tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="/../BaronVerse/delete.php" method="POST">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Are you sure you want to delete this?</h5>
                                                </div>
                                                <div class="d-flex px-4 pt-2 flex-column mb-3">
                                                    <div class="p-0">Name:
                                                        <?php echo $row['user_firstname'].' '.$row['user_lastname']; ?>
                                                    </div>
                                                    <div class="p-0">Device:
                                                        <?php echo $row['brand'].' '.$row['model']; ?></div>
                                                </div>
                                                <div class="modal-footer">
                                                    <input type="hidden" name="users_device_id"
                                                        value="<?php echo $row['users_device_id']; ?>">
                                                    <input type="hidden" name="udstatus" value="0">
                                                    <button type="submit" name="delete_udevice"
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
                                        }else{
                                        ?>
                                <!-- else display this  -->
                                <?php 
                                        
                                        $select_device_users = "SELECT * 
                                        FROM users_device 
                                        JOIN users 
                                        ON users.id = users_device.users_id 
                                        JOIN devices 
                                        ON devices.device_id = users_device.udevice_id
                                        JOIN category
                                        ON devices.device_category = category.category_id
                                        JOIN department
                                        ON users.department = department.department_id
                                        WHERE udstatus = '1'
                                        ";
                                        $user_info = mysqli_query($db_connection,$select_device_users);
                                            if(mysqli_num_rows($user_info) > 0)
                                            {
                                            ?>
                                <div class="card-body table-responsive" style="height: 100%; overflow-y: auto;">
                                    <table id="example" class="table table-sm ">
                                        <thead class="table-success">
                                            <tr>
                                                <th class="col-1">ID</th>
                                                <th class="col-2">User</th>
                                                <th class="col-3">Device</th>
                                                <th class="col-2">Category</th>
                                                <th class="col-1">Deployed</th>
                                                <th class="col-1">Returned</th>
                                                <th class="col-2">Department</th>
                                                <th class="col-1" colsrow="2" style="text-align: center;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <?php 
                                        while ($row = mysqli_fetch_assoc($user_info))
                                        {
                                            ?>
                                                <td><?php echo $row['users_device_id']; ?></td>
                                                <td><?php echo $row['user_firstname'].' '.$row['user_lastname']; ?></td>
                                                <td><?php echo $row['brand'].' '.$row['model']; ?></td>
                                                <td><?php echo $row['category_name']; ?></td>
                                                <td><?php 
                                                if($row['ud_deployed'] == '0000-00-00'){
                                                    echo '*';
                                                }else{
                                                echo date("F d, Y", strtotime($row['ud_deployed'])); }?></td>
                                                <td><?php 
                                                if($row['ud_returned'] == '0000-00-00'){
                                                    echo '*';
                                                }else{
                                                echo date("F d, Y", strtotime($row['ud_returned'])); }?></td>
                                                <td><?php echo $row['department_name']; ?></td>
                                                <td>
                                                    <ul
                                                        style="display: flex; justify-content: center; padding-left:0px; margin:0;">
                                                        <li style="list-style: none; text-align: center;"><button
                                                                type="button" class="btn btn-light mx-1"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#modaledit<?php echo $row['users_device_id']; ?>"><i
                                                                    class="fa-solid fa-pen-to-square "></i></button>
                                                        </li>
                                                        <li style="list-style: none; text-align: center;"><button
                                                                type="button" class="btn btn-light mx-1"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#modaldelete<?php echo $row['users_device_id']; ?>"><i
                                                                    class="fa-solid fa-trash"></i></button></li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            <!-- Update -->
                                            <div class="modal fade" id="modaledit<?php echo $row['users_device_id']; ?>"
                                                tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <form action="/../BaronVerse/update.php" method="POST">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Edit Users device</h5>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label>User</label>
                                                                    <select name="id_user" class="form-select" required>
                                                                        <?php
                                                             ?>
                                                                        <option hidden selected
                                                                            value='<?php echo $row['id']; ?>'>
                                                                            <?php echo $row['user_firstname'].' '.$row['user_lastname']; ?>
                                                                        </option>
                                                                        <?php 
                                                            $select_udevice = "SELECT * FROM users WHERE verify_status = '1' ";
                                                            $user_info_d = mysqli_query($db_connection,$select_udevice);
                                                                if(mysqli_num_rows($user_info_d) > 0)
                                                                {
                                                        ?>
                                                                        <?php 
                                                                while ($rows_userd = mysqli_fetch_assoc($user_info_d))
                                                                {
                                                                $id_userd = $rows_userd['id'];
                                                                $user_names = $rows_userd['user_firstname'].' '.$rows_userd['user_lastname'];
                                                                echo "<option  value='$id_userd'>$user_names</option>";
                                                                }
                                                            }
                                                            ?>
                                                                    </select>
                                                                </div>
                                                                <label for="date-input1" >Deployed</label>
                                                                <input type="date" id="date-input1" name="ud_deployed" value="<?php echo $row['ud_deployed']; ?>" placeholder="yyyy-mm-dd"
                                                                    style="width:100%; padding: 15px 10px 15px 10px; height:28px; border-radius:4px; border: 1px solid rgba(145, 145, 145, 0.511);">
                                                                <label for="date-input" >Returned</label>
                                                                <input type="date" id="date-input" name="ud_returned" value="<?php echo $row['ud_returned']; ?>" placeholder="yyyy-mm-dd"
                                                                    style="width:100%; padding: 15px 10px 15px 10px; height:28px; border-radius:4px; border: 1px solid rgba(145, 145, 145, 0.511);">
                                                                <div class="form-group">
                                                                    <label>Device</label>
                                                                    <select name="id_device" class="form-select"
                                                                        required>
                                                                        <?php
                                                             ?>
                                                                        <option hidden selected
                                                                            value='<?php echo $row['device_id']; ?>'>
                                                                            <?php echo $row['brand'].' '.$row['model']; ?>
                                                                        </option>
                                                                        
                                                                        <?php 
                                                            $select_udevice = "SELECT * FROM devices ";
                                                            $user_info_device = mysqli_query($db_connection,$select_udevice);
                                                                if(mysqli_num_rows($user_info_device) > 0)
                                                                {
                                                            ?>
                                                                        <?php 
                                                                while ($row_device = mysqli_fetch_assoc($user_info_device))
                                                                {
                                                                $id_device = $row_device['device_id'];
                                                                $name_device = $row_device['brand'].' '.$row_device['model'];
                                                                echo "<option  value='$id_device'>$name_device</option>";
                                                                }
                                                            }
                                                            ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <input type="hidden" name="users_device_id"
                                                                    value="<?php echo $row['users_device_id']; ?>">
                                                                <button type="submit" name="update_users_device"
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
                                            <div class="modal fade"
                                                id="modaldelete<?php echo $row['users_device_id']; ?>" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <form action="/../BaronVerse/delete.php" method="POST">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Are you sure you want to delete
                                                                    this?</h5>
                                                            </div>
                                                            <div class="d-flex px-4 pt-2 flex-column mb-3">
                                                                <div class="p-0">Name:
                                                                    <?php echo $row['user_firstname'].' '.$row['user_lastname']; ?>
                                                                </div>
                                                                <div class="p-0">Device:
                                                                    <?php echo $row['brand'].' '.$row['model']; ?></div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <input type="hidden" name="users_device_id"
                                                                    value="<?php echo $row['users_device_id']; ?>">
                                                                <input type="hidden" name="udstatus" value="0">
                                                                <button type="submit" name="delete_udevice"
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
                                        }
                                        ?>

                                        </tbody>
                                    </table>
                                </div>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <Br><Br>
</div>