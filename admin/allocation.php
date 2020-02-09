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
    
    //selecting all records from the staff table. Return an error if there are no records in the tables
    $staff=mysql_query("SELECT * FROM staff")
    or die("Nuk ka te dhena qe te shfaqen ... \n" . mysql_error()); 
?>
<?php
    //get order ids from the orders_details table based on flag=0
    $flag_0 = 0;
    $orders=mysql_query("SELECT * FROM orders_details WHERE flag='$flag_0'")
    or die("Nuk ka te dhena qe te shfaqen ... \n" . mysql_error()); 
?>
<?php
    //get reservation ids from the reservations_details table based on flag=0
    $flag_0 = 0;
    $reservations=mysql_query("SELECT * FROM reservations_details WHERE flag='$flag_0'")
    or die("Nuk ka te dhena qe te shfaqen ... \n" . mysql_error()); 
?>
<?php
    //selecting all records from the staff table. Return an error if there are no records in the tables
    $staff_1=mysql_query("SELECT * FROM staff")
    or die("Nuk ka te dhena qe te shfaqen ... \n" . mysql_error());
?>
<?php
    //selecting all records from the staff table. Return an error if there are no records in the tables
    $staff_2=mysql_query("SELECT * FROM staff")
    or die("Nuk ka te dhena qe te shfaqen ... \n" . mysql_error());
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Staff</title>
<link href="stylesheets/admin_styles.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="validation/admin.js">
</script>
</head>
<body>
<div id="page">
<div id="header">
<h1>Staff Allocation </h1>
<a href="index.php">Kryefaqja</a> | <a href="categories.php">Kategorite</a> | <a href="foods.php">Ushqimet</a> | <a href="accounts.php">Llogarite</a> | <a href="orders.php">Porosite</a> | <a href="reservations.php">Rezervimet</a> | <a href="specials.php">Specialet</a> | <a href="allocation.php">Stafi</a> | <a href="messages.php">Mesazhet</a> | <a href="options.php">Opsionet</a> | <a href="logout.php">Logout</a>
</div>
<div id="container">
<table border="0" width="600" align="center">
<CAPTION><h3>LISTA E STAFIT</h3></CAPTION>
<tr>
<th>ID Staf</th>
<th>Emri</th>
<th>Mbiemri</th>
<th>Rruga</th>
</tr>

<?php
//loop through all table rows
while ($row=mysql_fetch_array($staff)){
echo "<tr>";
echo "<td>" . $row['StaffID']."</td>";
echo "<td>" . $row['firstname']."</td>";
echo "<td>" . $row['lastname']."</td>";
echo "<td>" . $row['Street_Address']."</td>";
echo '<td><a href="delete-staff.php?id=' . $row['StaffID'] . '">Fshini staf</a></td>';
echo "</tr>";
}
mysql_free_result($staff);
mysql_close($link);
?>
</table>
<hr>
<table align="center">
<tr>
<form id="ordersAllocationForm" name="ordersAllocationForm" method="post" action="orders-allocation.php" onsubmit="return ordersAllocationValidate(this)">
<td>
  <table width="350" border="0" cellpadding="2" cellspacing="0">
  <CAPTION><h3>Porosite</h3></CAPTION>
	<tr>
		<td colspan="2" style="text-align:center;"><font color="#FF0000">* </font>Fushat e kerkuara</td>
	</tr>
    <tr>
      <th width="124">ID Porosi</th>
      <td width="168"><font color="#FF0000">* </font><select name="orderid" id="orderid">
        <option value="select">- zgjidhni nje opsion -
        <?php 
        //loop through orders_details table rows
        while ($row=mysql_fetch_array($orders)){
        echo "<option value=$row[order_id]>$row[order_id]"; 
        }
        ?>
        </select></td>
    </tr>
    <tr>
      <th>ID staf</th>
      <td><font color="#FF0000">* </font><select name="staffid" id="staffid">
        <option value="select">- zgjidhni nje opsion -
        <?php 
        //loop through staff table rows
        while ($row=mysql_fetch_array($staff_1)){
        echo "<option value=$row[StaffID]>$row[StaffID]"; 
        }
        ?>
        </select></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="Submit" value="Allocate Staff" /></td>
    </tr>
  </table>
</td>
</form>
<td>
<form id="reservationsAllocationForm" name="reservationsAllocationForm" method="post" action="reservations-allocation.php" onsubmit="return reservationsAllocationValidate(this)">
  <table width="300" border="0" align="center" cellpadding="2" cellspacing="0">
  <CAPTION><h3>REZERVIMET</h3></CAPTION>
	<tr>
		<td colspan="2" style="text-align:center;"><font color="#FF0000">* </font>Fushat e kerkuara</td>
	</tr>
    <tr>
      <th>ID Rezervim </th>
      <td><font color="#FF0000">* </font><select name="reservationid" id="reservationid">
        <option value="select">- zgjidhni nje opsion -
        <?php 
        //loop through reservations_details table rows
        while ($row=mysql_fetch_array($reservations)){
        echo "<option value=$row[ReservationID]>$row[ReservationID]"; 
        }
        ?>
        </select></td>
    </tr>
	<tr>
      <th>ID Staf </th>
      <td><font color="#FF0000">* </font><select name="staffid" id="staffid">
        <option value="select">- zgjidhni nje opsion -
        <?php 
        //loop through staff table rows
        while ($row=mysql_fetch_array($staff_2)){
        echo "<option value=$row[StaffID]>$row[StaffID]"; 
        }
        ?>
        </select></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="Submit" value="Allocate Staff" /></td>
    </tr>
  </table>
</td>
</form>
</tr>
</table>
<p>&nbsp;</p>
<hr>
</div>
<div id="footer">
<div class="bottom_addr">&copy; 2020 Juvenilja. Te gjitha te drejtat e rezervuara</div>
</div>
</div>
</body>
</html>