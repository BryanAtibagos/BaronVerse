<?php 
include_once __DIR__ . '/header.php';  
date_default_timezone_set('Asia/Manila'); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- table css bootstrap -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" />
    <!--  -->
    <!-- table javascript link -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="/../BaronVerse/jvscript/pagination.js"></script>
    <link href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
    <!--  -->
</head>
<style>
    .collapsibles {
        background-color: #ebeeee;
        color: black;
        cursor: pointer;
        padding: 18px;
        margin: 3px;
        padding-left: 0px;
        width: 100%;
        border-radius: 4px;
        border: none;
        /* border: 1px solid gray; */
        text-align: left;
        outline: none;
        font-size: 15px;
    }

    .act,
    .collapsibles:hover {
        /* background-color: #292A7C; */
        color: black;
    }

    .down {
        display: none;
    }

    .act .down {
        display: inline;
    }

    .act .right {
        display: none;
    }

    .content {
        border-left: 5px solid #292A7C;
        transition: all 2s ease;
        padding: 18px;
        display: none;
        overflow: hidden;
        background-color: #f1f1f1;
    }

    .ithelp ul {
        align-items: center;
        padding-left: 0;
        min-width: 400px;
        display: flex;
    }

    .ithelp ul li {
        padding: 8px;
        text-decoration: none;
        list-style: none;

    }

    .ithelp ul li a {
        padding-left: 35px;
        font-size: 30px;
        text-decoration: none;
        color: black;
    }
</style>

