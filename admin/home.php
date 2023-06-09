<?php 
include_once __DIR__ . '/../header.php';   
$get_user = mysqli_query($db_connection, "SELECT * FROM `users` WHERE `google_id`='$id' AND `ustatus`='1' ");
?>
<script>
    $(document).ready(function() {
        // Initialize the calendar
        $('#monthevent').fullCalendar({
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
                end: moment().endOf('month')
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
                                timeMax: moment().endOf('month').format(),
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
                                        title: "There are no events this month",
                                        color: 'red',
                                        start: moment(),
                                        end: moment()
                                    }], );
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
            eventClick: function(event) {
                window.open(event.url, '_blank');
                return false;
            }
        });
    }, );
</script>
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
            eventClick: function(event) {
                window.open(event.url, '_blank');
                return false;
            }
        });
    });
</script>
<?php 
        date_default_timezone_set('Asia/Manila');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js'></script>
    <link href='/../BaronVerse/calendar/lib/main.css' rel='stylesheet' />
    <script src='/../BaronVerse/calendar/lib/main.js'></script>
    <title>BaronVerse</title>
</head>
<body class="body">
    <!-- modal popup Add -->
    <div class="modal fade" id="addannounce" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="/../BaronVerse/add.php" method="POST" enctype="multipart/form-data" onsubmit="showLoading()">
                    <div class="modal-header" onsubmit="showLoading()">
                        <h5 class="modal-title" style="margin:auto;">Create Announcement</h5>
                    </div>
                    <br>
                    <div class="row profile-image">
                        <div class="col-2"><img onerror="this.onerror=null; this.src='/../BaronVerse/icons/users.svg'"
                                src="<?php echo $user['profile_image']; ?>" class="rounded-circle" height="40"></div>
                        <div class="col-10">
                            <ul class="cardheadertime">
                                <li style="font-weight: 600; font-size: 16px;">
                                    <?php echo $user['user_lastname'].' '.$user['user_firstname']; ?></li>
                                <li style="color:Gray; font-size:11px;">
                                    <select class="dropdownstyle" name="announce_depoption">
                                        <option value="<?php echo $user['department'] ?>">My Department</option>
                                        <option value="Baron Group">Baron Group</option>
                                        <option value="Baron Method">Baron Method</option>
                                        <option value="GHE">GHE</option>
                                        <option value="All">Public</option>
                                    </select>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" name="announce_user_id" value="<?php echo $user['id']; ?>"
                                class="form-control" required />
                        </div>
                        <div class="form-group">
                            <div class="form-outline">
                                <textarea class="form-control" name="announce_post" placeholder="Add something..."
                                    id="textAreaExample2" rows="8"></textarea>
                            </div>
                        </div>
                        <br>
                         <div>
                            <input type="file" name="image" class="inputdes" onchange="fileSelected()" />
                            <div id="progressBarContainer" style="display:none;">
                                <br>
                                <img src="../icons/loading.gif" height="20" alt="">
                                <span id="progressText">Uploading...</span>
                            </div>
                        </div>
                       
                        <div class="form-group">
                            <input type="hidden" name="announce_date" value=" <?php echo  date('Y-m-d H:i:s');?>"
                                class="form-control" required />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="announce_btn" class="btn btn-primary">Post</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--  -->
    <br>
    <div class="rowcontainer">
        <!-- left container -->
        <div class="leftcontainerhome">
            <ul class="profiledash">
                <li><a href=""><img src="<?php echo $user['profile_image']; ?>" class="rounded-circle"
                            height="40"><?php echo $user['user_firstname'].' '.$user['user_lastname']; ?></a></li>
                <li><a href="dashboard.php"><img src="/../BaronVerse/icons/dashboard.svg" class="filter-green "
                            height="40">Dashboard</a></li>
            </ul>
            <hr style="margin-left:25px;" width="85%">
            <ul class="googleworkspace">
                <li class="leftcontainerhometitle">Baron Sites</li>
                <li><a href="https://www.facebook.com/baronmethod" target="_blank"><img
                            src="/../BaronVerse/icons/facebook.svg" height="35">Facebook</a></li>
                <li><a href="https://www.tiktok.com/@baron.method" target="_blank"><img
                            src="/../BaronVerse/icons/tiktok.svg" height="35">Tiktok </a></li>
                <li><a href="https://www.baronmethod.com/" target="_blank"><img
                            src="/../BaronVerse/icons/TabLogo.png" height="35">Baron Method</a></li>
                <li><a href="https://www.instagram.com/baronmethod/" target="_blank"><img
                            src="/../BaronVerse/icons/instagram.svg" height="35">Instagram</a></li>
                <li><a href="https://twitter.com/baronmethod" target="_blank"><img
                            src="/../BaronVerse/icons/twitter.svg" height="35">Twitter</a></li>
            </ul>
            <hr style="margin-left:25px;" width="85%">
            <ul class="applicationtools">
                <li class="leftcontainerhometitle">Application Tools</li>
                <li><a href="https://www.viber.com/en/download/" target="_blank"><img
                            src="/../BaronVerse/icons/viber.svg" height="35">Viber</a></li>
                <li><a href="https://zoom.us/DOWNLOAD" target="_blank"><img src="/../BaronVerse/icons/zoom.svg"
                            height="35">Zoom</a></li>
                <li><a href="https://www.google.com/intl/en_ph/chrome/" target="_blank"><img
                            src="/../BaronVerse/icons/chrome.svg" height="35">Chrome</a></li>
                <li><a href="https://brave.com/" target="_blank"><img src="/../BaronVerse/icons/brave.svg"
                            height="35">Brave</a></li>
            </ul>
            <hr style="margin-left:25px;" width="85%">
            <ul class="googleworkspace">
                <li class="leftcontainerhometitle">Google Workspace</li>
                <li><a href="https://mail.google.com/mail/u/0/#inbox" target="_blank"><img
                            src="/../BaronVerse/icons/gmail.svg" height="35">Gmail</a></li>
                <li><a href="https://drive.google.com/drive/my-drive" target="_blank"><img
                            src="/../BaronVerse/icons/drive.svg" height="35">Drive</a></li>
                <li><a href="https://meet.google.com/?hs=197&authuser=0&pli=1" target="_blank"><img
                            src="/../BaronVerse/icons/meet.svg" height="35">Meet</a></li>
                <li><a href="https://docs.google.com/document/u/0/" target="_blank"><img
                            src="/../BaronVerse/icons/docs.svg" height="35">Docs</a></li>
                <li><a href="https://docs.google.com/spreadsheets/u/0/" target="_blank"><img
                            src="/../BaronVerse/icons/sheet.svg" height="35">Sheet</a></li>
                <li><a href="https://docs.google.com/presentation/u/0/?pli=1" target="_blank"><img
                            src="/../BaronVerse/icons/slides.svg" height="35">Slides</a></li>
            </ul>
            <br><br>
            <div style=" color:gray; left: 30px;bottom: 0; font-size:11px; padding-left:36px;  padding-bottom: 0px;">
                Baron Method © 2023 All Rights Reserved</div>
        </div>
        <!--  -->
        <!-- middle container -->
        <div class="middlecontainer">
            <br>
            <br>
            <!-- alert -->
            <div role="alert" id="message">
                <?php 
                 if(isset($_SESSION['status_success']))
                {
                    echo "<div class='alert alert-success' role='alert'><i class='fa-solid fa-circle-check px-2' style='font-size:20px;'></i>".$_SESSION['status_success']."</div>";
                    unset($_SESSION['status_success']);
                }elseif(isset($_SESSION['status_failed'])){
                    echo "<div class='alert alert-danger' role='alert'><i class='fa-solid fa-circle-xmark px-2' style='font-size:20px;'></i>".$_SESSION['status_failed']."</div>";
                    unset($_SESSION['status_failed']);
                }
            ?>
            </div>
            <!--  -->
            <div class="userhomecard mx-3">
                <div class="card-body">
                    <div class="row profile-image">
                        <div class="col-2" style="padding-left:18px;"><img
                                onerror="this.onerror=null; this.src='/../BaronVerse/icons/users.svg'"
                                src="<?php echo $user['profile_image']; ?>" class="rounded-circle" height="40"></div>
                        <div class="col-10">
                            <span data-bs-toggle="modal" data-bs-target="#addannounce"
                                class="announcement-button">Create
                                Announcement here...</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Welcome post-->
            <div class="userhomecard mx-3 my-4">
                <div class="card-body" style="">
                    <div class="row profile-image">
                        <div class="col-2"><img onerror="this.onerror=null; this.src='/../BaronVerse/icons/users.svg'"
                                src="/../BaronVerse/icons/TabLogo.png" class="rounded-circle" height="40"></div>
                        <div class="col-10">
                            <ul class="cardheadertime">
                                <li style="font-weight: 600; font-size: 16px;">BaronVerse</li>
                                <li style="color:Gray; font-size:11px;">Baron Method</li>
                            </ul>
                        </div>
                    </div>
                    <div class="welcomecover" style="padding:40px; margin:auto; text-align:center; ">
                        <h2 style="font-weight:800;">Hello,
                            <?php echo $user['user_firstname'].' '.$user['user_lastname']; ?></h2>
                        <h4>Welcome to the BaronVerse</h4>
                    </div>
                </div>
            </div>
            <!-- content area here -->
           <div id="load_data"></div>
           <div id="load_data_message"></div>
        </div>
        <!-- right container -->
        <div class="rightcontainerhome">
            <ul>
                <li class="rightcontainerhometitle">Today's Event</li>
                <li>
                    <div style="padding-right: 20px; width: 100%; ">
                        <div style="padding-top:0px;" id='calendar'></div>
                    </div>
                </li>
            </ul>
            <ul>
                <li class="rightcontainerhometitle">Upcoming Events</li>
                <li>
                    <div style="margin-right: 20px;">
                        <div id='monthevent'></div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</body>

