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
        die("E pamundur zgjedhja e databazes");
    }
//selecting all records from the Mesazhet table. Return an error if there is a problem
$result=mysql_query("SELECT * FROM Mesazhet")
or die("Nuk ka cfare te shfaqet ... \n" . mysql_error()); 
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Mesazhet</title>
<link href="stylesheets/admin_styles.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="validation/admin.js">
</script>
</head>
<body>
<div id="page">
<div id="header">
<h1>Menaxhimi i mesazheve</h1>
<a href="index.php">Kryefaqja</a> | <a href="categories.php">Kategorite</a> | <a href="foods.php">Ushqimet</a> | <a href="accounts.php">Llogarite</a> | <a href="orders.php">Porosite</a> | <a href="reservations.php">Rezervimet</a> | <a href="specials.php">Specialet</a> | <a href="allocation.php">Stafi</a> | <a href="messages.php">Mesazhet</a> | <a href="options.php">Opsionet</a> | <a href="logout.php">Logout</a>
</div>
<div id="container">
<form id="messageForm" name="messageForm" method="post" action="message-exec.php" onsubmit="return messageValidate(this)">
  <table width="540" border="0" cellpadding="2" cellspacing="0" align="center">
  <CAPTION><h3>DERGONI NJE MESAZH</h3></CAPTION>
    <tr>
      <th width="200">Tema</th>
      <td width="168"><input type="text" name="subject" id="subject" class="textfield" /></td>
    </tr>
    <tr>
      <th width="200">Kutia e mesazhit</th>
      <td width="168"><textarea name="txtmessage" class="textfield" rows="5" cols="60"></textarea></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td align="center"><input type="submit" name="Submit" value="Send Message" />
	  <input type="reset" name="Reset" value="Clear Field" /></td>
    </tr>
  </table>
</form>
<hr>
<table border="0" width="1000" align="center">
<CAPTION><h3>Mesazhet e derguara</h3></CAPTION>
<tr>
<th>ID Mesazh</th>
<th>Te dhenat e derguara</th>
<th>Koha e derguar</th>
<th>Tema e mesazhit</th>
<th>Teksti i mesazhit</th>
<th>Veprim(e)</th>
</tr>

<?php
//loop through all table rows
while ($row=mysql_fetch_array($result)){
echo "<tr>";
echo "<td>" . $row['message_id']."</td>";
echo "<td>" . $row['message_date']."</td>";
echo "<td>" . $row['message_time']."</td>";
echo "<td>" . $row['message_subject']."</td>";
echo "<td width='300' align='left'>" . $row['message_text']."</td>";
echo '<td><a href="delete-message.php?id=' . $row['message_id'] . '">Remove Message</a></td>';
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