<body class="body">
    <!-- modal popup Add -->
    <div class="modal fade" id="addithelp" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="/../BaronVerse/add.php" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Ticket</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                        <label>Device</label>
                        <select name="users_device_id_ithelp" class="form-select" required>
                                <option hidden value=''>Select Device</option>
                            <?php 
                                $select_user = "SELECT * 
                                FROM `devices` 
                                JOIN users_device
                                ON devices.device_id = users_device.udevice_id
                                JOIN users
                                ON users_device.users_id = users.id
                                WHERE users.google_id = '$id'
                                GROUP BY devices.device_id";
                                $user_info = mysqli_query($db_connection,$select_user);
                                    if(mysqli_num_rows($user_info) > 0)
                                    {
                            ?>
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
                                <textarea class="form-control" name="issue_ithelp" placeholder="Add something..."
                                    id="textAreaExample2" rows="8"></textarea>
                            </div>
                        </div>
                         <div class="form-group">
                            <input type="hidden" name="date" value="<?php echo date('Y-m-d H:i:s');?>"
                                class="form-control" required />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="ithelpadd" class="btn btn-primary">Add</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--  -->
    <br><br><br><br>
    <div class="dashboard-list" style="padding-left:14px;">
        <ul class="dashboard-ul">
        <li><a href="qanda.php"style="font-size:30px;">Q&A</a></li>
            <li><a href="faqs.php" style="font-size:30px;">FAQ's</a></li>
            <li><a href="ithelp.php"
                    style="color:#00a037; font-weight:500; font-size:30px; border-bottom:green solid 2px;">IT
                    Help</a></li>
        </ul>
    </div>
    <br><br>
    <div class="px-4 ">
        <div class="card-body">
            <div class="row">
                <div class="col-2 leftcont-user">
                    <div class="" style="">
                        <div class="title" style="padding: 20px 20px 0 20px;">
                            <h4>Tickets</h4>
                        </div>
                        <div class="card-body">
                            <?php include_once 'ithelpside.php' ?>
                        </div>
                    </div>
                </div>
                <div class="col-10 rightcont-user">
                    <div class="card border-0 cardshadow">
                        <ul class="header-card">
                            <li>
                                <h4>All Tickets<h4>
                            </li>
                            <li><button type="button" style="background: #292A7C; color:white;" class="btn" data-bs-toggle="modal"
                                    data-bs-target="#addithelp">
                                    <i class="fa-solid fa-plus"></i> Add Ticket
                                </button></li>
                        </ul>
                        <hr>
                        <?php 
                        $my_id = $user['id'];
                        $select_user = "SELECT DISTINCT *
                        FROM ticket
                        JOIN users_device 
                        ON ticket.t_users_device_id = users_device.users_device_id
                        JOIN devices 
                        ON users_device.udevice_id = devices.device_id
                        JOIN users
                        ON users_device.users_id = users.id
                        WHERE ticket.t_users_device_id = users_device.users_device_id AND users_device.users_id = '$my_id'
                        GROUP BY ticket.ticket_id;";
                        $user_info = mysqli_query($db_connection,$select_user);
                            if(mysqli_num_rows($user_info) > 0)
                            {
                        ?>
                        <div class="card-body table-responsive" style="height: 100%; overflow-y: auto;">
                            <table id="example" class="table table-sm table-borderedless">
                                <thead class="table-success">
                                    <tr>
                                        <th class="col-1">Ticket No</th>
                                        <th class="col-3">Device</th>
                                        <th class="col-2">User</th>
                                        <th class="col-2">Issue</th>
                                        <th class="col-2">Status</th>
                                        <th class="col-1">Date</th>
                                        <th class="col-1" colsrow="2" style="text-align: center;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php 
                                        while ($row = mysqli_fetch_assoc($user_info))
                                        {
                                            ?>
                                        <td><?php echo $row['ticket_id']; ?></td>
                                        <td><?php echo $row['brand'].' '.$row['model'] ?></td>
                                        <td><?php echo $row['user_firstname'].' '.$row['user_lastname'] ?></td>
                                        <td><?php echo $row['issue']; ?></td>
                                        <td><?php
                                    if($row['ticket_status'] == 'Working'){
                                        echo '<div 
                                        style="
                                        width: 50%;
                                        font-size: 14px;
                                        border-radius: 8px;
                                        text-align:center;
                                        color:white;
                                        background: #4BB543;
                                        ">Working</div>';
                                    }else{
                                        echo '<div 
                                        style="
                                        width: 50%;
                                        font-size: 14px;
                                        border-radius: 8px;
                                        text-align:center;
                                        color:white;
                                        background: #ffc107;
                                        ">Pending</div>';
                                    }
                                    ?></td>
                                        <td><?php echo date("F d, Y", strtotime($row['date']));?></td>
                                        <td>
                                            <ul
                                                style="display: flex; justify-content: center; padding-left:0px; margin:0;">
                                                <li style="list-style: none; text-align: center;"><button type="button"
                                                        class="btn btn-light mx-1" data-bs-toggle="modal"
                                                        data-bs-target="#modaledit<?php echo $row['ticket_id']; ?>"><i
                                                            class="fa-solid fa-pen-to-square "></i></button></li>
                                                <li style="list-style: none; text-align: center;"><button type="button"
                                                        class="btn btn-light mx-1" data-bs-toggle="modal"
                                                        data-bs-target="#modaldelete<?php echo $row['ticket_id']; ?>"><i
                                                            class="fa-solid fa-trash"></i></button></li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <!-- Update -->
                                    <div class="modal fade" id="modaledit<?php echo $row['ticket_id']; ?>" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="/../BaronVerse/update.php" method="POST">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Ticket</h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h6>Device</h6>
                                                        <div class="row pt-1">
                                                            <div class="col-4">
                                                                <div class="form-group">
                                                                    <label for="">Brand</label>
                                                                    <input type="text" name="brand"
                                                                        value="<?php echo $row['brand']; ?>"
                                                                        class="form-control" disabled />
                                                                </div>
                                                            </div>
                                                            <div class="col-8">
                                                                <div class="form-group">
                                                                    <label for="">Model</label>
                                                                    <input type="text" name="model"
                                                                        value="<?php echo $row['model']; ?>"
                                                                        class="form-control" disabled />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Processor</label>
                                                            <input type="text" name="processor"
                                                                value="<?php echo $row['processor']; ?>"
                                                                class="form-control" disabled />
                                                        </div>
                                                        <div class="row pt-1">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="">Ram</label>
                                                                    <input type="text" name="ram"
                                                                        value="<?php echo $row['ram']; ?>"
                                                                        class="form-control" disabled />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="form-group">
                                                                    <label for="">Storage</label>
                                                                    <input type="text" name="storage"
                                                                        value="<?php echo $row['storage']; ?>"
                                                                        class="form-control" disabled />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <h6>User</h6>
                                                        <div class="row pt-1">
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="">Firstname</label>
                                                                    <input type="text" name="brand"
                                                                        value="<?php echo $row['user_firstname']; ?>"
                                                                        class="form-control" disabled />
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="">Lastname</label>
                                                                    <input type="text" name="model"
                                                                        value="<?php echo $row['user_lastname']; ?>"
                                                                        class="form-control" disabled />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Department</label>
                                                            <input type="text" name="department"
                                                                value="<?php echo $row['department']; ?>"
                                                                class="form-control" disabled />
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Status</label>
                                                            <select class="form-select" name="ticket_status"
                                                                aria-label="Default select example" required>
                                                                <?php 
                                                                if($row['ticket_status'] == 'For repair'){
                                                                echo '
                                                                <option selected hidden value="For repair">For repair</option>
                                                                <option value="Working">Working</option>';
                                                                }else if($row['ticket_status'] == 'Working'){
                                                                echo '
                                                                <option selected hidden value="Working">Working</option>
                                                                <option value="For repair">For repair</option>>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <input type="hidden" name="ticket_id"
                                                            value="<?php echo $row['ticket_id']; ?>">
                                                        <button type="submit" name="update_ticket"
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
                                    <div class="modal fade" id="modaldelete<?php echo $row['ticket_id']; ?>"
                                        tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="/../BaronVerse/delete.php" method="POST">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Are you sure you want to delete this?
                                                        </h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h5>Device</h5>
                                                        <div class="d-flex flex-column">
                                                            <div class="p-0">Brand:
                                                                <?php echo $row['brand']; ?>
                                                            </div>
                                                            <div class="p-0">Model: <?php echo $row['model']; ?></div>
                                                        </div>
                                                        <hr>
                                                        <h5>User</h5>
                                                        <div class="d-flex flex-column">
                                                            <div class="p-0">Name:
                                                                <?php echo $row['user_firstname'].' '.$row['user_lastname']; ?>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <input type="hidden" name="ticket_id"
                                                                value="<?php echo $row['ticket_id']; ?>">
                                                            <button type="submit" name="delete_ticket"
                                                                class="btn btn-danger">Delete</button>
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                        </div>
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
                    </div>
                </div>
                <Br><Br>
            </div>
            <br><br>
</body>

</html>
<script>
    var coll = document.getElementsByClassName("collapsibles");
    var i;
    for (i = 0; i < coll.length; i++) {
        coll[i].addEventListener("click", function() {
            this.classList.toggle("act");
            var content = this.nextElementSibling;
            if (content.style.display === "block") {
                content.style.display = "none";
            } else {
                content.style.display = "block";
            }
        });
    }
</script>