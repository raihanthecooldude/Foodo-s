<?php
	if ($_SERVER['REQUEST_METHOD'] == "POST")
	{
		// $un = test_input($_POST['un']);
		// $pw = test_input($_POST['pw']);
		
		$un = $_POST['un'];
		$pw = $_POST['pw'];

		$c = oci_connect('system', '5590', 'localhost:1522/orcl');
		
		if (!$c) {
			$m = oci_error();
			echo $m['message']."\n";
			exit;
		}
		else 
		{
			$statement = "select * from useradmin where username = '$un' and apassword = '$pw'";
			$s = oci_parse($c, $statement);
			oci_execute($s);
			if(($row = oci_fetch_assoc($s)) != false) 
			{
				if($row['USERNAME']==$un && $row['APASSWORD']==$pw)
				{
					header("Location:home.php");
				}
			}
			else
			{
				echo "Wrong Username Or Password";
			}
		}
		oci_close($c);
	}
	else
	{
		header("Location:index.php");
	}
	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
?>