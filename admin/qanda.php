<?php 
include_once __DIR__ . '/../header.php';   
include 'packageIT/tablepackage.php';
// 
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <!--  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.3/css/bootstrap.min.css"
    integrity="sha512-SbiR/eusphKoMVVXysTKG/7VseWii+Y3FdHrt0EpKgpToZeemhqHeZeLWLhJutz/2ut2Vw1uQEj2MbRF+TVBUA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css">
  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput-typeahead.css" />

  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.3/js/bootstrap.min.js"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.6.0/bootstrap-tagsinput.min.js"
    integrity="sha512-SXJkO2QQrKk2amHckjns/RYjUIBCI34edl9yh0dzgw3scKu0q4Bo/dUr+sGHMUha0j9Q1Y7fJXJMaBi4xtyfDw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
</head>
<!-- modal popup Add -->
<div class="modal fade" id="addpq" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="/../BaronVerse/add.php" method="POST">
        <div class="modal-header">
          <h5 class="modal-title">Add Product Question</h5>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="">Question</label>
            <textarea name="pq_question" class="form-control" rows="3" required></textarea>
          </div>
          <div class="form-group">
            <label for="">Answer</label>
            <textarea name="pq_answer" class="form-control" rows="3" required></textarea>
          </div>
          <div class="form-group">
            <?php 
                $select_dep = "SELECT * 
                FROM `tags_qanda` ORDER BY tag_name ASC";
                $tags_qanda = mysqli_query($db_connection,$select_dep);
                    if(mysqli_num_rows($tags_qanda) > 0)
                    {
            ?>
            <label>Category</label>
            <select name="pq_tags" class="form-select" required>
              <option hidden value=''>Select Category</option>
              <?php 
                  while ($rows = mysqli_fetch_assoc($tags_qanda))
                  {
                  $tags_id = $rows['tags_id'];
                  $tags_name = $rows['tag_name'];
                  echo "<option  value='$tags_id'>$tags_name</option>";
                  }
              }
              ?>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" name="add_pq_btn" class="btn btn-primary">Add</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!--  -->

<body class="body">
  <br><br><br><br><br>
  <div class="nav-ticketing">
    <div class="dashboard-list" style="padding-left:14px;">
      <ul class="dashboard-ul">
        <li><a href="IThelpAdmin.php" style="font-size:30px;">FAQ's</a></li>
        <li><a href="qanda.php"
            style="font-size:30px; color:#00a037; font-weight:500;  border-bottom:green solid 2px;">Q&A</a></li>
      </ul>
    </div>
  </div>
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
  <!-- Q and A -->
  <div class="px-4" style="margin: 0 10px 0 10px ; padding: 0 20px 0 20px;">
    <?php
  // Check if the search form is submitted
  if (isset($_GET['search'])) {
    // Get the search query and split it into tags
    $search_query = str_replace(",", ", ", $_GET['search_query']);
    $tags = explode(", ", $search_query);
    
    // Check if the search query is not empty
    if (!empty($search_query)) {
      ?>
    <span style="color:black; font-weight:500; font-size:15px; padding: 10px; border-radius: 8px;">Filter by:</span>
    <?php
      // Loop through each tag and wrap it in a span element with a border
      foreach ($tags as $tag) {
        echo '<span style="padding: 5px; border: 1px solid green; color:green; border-radius: 4px; margin-left: 5px;">' . $tag . '</span>';
      }
    } else {
      // If the search query is empty, display "none"
      echo ' ';
    }
  } 
