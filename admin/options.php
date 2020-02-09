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
    
//retrive categories from the categories table
$categories=mysql_query("SELECT * FROM categories")
or die("Nuk ka te dhena qe te shfaqen ... \n" . mysql_error()); 

//retrieve quantities from the quantities table
$quantities=mysql_query("SELECT * FROM quantities")
or die("Dicka nuk shkon ... \n" . mysql_error()); 

//retrieve currencies from the currencies table (deleting)
$currencies=mysql_query("SELECT * FROM currencies")
or die("Dicka nuk shkon ... \n" . mysql_error()); 

//retrieve currencies from the currencies table (updating)
$currencies_1=mysql_query("SELECT * FROM currencies")
or die("Dicka nuk shkon ... \n" . mysql_error()); 

//retrieve polls from the ratings table
$ratings=mysql_query("SELECT * FROM ratings")
or die("Dicka nuk shkon ... \n" . mysql_error());

//retrieve timezones from the timezones table (deleting)
$timezones=mysql_query("SELECT * FROM timezones")
or die("Dicka nuk shkon ... \n" . mysql_error()); 

//retrieve timezones from the timezones table (updating)
$timezones_1=mysql_query("SELECT * FROM timezones")
or die("Dicka nuk shkon ... \n" . mysql_error());  

//retrieve tables from the tables table
$tables=mysql_query("SELECT * FROM tables")
or die("Dicka nuk shkon ... \n" . mysql_error());

//retrieve partyhalls from the partyhalls table
$partyhalls=mysql_query("SELECT * FROM partyhalls")
or die("Dicka nuk shkon ... \n" . mysql_error());

//retrieve questions from the questions table
$questions=mysql_query("SELECT * FROM questions")
or die("Dicka nuk shkon ... \n" . mysql_error());
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Options</title>
<link href="stylesheets/admin_styles.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="validation/admin.js">
</script>
</head>
<body>
<div id="page">
<div id="header">
<h1>Opsione </h1>
<a href="index.php">Kryefaqja</a> | <a href="categories.php">Kategori</a> | <a href="foods.php">Ushqime</a> | <a href="accounts.php">Llogari</a> | <a href="orders.php">Porosi</a> | <a href="reservations.php">Rezervime</a> | <a href="specials.php">Speciale</a> | <a href="allocation.php">Stafi</a> | <a href="messages.php">Mesazhe</a> | <a href="options.php">Opsione</a> | <a href="logout.php">Logout</a>
</div>
<div id="container">
<table align="center" width="910">
<CAPTION><h3>MENAXHIMI I KATEGORIVE</h3></CAPTION>
<tr>
<form name="categoryForm" id="categoryForm" action="categories-exec.php" method="post" onsubmit="return categoriesValidate(this)">
<td>
  <table width="250" border="0" cellpadding="2" cellspacing="0" align="center">
    <tr>
        <td>Kategoria</td>
        <td><input type="text" name="name" class="textfield" /></td>
        <td><input type="submit" name="Insert" value="Add" /></td>
    </tr>
  </table>
</td>
</form>
<td>
<form name="categoryForm" id="categoryForm" action="delete-category.php" method="post" onsubmit="return categoriesValidate(this)">
  <table width="250" border="0" align="center" cellpadding="2" cellspacing="0">
    <tr>
        <td>Kategoria</td>
        <td><select name="category" id="category">
        <option value="select">- zgjidhni kategorine -
        <?php 
        //loop through categories table rows
        while ($row=mysql_fetch_array($categories)){
        echo "<option value=$row[category_id]>$row[category_name]"; 
        }
        ?>
        </select></td>
        <td><input type="submit" name="Delete" value="Remove" /></td>
    </tr>
  </table>
</form>
</td>
</tr>
</table>
<p>&nbsp;</p>
<hr>
<table align="center" width="910">
<CAPTION><h3>MENAXHIMI I SASIVE</h3></CAPTION>
<tr>
<form name="quantityForm" id="quantityForm" action="quantities-exec.php" method="post" onsubmit="return quantitiesValidate(this)">
<td>
  <table width="250" border="0" cellpadding="2" cellspacing="0" align="center">
    <tr>
        <td>Quantity</td>
        <td><input type="text" name="name" class="textfield" /></td>
        <td><input type="submit" name="Insert" value="Add" /></td>
    </tr>
  </table>
</td>
</form>
<td>
<form name="quantityForm" id="quantityForm" action="delete-quantity.php" method="post" onsubmit="return quantitiesValidate(this)">
  <table width="250" border="0" align="center" cellpadding="2" cellspacing="0">
    <tr>
        <td>Sasia</td>
        <td><select name="quantity" id="quantity">
        <option value="select">- zgjidhni sasine -
        <?php 
        //loop through quantities table rows
        while ($row=mysql_fetch_array($quantities)){
        echo "<option value=$row[quantity_id]>$row[quantity_value]"; 
        }
        ?>
        </select></td>
        <td><input type="submit" name="Delete" value="Remove" /></td>
    </tr>
  </table>
