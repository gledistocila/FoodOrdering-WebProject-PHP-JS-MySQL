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

//selecting all records from the orders_details table. Return an error if there are no records in the table
$result=mysql_query("SELECT * FROM orders_details,cart_details,food_details,categories,quantities,members WHERE members.member_id='$memberId' AND orders_details.member_id='$memberId' AND orders_details.cart_id=cart_details.cart_id AND cart_details.food_id=food_details.food_id AND food_details.food_category=categories.category_id AND cart_details.quantity_id=quantities.quantity_id")
or die("Nuk ka te dhena qe te shfaqen ... \n" . mysql_error()); 
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
<?php
    //retrive a currency from the currencies table
    //define a default value for flag_1
    $flag_1 = 1;
    $currencies=mysql_query("SELECT * FROM currencies WHERE flag='$flag_1'")
    or die("Ndodhi nje problem ... \n" . "Skuadra jone po punon momentalisht ... \n" . "Ju lutem kontrolloni perseri pas disa oresh."); 
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Juvenilja:Kryefaqja e perdoruesit</title>
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
<h1>Mireseerdhet <?php echo $_SESSION['SESS_FIRST_NAME'];?></h1>
  <div style="border:#bd6f2f solid 1px;padding:4px 6px 2px 6px">
<a href="member-profile.php">Profili im</a> | <a href="cart.php">SHporta[<?php echo $num_items;?>]</a> |  <a href="inbox.php">Inbox[<?php echo $num_messages;?>]</a> | <a href="tables.php">Tabela</a> | <a href="partyhalls.php">Party-Hall</a> | <a href="ratings.php">Na vleresoni</a> | <a href="logout.php">Logout</a>
<p>&nbsp;</p>
<p>Ketu mund te shihni historine e pororsive tuaja si dhe mund ti fshini ato. Mund te beni edhe rezervime tavolinash nga llogaria juaj. Per me shume informacion <a href="contactus.php">Klikoni ketu</a> per te na kontaktuar.
<h3><a href="foodzone.php">Porositni me shume ushqim!</a></h3>
<hr>
<table border="0" width="910" style="text-align:center;">
<CAPTION><h2>HISTORIKU I POROSIVE</h2></CAPTION>
<tr>
<th>ID Porosi</th>
<th>Foto e ushqimit</th>
<th>Emri i ushqimit</th>
<th>Kategoria e ushqimit</th>
<th>Cmimi i ushqimit</th>
<th>Sasia</th>
<th>Totali</th>
<th>Data e dorezimit</th>
<th>Veprim(e)</th>
</tr>

<?php
//loop through all table rows
$symbol=mysql_fetch_assoc($currencies); //gets active currency
while ($row=mysql_fetch_array($result)){
echo "<tr>";
echo "<td>" . $row['order_id']."</td>";
echo '<td><a href=images/'. $row['food_photo']. ' alt="click to view full image" target="_blank"><img src=images/'. $row['food_photo']. ' width="80" height="70"></a></td>';
echo "<td>" . $row['food_name']."</td>";
echo "<td>" . $row['category_name']."</td>";
echo "<td>" . $symbol['currency_symbol']. "" . $row['food_price']."</td>";
echo "<td>" . $row['quantity_value']."</td>";
echo "<td>" . $symbol['currency_symbol']. "" . $row['total']."</td>";
echo "<td>" . $row['delivery_date']."</td>";
echo '<td><a href="delete-order.php?id=' . $row['order_id'] . '">Cancel Order</a></td>';
echo "</tr>";
}
mysql_free_result($result);
mysql_close($link);
?>
</table>
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
