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
//selecting all records from almost all tables. Return an error if there are no records in the tables
$result=mysql_query("SELECT members.member_id, members.firstname, members.lastname, billing_details.Street_Address, billing_details.Mobile_No, orders_details.*, food_details.*, cart_details.*, quantities.* FROM members, billing_details, orders_details, quantities, food_details, cart_details WHERE members.member_id=orders_details.member_id AND billing_details.billing_id=orders_details.billing_id AND orders_details.cart_id=cart_details.cart_id AND cart_details.food_id=food_details.food_id AND cart_details.quantity_id=quantities.quantity_id")
or die("Nuk ka te dhena qe te shfaqen ... \n" . mysql_error()); 
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Orders</title>
<link href="stylesheets/admin_styles.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="page">
<div id="header">
<h1>Mneaxhimi i porosive </h1>
<a href="index.php">Kryefaqja</a> | <a href="categories.php">Kategori</a> | <a href="foods.php">Ushqime</a> | <a href="accounts.php">Llogari</a> | <a href="orders.php">Porosi</a> | <a href="reservations.php">Rezervime</a> | <a href="specials.php">Speciale</a> | <a href="allocation.php">Stafi</a> | <a href="messages.php">Mesazhet</a> | <a href="options.php">Opsione</a> | <a href="logout.php">Logout</a>
</div>
<div id="container">
<table border="0" width="970" align="center">
<CAPTION><h3>LISTA E POROSIVE</h3></CAPTION>
<tr>
<th>ID Porosi</th>
<th>Emrat e klienteve</th>
<th>Emri i ushqimit</th>
<th>Cmimi i ushqimit</th>
<th>Sasia</th>
<th>Kostoja totale</th>
<th>Data e dorezimit</th>
<th>Adresa e dorezimit</th>
<th>Numri i celularit</th>
<th>Veprim(e)</th>
</tr>

<?php
//loop through all tables rows
while ($row=mysql_fetch_assoc($result)){
echo "<tr>";
echo "<td>" . $row['order_id']."</td>";
echo "<td>" . $row['firstname']."\t".$row['lastname']."</td>";
echo "<td>" . $row['food_name']."</td>";
echo "<td>" . $row['food_price']."</td>";
echo "<td>" . $row['quantity_value']."</td>";
echo "<td>" . $row['total']."</td>";
echo "<td>" . $row['delivery_date']."</td>";
echo "<td>" . $row['Street_Address']."</td>";
echo "<td>" . $row['Mobile_No']."</td>";
echo '<td><a href="delete-order.php?id=' . $row['order_id'] . '">Remove Order</a></td>';
echo "</tr>";
}
mysql_free_result($result);
mysql_close($link);
?>
</table>
<hr>
</div>
<div id="footer">
<div class="bottom_addr">&copy; 2020 Juvenilja. Te gjitha te drejtat e rezervuara</div>
</div>
</div>
</body>
</html>