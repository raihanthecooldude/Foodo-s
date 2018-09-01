<?php
	if ($_SERVER['REQUEST_METHOD'] == "POST")
	{
		// $un = test_input($_POST['un']);
		// $pw = test_input($_POST['pw']);
		
		$uname = $_POST['uname'];
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
			$statement = "begin insert_into_useradmin(:u_aname, :u_username, :u_apassword); end;";
			$s = oci_parse($c, $statement);
			oci_bind_by_name($s, ':u_aname', $uname);
			oci_bind_by_name($s, ':u_username', $un);
			oci_bind_by_name($s, ':u_apassword', $pw);
			if(oci_execute($s))
			{
				oci_close($c);
				header('Location:signupdone.php');
			}
			else
			{
				oci_rollback($c);
				$error=oci_error($statement);
				echo $error['message'];
				oci_close($c);
			}
		}
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