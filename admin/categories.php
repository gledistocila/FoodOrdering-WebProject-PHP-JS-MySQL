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
$result=mysql_query("SELECT * FROM categories")
or die("Nuk ka te dhena qe te shfaqen ... \n" . mysql_error()); 
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Kategorite</title>
<link href="stylesheets/admin_styles.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="validation/admin.js">
</script>
</head>
<body>
<div id="page">
<div id="header">
<h1>Menaxhimi i Porosive</h1>
<a href="index.php">Kryefaqja</a> | <a href="categories.php">Kategorite</a> | <a href="foods.php">Ushqimet</a> | <a href="accounts.php">Llogarite</a> | <a href="orders.php">Porosite</a> | <a href="reservations.php">Rezervimet</a> | <a href="specials.php">Specialet</a> | <a href="allocation.php">Staf</a> | <a href="messages.php">Mesazhet</a> | <a href="options.php">Opsionet</a> | <a href="logout.php">Logout</a>
</div>
<div id="container">
<table width="320" align="center">
<CAPTION><h3>SHTONI NJE KATEGORI TE RE</h3></CAPTION>
<form name="categoryForm" id="categoryForm" action="categories-exec.php" method="post" onsubmit="return categoriesValidate(this)">
<tr>
    <th>Emri</th>
    <th>Veprim(e)</th>
</tr>
<tr>
    <td><input type="text" name="name" class="textfield" /></td>
    <td><input type="submit" name="Submit" value="Add" /></td>
</tr>
</form>
</table>
<hr>
<table width="320" align="center">
<CAPTION><h3>KATEGORITE E DISPONUESHME</h3></CAPTION>
<tr>
<th>Emri i kategorise</th>
<th>Veprim(e)</th>
</tr>

<?php
//loop through all table rows
while ($row=mysql_fetch_array($result)){
echo "<tr>";
echo "<td>" . $row['category_name']."</td>";
echo '<td><a href="delete-category.php?id=' . $row['category_id'] . '">Fshij kategori</a></td>';
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