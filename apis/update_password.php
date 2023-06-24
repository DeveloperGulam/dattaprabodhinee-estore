<?php
require_once('db.php');
$id = $_POST['id'];
$current = $_POST['current'];
$new = $_POST['new'];
$query="SELECT * FROM users WHERE id='$id'";
$fire=mysqli_query($db, $query);
if(mysqli_num_rows($fire) > 0){
$fetch=mysqli_fetch_array($fire, MYSQLI_BOTH);
    if($fetch['password'] == $current){
        $sql ="UPDATE users SET password='$new' WHERE id='$id'";
        if(mysqli_query($db, $sql)){
            echo json_encode(array('resp'=>'true'));
        }
        else{
            echo json_encode(array('resp'=>'false'));
        }
    }
    else{
        echo json_encode(array('resp'=>"old password does't match!"));
    }
}
else{
    echo json_encode(array('resp'=>"user does't exist!"));
}
?>