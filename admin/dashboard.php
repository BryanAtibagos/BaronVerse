<?php 
include_once __DIR__ . '/../header.php';   
$get_user = mysqli_query($db_connection, "SELECT * FROM `users` WHERE `google_id`='$id' ");
// if(!isset($_SESSION['login_id'])){
//     header('Location: login.php');
//     exit;
// }
// if(mysqli_num_rows($get_user) > 0){
//     $user = mysqli_fetch_assoc($get_user);
// }
// else{
//     header('Location: logout.php');
//     exit;
// }
?>
<?php
$get_user = mysqli_query($db_connection, "SELECT * FROM `users` WHERE `google_id`='$id'");
$user = mysqli_fetch_assoc($get_user);
?>
<link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css' rel='stylesheet' />
<link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.print.min.css' rel='stylesheet'
    media='print' />
<script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js'></script>
<link href='/BaronVerse/calendar/lib/main.css' rel='stylesheet' />
<script src='/BaronVerse/calendar/lib/main.js'></script>
<?php 
        date_default_timezone_set('Asia/Manila');
        function get_time_ago($time){
            $time_difference=time()-$time;
            if($time_difference < 1) { return ' 1 second ago';}
            $condition=array(
                12*30*24*60*60 => 'year',
                30*24*60*60 => 'month',
                24*60*60 => 'day',
                60*60 => 'hr',
                60 => 'min',
                1 => 'sec'
            );
            foreach($condition as $sec => $str)
            {
                $d=$time_difference /$sec;
                if($d >= 1){
                    $t=round($d);
                    return $t.' '.$str.($t >1 ? 's' : ' ').' ago';
                }
            }
        }
    ?>
<script>
    $(document).ready(function() {
        // Initialize the calendar
        $('#calendar').fullCalendar({
            height: 'auto',
            header: {
                left: false,
                center: false,
                right: false
            },
            defaultView: 'listMonth',
            navLinks: false,
            editable: true,
            eventLimit: true,
            visibleRange: {
                start: moment().startOf('day'),
                end: moment().endOf('day')
            },
            // listDayFormat: false,
            // listDayAltFormat: false,
            eventSources: [{
                    // First calendar ID URL
                    events: function(start, end, timezone, callback) {
                        $.ajax({
                            startParam: 'start',
                            endParam: 'end',
                            url: 'https://www.googleapis.com/calendar/v3/calendars/organicsph.it@gmail.com/events',
                            dataType: 'json',
                            color: 'green',
                            data: {
                                key: 'AIzaSyC55Jn1vKfCgX6CpJlj3DjGPMoZNFzA2KY',
                                timeMin: moment().startOf('day').format(),
                                timeMax: moment().endOf('day').format(),
                                singleEvents: true,
                                orderBy: 'startTime'
                            },
                            success: function(response) {
                                var today = moment().format('YYYY-MM-DD');
                                var filteredEvents = [];
                                $.each(response.items, function(i, item) {
                                    var eventStart = moment(item.start
                                        .dateTime || item.start.date
                                    ).format('YYYY-MM-DD');
                                    if (eventStart >= today) {
                                        filteredEvents.push({
                                            title: item.summary,
                                            start: item.start
                                                .dateTime ||
                                                item.start.date,
                                            end: item.end
                                                .dateTime ||
                                                item.end.date,
                                            url: item.htmlLink
                                        });
                                    }
                                });
                                if (filteredEvents.length > 0) {
                                    callback(filteredEvents);
                                } else {
                                    callback([{
                                        title: "No events today",
                                        color: 'red',
                                        start: moment(),
                                        end: moment()
                                    }]);
                                }
                            }
                        });
                    },
                },
                {
                    // Second calendar ID URL
                    events: function(start, end, timezone, callback) {
                        $.ajax({
                            startParam: 'start',
                            endParam: 'end',
                            url: 'https://www.googleapis.com/calendar/v3/calendars/5517b6b1ba4291e831b19f77c2c371729f175b763f5fa5e38800b082b863f392@group.calendar.google.com/events',
                            dataType: 'json',
                            color: 'blue',
                            data: {
                                key: 'AIzaSyC55Jn1vKfCgX6CpJlj3DjGPMoZNFzA2KY',
                                timeMin: moment().startOf('day').format(),
                                timeMax: moment().endOf('day').format(),
                                singleEvents: true,
                                orderBy: 'startTime'
                            },
                            success: function(response) {
                                var today = moment().format('YYYY-MM-DD');
                                var filteredEvents = [];
                                $.each(response.items, function(i, item) {
                                    var eventStart = moment(item.start
                                        .dateTime || item.start.date
                                    ).format('YYYY-MM-DD');
                                    if (eventStart >= today) {
                                        filteredEvents.push({
                                            title: item.summary,
                                            start: item.start
                                                .dateTime ||
                                                item.start.date,
                                            end: item.end
                                                .dateTime ||
                                                item.end.date,
                                            url: item.htmlLink
                                        });
                                    }
                                });
                                callback(filteredEvents);
                            }
                        });
                    },
                }
            ],
        });
    });
