<?php
    require_once('db.php');
    $video_url = $_FILES['video_url']['name'];
    $file_tmp = $_FILES['video_url']['tmp_name'];
    $loc = 'video/';

    $query="INSERT INTO videos(video_url) VALUES('$video_url')";
    if(mysqli_query($db, $query)){
        move_uploaded_file($file_tmp, $loc.$video_url);
        echo json_encode(array('resp'=>'Insert Successfully.'));
    }
    else{
        echo json_encode(array('resp'=>'Failed.'));
    }
?>