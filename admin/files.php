<?php
include_once __DIR__ . '/../header.php';    
?>
<!-- table css bootstrap -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" />
<!--  -->
<!-- table javascript link -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script src="/../BaronVerse/jvscript/pagination.js">
</script>
<!--  -->
<!--  -->
<?php
function formatSizeUnits($bytes){
    if ($bytes >= 1073741824){
        $bytes = number_format($bytes / 1073741824, 2) . ' GB';
    } elseif ($bytes >= 1048576){
        $bytes = number_format($bytes / 1048576, 2) . ' MB';
    } elseif ($bytes >= 1024){
        $bytes = number_format($bytes / 1024, 2) . ' KB';
    } elseif ($bytes > 1){
        $bytes = $bytes . ' bytes';
    } elseif ($bytes == 1){
        $bytes = $bytes . ' byte';
    } else {
        $bytes = '0 bytes';
    }
    return $bytes;
}
?>
<!DOCTYPE html>
<html lang="en">

<body class="body">
    <!-- modal popup Add -->
    <div class="modal fade" id="addfile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="/../BaronVerse/add.php" method="POST" enctype="multipart/form-data"
                    onsubmit="showLoading()">
                    <div class="modal-header">
                        <!-- <h5 class="modal-title">Upload file</h5> -->
                    </div>
                    <div class="modal-body">
                        <div class="form-group formscl">
                            <input type="file" class="inputstyle" name="file[]" multiple required
                                onchange="fileSelected()" />
                            <div id="progressBarContainer" style="display:none;">
                                <br>
                                <img src="../icons/loading.gif" height="20" alt="">
                                <span id="progressText">Uploading...</span>
                            </div>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="submit_file" class="btn btn-primary">Upload</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--  -->
    <Br><br><br><br><br>
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
    <div class="dashboard-list" style="padding-left:14px;">
        <ul class="dashboard-ul">
            <li><a href="#" style="font-weight:500; font-size:30px; ">Files</a></li>
        </ul>
    </div>
    <div style="padding: 0px 20px 0px 20px;">
        <div class="card border-0 cardshadow" style=" border-radius: 10px;">
            <ul class="header-card">
                <li>
                    <h4>
                        <h4>
                </li>
                <li><button type="button" style="background: #292A7C; color:white;" class="btn" data-bs-toggle="modal"
                        data-bs-target="#addfile">
                        Upload File
                    </button></li>
            </ul>
            <hr>
            <?php
                $my_id = $user['id'];
                $select_user = "SELECT * FROM `file` WHERE file_user = '$my_id' AND file_status = '1' ";
                $user_info = mysqli_query($db_connection,$select_user);
                if(mysqli_num_rows($user_info) > 0)
                {
                ?>
            <div class="card-body table-responsive" style="height: 100%; overflow-y: auto;">
                <table id="example" class="table table-sm ">
                    <thead style="border-bottom: 2px solid rgba(128, 128, 128, 0.16);">
                        <tr>
                            <th class="col-4">Name</th>
                            <th class="col-3">Date</th>
                            <th class="col-2">Owner</th>
                            <th class="col-2">Size</th>
                            <th class="col-1" colsrow="2" style="text-align: center;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php 
                            while ($row = mysqli_fetch_assoc($user_info))
                        {
                        ?>
                            <td>
                                <?php 
                            $select_file_user = $row['file_id'];
                            $select_file_format = "SELECT substring_index(file_name,'.',-1) as format from `file` WHERE file_id = '$select_file_user';";
                            $result_file_format = mysqli_query($db_connection, $select_file_format);
                            $format_file = mysqli_fetch_assoc($result_file_format);
                            $format_run = $format_file['format'];
                            if($format_run == 'docx'){
                                ?>
                                <img src='/../BaronVerse/icons/wordfile.svg' height="40" alt='wordfile'>
                                <?php
                            }elseif($format_run == 'pdf'){
                                ?>
                                <img src='/../BaronVerse/icons/pdffile.svg' height="40" alt='pdffile'>
                                <?php
                            }elseif($format_run == 'xls'){
                                ?>
                                <img src='/../BaronVerse/icons/excelfile.svg' height="40" alt='excelfile'>
                                <?php
                            }elseif($format_run == 'ppt'){
                                ?>
                                <img src='/../BaronVerse/icons/pptfile.svg' height="40" alt='pptfile'>
                                <?php
                            }else{
                                ?>
                                <img src='/../BaronVerse/icons/other.svg' height="40" alt='otherfile'>
                                <?php
                            }
                            ?><?php echo $row['file_name'] ?></td>
                            <td><?php echo date("F d, Y g:i a", strtotime($row['file_date']));?></td>
                            <td><?php 
                            if($row['file_user'] == $user['id']){
                                echo 'You';
                            }else{
                                echo 'Other';
                            }?></td>
                            <td><?php 
                            $filesize = $row['file_size'];
                            $formattedsize = formatSizeUnits($filesize);
                            echo $formattedsize;
                             ?></td>
                            <td>
                                <ul style="display: flex; justify-content: center; padding-left:0px; margin:0;">
                                    <li style="list-style: none; text-align: center;"><a class="btn btn-light mx-1"
                                            download="<?php echo $row['file_name']?>"
                                            href="../fileupload/<?php echo $row['file_uniq_name']; ?>"><i
                                                class="fa-solid fa-download"></i></a>
                                    </li>
                                    <li style="list-style: none; text-align: center;"><button type="button"
                                            class="btn btn-light mx-1" data-bs-toggle="modal"
                                            data-bs-target="#modaldelete<?php echo $row['file_id']; ?>"><i
                                                class="fa-solid fa-trash"></i></button></li>
                                </ul>
                            </td>
                        </tr>
                        <div class="modal fade" id="modaldelete<?php echo $row['file_id']; ?>" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="/../BaronVerse/delete.php" method="POST">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Are you sure you want to delete
                                                this?</h5>
                                        </div>
                                        <div class="modal-footer">
                                            <input type="hidden" name="file_id" value="<?php echo $row['file_id']; ?>">
                                            <input type="hidden" name="file_uniq_name"
                                                value="<?php echo $row['file_uniq_name']; ?>">
                                            <button type="submit" name="delete_file"
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