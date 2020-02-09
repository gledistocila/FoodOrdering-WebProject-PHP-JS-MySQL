<?php
$link = mysql_connect('localhost', 'root', '') or die(mysql_error());
mysql_select_db('polling') or die(mysql_error());

session_start();
//If your session isn't valid, it returns you to the login screen for protection
if(empty($_SESSION['member_id'])){
 header("location:access-denied.php");
}
?>
<?php
// retrieving positions sql query
$positions=mysql_query("SELECT * FROM tbPositions")
or die("Nuk ka te dhena qe te shfaqen ... \n" . mysql_error()); 
?>
<?php
    // retrieval sql query
// check if Submit is set in POST
 if (isset($_POST['Submit']))
 {
 // get position value
 $position = addslashes( $_POST['position'] ); //prevents types of SQL injection
 
 // retrieve based on position
 $result = mysql_query("SELECT * FROM tbCandidates WHERE candidate_position='$position'")
 or die(" Nuk ka te dhena momentalisht ... \n"); 
 
 // redirect back to vote
 //header("Location: vote.php");
 }
 else
 // do something
  
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Faqja e votimit</title>
<link href="css/user_styles.css" rel="stylesheet" type="text/css" />   
<script language="JavaScript" src="js/user.js">
</script>
<script type="text/javascript">
function getVote(int)
{
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }

xmlhttp.open("GET","save.php?vote="+int,true);
xmlhttp.send();
}

function getPosition(String)
{
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }

xmlhttp.open("GET","vote.php?position="+String,true);
xmlhttp.send();
}
</script>
<script type="text/javascript">
$(document).ready(function(){
   var j = jQuery.noConflict();
    j(document).ready(function()
    {
        j(".refresh").everyTime(1000,function(i){
            j.ajax({
              url: "admin/refresh.php",
              cache: false,
              success: function(html){
                j(".refresh").html(html);
              }
            })
        })
        
    });
   j('.refresh').css({color:"green"});
});
</script>
</head>
<body bgcolor="tan">
<center><a href ="https://sourceforge.net/projects/pollingsystem/"><img src = "images/logo" alt="site logo"></a></center><br>     
<center><b><font color = "brown" size="6">Sistem i thjeshte votimi</font></b></center><br><br>
<body>
<div id="page">
<div id="header">
  <h1>SONDAZHET AKTUALE</h1>
  <a href="student.php">Kryefaqja</a> | <a href="vote.php">Sondazhet aktuale</a> | <a href="manage-profile.php">Menaxhimi i profilit tim</a> | <a href="logout.php">Logout</a>
</div>
<div class="refresh">
</div>
<div id="container">
<table width="420" align="center">
<form name="fmNames" id="fmNames" method="post" action="vote.php" onsubmit="return positionValidate(this)">
<tr>
    <td>Zgjidhni pozicionin</td>
    <td><SELECT NAME="position" id="position" onchange="getPosition(this.value)">
    <OPTION VALUE="select">zgjidhni
    <?php 
    //loop through all table rows
    while ($row=mysql_fetch_array($positions)){
    echo "<OPTION VALUE=$row[position_name]>$row[position_name]"; 
    //mysql_free_result($positions_retrieved);
    //mysql_close($link);
    }
    ?>
    </SELECT></td>
    <td><input type="submit" name="Submit" value="See Candidates" /></td>
</tr>
<tr>
    <td>&nbsp;</td> 
    <td>&nbsp;</td>
</tr>
</form> 
</table>
<table width="270" align="center">
<form>
<tr>
    <th>Kandidatet:</th>
</tr>
<?php
//loop through all table rows
//if (mysql_num_rows($result)>0){
  if (isset($_POST['Submit'])){
while ($row=mysql_fetch_array($result)){
echo "<tr>";
echo "<td>" . $row['candidate_name']."</td>";
echo "<td><input type='radio' name='vote' value='$row[candidate_name]' onclick='getVote(this.value)' /></td>";
echo "</tr>";
}
mysql_free_result($result);
mysql_close($link);
//}
  }
else
// do nothing
?>
<tr>
    <h3>Klikoni mbi rrethin korrespondues te secilit kandidat per te votuar.Nuk mund te votoni perm e shume se nje kandidat.Ky proces nuk mund te kthehet mbrapsht keshtu qe votoni me kujdes.</h3>
    <td>&nbsp;</td>
</tr>
</form>
</table>
</div>
<div id="footer"> 
  <div class="bottom_addr">&copy; 2020 Sistem i thjeshte votimi. Te gjitha te drejtat e rezervuara</div>
</div>
</div>
</body>
</html>