</form>
</td>
</tr>
</table>
<p>&nbsp;</p>
<hr>
<table align="center" width="910">
<CAPTION><h3>MENAXHIMI I KURSIT TE KEMBIMIT</h3></CAPTION>
<tr>
<td>
<form name="currencyForm" id="currencyForm" action="currencies-exec.php" method="post" onsubmit="return currenciesValidate(this)">
  <table width="250" border="0" cellpadding="2" cellspacing="0" align="center">
    <tr>
        <td>Monedha/Simboli</td>
        <td><input type="text" name="name" class="textfield" /></td>
        <td><input type="submit" name="Insert" value="Add" /></td>
    </tr>
  </table>
</form>
</td>
<td>
<form name="currencyForm" id="currencyForm" action="delete-currency.php" method="post" onsubmit="return currenciesValidate(this)">
  <table width="250" border="0" align="center" cellpadding="2" cellspacing="0">
    <tr>
        <td>Monedha/Simboli</td>
        <td><select name="currency" id="currency">
        <option value="select">- zgjidhni kursin e kembimit -
        <?php 
        //loop through currencies table rows
        while ($row=mysql_fetch_array($currencies)){
        echo "<option value=$row[currency_id]>$row[currency_symbol]"; 
        }
        ?>
        </select></td>
        <td><input type="submit" name="Delete" value="Remove" /></td>
    </tr>
  </table>
</form>
</td>
<td>
<form name="currencyForm" id="currencyForm" action="activate-currency.php" method="post" onsubmit="return currenciesValidate(this)">
  <table width="250" border="0" align="center" cellpadding="2" cellspacing="0">
    <tr>
        <td>Monedha/Simboli</td>
        <td><select name="currency" id="currency">
        <option value="select">- zgjidhni kursin e kembimit -
        <?php 
        //loop through currencies table rows
        while ($row=mysql_fetch_array($currencies_1)){
        echo "<option value=$row[currency_id]>$row[currency_symbol]"; 
        }
        ?>
        </select></td>
        <td><input type="submit" name="Update" value="Activate" /></td>
    </tr>
  </table>
</form>
</td>
</tr>
</table>
<p>&nbsp;</p>
<hr>
<table align="center" width="910">
<CAPTION><h3>MENAXHIMI I RATINGS</h3></CAPTION>
<tr>
<form name="ratingForm" id="ratingForm" action="ratings-exec.php" method="post" onsubmit="return ratingsValidate(this)">
<td>
  <table width="300" border="0" cellpadding="2" cellspacing="0" align="center">
    <tr>
        <td>Niveli i rate</td>
        <td><input type="text" name="name" id="name" class="textfield" /></td>
        <td><input type="submit" name="Insert" value="Add" /></td>
    </tr>
  </table>
</td>
</form>
<td>
<form name="ratingForm" id="ratingForm" action="delete-rating.php" method="post" onsubmit="return ratingsValidate(this)">
  <table width="300" border="0" align="center" cellpadding="2" cellspacing="0">
    <tr>
        <td>Niveli i rate</td>
        <td><select name="rating" id="rating">
        <option value="select">- zgjidhni nivelin -
        <?php 
        //loop through ratings table rows
        while ($row=mysql_fetch_array($ratings)){
        echo "<option value=$row[rate_id]>$row[rate_name]"; 
        }
        ?>
        </select></td>
        <td><input type="submit" name="Delete" value="Remove" /></td>
    </tr>
  </table>
</form>
</td>
</tr>
</table>
<p>&nbsp;</p>
<hr>
<table align="center" width="910">
<CAPTION><h3>MENAXHIMI I ZONES SE KOHES</h3></CAPTION>
<tr>
<td>
<form name="timezoneForm" id="timezoneForm" action="timezone-exec.php" method="post" onsubmit="return timezonesValidate(this)">
  <table width="250" border="0" cellpadding="2" cellspacing="0" align="center">
    <tr>
        <td>Zona e kohes</td>
        <td><input type="text" name="name" class="textfield" /></td>
        <td><input type="submit" name="Insert" value="Add" /></td>
    </tr>
  </table>
</form>
</td>
<td>
<form name="timezoneForm" id="timezoneForm" action="delete-timezone.php" method="post" onsubmit="return timezonesValidate(this)">
  <table width="250" border="0" align="center" cellpadding="2" cellspacing="0">
    <tr>
        <td>Zona e kohes</td>
        <td><select name="timezone" id="timezone">
        <option value="select">- zgjidhni zonen tuaj te kohes -
        <?php 
        //loop through timezones table rows
        while ($row=mysql_fetch_array($timezones)){
        echo "<option value=$row[timezone_id]>$row[timezone_reference]"; 
        }
        ?>
        </select></td>
        <td><input type="submit" name="Delete" value="Remove" /></td>
    </tr>
  </table>