</script>
<!-- modal popup Add -->
<div class="modal fade" id="addlink" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/../BaronVerse/add.php" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title">Add Link</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" value="<?php echo $user['id'] ?>" name="link_user_id" class="form-control"
                        required />
                    <div class="form-group">
                        <label for="">Link</label>
                        <input type="text" name="link_reference" class="form-control" required />
                        <div class="form-text" id="basic-addon4">Paste your link here</div>
                    </div>
                    <div class="form-group">
                        <label for="">Link name</label>
                        <input type="text" name="link_name" class="form-control" required />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="add_link" class="btn btn-primary">Add</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--  -->
<!-- modal popup department -->
<div class="modal fade" id="adddepart" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/../BaronVerse/add.php" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title">Add Department</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Department</label>
                        <input type="text" name="department_name" class="form-control" required />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="add_depart" class="btn btn-primary">Add</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--  -->
<br><br><br>
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
<body class="body">
    <div style="padding-bottom: 2.5rem;">
        <Br>
        <div class="px-4 contents">
            <div class="homepath">
                <ul class="homepathul">
                    <li><a href="/../BaronVerse/admin/dashboard.php">
                            <h2>Dashboard</h2>
                        </a></li>
                    <!-- <li><i class="fa-solid fa-angle-right"></i></li> -->
                    <!-- <li><a href="/../BaronVerse/admin/home.php"
                            style="color:#00a037; font-weight:500; font-size:20px;">Home</a></li> -->
                </ul>
            </div>
            <br>
            <div class="row pb-2" style=" margin:auto;">
                <div class="row" style=" margin:auto;">
                    <div class="col-lg-8">
                        <ul class="box-info">
                            <li>
                                <a href="/../BaronVerse/admin/users.php">
                                    <i class="bx fa-solid fa-user-group"></i>
                                    <span class="text">
                                        <h3 class="box-info-total"><?php echo $total_rows; ?></h3>
                                        <p class="box-info-name">Users</p>
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="/../BaronVerse/admin/devices/devices.php">
                                    <i class="bx fa-solid fa-laptop"></i>
                                    <span class="text">
                                        <h3 class="box-info-total"><?php echo $total_devices; ?></h3>
                                        <p class="box-info-name">Devices</p>
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="/../BaronVerse/admin/usersdevice/usersdevice.php">
                                    <i class="bx fa-solid fa-user-gear"></i>
                                    <span class="text">
                                        <h3 class="box-info-total"><?php echo $total_Udevices; ?></h3>
                                        <p class="box-info-name">User's Device</p>
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="/../BaronVerse/admin/ticket/ticketall.php">
                                    <i class="bx fa-solid fa-ticket"></i>
                                    <span class="text">
                                        <h3 class="box-info-total"><?php echo $total_ticket_dash; ?></h3>
                                        <p class="box-info-name">Pending Tickets</p>
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!--  -->
                    <div class="col-lg-4">
                        <?php 
                                        $sql_countdev = "SELECT DISTINCT COUNT(*) as devicescount FROM devices 
                                        LEFT JOIN users_device 
                                        ON devices.device_id = users_device.udevice_id
                                        LEFT JOIN ticket 
                                        ON ticket.t_users_device_id = users_device.users_device_id
                                        WHERE ticket.ticket_status = 'For Repair'
                                        GROUP BY ticket.ticket_id
                                        ";
                                        $result_ticket_countdev = mysqli_query($db_connection, $sql_countdev);
                                        $rows_countdev = mysqli_fetch_assoc($result_ticket_countdev);

                                        $sql_device = "SELECT DISTINCT COUNT(*) as device FROM devices 
                                        LEFT JOIN users_device 
                                        ON devices.device_id = users_device.udevice_id
                                        LEFT JOIN ticket 
                                        ON ticket.t_users_device_id = users_device.users_device_id
                                        WHERE ticket.ticket_status = 'Working'
                                        AND tstatus = '1'
                                        GROUP BY ticket.ticket_id
                                        ";
                                        $sql_ticket = "SELECT COUNT(*) as total_rows FROM ticket";
                                        $result_ticket = mysqli_query($db_connection, $sql_ticket);
                                        $rows = mysqli_fetch_assoc($result_ticket);
                                        $total_ticket_work = $rows['total_rows'];
                                        $result_device = mysqli_query($db_connection, $sql_device);
                                        $row_device = mysqli_fetch_assoc($result_device);
                                        // $total_device = $row_device['device'];
                                        $sql_allticket = "SELECT COUNT(*) as total_rows_allticket FROM ticket WHERE ticket_status = 'For repair' ";
                                        $result_allticket = mysqli_query($db_connection, $sql_allticket);
                                        $rows_ticket = mysqli_fetch_assoc($result_allticket);
                                        $total_allticket = $rows_ticket['total_rows_allticket'];
                                        // $div_allticket = $total_allticket /  $total_ticket_work;
                                        // $average_allticket = $div_allticket * 100;
                                        ?>
                        <?php 
                                        $sql_working = "SELECT COUNT(*) as total_rows_working FROM ticket WHERE ticket_status = 'Working'  AND tstatus = '1' ";
                                        $result_working = mysqli_query($db_connection, $sql_working);
                                        $rows_working = mysqli_fetch_assoc($result_working);
                                        $total_working = $rows_working['total_rows_working'];
                                        // $add_dev_ticket = $total_working / $total_ticket_work;
                                        // $average_ticket = $add_dev_ticket * 100;
                                    ?>
                        <div class="row ">
                            <div class="col">
                                <div class="box-design p-2 ">
                                    <div style="font-weight:600; font-size:18px; color: gray; padding-left:5px;">
                                        NEED TO FIX
                                    </div>
                                    <div class="row">
                                        <div class="col ">
                                            <div style="line-height: 0pt;">
                                                <h4 style="padding-left:5px; font-size:3rem;">
                                                    <?php 
                                                if(empty($rows_countdev['devicescount'])){
                                                    echo '0';
                                                }else{
                                                 echo $rows_countdev['devicescount'];  }?></h4>
                                                <div style="padding-left:5px; font-weight:600;">Devices</div>
                                            </div>
                                        </div>
                                        <div class="col pt-4">
                                            <div class="container">
                                                <div class="box" style="border-radius: 10px">
                                                    <div class="chart" data-percent="<?php 
                                                    if(($total_allticket) == 0){
                                                        echo '0';
                                                    }else{
                                                        $div_allticket = $total_allticket /  $total_ticket_work;
                                                        $average_allticket = $div_allticket * 100;
                                                        echo  $average_allticket ;
                                                    }
                                                    
                                                    ?>">
                                                        <?php 
                                                         if(($total_allticket) == 0){
                                                            echo '0';
                                                        }else{
                                                            $div_allticket = $total_allticket /  $total_ticket_work;
                                                            $average_allticket = $div_allticket * 100;
                                                            echo  round($average_allticket) ;
                                                        }
                                                         ?>%</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="box-design p-2">
                                    <div style="font-weight:600; font-size:18px; color: gray; padding-left:5px;">
                                        TICKET SOLVED
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div style="line-height: 0pt;">
                                                <h4 style="padding-left:5px; font-size:3rem;">
                                                    <?php echo round($total_working) ?></h4>
                                                <div style="padding-left:5px; font-weight:600;">Tickets</div>
                                            </div>
                                        </div>
                                        <div class="col pt-4">
                                            <div class="container">
                                                <div class="box" style="border-radius: 10px">
                                                    <div class="chart" data-percent="<?php 
                                                      if((($total_working) == 0) || (($total_ticket_work) == 0) ){
                                                        echo '0';
                                                    }else{
                                                   $add_dev_ticket = $total_working / $total_ticket_work;
                                        $average_ticket = $add_dev_ticket * 100;
                                        echo  round($average_ticket);
                                                    }
                                                    ?>">
                                                        <?php 
                                                         if((($total_working) == 0) || (($total_ticket_work) == 0)){
                                                            echo '0';
                                                        }else{
                                                       $add_dev_ticket = $total_working / $total_ticket_work;
                                            $average_ticket = $add_dev_ticket * 100;
                                            echo  round($average_ticket) ;
                                                        }
                                                        ?>%</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <br>
                    <h4 style="font-weight:600;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                            class="bi bi-ticket-perforated" viewBox="0 0 16 20">
                            <path
                                d="M4 4.85v.9h1v-.9H4Zm7 0v.9h1v-.9h-1Zm-7 1.8v.9h1v-.9H4Zm7 0v.9h1v-.9h-1Zm-7 1.8v.9h1v-.9H4Zm7 0v.9h1v-.9h-1Zm-7 1.8v.9h1v-.9H4Zm7 0v.9h1v-.9h-1Z" />
                            <path
                                d="M1.5 3A1.5 1.5 0 0 0 0 4.5V6a.5.5 0 0 0 .5.5 1.5 1.5 0 1 1 0 3 .5.5 0 0 0-.5.5v1.5A1.5 1.5 0 0 0 1.5 13h13a1.5 1.5 0 0 0 1.5-1.5V10a.5.5 0 0 0-.5-.5 1.5 1.5 0 0 1 0-3A.5.5 0 0 0 16 6V4.5A1.5 1.5 0 0 0 14.5 3h-13ZM1 4.5a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 .5.5v1.05a2.5 2.5 0 0 0 0 4.9v1.05a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-1.05a2.5 2.5 0 0 0 0-4.9V4.5Z" />
                        </svg>
                        All
                        Tickets</h4>
                    <hr style="color:gray;">
                    <div class="card border-0 container-box">
                        <div class="title pt-4 px-2">
                        </div>
                        <div class="card border-0" >
                            <div class="announce-ticket">
                                <?php 
                                $select_device_users = "SELECT * 
                                FROM ticket 
                                JOIN users_device ON ticket.t_users_device_id = users_device.users_device_id
                                JOIN users ON users.id = users_device.users_id
                                JOIN devices ON devices.device_id = users_device.udevice_id
                                WHERE ticket.ticket_status = 'For repair'
                                ORDER BY date DESC"
                                ;
                                $user_info = mysqli_query($db_connection,$select_device_users);
                                    if(mysqli_num_rows($user_info) > 0)
                                    {
                                        while ($row = mysqli_fetch_assoc($user_info))
                                        {
                                ?>
                                <div class="card my-2 " style="border-radius:10px; box-shadow: 5px 5px 5px -3px rgba(10, 99, 169, 0.16),-5px -5px 5px -3px rgba(255, 255, 255, 0.70);">
                                    <div class="card-body">
                                        <div class="announce-ticket-list">
                                            <ul>
                                                <li><i class="fa-solid fa-ellipsis-vertical"></i></li>
                                                <li>
                                                    <div style="
                                            height: 10px;
                                            width: 10px; 
                                            background-color: orange; 
                                            border-radius: 50%; "></div>
                                                </li>
                                                <li
                                                    style="background: #f5f5f5; border: 1px solid #cecece; border-radius: 4px; padding:5px;">
                                                    <div style="
                                                font-weight:700; 
                                                font-size:25px; 
                                                line-height: 16pt; 
                                                padding-top:4px;">
                                                        <?php echo date("d", strtotime($row['date'])); ?></div>
                                                    <div style="font-size:13px;">
                                                        <?php echo strtoupper(date("M", strtotime($row['date']))); ?>
                                                    </div>
                                                </li>
                                                <li style="padding-left: 15px;">
                                                    <img src="<?php echo $row['profile_image']; ?>"
                                                        class="rounded-circle" height="30"
                                                        referrerpolicy="no-referrer" />
                                                </li>
                                                <li style="width:400px; text-align:left;">
                                                    <div style="font-weight:700;">
                                                        <?php echo ucfirst($row['issue'])?>
                                                    </div>
                                                    <div class="allticketscont" style="color: gray; font-size: 0.7rem;">
                                                        <?php echo $row['email'] ?> |
                                                        <?php echo date("F d, Y g:i a", strtotime($row['date'])); ?>
                                                    </div>
                                                </li>
                                                <li class="timeago" style="width:30vw">
                                                    <div style="align-items: right; text-align: right; padding:10px;">
                                                        <i class="fa-regular fa-clock"></i>
                                                        <?php echo get_time_ago(strtotime($row['date'])); ?>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            }else{
                                echo "<div style='display:flex; text-align: center; background: rgba(179, 188, 188, 0.418); width: 100%; height: 100%;'>
                                <h3 style='margin: auto;'>No Tickets</h3>
                              </div>";
                            }
                            ?>
                            </div>
                        </div>
                    </div>
                    <br>
                </div>
                <div class="col-lg-4 ">
                    <div class="border-0">
                        <br>
                        <ul class="header-link">
                            <li>
                                <h4 style="font-weight:600;" class="px-3">
                                    Department
                                </h4>
                            </li>
                            <li><button type="button" class="btn" style="background: #292A7C; color:white;"
                                    data-bs-toggle="modal" data-bs-target="#adddepart">
                                    <i class="fa-solid fa-plus"></i>
                                </button></li>
                        </ul>
                        <hr style="color:gray;">
                        <div class="border-0">
                            <div class="card border-0 boxshadowcontainer py-4">
                            <div class="card border-0 link-shaside" style="height:261px">
                                <?php 
                                        $select_dep = "SELECT DISTINCT *
                                        FROM department";
                                        $dep_info = mysqli_query($db_connection,$select_dep);
                                            if(mysqli_num_rows($dep_info) > 0)
                                            {
                                            ?>
                                <table id="example" class="table table-sm ">
                                    <?php 
                                        while ($row_depart = mysqli_fetch_assoc($dep_info))
                                        {
                                            ?>
                                    <tbody>
                                        <tr style="border: 2px solid white;">
                                            <td class="col-11">
                                                <div class="link-dashboard"><a
                                                        target="_blank"><?php echo $row_depart['department_name']; ?></a>
                                                </div>
                                            </td>
                                            <td class="col-1">
                                                <div class="dropstart" style="text-align:end;">
                                                    <button class="btn" type="button" data-bs-toggle="dropdown"
                                                        aria-expanded="false">
                                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><button type="button" class="btn w-100 btn-light"
                                                                style="text-align:start;" data-bs-toggle="modal"
                                                                data-bs-target="#modaledit<?php echo $row_depart['department_id']; ?>">Edit</button>
                                                        </li>
                                                        <li><button type="button" class="btn w-100 btn-light"
                                                                style="text-align:start;" data-bs-toggle="modal"
                                                                data-bs-target="#modaldelete<?php echo $row_depart['department_id']; ?>">Delete</button>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- Update -->
                                        <div class="modal fade"
                                            id="modaledit<?php echo $row_depart['department_id']; ?>" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="/../BaronVerse/update.php" method="POST">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit</h5>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="">Department</label>
                                                                <input type="text" name="department_name"
                                                                    value="<?php echo $row_depart['department_name']; ?>"
                                                                    class="form-control" required />
                                                            </div>
                                                            <div class="modal-footer">
                                                                <input type="hidden" name="department_id"
                                                                    value="<?php echo $row_depart['department_id']; ?>">
                                                                <button type="submit" name="update_depart"
                                                                    class="btn btn-primary">Update</button>
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
                                        <div class="modal fade"
                                            id="modaldelete<?php echo $row_depart['department_id']; ?>" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="/../BaronVerse/delete.php" method="POST">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Are you sure you want to
                                                                delete this?</h5>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="d-flex flex-column">
                                                                <div class="p-0"><b>Department: </b>
                                                                    <?php echo $row_depart['department_name']; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <input type="hidden" name="department_id"
                                                                value="<?php echo $row_depart['department_id']; ?>">
                                                            <button type="submit" name="delete_depart"
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
                                            echo "<div style='margin:auto; padding-bottom:20px;'>No Record</div>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        </div>

                        <br>
                        <div class="card border-0 boxshadowcontainer">
                            <div class="card border-0">
                                <ul class="header-link p-3">
                                    <li>
                                        <h4>Links<h4>
                                    </li>
                                    <li><button type="button" class="btn" style="background: #292A7C; color:white;"
                                            data-bs-toggle="modal" data-bs-target="#addlink">
                                            <i class="fa-solid fa-plus"></i>
                                        </button></li>
                                </ul>
                            </div>
                            <!-- shaside error change another css -->
                            <div class="card border-0 link-shaside" style="height:261px">
                                <?php 
                                        $user_id_link = $user['id'];
                                        $select_user = "SELECT DISTINCT *
                                        FROM link
                                        WHERE link_user_id = '$user_id_link'";
                                        $link_info = mysqli_query($db_connection,$select_user);
                                            if(mysqli_num_rows($link_info) > 0)
                                            {
                                            ?>
                                <table id="example" class="table table-sm ">
                                    <?php 
                                        while ($row_link = mysqli_fetch_assoc($link_info))
                                        {
                                            ?>
                                    <tbody>
                                        <tr style="border: 2px solid white;">
                                            <td class="col-11">
                                                <div class="link-dashboard"><a
                                                        href="<?php echo $row_link['link_reference']; ?> "
                                                        target="_blank"><?php echo $row_link['link_name']; ?></a>
                                                </div>
                                            </td>
                                            <td class="col-1">
                                                <div class="dropstart" style="text-align:end;">
                                                    <button class="btn" type="button" data-bs-toggle="dropdown"
                                                        aria-expanded="false">
                                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><button type="button" class="btn w-100 btn-light"
                                                                style="text-align:start;" data-bs-toggle="modal"
                                                                data-bs-target="#modaledit<?php echo $row_link['link_id']; ?>">Edit</button>
                                                        </li>
                                                        <li><button type="button" class="btn w-100 btn-light"
                                                                style="text-align:start;" data-bs-toggle="modal"
                                                                data-bs-target="#modaldelete<?php echo $row_link['link_id']; ?>">Delete</button>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- Update -->
                                        <div class="modal fade" id="modaledit<?php echo $row_link['link_id']; ?>"
                                            tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="/../BaronVerse/update.php" method="POST">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit</h5>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="">Link</label>
                                                                <input type="text" name="link_reference"
                                                                    value="<?php echo $row_link['link_reference']; ?>"
                                                                    class="form-control" required />
                                                                <div class="form-text" id="basic-addon4">Paste
                                                                    your link here</div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Link name</label>
                                                                <input type="text" name="link_name"
                                                                    value="<?php echo $row_link['link_name']; ?>"
                                                                    class="form-control" required />
                                                            </div>
                                                            <div class="modal-footer">
                                                                <input type="hidden" name="link_id"
                                                                    value="<?php echo $row_link['link_id']; ?>">
                                                                <button type="submit" name="update_link"
                                                                    class="btn btn-primary">Update</button>
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
                                        <div class="modal fade" id="modaldelete<?php echo $row_link['link_id']; ?>"
                                            tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="/../BaronVerse/delete.php" method="POST">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Are you sure you want to
                                                                delete this?</h5>
                                                        </div>
                                                        <div class="modal-body">
                                                            <h5>Device</h5>
                                                            <div class="d-flex flex-column">
                                                                <div class="p-0"><b>Link:</b>
                                                                    <?php echo $row_link['link_reference']; ?>
                                                                </div>
                                                                <div class="p-0"><b>Link name:</b>
                                                                    <?php echo $row_link['link_name']; ?></div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <input type="hidden" name="link_id"
                                                                    value="<?php echo $row_link['link_id']; ?>">
                                                                <button type="submit" name="delete_link"
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
                </div>
            </div>

        </div>
    </div>
    <script type="text/javascript">
        window.addEventListener('scroll', reveal);

        function reveal() {
            var reveals = document.querySelectorAll(`.reveal`);
            for (var i = 0; i < reveals.length; i++) {
                var windowheight = window.innerHeight;
                var revealtop = reveals[i].getBoundingClientRect().top;
                var revealpoint = 150;
                if (revealtop < windowheight - revealpoint) {
                    reveals[i].classList.add('active');
                } else {
                    reveals[i].classList.remove('active');
                }
            }
        }
    </script>
    <script src="jquery.easypiechart.js"></script>
    <script>
        $(function() {
            $('.chart').easyPieChart({});
        });
    </script>
</body>
<script>
    $(document).ready(function() {
        setTimeout(function() {
            $('#message').hide();
        }, 3000);
    })
</script>