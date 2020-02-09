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
    
    //define default value for flag
    $flag_1 = 1;
	
	//Sanitize the POST values
	$OrderID = clean($_POST['orderid']);
	$StaffID = clean($_POST['staffid']);
	
 
     // update the entry
     $result = mysql_query("UPDATE orders_details SET StaffID='$StaffID', flag='$flag_1' WHERE order_id='$OrderID'")
     or die("Porosia ose stafi nuk ekziston ... \n" . mysql_error()); 
     
     //check if query executed
     if($result) {
     // redirect back to the allocation page
     header("Location: allocation.php");
     exit();
     }
     else
     // Gives an error
     {
     die("Alokimi i porosise deshtoi ..." . mysql_error());
     }
 
?>