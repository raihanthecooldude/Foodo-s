<?php
	// if ($_SERVER['REQUEST_METHOD'] == "POST")
	// {
		// $un = test_input($_POST['un']);
		// $pw = test_input($_POST['pw']);
		
		// $area = test_input($_GET['area']);
		// $food = test_input($_GET['food']);
		// $price = test_input($_GET['price']);

		$area = test_input($_SESSION['area']);
		$food = test_input($_SESSION['food']);
		$price = test_input($_SESSION['price']);

		$c = oci_connect('system', '5590', 'localhost:1522/orcl');
		
		if (!$c) {
			$m = oci_error();
			echo $m['message']."\n";
			exit;
		}
		else 
		{
			if($area=="Dhaka")
			{
				// $statement = "select food.* from food, restaurant where (food.RID=restaurant.RID) and (FOOD_NAME='$food' and PRICE <= '$price')";
				// $statement = "select food.* from food where CATEGORY='$food' and PRICE <= '$price'";

				// $statement = "select * from food, restaurant where food.rid = restaurant.rid and category LIKE '%$food%' and price <= '$price'";
				$statement = "select * from search_view where category LIKE '%$food%' and price <= '$price'";

			}
			else
			{
				// $statement = "select food.* from food, restaurant where (food.RID = restaurant.RID) and (food.CATEGORY like '%$food%' and food.PRICE <= '$price' and restaurant.AREA = '$area')";

				// $statement = "select * from food, restaurant where food.rid = restaurant.rid and area = '$area' and category LIKE '%$food%' and price <= '$price'";
				$statement = "select * from search_view where area = '$area' and category LIKE '%$food%' and price <= '$price'";
			}
			
			$s = oci_parse($c, $statement);
			oci_execute($s);
			$count=0;
			while(($row = oci_fetch_assoc($s)) != false) 
			{
				// echo $area." ".$row['food.PRICE']." ".$row['restaurant.RESTAURANT_NAME']."<br>";
				// echo $area." ".$row['RESTAURANT_NAME']." ".$row['FOOD_NAME']." ".$row['PRICE'];
				// var_dump($row);
				// echo "<br>";
				if($count==0)
				{
					echo "<tr> <th>Restaurant Name</th> <th>Food Name</th> <th>Price</th> </tr>";
				}
				$count=1;

				echo "<tr>";
				echo "<td>".$row['RESTAURANT_NAME']."</td>";
				echo "<td>".$row['FOOD_NAME']."</td>";
				echo "<td>".$row['PRICE']."</td>";
				echo "</tr>";
			}

			if($count==0)
			{
				echo "<p style='line-height: 1.6; font-family: Calibri; font-size: 16px; color: black;'>There is no restaurant within this price range in this area. <a href='index.php'>Search again!</a> Thank You.</p>";
			}
		}
		oci_close($c);
	// }
	// else
	// {
	// 	header("Location:index.php");
	// }
	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
?>