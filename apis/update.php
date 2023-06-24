<?php
require_once('db.php');
$id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];
$number = $_POST['number'];

$query ="UPDATE users SET name='$name', email='$email', number='$number' WHERE id='$id'";
if(mysqli_query($db, $query)){
    echo json_encode(array('resp'=>'true'));
}
else{
    echo json_encode(array('resp'=>'false'));
}
?>