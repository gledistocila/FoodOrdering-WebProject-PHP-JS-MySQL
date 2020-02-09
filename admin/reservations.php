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
//selecting all records from the reservations_details table based on table ids. Return an error if there are no records in the table
$tables=mysql_query("SELECT members.firstname, members.lastname, reservations_details.ReservationID, reservations_details.table_id, reservations_details.Reserve_Date, reservations_details.Reserve_Time, tables.table_id, tables.table_name FROM members, reservations_details, tables WHERE members.member_id = reservations_details.member_id AND tables.table_id=reservations_details.table_id")
or die("Nuk ka te dhena qe te shfaqen ... \n" . mysql_error()); 

//selecting all records from the reservations_details table based on partyhall ids. Return an error if there are no records in the table
$partyhalls=mysql_query("SELECT members.firstname, members.lastname, reservations_details.ReservationID, reservations_details.partyhall_id, reservations_details.Reserve_Date, reservations_details.Reserve_Time, partyhalls.partyhall_id, partyhalls.partyhall_name FROM members, reservations_details, partyhalls WHERE members.member_id = reservations_details.member_id AND partyhalls.partyhall_id=reservations_details.partyhall_id")
or die("Nuk ka te dhena qe te shfaqen ... \n" . mysql_error()); 
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Rezervimet</title>
<link href="stylesheets/admin_styles.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="page">
<div id="header">
<h1>Menaxhimi i rezervimeve</h1>
<a href="index.php">Kryefaqja</a> | <a href="categories.php">Kategori</a> | <a href="foods.php">Ushqime</a> | <a href="accounts.php">Llogari</a> | <a href="orders.php">Porosi</a> | <a href="reservations.php">Rezervime</a> | <a href="specials.php">Speciale</a> | <a href="allocation.php">Stafi</a> | <a href="messages.php">Mesazhe</a> | <a href="options.php">Opsione</a> | <a href="logout.php">Logout</a>
</div>
<div id="container">
<table border="0" width="900" align="center">
<CAPTION><h3>TAVOLINA TE REZERVUARA</h3></CAPTION>
<tr>
<th>ID Rezervim</th>
<th>Emri</th>
<th>Mbiemri</th>
<th>Emri i tavolines</th>
<th>Data e rezervimit</th>
<th>Koha e rezervimit</th>
<th>Veprim(e)</th>
</tr>

<?php
//loop through all table rows
while ($row=mysql_fetch_array($tables)){
echo "<tr>";
echo "<td>" . $row['ReservationID']."</td>";
echo "<td>" . $row['firstname']."</td>";
echo "<td>" . $row['lastname']."</td>";
echo "<td>" . $row['table_name']."</td>";
echo "<td>" . $row['Reserve_Date']."</td>";
echo "<td>" . $row['Reserve_Time']."</td>";
echo '<td><a href="delete-reservation.php?id=' . $row['ReservationID'] . '">Delete Reservation</a></td>';
echo "</tr>";
}
mysql_free_result($tables);
//mysql_close($link);
?>
</table>
<hr>
<table border="0" width="900" align="center">
<CAPTION><h3>PARTY-HALLS TE REZERVUARA</h3></CAPTION>
<tr>
<th>ID Rezervim</th>
<th>Emri</th>
<th>Mbiemri</th>
<th>Emri PartyHall</th>
<th>Data e rezervimit</th>
<th>Koha e rezervimit</th>
<th>Veprim(e)</th>
</tr>

<?php
//loop through all table rows
while ($row=mysql_fetch_array($partyhalls)){
echo "<tr>";
echo "<td>" . $row['ReservationID']."</td>";
echo "<td>" . $row['firstname']."</td>";
echo "<td>" . $row['lastname']."</td>";
echo "<td>" . $row['partyhall_name']."</td>";
echo "<td>" . $row['Reserve_Date']."</td>";
echo "<td>" . $row['Reserve_Time']."</td>";
echo '<td><a href="delete-reservation.php?id=' . $row['ReservationID'] . '">Delete Reservation</a></td>';
echo "</tr>";
}
mysql_free_result($partyhalls);
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