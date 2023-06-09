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
                                        <a href="devices.php" class="users-a">Devices</a>
                                    </li>
                                    <li class="users-li">
                                        <a href="usersdevice.php" class="">User's device</a>
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
                            $select_user = "SELECT DISTINCT *
                        FROM devices 
                        LEFT JOIN users_device 
                        ON devices.device_id = users_device.udevice_id
                        LEFT JOIN ticket 
                        ON ticket.t_users_device_id = users_device.users_device_id
                        LEFT JOIN category
                        ON category.category_id = devices.device_category
                        WHERE dstatus = '0'
                        GROUP BY devices.device_id;";
                            $user_info = mysqli_query($db_connection,$select_user);
                            if(mysqli_num_rows($user_info) > 0)
                            {
                    ?>
                        <div class="card-body table-responsive" style="height: 100%; overflow-y: auto;">
                            <table id="example" class="table table-sm ">
                                <thead class="table-success">
                                    <tr>
                                    <th class="col-1">ID</th>
                                    <th class="col-1">Brand</th>
                                    <th class="col-2">Model</th>
                                    <th class="col-2">Processor</th>
                                    <th class="col-1">Ram</th>
                                    <th class="col-1">Storage</th>
                                    <th class="col-1">Category</th>
                                    <th class="col-1">Status</th>
                                    <th class="col-1">is Deployed</th>
                                    <th class="col-1" colsrow="2" style="text-align: center;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php 
                                        while ($row = mysqli_fetch_assoc($user_info))
                                        {
                                            ?>
                                    <td><?php echo $row['device_id']; ?></td>
                                    <td><?php echo $row['brand']; ?></td>
                                    <td><?php echo $row['model']; ?></td>
                                    <td><?php echo $row['processor']; ?></td>
                                    <td><?php echo $row['ram'];?></td>
                                    <td><?php echo $row['storage']; ?></td>
                                    <td><?php echo $row['category_name']; ?></td>
                                    <td><?php
                                     if($row['t_users_device_id']){
                                        echo '<div 
                                        style="
                                        margin: auto;
                                        font-size: 14px;
                                        border-radius: 8px;
                                        text-align:center;
                                        color:white;
                                        background: #ffc107;
                                        ">For Repair</div>';
                                    }elseif($row['users_device_id']){
                                        echo '<div 
                                        style="
                                        margin: auto;
                                        font-size: 14px;
                                        border-radius: 8px;
                                        text-align:center;
                                        color:white;
                                        background: #4BB543;
                                        ">Working</div>';
                                    }else{
                                        echo '<div 
                                        style="
                                        margin: auto;
                                        font-size: 14px;
                                        border-radius: 8px;
                                        text-align:center;
                                        color:white;
                                        background: #4BB543;
                                        ">Working</div>';
                                    }
                                    ?></td>
                                    <td><?php
                                    if($row['device_id'] == $row['udevice_id']){
                                        echo '<div 
                                        style="
                                        width: 50%;
                                        margin: auto;
                                        font-size: 14px;
                                        border-radius: 8px;
                                        text-align:center;
                                        color:white;
                                        background: #4BB543;
                                        ">Yes</div>';
                                    }else{
                                        echo '<div 
                                        style="
                                        width: 50%;
                                        margin: auto;
                                        font-size: 14px;
                                        border-radius: 8px;
                                        text-align:center;
                                        color:white;
                                        background: #DC3545;
                                        ">No</div>';
                                    }
                                    ?></td>
                                    <td>
                                        <ul style="display: flex; justify-content: center; padding-left:0px; margin:0;">
                                        <li style="list-style: none; text-align: center;"><button type="button"
                                                        class="btn btn-success mx-1" data-bs-toggle="modal"
                                                        data-bs-target="#modaledit<?php echo $row['device_id']; ?>">Recover</button>
                                                </li>
                                                <li style="list-style: none; text-align: center;"><button type="button"
                                                        class="btn btn-danger mx-1" data-bs-toggle="modal"
                                                        data-bs-target="#modaldelete<?php echo $row['device_id']; ?>">Delete</button>
                                                </li>
                                        </ul>
                                    </td>
                                    </tr>
                                     <!-- Update -->
                                     <div class="modal fade" id="modaledit<?php echo $row['device_id']; ?>"
                                                tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <form action="/../BaronVerse/update.php" method="POST">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Recover Device</h5>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for="">Brand</label>
                                                                    <input type="text" name="brand"
                                                                        value="<?php echo $row['brand']; ?>"
                                                                        class="form-control" disabled/>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="">Model</label>
                                                                    <input type="text" name="model"
                                                                        value="<?php echo $row['model']; ?>"
                                                                        class="form-control" disabled/>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="">Processor</label>
                                                                    <input type="text" name="processor"
                                                                        value="<?php echo $row['processor']; ?>"
                                                                        class="form-control" disabled/>
                                                                </div>
                                                                <div class="row pt-1">
                                                                    <div class="col-md-4">
                                                                        <label for="">Ram</label>
                                                                        <select class="form-select" name="ram"
                                                                            aria-label="Default select example"
                                                                            disabled>
                                                                            <?php 
                                                           if($row['ram'] == 'None'){
                                                            echo '
                                                            <option value="None">None</option>
                                                            <option value="4GB">4GB</option>
                                                            <option value="8GB">8GB</option>
                                                            <option value="12GB">12GB</option>
                                                            <option value="16GB">16GB</option>
                                                            <option value="20GB">20GB</option>
                                                            <option value="32GB">32GB</option>';
                                                           }else if($row['ram'] == '4GB'){
                                                            echo '
                                                            <option value="4GB">4GB</option>
                                                            <option value="8GB">8GB</option>
                                                            <option value="12GB">12GB</option>
                                                            <option value="16GB">16GB</option>
                                                            <option value="20GB">20GB</option>
                                                            <option value="32GB">32GB</option>
                                                            <option value="None">None</option>';
                                                           }else if($row['ram'] == '8GB'){
                                                            echo '
                                                            <option value="8GB">8GB</option>
                                                            <option value="4GB">4GB</option>
                                                            <option value="12GB">12GB</option>
                                                            <option value="16GB">16GB</option>
                                                            <option value="20GB">20GB</option>
                                                            <option value="32GB">32GB</option>
                                                            <option value="None">None</option>';
                                                           }else if($row['ram'] == '12GB'){
                                                            echo '
                                                            <option value="12GB">12GB</option>
                                                            <option value="4GB">4GB</option>
                                                            <option value="8GB">8GB</option>
                                                            <option value="16GB">16GB</option>
                                                            <option value="20GB">20GB</option>
                                                            <option value="32GB">32GB</option>
                                                            <option value="None">None</option>';
                                                           }else if($row['ram'] == '16GB'){
                                                            echo '
                                                            <option value="16GB">16GB</option>
                                                            <option value="4GB">4GB</option>
                                                            <option value="8GB">8GB</option>
                                                            <option value="12GB">12GB</option>
                                                            <option value="20GB">20GB</option>
                                                            <option value="32GB">32GB</option>
                                                            <option value="None">None</option>';
                                                           }else if($row['ram'] == '20GB'){
                                                            echo '
                                                            <option value="20GB">20GB</option>
                                                            <option value="4GB">4GB</option>
                                                            <option value="8GB">8GB</option>
                                                            <option value="12GB">12GB</option>
                                                            <option value="16GB">16GB</option>
                                                            <option value="32GB">32GB</option>
                                                            <option value="None">None</option>';
                                                           }else if($row['ram'] == '32GB'){
                                                            echo '
                                                            <option value="32GB">32GB</option>
                                                            <option value="4GB">4GB</option>
                                                            <option value="8GB">8GB</option>
                                                            <option value="12GB">12GB</option>
                                                            <option value="16GB">16GB</option>
                                                            <option value="20GB">20GB</option>
                                                            <option value="None">None</option>';
                                                           }
                                                           ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <div class="form-group">
                                                                            <label for="">Storage</label>
                                                                            <input type="text" name="storage"
                                                                                value="<?php echo $row['storage']; ?>"
                                                                                class="form-control" disabled/>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Category</label>
                                                                    <select name="device_category" class="form-select"
                                                                    disabled>
                                                                        <?php
                                                                        ?>
                                                                        <option hidden selected
                                                                            value='<?php echo $row['category_id']; ?>'>
                                                                            <?php echo $row['category_name']; ?>
                                                                        </option>
                                                                        <?php 
                                                                        $select_category = "SELECT * FROM category ";
                                                                        $info_category = mysqli_query($db_connection,$select_category);
                                                                            if(mysqli_num_rows($info_category) > 0)
                                                                            {
                                                                    ?>
                                                                        <?php 
                                                                            while ($rows_cat = mysqli_fetch_assoc($info_category))
                                                                            {
                                                                            $category_id = $rows_cat['category_id'];
                                                                            $category_name = $rows_cat['category_name'];
                                                                            echo "<option  value='$category_id'>$category_name</option>";
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="">Other</label>
                                                                    <div class="form-outline">
                                                                        <textarea class="form-control"
                                                                            value="<?php echo $row['add_more_details'];?>"
                                                                            name="add_more_details"
                                                                            placeholder="Add something..."
                                                                            id="textAreaExample2"
                                                                            rows="8" disabled><?php echo $row['add_more_details'];?></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                            <input type="hidden" name="id"
                                                            value="<?php echo $row['device_id']; ?>">
                                                            <input type="hidden" name="dstatus" value="1">
                                                                <input type="hidden" name="device_id"
                                                                    value="<?php echo $row['device_id']; ?>">
                                                                <button type="submit" name="recover_device"
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
                                            <div class="modal fade" id="modaldelete<?php echo $row['device_id']; ?>"
                                                tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <form action="/../BaronVerse/delete.php" method="POST">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Are you sure you want to permanently delete this record?</h5>
                                                            </div>
                                                            <div class="d-flex px-4 pt-2 flex-column mb-3">
                                                                <div class="p-0">Brand:
                                                                    <?php echo $row['brand']; ?>
                                                                </div>
                                                                <div class="p-0">Model: <?php echo $row['model']; ?>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <input type="hidden" name="device_id"
                                                                    value="<?php echo $row['device_id']; ?>">
                                                                <button type="submit" name="per_delete_device"
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