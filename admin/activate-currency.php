<?php
    //Start session
    session_start();
    
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
        die("E pamundur te zgjidhet nje databaze");
    }
 
    //Function to sanitize values received from the form. Prevents SQL injection
    function clean($str) {
        $str = @trim($str);
        if(get_magic_quotes_gpc()) {
            $str = stripslashes($str);
        }
        return mysql_real_escape_string($str);
    }
    
    if(isset($_POST['Update'])){
        //define default values for flag_0 and flag_1
        $flag_0 = 0;
        $flag_1 = 1;
        
        //check whether their is an active currency
        $qry=mysql_query("SELECT * FROM currencies WHERE flag='$flag_1'") or die("Dicka nuk shkon ... \n" . mysql_error()); 
        if(mysql_num_rows($qry)>0){
            $row=mysql_fetch_assoc($qry);
            $currency_id=$row['currency_id'];
            // update the entry with a deactivation flag
            $result = mysql_query("UPDATE currencies SET flag='$flag_0' WHERE currency_id='$currency_id'")
            or die("Dicka nuk shkon ... \n". mysql_error());
            
                //Perform activation of another currency
                
                    //Sanitize the POST values
                    $currency_id = clean($_POST['currency']);
             
                 // update the entry with an activation flag
                 $result = mysql_query("UPDATE currencies SET flag='$flag_1' WHERE currency_id='$currency_id'")
                 or die("Dicka nuk shkon... \n". mysql_error()); 
                 
                 //check if query executed
                 if($result) {
                 // redirect back to the options page
                 header("Location: options.php");
                 exit();
                 }
                 else
                 // Gives an error
                 {
                 die("aktivizimi deshtoi ..." . mysql_error());
                 }
        }
            else{
                    //Sanitize the POST values
                    $currency_id = clean($_POST['currency']);
             
                 // update the entry with an activation flag
                 $result = mysql_query("UPDATE currencies SET flag='$flag_1' WHERE currency_id='$currency_id'")
                 or die("Dicka nuk shkon... \n". mysql_error()); 
                 
                 //check if query executed
                 if($result) {
                     // redirect back to the options page
                     header("Location: options.php");
                     exit();
                 }
                 else
                 // Gives an error
                 {
                    die("aktivizimi deshtoi ..." . mysql_error());
                 }
            }
    }
?>