<?php

/*
This file allows for connection to the database given for this project.

Mitchell Seitz, TRU ID T00729116, Feb 14/2023
*/
// This file is based on the equivalent file from the guitar store program in chapter 6 of our course textbook

$dsn = 'mysql:host=localhost;dbname=compsci_store_database'; //modified to point to our tech_support database
//our tech support credentials
$username = 'css_internal'; // Change this to a false username to test the error page--------~~~~~~~~
$password = 'PaulAtreides1998';

//now we try and access the database, or will be directed to an error page if it does not work. 
try {
    $db = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    session_start();//start session
    //set error message and redirect to error page.
    $_SESSION['error_message'] = '<br><br> Error: Could not access database. <br><br>' . $e->getMessage();
    header("Location: errorPage.php");
}

include_once "functions.php"; //loading in our functions file 

//now we try and get the products loaded in. function in file products.php
$products = get_products();

?>