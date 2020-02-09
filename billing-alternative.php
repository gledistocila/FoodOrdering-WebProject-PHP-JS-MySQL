<?php
    require_once('auth.php');
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Juvenilja:Fatura</title>
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
<h1>Adresa e faturimit</h1>
<hr>
<p>Ju nuk keni nje llogari faturimi. Duhet ta krijoni nje te tille ne menyre qe ta keni te mundur te porositni asortimentet tona. Per me shume informacion <a href="contactus.php">Klikoni ketu</a> per te ne kontaktuar.</p>
  <div style="border:#bd6f2f solid 1px;padding:4px 6px 2px 6px">
<form id="billingForm" name="billingForm" method="post" action="billing-exec.php?id=<?php echo $_SESSION['SESS_MEMBER_ID'];?>" onsubmit="return billingValidate(this)">
  <table width="300" border="0" align="center" cellpadding="2" cellspacing="0">
  <CAPTION><h3>SHTONI ADRESEN E FATURIMIT</h3></CAPTION>
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