?>
  </div>
  <div class="table-responsive px-4" style="margin:10px; padding:20px; border-radius:9px;">
    <form method="GET">
      <div class="filter-search">
        <input type="text" id="tags" class="form-control" placeholder="Filter by category" name="search_query"
          data-role="tagsinput" />
        <div style=" padding-left:10px;">
          <button class="btn" style="background: #292A7C; color:white;" type="submit" name="search"
            id="button-addon2">Filter</button>
        </div>
      </div>
    </form>
    <br>
    <div class="card border-0 cardshadow qanda">
      <ul class="header-card">
        <li>
          <h4 style="font-weight:600;">Product Questions<h4>
        </li>
        <li><button type="button" style="background: #292A7C; color:white;" class="btn" data-bs-toggle="modal"
            data-bs-target="#addpq">
            <i class="fa-solid fa-plus"></i> Add Q&A
          </button></li>
      </ul>
      <hr style="border: 1px solid gray;">
      <div class="card-body">
        <table id="example" class="table table-sm ">
          <thead class="table-dark">
            <tr>
              <th class="col-11">Questions</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <?php 
                  // Check if the search form is submitted
    if (isset($_GET['search'])) {
      // Get the search query
      $search_query = str_replace(",", "|",$_GET['search_query']);
      // Modify the SQL query to include a WHERE clause for searching tags
      $product_question = "SELECT * 
                      FROM product_question 
                      JOIN tags_qanda 
                      ON product_question.pq_tags = tags_qanda.tags_id 
                      WHERE pq_status = '1' AND pq_question REGEXP '".$search_query."' OR tag_name REGEXP '".$search_query."'";
  } else {
      // SQL query without search query
      $product_question = "SELECT * 
                      FROM product_question 
                      JOIN tags_qanda 
                      ON product_question.pq_tags = tags_qanda.tags_id 
                      WHERE pq_status = '1'";
                  }
          $product_question_run = mysqli_query($db_connection, $product_question);
          if(mysqli_num_rows($product_question_run) > 0){
            foreach($product_question_run as $proditems) :
              ?>
              <td style="border: none;">
                <div style="">
                  <button type="button" class="collapsibles">
                    <ul style="display:flex; list-style:none; margin:auto;justify-content: space-between;">
                      <li><?php echo $proditems['pq_question']; ?></li>
                      <li>
                        <i class="right fa-solid fa-plus"></i>
                        <i class="down fa-solid fa-minus"></i>
                      </li>
                    </ul>
                  </button>
                  <div class="content">
                    <ul>
                      <li>
                        <?php echo $proditems['pq_answer']; ?>
                      </li>
                    </ul>
                  </div>
                </div>
              </td>
              <td style="  text-align: center; vertical-align: middle;">
                <ul style="display: flex; justify-content: center; padding-left:0px; margin:0;">
                  <li style="list-style: none; text-align: center;"><button type="button" class="btn btn-light mx-1"
                      data-bs-toggle="modal"
                      data-bs-target="#modaledit<?php echo $proditems['product_question_id']; ?>"><i
                        class="fa-solid fa-pen-to-square "></i></button></li>
                  <li style="list-style: none; text-align: center;"><button type="button" class="btn btn-light mx-1"
                      data-bs-toggle="modal"
                      data-bs-target="#modaldelete<?php echo $proditems['product_question_id']; ?>"><i
                        class="fa-solid fa-trash"></i></button></li>
                </ul>
              </td>
            </tr>
            <!-- Update -->
            <div class="modal fade" id="modaledit<?php echo $proditems['product_question_id']; ?>" tabindex="-1"
              aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <form action="/../BaronVerse/update.php" method="POST">
                    <div class="modal-header">
                      <h5 class="modal-title">Edit Product Question</h5>
                    </div>
                    <div class="modal-body">
                      <div class="form-group">
                        <label>Question</label>
                        <div class="form-group">
                          <div class="form-outline">
                            <textarea class="form-control" name="pq_question"
                              value="<?php echo $proditems['pq_question']; ?>" placeholder="Add something..."
                              id="textAreaExample2" rows="3"><?php echo $proditems['pq_question']; ?></textarea>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label>Answer</label>
                        <div class="form-group">
                          <div class="form-outline">
                            <textarea class="form-control" name="pq_answer"
                              value="<?php echo $proditems['pq_answer']; ?>" placeholder="Add something..."
                              id="textAreaExample2" rows="3"><?php echo $proditems['pq_answer']; ?></textarea>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label>Category</label>
                        <select name="pq_tags" class="form-select">
                          <option hidden selected value='<?php echo $proditems['pq_tags']; ?>'>
                            <?php echo $proditems['tag_name']; ?>
                          </option>
                          <?php 
                                $select_tags = "SELECT * FROM tags_qanda ORDER BY tag_name ASC";
                                $tags_info = mysqli_query($db_connection,$select_tags);
                                    if(mysqli_num_rows($tags_info) > 0)
                                    {
                            ?>
                          <?php 
                                while ($rows_tags = mysqli_fetch_assoc($tags_info))
                                {
                                $tags_id = $rows_tags['tags_id'];
                                $tags_name = $rows_tags['tag_name'];
                                echo "<option  value='$tags_id'>$tags_name</option>";
                                }
                            }
                            ?>
                        </select>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <input type="hidden" name="product_question_id"
                        value="<?php echo $proditems['product_question_id']; ?>">
                      <button type="submit" name="update_product_question" class="btn btn-primary">Update</button>
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <!--  -->
            <!-- Delete -->
            <div class="modal fade" id="modaldelete<?php echo $proditems['product_question_id']; ?>" tabindex="-1"
              aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <form action="/../BaronVerse/delete.php" method="POST">
                    <div class="modal-header">
                      <h5 class="modal-title">Are you sure you want to delete this?</h5>
                    </div>
                    <div class="modal-footer">
                      <input type="hidden" name="product_question_id"
                        value="<?php echo $proditems['product_question_id']; ?>">
                      <input type="hidden" name="pq_status" value="0">
                      <button type="submit" name="pq_delete" class="btn btn-danger">Delete</button>
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <!--  -->
            <?php
              endforeach;
                }else{
                  echo 'No Record';
                }
                
                ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div style="clear:both"></div>
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
<script>
  $(document).ready(function() {
    setTimeout(function() {
      $('#message').hide();
    }, 3000);
  })
</script>