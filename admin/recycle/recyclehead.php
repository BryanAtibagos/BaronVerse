<?php
include_once __DIR__ . '/../../header.php';    
include_once '../packageIT/tablepackage.php';
include '../../jvscript/datatables.php';
?>

<!DOCTYPE html>
<html lang="en">

<body class="body">
    <!-- modal popup Add -->
    <div class="modal fade" id="addevice" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="/../BaronVerse/add.php" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Account</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Brand</label>
                            <input type="text" name="brand" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <label for="">Model</label>
                            <input type="text" name="model" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <label for="">Processor</label>
                            <input type="text" name="processor" class="form-control" required />
                        </div>
                        <div class="row pt-1">
                            <div class="col-md-4">
                                <label for="">Ram</label>
                                <select class="form-select" name="ram" aria-label="Default select example" required>
                                    <option value="None" selected>Select Ram</option>
                                    <option value="4GB">4GB</option>
                                    <option value="8GB">8GB</option>
                                    <option value="12GB">12GB</option>
                                    <option value="16GB">16GB</option>
                                    <option value="20GB">20GB</option>
                                    <option value="32GB">32GB</option>
                                </select>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="">Storage</label>
                                    <input type="text" name="storage" class="form-control" required />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <?php 
                                $select_category = "SELECT * 
                                FROM `category` WHERE cstatus = '1'";
                                $category_info = mysqli_query($db_connection,$select_category);
                                    if(mysqli_num_rows($category_info) > 0)
                                    {
                            ?>
                            <label>Category</label>
                            <select name="device_category" class="form-select" required>
                                <option hidden value=''>Select Category</option>
                                <?php 
                                    while ($rows = mysqli_fetch_assoc($category_info))
                                    {
                                    $category_id = $rows['category_id'];
                                    $category_name = $rows['category_name'];
                                    echo "<option  value='$category_id'>$category_name</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Other</label>
                            <div class="form-outline">
                                <textarea class="form-control" name="add_more_details" placeholder="Add something..."
                                    id="textAreaExample2" rows="8"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="add_device" class="btn btn-primary">Add</button>
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
                <li><a href="/../BaronVerse/admin/devices/devices.php"
                        style="color:#00a037; font-weight:500; font-size:20px;">Devices</a></li>
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
                <li><a href="/../BaronVerse/admin/usersdevice/usersdevice.php">User's Device</a></li>
                <li><a href="/../BaronVerse/admin/ticket/ticketall.php">Pending Tickets</a></li>
                <li><a href="/../BaronVerse/admin/recycle/recycle.php" 
                        style="color:#00a037; font-weight:500; border-bottom:green solid 2px;">Recycle</a></li>
            </ul>
        </div>
    </div>
</body>
<script>
    $(document).ready(function() {
        setTimeout(function() {
            $('#message').hide();
        }, 3000);
    })
</script>
<script>
    $(document).ready(function() {
        $('.editbtn').on('click', function() {
            $('#editmodal').modal('show');
            $tr = $(this).closest('tr');
            var data = $tr.children('td').map(function() {
                return $(this).text();
            }).get();
            console.log(data);
            $('#update_id').val(data[0]);
            $('#firstname').val(data[1]);
            $('#lastname').val(data[2]);
            $('#email').val(data[3]);
            $('#position').val(data[4]);
        });
    });
</script>

</html>