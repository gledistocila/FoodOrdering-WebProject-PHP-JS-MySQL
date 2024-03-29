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
    
    //define default value for flag
    $flag_1 = 1;
    
    //defining global variables
    $qry="";
    $excellent_qry="";
    $good_qry="";
    $average_qry="";
    $bad_qry="";
    $worse_qry="";
    
//count the number of records in the members, orders_details, and reservations_details tables
$members=mysql_query("SELECT * FROM members")
or die("Nuk ka te dhena te numerueshme ... \n" . mysql_error()); 

$orders_placed=mysql_query("SELECT * FROM orders_details")
or die("Nuk ka te dhena te numerueshme ... \n" . mysql_error());

$orders_processed=mysql_query("SELECT * FROM orders_details WHERE flag='$flag_1'")
or die("Nuk ka te dhena te numerueshme ... \n" . mysql_error());

$tables_reserved=mysql_query("SELECT * FROM reservations_details WHERE table_flag='$flag_1'")
or die("Nuk ka te dhena te numerueshme ... \n" . mysql_error());

$partyhalls_reserved=mysql_query("SELECT * FROM reservations_details WHERE partyhall_flag='$flag_1'")
or die("Nuk ka te dhena te numerueshme ... \n" . mysql_error());

$tables_allocated=mysql_query("SELECT * FROM reservations_details WHERE flag='$flag_1' AND table_flag='$flag_1'")
or die("Nuk ka te dhena te numerueshme ... \n" . mysql_error());

$partyhalls_allocated=mysql_query("SELECT * FROM reservations_details WHERE flag='$flag_1' AND partyhall_flag='$flag_1'")
or die("Nuk ka te dhena te numerueshme ... \n" . mysql_error());

//get food names and ids from food_details table
$foods=mysql_query("SELECT * FROM food_details")
or die("Dicka nuk shkon ... \n" . mysql_error());
?>
<?php
    if(isset($_POST['Submit'])){
        //Function to sanitize values received from the form. Prevents SQL injection
        function clean($str) {
            $str = @trim($str);
            if(get_magic_quotes_gpc()) {
                $str = stripslashes($str);
            }
            return mysql_real_escape_string($str);
        }
        //get category id
        $id = clean($_POST['food']);
        
        //get ratings ids
        $ratings=mysql_query("SELECT * FROM ratings")
        or die("Dicka nuk shkon ... \n" . mysql_error());
        $row_1=mysql_fetch_array($ratings);
        $row_2=mysql_fetch_array($ratings);
        $row_3=mysql_fetch_array($ratings);
        $row_4=mysql_fetch_array($ratings);
        $row_5=mysql_fetch_array($ratings);
        if($row_1){
            $excellent=$row_1['rate_id'];
        }
        if($row_2){
            $good=$row_2['rate_id'];
        }
        if($row_3){
            $average=$row_3['rate_id'];
        }
        if($row_4){
            $bad=$row_4['rate_id'];
        }
        if($row_5){
            $worse=$row_5['rate_id'];
        }
        
        //selecting all records from the food_details and polls_details tables based on food id. Return an error if there are no records in the table
        $qry=mysql_query("SELECT * FROM food_details, polls_details WHERE polls_details.food_id='$id' AND food_details.food_id='$id'")
        or die("Dicka nuk shkon ... \n" . mysql_error());
        
        $excellent_qry=mysql_query("SELECT * FROM food_details, polls_details WHERE polls_details.food_id='$id' AND food_details.food_id='$id' AND polls_details.rate_id='$excellent'")
        or die("Dicka nuk shkon ... \n" . mysql_error()); 
        
        $good_qry=mysql_query("SELECT * FROM food_details, polls_details WHERE polls_details.food_id='$id' AND food_details.food_id='$id' AND polls_details.rate_id='$good'")
        or die("Dicka nuk shkon ... \n" . mysql_error()); 
        
        $average_qry=mysql_query("SELECT * FROM food_details, polls_details WHERE polls_details.food_id='$id' AND food_details.food_id='$id' AND polls_details.rate_id='$average'")
        or die("Dicka nuk shkon ... \n" . mysql_error()); 
        
        $bad_qry=mysql_query("SELECT * FROM food_details, polls_details WHERE polls_details.food_id='$id' AND food_details.food_id='$id' AND polls_details.rate_id='$bad'")
        or die("Dicka nuk shkon ... \n" . mysql_error());
        
        $worse_qry=mysql_query("SELECT * FROM food_details, polls_details WHERE polls_details.food_id='$id' AND food_details.food_id='$id' AND polls_details.rate_id='$worse'")
        or die("Dicka nuk shkon ... \n" . mysql_error());  
        
        $no_rate_qry=mysql_query("SELECT * FROM food_details WHERE food_id='$id'")
        or die("Dicka nuk shkon ... \n" . mysql_error());
    }
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Admin Index</title>
<link href="stylesheets/admin_styles.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="validation/admin.js">
</script>
</head>
<body>
<div id="page">
<div id="header">
<h1>Control Panel i administratorit</h1>
<a href="profile.php">Profili</a> | <a href="categories.php">Kategorite</a> | <a href="foods.php">Ushqimet</a> | <a href="accounts.php">Llogari</a> | <a href="orders.php">Porosi</a> | <a href="reservations.php">Rezervime</a> | <a href="specials.php">Speciale</a> | <a href="allocation.php">Staf</a> | <a href="messages.php">Mesazhet</a> | <a href="options.php">Opsionet</a> | <a href="logout.php">Logout</a>
</div>
<div id="container">
<table width="1000" align="center" style="text-align:center">
<CAPTION><h3>STATUS I TANISHEM</h3></CAPTION>
<tr>
    <th>Perdorues te regjistruar</th>
    <th>Porosite e kryera</th>
    <th>Porosite e perfunduara</th>
    <th>Porosi ne perpunim</th>  
    <th>Tavolina te rezervuara</th>
    <th>Tavolina te zena</th>
    <th>Tavolina ne perpunim</th>
    <th>PartyHall(s) te rezervuara</th>
    <th>PartyHall(s) te zena</th>
    <th>PartyHall(s) ne perpunim</th>    
