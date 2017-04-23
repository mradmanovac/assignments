<?php

$conn = mysqli_connect("localhost", "domaci", "601f1889667efaebb33b8c12572835da3f027f78", "homeworks");

if ($err = mysqli_connect_errno($conn)) {
    echo "Greska u konekciji</br>";
    echo $err;
    die();
}
?>