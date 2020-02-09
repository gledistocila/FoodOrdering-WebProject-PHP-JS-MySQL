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
        die("E pamundur te zgjidhet databaza");
    }
?>
<?php
    if(isset($_POST['Submit'])){
        //Function to sanitize values received from the form. Prevents SQL injection
        function clean($str) {
            $str = @trim($str);
            if(get_magic_quotes_gpc()) {
                $str = stripslashes($str);
            }
            return mysql_real_escape_string($str);
        }
        //get email
        $email = clean($_POST['email']);
        
        //selecting a specific record from the members table. Return an error if there are no records in the table
        $result=mysql_query("SELECT * FROM members WHERE login='$email'")
        or die("Ndodhi nje problem ... \n" . "Skuadra jone po punon momentalisht ... \n" . "Ju lutem kontrolloni perseri pas disa oresh."); 
    }
?>
<?php
    if(isset($_POST['Change'])){
        //Function to sanitize values received from the form. Prevents SQL injection
        function clean($str) {
            $str = @trim($str);
            if(get_magic_quotes_gpc()) {
                $str = stripslashes($str);
            }
            return mysql_real_escape_string($str);
        }
        if(trim($_SESSION['member_id']) != ''){
            $member_id=$_SESSION['member_id']; //gets member id from session
            //get answer and new password from form
            $answer = clean($_POST['answer']);
            $new_password = clean($_POST['new_password']);
            
         // update the entry
         $result = mysql_query("UPDATE members SET passwd='".md5($_POST['new_password'])."' WHERE member_id='$member_id' AND answer='".md5($_POST['answer'])."'")
         or die("Ndodhi nje problem ... \n" . "Skuadra jone po punon momentalisht ... \n" . "Ju lutem kontrolloni perseri pas disa oresh. \n");  
         
         if($result){
                unset($_SESSION['member_id']);
                header("Location: reset-success.php"); //redirect to reset success page         
         }
         else{
                unset($_SESSION['member_id']);
                header("Location: reset-failed.php"); //redirect to reset failed page
         }
            }
            else{
                unset($_SESSION['member_id']);
                header("Location: reset-failed.php"); //redirect to reset failed page
            }
    }
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Juvenilja:Rivendosja e password</title>
<link href="stylesheets/user_styles.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="validation/user.js">
</script>
</head>
<body>
<div id="reset">
  <div style="border:#bd6f2f solid 1px;padding:4px 6px 2px 6px">
  <form name="passwordResetForm" id="passwordResetForm" method="post" action="password-reset.php" onsubmit="return passwordResetValidate(this)">
     <table width="360" style="text-align:center;">
     <tr>
        <th>Email</th>
        <td width="168"><input name="email" type="text" class="textfield" id="email" /></td>
        <td><input type="submit" name="Submit" value="Check" /></td>
     </tr>
     </table>
 </form>
  <?php
    if(isset($_POST['Submit'])){
        $row=mysql_fetch_assoc($result);
        $_SESSION['member_id']=$row['member_id']; //creates a member id session
        session_write_close(); //closes session
        $question_id=$row['question_id'];
        
        //get question text based on question_id
        $question=mysql_query("SELECT * FROM questions WHERE question_id='$question_id'")
        or die("Ndodhi nje problem ... \n" . "Skuadra jone po punon momentalisht ... \n" . "Ju lutem kontrolloni perseri pas disa oresh.");
        
        $question_row=mysql_fetch_assoc($question);
        $question=$question_row['question_text'];
        if($question!=""){
            echo "<b>ID juaj:</b> ".$_SESSION['member_id']."<br>";
            echo "<b>Pyetja juaj e sigurise:</b> ".$question;
        }
        else{
            echo "<b>YPyetja juaj e sigurise:</b> KJO LLOGARI NUK EKZISTON! JU LUTEMI KONTROLLONI EMAILIN TUAJ DHE PROVONI PERSERI.";
        }
    }
  ?>
  <hr>
  <form name="passwordResetForm" id="passwordResetForm" method="post" action="password-reset.php" onsubmit="return passwordResetValidate_2(this)">
     <table width="360" style="text-align:center;">
     <tr>
        <td colspan="2" style="text-align:center;"><font color="#FF0000">* </font>Fushat e kerkuara</td>
     </tr>
     <tr>
        <th>Pergjigja juaj e sigurise</th>
        <td width="168"><font color="#FF0000">* </font><input name="answer" type="text" class="textfield" id="answer" /></td>
     </tr>
     <tr>
        <th>Password i ri</th>
        <td width="168"><font color="#FF0000">* </font><input name="new_password" type="password" class="textfield" id="new_password" /></td>
     </tr>
     <tr>
        <th>Konfirmoni Passwordin e ri</th>
        <td width="168"><font color="#FF0000">* </font><input name="confirm_new_password" type="password" class="textfield" id="confirm_new_password" /></td>
     </tr>
     <tr>
        <td colspan="2"><input type="reset" name="Reset" value="Clear Fields" /><input type="submit" name="Change" value="Change Password" /></td>
     </tr>
     </table>
 </form>
  </div>
  </div>
</body>
</html>