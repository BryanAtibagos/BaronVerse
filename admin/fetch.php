<?php

//fetch.php
$connect = new PDO("mysql:host=localhost;dbname=baronverse", "root", "");

$output = '';

$query = '';

if(isset($_POST["query"]))
{
 $search = str_replace(",", "|", $_POST["query"]);
 $query = "SELECT * FROM product_question 
 WHERE pq_question REGEXP '".$search."' 
 OR pq_answer REGEXP '".$search."' 
 ";
}
else
{
 $query = "SELECT * FROM product_question ORDER BY product_question_id
 ";
}

$statement = $connect->prepare($query);
$statement->execute();

while($row = $statement->fetch(PDO::FETCH_ASSOC))
{
 $data[] = $row;
}

echo json_encode($data);

?>