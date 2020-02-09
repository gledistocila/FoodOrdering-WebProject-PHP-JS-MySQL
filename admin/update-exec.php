<?php
	//checking connection and connecting to a database
	require_once('connection/config.php');
	//Connect to mysql server
	$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
	if(!$link) {
		die('Lidhja me serverin deshtoi: ' . mysql_error());
	}
	
	//Select database
	$db = mysql_select_db(DB_DATABASE);
	if(!$db) {
		die("E pamundur te zgjidhet databaza");
	}
 
 //Function to sanitize values received from the form. Prevents SQL injection
	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysql_real_escape_string($str);
	}
	
	//Sanitize the POST values
	$OldPassword = clean($_POST['opassword']);
	$NewPassword = clean($_POST['npassword']);
	$ConfirmNewPassword = clean($_POST['cpassword']);
	
     // check if the 'id' variable is set in URL
     if (isset($_GET['id']))
     {
         // get id value
         $id = $_GET['id'];
         
         // update the entry
         $result = mysql_query("UPDATE pizza_admin SET Password='$NewPassword' WHERE Admin_ID='$id' AND Password='$OldPassword'")
         or die("Admin nuk ekziston ... \n". mysql_error()); 
         
         // redirect back to the member profile
         header("Location: profile.php");
     }
     else
     // if id isn't set, give an error
     {
        die("Ndryshimi i passwordit deshtoi ..." . mysql_error());
     }
 
?>