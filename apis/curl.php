<?php
$post_url = "https://www.smartcallesb.co.za:8101/webservice/api";
$get_url = "https://www.smartcallesb.co.za:8101/webservice/swagger.json";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $post_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$data=array('name'=>"gg");
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
$result=curl_exec($ch);
curl_close($ch);
echo "<pre>";
print_r($result);
?>