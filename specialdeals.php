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
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Juvenilja:Promo speciale</title>
<script type="text/javascript" src="swf/swfobject.js"></script>
<link href="stylesheets/user_styles.css" rel="stylesheet" type="text/css">
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

  <h1>PROMO SPECIALE</h1>
  <hr>
  <p>Shikoni ofertat speciale me poshte. Jane per nje kohe te limituar. Merrni vendimin tuaj tani.</p>
  <h3>Shenim: Qe te porositni nje oferte speciale, duhet te shkoni te seksioni i menuse.</h3>
  <div style="border:#bd6f2f solid 1px;padding:4px 6px 2px 6px">
<table width="850" align="center">
    <CAPTION><h3>PROMO SPECIALE</h3></CAPTION>
        <tr>
                <th>Foto e promos</th>
                <th>Emri i promos</th>
                <th>Pershkrimi i promos</th>
                <th>Data e fillimit</th>
                <th>Data e mbarimit</th>
                <th>Cmimi i promos</th>
        </tr>
        <?php
                $symbol=mysql_fetch_assoc($currencies); //gets active currency
                while ($row=mysql_fetch_assoc($result)){
                    echo "<tr>";
                    echo '<td><a href=images/'. $row['special_photo']. ' alt="click to view full image" target="_blank"><img src=images/'. $row['special_photo']. ' width="80" height="70"></a></td>';
                    echo "<td>" . $row['special_name']."</td>";
                    echo "<td width='250' align='left'>" . $row['special_description']."</td>";
                    echo "<td>" . $row['special_start_date']."</td>";
                    echo "<td>" . $row['special_end_date']."</td>";
                    echo "<td>" . $symbol['currency_symbol']. "" . $row['special_price']."</td>";
                    echo "</td>";
                    echo "</tr>";
                    }
            mysql_free_result($result);
            mysql_close($link);
?>
</table>
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
