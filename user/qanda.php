<?php 
include_once __DIR__ . '/header.php';   
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
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
</head>

<body class="body">
  <br><br><br><br>
  <div class="nav-ticketing">
    <div class="dashboard-list" style="padding-left:14px;">
      <ul class="dashboard-ul">
      <li><a href="qanda.php" style="font-size:30px; color:#00a037; font-weight:500;  border-bottom:green solid 2px;">Q&A</a></li>
      <li><a href="faqs.php" style="font-size:30px; ">FAQ's</a></li>
      <li><a href="ithelp.php" style="font-size:30px;">IT
          Help</a></li>
      </ul>
    </div>
  </div>
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
      </ul>
      <hr style="border: 1px solid gray;">
      <div class="card-body">
        <table id="example" class="table table-sm ">
          <thead class="table-dark">
            <tr>
              <th class="col-11">Questions</th>
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
            </tr>
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