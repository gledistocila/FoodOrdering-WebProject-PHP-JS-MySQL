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
//retrive promotions from the specials table
$result=mysql_query("SELECT * FROM specials")
or die("Nuk ka te dhena qe te shfaqen ... \n" . mysql_error()); 
?>
<?php
    //retrive a currency from the currencies table
    //define a default value for flag_1
    $flag_1 = 1;
    $currencies=mysql_query("SELECT * FROM currencies WHERE flag='$flag_1'")
    or die("Ndodhi nje problem ... \n" . "Skuadra jone po punon momentalisht ... \n" . "Ju lutem kontrolloni perseri pas disa oresh."); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Specials</title>
<link href="stylesheets/admin_styles.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="validation/admin.js">
</script>
</head>
<body>
<div id="page">
<div id="header">
<h1>Menaxhimi i specialeve </h1>
<a href="index.php">Kryefaqja</a> | <a href="categories.php">Kategori</a> | <a href="foods.php">Ushqime</a> | <a href="accounts.php">Llogari</a> | <a href="orders.php">Porosi</a> | <a href="reservations.php">Rezervime</a> | <a href="specials.php">Speciale</a> | <a href="allocation.php">Stafi</a> | <a href="messages.php">Mesazhe</a> | <a href="options.php">Opsione</a> | <a href="logout.php">Logout</a>
</div>
<div id="container">
<table width="850" align="center">
<CAPTION><h3>MAENAXHIMI I PROMOVE</h3></CAPTION>
<form name="specialsForm" id="specialsForm" action="specials-exec.php" method="post" enctype="multipart/form-data" onsubmit="return specialsValidate(this)">
<tr>
    <th>Emri</th>
    <th>Pershkrimi</th>
    <th>Cmimi</th>
    <th>Data e fillimit</th>
    <th>Data e mbarimit</th>
    <th>Foto</th>
    <th>Action</th>
</tr>
<tr>
    <td><input type="text" name="name" id="name" class="textfield" /></td>
    <td><textarea name="description" id="description" class="textfield" rows="2" cols="15"></textarea></td>
    <td><input type="text" name="price" id="price" class="textfield" /></td>
    <td><input type="date" name="start_date" id="start_date" class="textfield" /></td>
    <td><input type="date" name="end_date" id="end_date" class="textfield" /></td>
    <td><input type="file" name="photo" id="photo"/></td>
    <td><input type="submit" name="Submit" value="Add" /></td>
</tr>
</form>
</table>
<hr>
<table width="950" align="center">
<CAPTION><h3>LISTA E SPECIALEVE</h3></CAPTION>
<tr>
<th>Foto e promos</th>
<th>Emri i promos</th>
<th>Pershkrimi i promos</th>
<th>Cmimi i promos</th>
<th>Data e fillimit</th>
<th>Data e mbarimit</th>
<th>Veprim(e)</th>
</tr>

<?php
//loop through all table rows
$symbol=mysql_fetch_assoc($currencies); //gets active currency
while ($row=mysql_fetch_array($result)){
echo "<tr>";
echo '<td><img src=../images/'. $row['special_photo']. ' width="80" height="70"></td>';
echo "<td>" . $row['special_name']."</td>";
echo "<td width='180' align='left'>" . $row['special_description']."</td>";
echo "<td>" . $symbol['currency_symbol']. "" . $row['special_price']."</td>";
echo "<td>" . $row['special_start_date']."</td>";
echo "<td>" . $row['special_end_date']."</td>";
echo '<td><a href="delete-special.php?id=' . $row['special_id'] . '">Remove Promo</a></td>';
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