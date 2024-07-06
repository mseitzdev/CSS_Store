<!-- 

Index.php , the main file for the student store

Programmed by Mitchell Seitz, March 6 2024. 

This file will selectively display other files 
containing contents of the website, as well as 
handle processing of user input and function 
calls.

-->

<?php 
//start session
session_start();

//inclding program header
include 'res/header.php'; 

?>

<main>
    
    <div class="information">
        <h1> Oops! Something went wrong. </h1>
        <?php 
            //echo the error message
            echo $_SESSION['error_message'];
        ?>
    </div>

</main>

<?php 
//including footer 
include 'res/footer.php'; 
?>