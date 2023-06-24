<?php 
if(isset($_POST['submit'])){
    $to = "gulam.gaus@zorang.com";
    $from = $_POST['email']; // this is the sender's Email address
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $subject = "Address in Mumbai";
    $message = $_POST['message'];

    $headers = "From: Anjali Rathi " . $from;
    mail($to,$subject,$message,$headers);
        echo "Mail Sent.";
    }
?>

<!DOCTYPE html>
<head>
<title>Form submission</title>
</head>
<body>

<form action="" method="post">
First Name: <input type="text" name="first_name"><br>
Last Name: <input type="text" name="last_name"><br>
Email: <input type="text" name="email"><br>
Message:<br><textarea rows="5" name="message" cols="30"></textarea><br>
<input type="submit" name="submit" value="Submit">
</form>

</body>
</html> 