<?php
include_once('db.php');
include('functions/function.php');
$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
if ($page <= 0) $page = 1;
 
$per_page = 5; // Set how many records do you want to display per page.
 
$startpoint = ($page * $per_page) - $per_page;
 
$statement = "`std`"; // Change `records` according to your table name.
  
$results = mysqli_query($conDB,"SELECT * FROM {$statement} LIMIT {$startpoint} , {$per_page}");
 
if (mysqli_num_rows($results) != 0) {
     
    // displaying records.
    while ($row = mysqli_fetch_array($results)) {
        echo $row['Name'] . '<br>';
    }
  
} else {
     echo "No records are found.";
}
 
 // displaying paginaiton.
echo pagination($statement,$per_page,$page,$url='?');
?>