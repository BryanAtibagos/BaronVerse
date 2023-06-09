 <!-- else display this  -->
 <?php
  include_once __DIR__ . '/condition.php';
                                                $select_user = "SELECT * FROM users JOIN department
                                                ON users.department = department.department_id WHERE ustatus= '1'  ";
                                                $user_info = mysqli_query($db_connection,$select_user);
                                                if(mysqli_num_rows($user_info) > 0)
                                                {
                                                ?>
 <div class="card-body table-responsive" style="height: 100%; overflow-y: auto;">
     <table id="example" class="table table-sm ">
         <thead class="table-success">
             <tr>
                 <th class="col-1">ID</th>
                 <th class="col-2">Firstname</th>
                 <th class="col-2">Lastname</th>
                 <th class="col-2">Email</th>
                 <th class="col-1">User type</th>
                 <th class="col-2">Department</th>
                 <th class="col-1">Company</th>
                 <th class="col-1" colsrow="2" style="text-align: center;">Action</th>
             </tr>
         </thead>
         <tbody>
             <tr>
                 <?php 
                                                        while ($row = mysqli_fetch_assoc($user_info))
                                                    {
                                                    ?>
                 <td><?php echo $row['id']; ?></td>
                 <td><?php echo $row['user_firstname']; ?></td>
                 <td><?php echo $row['user_lastname']; ?></td>
                 <td><?php echo $row['email']; ?></td>
                 <td>
                     <?php 
                                                        if($row['user_type'] == "1"){
                                                            echo 'Super Admin';
                                                        }elseif($row['user_type'] == "2"){
                                                            echo 'Admin';
                                                        }else{
                                                            echo 'User';
                                                        }
                                                        ?>
                 </td>
                 <td><?php echo $row['department_name'];?></td>
                 <td><?php echo $row['company'];?></td>
                 <td>
                     <ul style="display: flex; justify-content: center; padding-left:0px; margin:0;">
                         <li style="list-style: none; text-align: center;"><button type="button"
                                 class="btn btn-light mx-1" data-bs-toggle="modal"
                                 data-bs-target="#modaledit<?php echo $row['id']; ?>"><i
                                     class="fa-solid fa-pen-to-square "></i></button>
                         </li>
                         <li style="list-style: none; text-align: center;"><button type="button"
                                 class="btn btn-light mx-1" data-bs-toggle="modal"
                                 data-bs-target="#modaldelete<?php echo $row['id']; ?>"><i
                                     class="fa-solid fa-trash"></i></button></li>
                     </ul>
                 </td>
             </tr>
             <!-- Update -->
             <div class="modal fade" id="modaledit<?php echo $row['id']; ?>" tabindex="-1"
                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                 <div class="modal-dialog">
                     <div class="modal-content">
                         <form action="/../BaronVerse/update.php" method="POST">
                             <div class="modal-header">
                                 <h5 class="modal-title">Edit User</h5>
                             </div>
                             <div class="modal-body">
                                 <!-- if user is Super Admin print this -->
                                 <?php
                                                                    if(($user['user_type'])  <= ($row['user_type'])){
                                                                ?>
                                 <div class="form-group">
                                     <label for="">Firstname</label>
                                     <input type="text" name="firstname" value="<?php echo $row['user_firstname']; ?>"
                                         class="form-control">
                                 </div>
                                 <div class="form-group">
                                     <label for="">Lastname</label>
                                     <input type="text" name="lastname" value="<?php echo $row['user_lastname']; ?>"
                                         class="form-control">
                                 </div>
                                 <div class="form-group">
                                     <label for="">Email</label>
                                     <input type="email" name="email" value="<?php echo $row['email']; ?>"
                                         class="form-control" disabled />
                                 </div>
                                 <label for="">User type</label>
                                 <select class="form-select" name="user_type">
                                     <?php 
                                                                if($row['user_type'] == 1){
                                                                echo '
                                                                <option hidden selected value="1">Super Admin</option>
                                                                <option value="2">Admin</option>
                                                                <option value="3">User</option>';
                                                                }else if($row['user_type'] == 2){
                                                                echo '
                                                                <option hidden selected value="2">Admin</option>
                                                                <option value="1">Super Admin</option>
                                                                <option value="3">User</option>';
                                                                }else{
                                                                    echo '<option hidden selected value="3">User</option>
                                                                    <option value="1">Super Admin</option>
                                                                    <option value="2">Admin</option>';
                                                                }
                                                                ?>
                                 </select>
                                 <div class="form-text" id="basic-addon4">A Super Admin
                                     can delete
                                     all data</div>
                                 <div class="form-text" id="basic-addon4">An admin cannot
                                     remove a
                                     super admin.</div>
                                 <br>
                                 <div class="form-group">
                                     <label>Department</label>
                                     <select name="department" class="form-select" required>
                                         <?php
                                                                        ?>
                                         <option hidden selected value='<?php echo $row['department']; ?>'>
                                             <?php echo $row['department_name']; ?>
                                         </option>
                                         <?php 
                                                                        $select_dep = "SELECT * FROM department ";
                                                                        $user_info_dep = mysqli_query($db_connection,$select_dep);
                                                                            if(mysqli_num_rows($user_info_dep) > 0)
                                                                            {
                                                                    ?>
                                         <?php 
                                                                            while ($rows_dep = mysqli_fetch_assoc($user_info_dep))
                                                                            {
                                                                            $department_id = $rows_dep['department_id'];
                                                                            $department_name = $rows_dep['department_name'];
                                                                            echo "<option  value='$department_id'>$department_name</option>";
                                                                            }
                                                                        }
                                                                        ?>
                                     </select>
                                 </div>
                                 <label for="">Company</label>
                                 <select class="form-select" name="company">
                                     <?php 
                                                                if($row['company'] == 'Baron Group'){
                                                                echo '
                                                                <option hidden selected value="Baron Group">Baron Group</option>
                                                                <option value="Baron Method">Baron Method</option>
                                                                <option value="GHE">GHE</option>';
                                                                }else if($row['Baron Method'] == 'Baron Method'){
                                                                echo '
                                                                <option hidden selected value="Baron Method">Baron Method</option>
                                                                <option value="Baron Group">Baron Group</option>
                                                                <option value="GHE">GHE</option>';
                                                                }else{
                                                                    echo '<option hidden selected value="GHE">GHE</option>
                                                                    <option value="Baron Group">Baron Group</option>
                                                                    <option value="Baron Method">Baron Method</option>';
                                                                }
                                                                ?>
                                 </select>
                                 <!-- if user is Admin print this  -->
                                 <?php
                                                                    }elseif(($user['user_type'])  >= ($row['user_type'])){
                                                                ?>
                                 <div class="form-group">
                                     <label for="">Firstname</label>
                                     <input type="text" name="firstname" value="<?php echo $row['user_firstname']; ?>"
                                         class="form-control" disabled />
                                 </div>
                                 <div class="form-group">
                                     <label for="">Lastname</label>
                                     <input type="text" name="lastname" value="<?php echo $row['user_lastname']; ?>"
                                         class="form-control" disabled />
                                 </div>
                                 <div class="form-group">
                                     <label for="">Email</label>
                                     <input type="email" name="email" value="<?php echo $row['email']; ?>"
                                         class="form-control" disabled />
                                 </div>
                                 <label for="">User type</label>
                                 <select class="form-select" name="user_type" disabled>
                                     <?php 
                                                                if($row['user_type'] == 1){
                                                                echo '
                                                                <option hidden selected value="1">Super Admin</option>
                                                                <option value="2">Admin</option>';
                                                                }else if($row['user_type'] == 2){
                                                                echo '
                                                                <option hidden selected value="2">Admin</option>
                                                                <option value="1">Super Admin</option>';
                                                                }else{
                                                                    echo '<option hidden selected value="3">User</option>
                                                                    <option value="1">Super Admin</option>
                                                                    <option value="2">Admin</option>';
                                                                }
                                                                ?>
                                 </select>
                                 <div class="form-text" id="basic-addon4">A Super Admin
                                     can delete
                                     all data</div>
                                 <div class="form-text" id="basic-addon4">An admin cannot
                                     remove a
                                     super admin.</div>
                                 <br>
                                 <div class="form-group">
                                     <label>Department</label>
                                     <select name="department" class="form-select" disabled>
                                         <?php
                                                                        ?>
                                         <option hidden selected value='<?php echo $row['department']; ?>'>
                                             <?php echo $row['department_name']; ?>
                                         </option>
                                         <?php 
                                                                        $select_dep = "SELECT * FROM department ";
                                                                        $user_info_dep = mysqli_query($db_connection,$select_dep);
                                                                            if(mysqli_num_rows($user_info_dep) > 0)
                                                                            {
                                                                    ?>
                                         <?php 
                                                                            while ($rows_dep = mysqli_fetch_assoc($user_info_dep))
                                                                            {
                                                                            $department_id = $rows_dep['department_id'];
                                                                            $department_name = $rows_dep['department_name'];
                                                                            echo "<option  value='$department_id'>$department_name</option>";
                                                                            }
                                                                        }
                                                                        ?>
                                     </select>
                                 </div>

                                 <!-- disabled all -->
                                 <?php
                                                                    }else{
                                                                ?>
                                 <div class="form-group">
                                     <label for="">Firstname</label>
                                     <input type="text" name="firstname" value="<?php echo $row['user_firstname']; ?>"
                                         class="form-control" disabled />
                                 </div>
                                 <div class="form-group">
                                     <label for="">Lastname</label>
                                     <input type="text" name="lastname" value="<?php echo $row['user_lastname']; ?>"
                                         class="form-control" disabled />
                                 </div>
                                 <div class="form-group">
                                     <label for="">Email</label>
                                     <input type="email" name="email" value="<?php echo $row['email']; ?>"
                                         class="form-control" disabled />
                                 </div>
                                 <label for="">User type</label>
                                 <select class="form-select" name="user_type" disabled>
                                     <?php 
                                                                if($row['user_type'] == 1){
                                                                echo '
                                                                <option hidden selected value="1">Super Admin</option>
                                                                <option value="2">Admin</option>
                                                                <option value="3">User</option>';
                                                                }else if($row['user_type'] == 2){
                                                                echo '
                                                                <option hidden selected value="2">Admin</option>
                                                                <option value="1">Super Admin</option>
                                                                <option value="3">User</option>';
                                                                }else{
                                                                    echo '<option hidden selected value="3">User</option>
                                                                    <option value="1">Super Admin</option>
                                                                    <option value="2">Admin</option>';
                                                                }
                                                                ?>
                                 </select>
                                 <div class="form-text" id="basic-addon4">A Super Admin
                                     can delete
                                     all data</div>
                                 <div class="form-text" id="basic-addon4">An admin cannot
                                     remove a
                                     super admin.</div>
                                 <br>
                                 <div class="form-group">
                                     <label>Department</label>
                                     <select name="department" class="form-select" disabled>
                                         <?php
                                                                        ?>
                                         <option hidden selected value='<?php echo $row['department']; ?>'>
                                             <?php echo $row['department_name']; ?>
                                         </option>
                                         <?php 
                                                                        $select_dep = "SELECT * FROM department ";
                                                                        $user_info_dep = mysqli_query($db_connection,$select_dep);
                                                                            if(mysqli_num_rows($user_info_dep) > 0)
                                                                            {
                                                                    ?>
                                         <?php 
                                                                            while ($rows_dep = mysqli_fetch_assoc($user_info_dep))
                                                                            {
                                                                            $department_id = $rows_dep['department_id'];
                                                                            $department_name = $rows_dep['department_name'];
                                                                            echo "<option  value='$department_id'>$department_name</option>";
                                                                            }
                                                                        }
                                                                        ?>
                                     </select>
                                 </div>
                                 <?php
                                                }
                                                    ?>
                             </div>
                             <div class="modal-footer">
                                 <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                 <button type="submit" name="update" class="btn btn-primary">Update</button>
                                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                             </div>
                         </form>
                     </div>
                 </div>
             </div>
             <!--  -->

             <!-- Delete -->
             <div class="modal fade" id="modaldelete<?php echo $row['id']; ?>" tabindex="-1"
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
                                 <div class="p-0">Email: <?php echo $row['email']; ?>
                                 </div>
                             </div>
                             <div class="modal-footer">
                                 <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                 <input type="hidden" name="ustatus" value="0">
                                 <button type="submit" name="delete" class="btn btn-danger">Delete</button>
                                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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