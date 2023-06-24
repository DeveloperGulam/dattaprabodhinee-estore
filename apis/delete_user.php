<?php
require_once('db.php');
$id = $_POST['id'];
$query ="DELETE FROM users WHERE id='$id'";
if(mysqli_query($db, $query)){
    echo json_encode(array('resp'=>'true'));
}
else{
    echo json_encode(array('resp'=>'false'));
}
?>