<?php
    //Start session
    session_start();
    
    //Include database connection details
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
    
    //Function to sanitize values received from the form. Prevents SQL injection
    function clean($str) {
        $str = @trim($str);
        if(get_magic_quotes_gpc()) {
            $str = stripslashes($str);
        }
        return mysql_real_escape_string($str);
    }
    
    //setup a directory where images will be saved 
    $target = "../images/"; 
    $target = $target . basename( $_FILES['photo']['name']); 
    
    //Sanitize the POST values
    $name = clean($_POST['name']);
    $description = clean($_POST['description']);
    $price = clean($_POST['price']);
    $category = clean($_POST['category']);
    $photo = clean($_FILES['photo']['name']);

    //Create INSERT query
    $qry = "INSERT INTO food_details(food_name, food_description, food_price, food_photo, food_category) VALUES('$name','$description','$price','$photo','$category')";
    $result = @mysql_query($qry);
    
    //Check whether the query was successful or not
    if($result) {
            //Writes the photo to the server 
         $moved = move_uploaded_file($_FILES['photo']['tmp_name'], $target);
         
         if($moved) 
         {      
             //everything is okay
             echo "Fotoja ". basename( $_FILES['photo']['name']). " eshte ngarkuar dhe informacioni juaj eshte shtuar ne direktori."; 
         } else {  
             //Gives an error if its not okay 
             echo "Me falni,kishte nje problem duke ngarkuar foton. "  . $_FILES["photo"]["error"]; 
         }
        header("location: foods.php");
        exit();
    }else {
        die("Deshtoi " . mysql_error());
    } 
 ?>