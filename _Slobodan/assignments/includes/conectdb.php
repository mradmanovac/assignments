<?php  



$conn = mysqli_connect("localhost", "root", "", "homeworks");

if($err = mysqli_connect_errno($conn)){
	echo "Greska u konekciji</br>";
	echo $err;
	die();
}



?>