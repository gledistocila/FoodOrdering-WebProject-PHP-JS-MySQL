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
<title>Juvenilja:Profili im</title>
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
  <div id="company_name">Food Plaza Restaurant</div>
</div>
<div id="center">
<h1>Profili im</h1>
  <div style="border:#bd6f2f solid 1px;padding:4px 6px 2px 6px">
<a href="member-index.php">Kryefaqja</a> | <a href="cart.php">Shporta[<?php echo $num_items;?>]</a> |  <a href="inbox.php">Inbox[<?php echo $num_messages;?>]</a> | <a href="tables.php">Tabela</a> | <a href="partyhalls.php">Party-Hall</a> | <a href="ratings.php">Na vleresoni</a> | <a href="logout.php">Logout</a>
<p>&nbsp;</p>
<p>Ketu mund te ndryshoni fjalekalimin tuaj dhe te shtoni nje llogari faturimi. Llogaria e faturimit do te perdoret per te faturuar porosite tuaja dhe per te na dhene informacion se ku ti dergojme ato. Per me shume informacion <a href="contactus.php">Klikoni ketu</a> per te na kontaktuar.</p>
<hr>
<table width="870">
<tr>
<form id="updateForm" name="updateForm" method="post" action="update-exec.php?id=<?php echo $_SESSION['SESS_MEMBER_ID'];?>" onsubmit="return updateValidate(this)">
<td>
  <table width="350" align="center" border="0" cellpadding="2" cellspacing="0">
  <CAPTION><h2>NDRYSHONI PASSWORDIN TUAJ</h2></CAPTION>
	<tr>
		<td colspan="2" style="text-align:center;"><font color="#FF0000">* </font>Fushat e kerkuara</td>
	</tr>
    <tr>
      <th width="124">Password i vjeter</th>
      <td width="168"><font color="#FF0000">* </font><input name="opassword" type="password" class="textfield" id="opassword" /></td>
    </tr>
    <tr>
      <th>Password i ri</th>
      <td><font color="#FF0000">* </font><input name="npassword" type="password" class="textfield" id="npassword" /></td>
    </tr>
    <tr>
      <th>Konfirmoni passwordin e ri </th>
      <td><font color="#FF0000">* </font><input name="cpassword" type="password" class="textfield" id="cpassword" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="Submit" value="Change" /></td>
    </tr>
  </table>
</td>
</form>
<td>
<form id="billingForm" name="billingForm" method="post" action="billing-exec.php?id=<?php echo $_SESSION['SESS_MEMBER_ID'];?>" onsubmit="return billingValidate(this)">
  <table width="300" border="0" align="center" cellpadding="2" cellspacing="0">
  <CAPTION><h2>SHTONI ADRESEN E FATURIMIT</h2></CAPTION>
	<tr>
		<td colspan="2" style="text-align:center;"><font color="#FF0000">* </font>Fushat e kerkuara</td>
	</tr>
    <tr>
      <th>Rruga </th>
      <td><font color="#FF0000">* </font><input name="sAddress" type="text" class="textfield" id="sAddress" /></td>
    </tr>
	<tr>
      <th>Numri i kutise postare </th>
      <td><font color="#FF0000">* </font><input name="box" type="text" class="textfield" id="box" /></td>
    </tr>
    <tr>
      <th>Qyteti </th>
      <td><font color="#FF0000">* </font><input name="city" type="text" class="textfield" id="city" /></td>
    </tr>
    <tr>
      <th width="124">Cel</th>
      <td width="168"><font color="#FF0000">* </font><input name="mNumber" type="text" class="textfield" id="mNumber" /></td>
    </tr>
    <tr>
      <th>Tel</th>
      <td>&nbsp;&nbsp;&nbsp;<input name="lNumber" type="text" class="textfield" id="lNumber" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="Submit" value="Add" /></td>
    </tr>
  </table>
</td>
</form>
</tr>
</table>
<p>&nbsp;</p>
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