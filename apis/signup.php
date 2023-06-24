<?php
require_once('db.php');
$name = $_POST['name'];
$email = $_POST['email'];
$number = $_POST['number'];
$password = $_POST['password'];

$check ="select * from users where email='$email' or number='$number'";
$fire = mysqli_query($db, $check);
if(mysqli_num_rows($fire)>0){
    echo json_encode(array('resp'=>'User already exist.'));
}
else{
    $query="INSERT INTO users(name, email, number, password) VALUES('$name','$email','$number','$password')";
    if(mysqli_query($db, $query)){
        echo json_encode(array('resp'=>'User Register Successfully.'));
    }
    else{
        echo json_encode(array('resp'=>'Regsitration Failed.'));
    }
}
?>