</form>
</td>
<td>
<form name="timezoneForm" id="timezoneForm" action="activate-timezone.php" method="post" onsubmit="return timezonesValidate(this)">
  <table width="250" border="0" align="center" cellpadding="2" cellspacing="0">
    <tr>
        <td>Zona e kohes</td>
        <td><select name="timezone" id="timezone">
        <option value="select">- zgjidhni zonen e kohes -
        <?php 
        //loop through timezones table rows
        while ($row=mysql_fetch_array($timezones_1)){
        echo "<option value=$row[timezone_id]>$row[timezone_reference]"; 
        }
        ?>
        </select></td>
        <td><input type="submit" name="Update" value="Activate" /></td>
    </tr>
  </table>
</form>
</td>
</tr>
</table>
<p>&nbsp;</p>
<hr>
<table align="center" width="910">
<CAPTION><h3>MENAXHIMI I TABELAVE</h3></CAPTION>
<tr>
<form name="tableForm" id="tableForm" action="tables-exec.php" method="post" onsubmit="return tablesValidate(this)">
<td>
  <table width="350" border="0" cellpadding="2" cellspacing="0" align="center">
    <tr>
        <td>Emri/Numri i tabeles</td>
        <td><input type="text" name="name" class="textfield" /></td>
        <td><input type="submit" name="Insert" value="Add" /></td>
    </tr>
  </table>
</td>
</form>
<td>
<form name="tableForm" id="tableForm" action="delete-table.php" method="post" onsubmit="return tablesValidate(this)">
  <table width="350" border="0" align="center" cellpadding="2" cellspacing="0">
    <tr>
        <td>Emri/Numri i tabeles</td>
        <td><select name="table" id="table">
        <option value="select">- zgjidhni tabelen -
        <?php 
        //loop through tables table rows
        while ($row=mysql_fetch_array($tables)){
        echo "<option value=$row[table_id]>$row[table_name]"; 
        }
        ?>
        </select></td>
        <td><input type="submit" name="Delete" value="Remove" /></td>
    </tr>
  </table>
</form>
</td>
</tr>
</table>
<p>&nbsp;</p>
<hr>
<table align="center" width="910">
<CAPTION><h3>MENAXHIMI I PARTYHALLS</h3></CAPTION>
<tr>
<form name="partyhallForm" id="partyhallForm" action="partyhalls-exec.php" method="post" onsubmit="return partyhallsValidate(this)">
<td>
  <table width="350" border="0" cellpadding="2" cellspacing="0" align="center">
    <tr>
        <td>Emri/Numri i partyhall</td>
        <td><input type="text" name="name" class="textfield" /></td>
        <td><input type="submit" name="Insert" value="Add" /></td>
    </tr>
  </table>
</td>
</form>
<td>
<form name="partyhallForm" id="partyhallForm" action="delete-partyhall.php" method="post" onsubmit="return partyhallsValidate(this)">
  <table width="370" border="0" align="center" cellpadding="2" cellspacing="0">
    <tr>
        <td>Emri/Numri i partyhall</td>
        <td><select name="partyhall" id="partyhall">
        <option value="select">- zgjidhni partyhall -
        <?php 
        //loop through partyhalls table rows
        while ($row=mysql_fetch_array($partyhalls)){
        echo "<option value=$row[partyhall_id]>$row[partyhall_name]"; 
        }
        ?>
        </select></td>
        <td><input type="submit" name="Delete" value="Remove" /></td>
    </tr>
  </table>
</form>
</td>
</tr>
</table>
<p>&nbsp;</p>
<hr>
<table align="center" width="910">
<CAPTION><h3>MENAXHIMI I PYETJEVE</h3></CAPTION>
<tr>
<form name="questionForm" id="questionForm" action="questions-exec.php" method="post" onsubmit="return questionsValidate(this)">
<td>
  <table width="300" border="0" cellpadding="2" cellspacing="0" align="center">
    <tr>
        <td>Pyetje</td>
        <td><input type="text" name="name" class="textfield" /></td>
        <td><input type="submit" name="Insert" value="Add" /></td>
    </tr>
  </table>
</td>
</form>
<td>
<form name="questionForm" id="questionForm" action="delete-question.php" method="post" onsubmit="return questionsValidate(this)">
  <table width="300" border="0" align="center" cellpadding="2" cellspacing="0">
    <tr>
        <td>Pyetje</td>
        <td><select name="question" id="question">
        <option value="select">- zgjidhni pyetjen -
        <?php 
        //loop through quantities table rows
        while ($row=mysql_fetch_array($questions)){
        echo "<option value=$row[question_id]>$row[question_text]"; 
        }
        ?>
        </select></td>
        <td><input type="submit" name="Delete" value="Remove" /></td>
    </tr>
  </table>
</form>
</td>
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
