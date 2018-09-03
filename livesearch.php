<?php

	include('config.php');

///write new query here
$q=$_GET["q"];

$statement = "SELECT RESTAURANT_NAME FROM RESTAURANT where RESTAURANT_NAME like  '%$q%' ";
$s=oci_parse($c,$statement);
oci_execute($s);
while($row = oci_fetch_assoc($s) != false)
{
    	// echo $row['RESTAURANT_NAME']."<br>";
        echo "<p><a href='#' class='leftborder'><b>".$row['RESTAURANT_NAME']."</b></a></p>";
 }
// else
// {
//     echo "No restaurant found according to this search term";
// }