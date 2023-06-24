<?php
require_once('db.php');

$query="SELECT * FROM users ORDER BY id DESC";
$fire=mysqli_query($db, $query);
while($fetch=mysqli_fetch_array($fire, MYSQLI_BOTH)){
    $output[] = $fetch;
}
echo json_encode($output);
?>