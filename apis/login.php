<?php
require_once('db.php');
$username = $_POST['username'];
$password = $_POST['password'];

$query="SELECT * FROM users WHERE email='$username' or number='$username'";
$fire=mysqli_query($db, $query);
if(mysqli_num_rows($fire) > 0){
$fetch=mysqli_fetch_array($fire, MYSQLI_BOTH);
    if($fetch['password'] == $password){
        echo json_encode(array('userInfo'=>$fetch, 'resp'=>"true"));
    }
    else{
        echo json_encode(array('resp'=>"wrong password!"));
    }
}
else{
    echo json_encode(array('resp'=>"user does't exist!"));
}
?>