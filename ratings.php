<?php
    require_once('auth.php');
?>
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
//get member id from session
$memberId=$_SESSION['SESS_MEMBER_ID']; 

//selecting all records from the food_details table. Return an error if there are no records in the table
$foods=mysql_query("SELECT * FROM food_details")
or die("Ndodhi nje problem ... \n" . "Skuadra jone po punon momentalisht ... \n" . "Ju lutem kontrolloni perseri pas disa oresh."); 

//selecting all records from the ratings table. Return an error if there are no records in the table
$ratings=mysql_query("SELECT * FROM ratings")
or die("Ndodhi nje problem ... \n" . "Skuadra jone po punon momentalisht ... \n" . "Ju lutem kontrolloni perseri pas disa oresh."); 
?>
<?php
    //retrieving all rows from the cart_details table based on flag=0
    $flag_0 = 0;
    $items=mysql_query("SELECT * FROM cart_details WHERE member_id='$memberId' AND flag='$flag_0'")
    or die("Dicka nuk shkon ... \n" . mysql_error()); 
    //get the number of rows
    $num_items = mysql_num_rows($items);
?>
<?php
    //retrieving all rows from the messages table
    $messages=mysql_query("SELECT * FROM messages")
    or die("Dicka nuk shkon ... \n" . mysql_error()); 
    //get the number of rows
    $num_messages = mysql_num_rows($messages);
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Juvneilja:Vleresimi</title>
<link href="stylesheets/user_styles.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="validation/user.js">
</script>
</head>
<body>
<div id="page">
  <div id="menu"><ul>
  <li><a href="index.php">Kryefaqja</a></li>
  <li><a href="foodzone.php">Ushqime</a></li>
  <li><a href="specialdeals.php">Promo speciale</a></li>
  <li><a href="member-index.php">Llogaria ime</a></li>
  <li><a href="contactus.php">Na kontaktoni</a></li>
  </ul>
  </div>
<div id="header">
  <div id="logo"> <a href="index.php" class="blockLink"></a></div>
  <div id="company_name">Restorant Juvenilja</div>
</div>
<div id="center">
<h1>NA VLERESONI</h1>
  <div style="border:#bd6f2f solid 1px;padding:4px 6px 2px 6px">
<a href="member-index.php">Kryefaqja</a> | <a href="cart.php">Shporta[<?php echo $num_items;?>]</a> |  <a href="inbox.php">Inbox[<?php echo $num_messages;?>]</a> | <a href="tables.php">Tabela</a> | <a href="partyhalls.php">Party-Hall</a> | <a href="ratings.php">Na vleresoni</a> | <a href="logout.php">Logout</a>
<p>&nbsp;</p>
<p>Per me shume informacion <a href="contactus.php">Klikoni ketu</a> per te na kontaktuar.
<hr>
<form name="ratingForm" id="ratingForm" method="post" action="ratings-exec.php?id=<?php echo $_SESSION['SESS_MEMBER_ID'];?>" onsubmit="return ratingValidate(this)" style="text-align:center;">
    <table align="center" width="300">
        <CAPTION><h2>VLERESONI USHQIMET TONA</h2></CAPTION>
            <tr>
                <td>Food</td>
                <td><select name="food" id="food">
                <option value="select">- zgjidhni ushqimin -
                <?php 
                //loop through food_details table rows
                while ($row=mysql_fetch_array($foods)){
                echo "<option value=$row[food_id]>$row[food_name]"; 
                }
                ?>
                </select></td>
            <tr>
                <td>Shkalla</td>
                <td><select name="scale" id="scale">
                <option value="select">- zgjidhni shkallen -
                <?php 
                //loop through ratings table rows
                while ($row=mysql_fetch_array($ratings)){
                echo "<option value=$row[rate_id]>$row[rate_name]"; 
                }
                ?>
                </select></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" name="Submit" value="Rate" /></td>
            </td>
    </table>
</form>
</div>
</div>
<div id="footer">
    <div class="bottom_menu"><a href="index.php">Kryefaqja</a>  |  <a href="aboutus.php">Rreth nesh</a>  |  <a href="specialdeals.php">Promo speciale</a>  |  <a href="foodzone.php">Ushqime</a>  |  <a href="#">Programi</a> |<br>
  | <a href="admin/index.php" target="_blank">Administrator</a> |</div>
  
  <div class="bottom_addr">&copy; 2020 Juvenilja. Te gjitha te drejtat e rezervuara</div>
</div>
</div>
</body>
</html>