<!-- This file is based on the header for the guitar shop program from the textbook-->
<?php 

// make sure the page uses a secure connection - Forces secure connection on all pages, as header is included everywhere. 
$https = filter_input(INPUT_SERVER, 'HTTPS'); 
if (!$https) {
    $host = filter_input(INPUT_SERVER, 'HTTP_HOST'); 
    $uri = filter_input(INPUT_SERVER, 'REQUEST_URI'); 
    $url = 'https://' . $host . $uri; header("Location: " . $url); 
    exit();
} 

//starting session 
session_start();

?>

<!DOCTYPE html>
<html>
<!-- the head section -->
<head>
    <title> CompSci Student Store </title>
    <!-- <link rel="stylesheet" type="text/css" href="main.css"> -->
</head>

<!-- Linking in the main CSS file to our program. -->
<style>
    <?php include  "res/main.css" ; ?>
</style>

<!-- the header section -->
<body>
<header>
    <img src="res/csstore.png" height="80">
</header>

<!-- this is the menu link and login information  -->
<div style="height: 45px; background-color: steelblue;">
    <h1 style="text-align: left; width: 50%; background-color: steelblue; color: black; 
               display: inline-block; float: left;"> 
        <?php include 'res/menu.php'; ?> Menu 
    </h1>
    <h1 style="text-align: right; width: 48%; background-color: steelblue; color: black; 
               display: inline-block; float: right; margin-top: 5px; margin-right: 2%; font-size: 25px;"> 
        <?php 
            //showing the login or view account button depending on if the user is logged in
            if($_SESSION['loggedIn'] == false || $_SESSION['loggedIn'] == NULL){
                echo '<form action="index.php" method="post">';
                echo '<input type="submit" name="action" value="Product Catalog" style="font-size: 25px;" >';
                echo ' ';
                echo '<input type="submit" name="action" value="Cart" style="font-size: 25px;" >';
                echo ' ';
                echo '<input type="submit" name="action" value="Account Login" style="font-size: 25px;" >';
                echo '</form>';
            }else{
                echo '<form action="index.php" method="post">';
                echo '<input type="submit" name="action" value="Product Catalog" style="font-size: 25px;" >';
                echo ' ';
                echo '<input type="submit" name="action" value="Cart" style="font-size: 25px;" >';
                echo ' ';
                echo '<input type="submit" name="action" value="View Account" style="font-size: 25px;" >';
                echo '</form>';
            }
        ?>
    </h1>
</div>

