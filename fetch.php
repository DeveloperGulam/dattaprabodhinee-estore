<?php

//fetch.php
$connect = mysqli_connect("localhost","u708118651_estore","D@tta@kuldeep@227:;","u708118651_estore");

$query="SELECT * FROM products WHERE price BETWEEN '".$_POST["minimum_range"]."' AND '".$_POST["maximum_range"]."' ORDER BY price ASC";
$fire = mysqli_query($connect,$query);
$total_row = mysqli_num_rows($fire);
$output = '<h4 align="center">Total Item - '.$total_row.'</h4><div class="row">';

if($total_row > 0)
{
	while($fetch=mysqli_fetch_array($fire,MYSQLI_BOTH))
	{
		$output .= '
		<div class="col-md-2">
			<img src="https://estore.dattaprabodhinee.com/assets/images/product/'.$fetch["product_img"].'" style="height:150px;width:150px;" />
			<h4 align="center">'.$fetch["name"].'</h4>
			<h3 align="center" class="text-danger">Price: '.$fetch["price"].'</h3>
			<br />
		</div>
		';
	}
}
else
{
	$output .= '
		<h3 align="center">No Product Found</h3>
	';
}
$output .= '
</div>
';

echo $output;

?>