</tr>

<?php
        $result1=mysql_num_rows($members);
        $result2=mysql_num_rows($orders_placed);
        $result3=mysql_num_rows($orders_processed);
        $result4=$result2-$result3; //gets pending order(s)
        $result5=mysql_num_rows($tables_reserved);
        $result6=mysql_num_rows($tables_allocated);
        $result7=$result5-$result6; //gets pending table(s)
        $result8=mysql_num_rows($partyhalls_reserved);
        $result9=mysql_num_rows($partyhalls_allocated);
        $result10=$result8-$result9; //gets pending partyhall(s)
        echo "<tr align=>";
            echo "<td>" . $result1."</td>";
            echo "<td>" . $result2."</td>";
            echo "<td>" . $result3."</td>";
            echo "<td>" . $result4."</td>";
            echo "<td>" . $result5."</td>";
            echo "<td>" . $result6."</td>";
            echo "<td>" . $result7."</td>";
            echo "<td>" . $result8."</td>";
            echo "<td>" . $result9."</td>";
            echo "<td>" . $result10."</td>";
        echo "</tr>";
?>
</table>
<hr>
<form name="foodStatusForm" id="foodStatusForm" method="post" action="index.php" onsubmit="return statusValidate(this)">
    <table width="360" align="center">
    <CAPTION><h3>RATINGS E KLIENTEVE (100%)</h3></CAPTION>
         <tr>
            <td>uUshqim</td>
            <td width="168"><select name="food" id="food">
            <option value="select">- zgjidhni ushqim -
            <?php 
            //loop through food_details table rows
            while ($row=mysql_fetch_array($foods)){
            echo "<option value=$row[food_id]>$row[food_name]"; 
            }
            ?>
            </select></td>
            <td><input type="submit" name="Submit" value="Show Ratings" /></td>
         </tr>
    </table>
</form>
<table width="900" align="center">
<tr>
    <th></th>
    <th>Shkelqyer</th>
    <th>Shume mire</th>
    <th>Mesatar</th>
    <th>Dobet</th>
    <th>Shume dobet</th>
</tr>

<?php
    if(isset($_POST['Submit'])){
        //actual values
        $excellent_value=mysql_num_rows($excellent_qry);
        $good_value=mysql_num_rows($good_qry);
        $average_value=mysql_num_rows($average_qry);
        $bad_value=mysql_num_rows($bad_qry);
        $worse_value=mysql_num_rows($worse_qry);
        //percentile rates
        $total_value=mysql_num_rows($qry);
        if($total_value != 0){
            $excellent_rate=$excellent_value/$total_value*100;
            $good_rate=$good_value/$total_value*100;
            $average_rate=$average_value/$total_value*100;
            $bad_rate=$bad_value/$total_value*100;
            $worse_rate=$worse_value/$total_value*100;
        }
        else{
            $excellent_rate=0;
            $good_rate=0;
            $average_rate=0;
            $bad_rate=0;
            $worse_rate=0;
        }
        //get food name
        if(mysql_num_rows($qry)>0){
            $row=mysql_fetch_array($qry);
            $food_name=$row['food_name'];
        }
        else{
            $row=mysql_fetch_array($no_rate_qry);
            $food_name=$row['food_name'];
        }
        echo "<tr>";
        echo "<th>" .$food_name."</th>";
        echo "<td>" .$excellent_value."(". $excellent_rate."%)"."</td>";
        echo "<td>" .$good_value."(". $good_rate."%)"."</td>";
        echo "<td>" .$average_value."(". $average_rate."%)"."</td>";
        echo "<td>" .$bad_value."(". $bad_rate."%)"."</td>";
        echo "<td>" .$worse_value."(". $worse_rate."%)"."</td>";
        echo "</tr>";
    }
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