</html>
<script>
    $(document).ready(function() {
        setTimeout(function() {
            $('#message').hide();
        }, 3000);
    })
</script>
<script>
    $(document).ready(function(){
        var limit = 5;
        var start =0;
        var action = 'inactive';

        function load_content_data(limit, start){
            $.ajax({
                url: "contenthome.php",
                method: "POST",
                data: {limit:limit, start:start},
                cache: false,
                success: function(data){
                    $('#load_data').append(data);
                    if(data == ''){
                        $('#load_data_message').html("<div class=' text-center'><button type='button' style='width:50%;' class='btn'> </button></div>");
                        action = 'active';
                    }else{
                        $('#load_data_message').html("<div class=' text-center'><button type='button' style='background: #5c5ecff8; color:white; width:50%;' class='btn'></button></div>");
                        action = 'inactive';
                    }
                }
            });
        }
        if(action == 'inactive'){
            action = 'active';
            load_content_data(limit, start);
        }
        $(window).scroll(function(){
            if($(window).scrollTop() + $(window).height() > $("#load_data").height() && action =='inactive')
            {
                action = 'active';
                start = start + limit;
                setTimeout(function(){
                    load_content_data(limit, start);
                },1000);
            }
        })
    });
</script>
<script>
    function showLoading() {
        document.getElementById("progressBarContainer").style.display = "block";
    }
    function fileSelected() {
        var progressBar = document.getElementById("progressBar");
        var progressText = document.getElementById("progressText");
        progressBar.value = 0;
        progressText.innerText = "Uploading...";
    }
</script>