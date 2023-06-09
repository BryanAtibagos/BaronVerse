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
                                        <a href="usersdevice.php" class="users-a">User's device</a>
                                    </li>
                                    <li class="users-li">
                                        <a href="pendingticket.php" class="">Pending Ticket</a>
                                    </li>
                                    <li class="users-li">
                                        <a href="announcement.php" class="">Announcement</a>
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
                            FROM users_device 
                            JOIN users 
                            ON users.id = users_device.users_id 
                            JOIN devices 
                            ON devices.device_id = users_device.udevice_id
                            JOIN category
                            ON devices.device_category = category.category_id
                            JOIN department
                            ON users.department = department.department_id
                            WHERE udstatus = '0'
                            ";
                            $user_info = mysqli_query($db_connection,$select_user);
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
                                    <td><?php echo $row['department_name']; ?></td>
                                    <td>
                                        <ul style="display: flex; justify-content: center; padding-left:0px; margin:0;">
                                                <li style="list-style: none; text-align: center;"><button type="button"
                                                        class="btn btn-success mx-1" data-bs-toggle="modal"
                                                        data-bs-target="#modaledit<?php echo $row['users_device_id']; ?>">Recover</button>
                                                </li>
                                                <li style="list-style: none; text-align: center;"><button type="button"
                                                        class="btn btn-danger mx-1" data-bs-toggle="modal"
                                                        data-bs-target="#modaldelete<?php echo $row['users_device_id']; ?>">Delete</button>
                                                </li>
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
                                                    <h5 class="modal-title">Edit User</h5>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label>User</label>
                                                        <select name="id_user" class="form-select" disabled>
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
                                                    <div class="form-group">
                                                        <label>User</label>
                                                        <select name="id_device" class="form-select" disabled>
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
                                                    <input type="hidden" name="udstatus" value="1">
                                                    <button type="submit" name="recover_users_device"
                                                        class="btn btn-primary">Recover</button>
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
                                                    <button type="submit" name="per_delete_usersdevice"
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