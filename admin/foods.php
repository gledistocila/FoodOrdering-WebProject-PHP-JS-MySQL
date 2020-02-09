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
    $result=mysql_query("SELECT * FROM food_details,categories WHERE food_details.food_category=categories.category_id")
    or die("Nuk ka te dhena qe te shfaqen ... \n" . mysql_error()); 
?>
<?php
    //retrive categories from the categories table
    $categories=mysql_query("SELECT * FROM categories")
    or die("Nuk ka te dhena qe te shfaqen ... \n" . mysql_error()); 
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
<title>Foods</title>
<link href="stylesheets/admin_styles.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="validation/admin.js">
</script>
</head>
<body>
<div id="page">
<div id="header">
<h1>Menaxhimi i ushqimeve</h1>
<a href="index.php">Kryefaqja</a> | <a href="categories.php">Kategorite</a> | <a href="foods.php">Ushqimet</a> | <a href="accounts.php">Llogarite</a> | <a href="orders.php">Porosite</a> | <a href="reservations.php">Rezervimet</a> | <a href="specials.php">Speciale</a> | <a href="allocation.php">Stafi</a> | <a href="messages.php">Mesazhet</a> | <a href="options.php">Opsionet</a> | <a href="logout.php">Logout</a>
</div>
<div id="container">
<table width="760" align="center">
<CAPTION><h3>SHTO USHQIM</h3></CAPTION>
<form name="foodsForm" id="foodsForm" action="foods-exec.php" method="post" enctype="multipart/form-data" onsubmit="return foodsValidate(this)">
<tr>
    <th>Emri</th>
    <th>Pershkrimi</th>
    <th>Cmimi</th>
    <th>Kategoria</th>
    <th>Foto</th>
    <th>Veprim(e)</th>
</tr>
<tr>
    <td><input type="text" name="name" id="name" class="textfield" /></td>
    <td><textarea name="description" id="description" class="textfield" rows="2" cols="15"></textarea></td>
    <td><input type="text" name="price" id="price" class="textfield" /></td>
    <td width="168"><select name="category" id="category">
    <option value="select">- zgjidhni nje opsion -
    <?php 
    //loop through categories table rows
    while ($row=mysql_fetch_array($categories)){
    echo "<option value=$row[category_id]>$row[category_name]"; 
    }
    ?>
    </select></td>
    <td><input type="file" name="photo" id="photo"/></td>
    <td><input type="submit" name="Submit" value="Add" /></td>
</tr>
</form>
</table>
<hr>
<table width="950" align="center">
<CAPTION><h3>USHQIME TE DISPONUESHME</h3></CAPTION>
<tr>
<th>Foto e ushqimit</th>
<th>Emri i ushqimit</th>
<th>Pershkrimi i ushqimit</th>
<th>Cmimi i ushqimit</th>
<th>Kategoria e ushqimit</th>
<th>Veprim(e)</th>
</tr>

<?php
//loop through all table rows
$symbol=mysql_fetch_assoc($currencies); //gets active currency
while ($row=mysql_fetch_array($result)){
echo "<tr>";
echo '<td><img src=../images/'. $row['food_photo']. ' width="80" height="70"></td>';
echo "<td>" . $row['food_name']."</td>";
echo "<td>" . $row['food_description']."</td>";
echo "<td>" . $symbol['currency_symbol']. "" . $row['food_price']."</td>";
echo "<td>" . $row['category_name']."</td>";
echo '<td><a href="delete-food.php?id=' . $row['food_id'] . '">Fshij ushqim</a></td>';
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