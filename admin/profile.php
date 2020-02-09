<?php
	require_once('auth.php');
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Profile</title>
<link href="stylesheets/admin_styles.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="validation/admin.js">
</script>
</head>
<body>
<div id="page">
<div id="header">
<h1>Profili </h1>
<a href="index.php">Kryefaqja</a> | <a href="categories.php">Kategori</a> | <a href="foods.php">Ushqime</a> | <a href="accounts.php">Llogari</a> | <a href="orders.php">Porosi</a> | <a href="reservations.php">Rezervime</a> | <a href="specials.php">Speciale</a> | <a href="allocation.php">Stafi</a> | <a href="messages.php">Mesazhet</a> | <a href="options.php">Opsione</a> | <a href="logout.php">Logout</a>
</div>
<div id="container">
<table align="center">
<tr>
<form id="updateForm" name="updateForm" method="post" action="update-exec.php?id=<?php echo $_SESSION['SESS_ADMIN_ID'];?>" onsubmit="return updateValidate(this)">
<td>
  <table width="350" border="0" cellpadding="2" cellspacing="0">
  <CAPTION><h3>NDRYSHIMI I PASSWORDIT TE ADMINISTRATORIT</h3></CAPTION>
	<tr>
		<td colspan="2" style="text-align:center;"><font color="#FF0000">* </font>Fushat e kerkuara</td>
	</tr>
    <tr>
      <th width="124">Password i tanishem</th>
      <td width="168"><font color="#FF0000">* </font><input name="opassword" type="password" class="textfield" id="opassword" /></td>
    </tr>
    <tr>
      <th>Password i ri</th>
      <td><font color="#FF0000">* </font><input name="npassword" type="password" class="textfield" id="npassword" /></td>
    </tr>
    <tr>
      <th>Konfirmoni passwordin e ri</th>
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
<form id="staffForm" name="staffForm" method="post" action="staff-exec.php" onsubmit="return staffValidate(this)">
  <table width="300" border="0" align="center" cellpadding="2" cellspacing="0">
  <CAPTION><h3>SHTONI STAF TE RI</h3></CAPTION>
	<tr>
		<td colspan="2" style="text-align:center;"><font color="#FF0000">* </font>Fushat e kerkuara</td>
	</tr>
    <tr>
      <th>Emri </th>
      <td><font color="#FF0000">* </font><input name="fName" type="text" class="textfield" id="fName" /></td>
    </tr>
	<tr>
      <th>Mbiemri </th>
      <td><font color="#FF0000">* </font><input name="lName" type="text" class="textfield" id="lName" /></td>
    </tr>
	 <tr>
      <th>Rruga </th>
      <td><font color="#FF0000">* </font><input name="sAddress" type="text" class="textfield" id="sAddress" /></td>
    </tr>
    <tr>
      <th>Cel/Tel </th>
      <td><font color="#FF0000">* </font><input name="mobile" type="text" class="textfield" id="mobile" /></td>
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
<hr>
</div>
<div id="footer">
<div class="bottom_addr">&copy; 2020 Juvenilja. Te gjitha te drejtat e rezervuara</div>
</div>
</div>
</body>
</html>
