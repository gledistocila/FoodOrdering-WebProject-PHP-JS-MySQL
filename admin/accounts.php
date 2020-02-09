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
		die("E pamundur te zgjidhet nje databaze");
	}
//selecting all records from the members table. Return an error if there are no records in the tables
$result=mysql_query("SELECT * FROM members")
or die("Nuk ka te dhena per t'u shfaqur \n" . mysql_error()); 
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Members</title>
<link href="stylesheets/admin_styles.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="page">
<div id="header">
<h1>Menaxhimi i pjesetareve</h1>
<a href="index.php">Kryefaqja</a> | <a href="categories.php">Kategorite</a> | <a href="foods.php">Ushqimet</a> | <a href="accounts.php">Llogarite</a> | <a href="orders.php">Porosite</a> | <a href="reservations.php">Rezervimet</a> | <a href="specials.php">Specialet</a> | <a href="allocation.php">Stafi</a> | <a href="messages.php">Mesazhet</a> | <a href="options.php">Opsionet</a> | <a href="logout.php">Logout</a>
</div>
<div id="container">
<table border="0" width="620" align="center">
<CAPTION><h3>LISTA E PJESETAREVE</h3></CAPTION>
<tr>
<th>ID e pjesetarit</th>
<th>Emri</th>
<th>Mbiemri</th>
<th>Email</th>
</tr>

<?php
//loop through all table rows
while ($row=mysql_fetch_array($result)){
echo "<tr>";
echo "<td>" . $row['member_id']."</td>";
echo "<td>" . $row['firstname']."</td>";
echo "<td>" . $row['lastname']."</td>";
echo "<td>" . $row['login']."</td>";
echo '<td><a href="delete-member.php?id=' . $row['member_id'] . '">Fshini pjesetar.</a></td>';
echo "</tr>";
}
mysql_free_result($result);
mysql_close($link);
?>
</table>
<hr>
</div>
<div id="footer">
<div class="bottom_addr">&copy; 2020 Juvenilja.Te gjitha te drejtat e rezervuara.</div>
</div>
</div>
</body>
</html>