<?php
/*
  This is the account page, which holds the login page as well as the customer information
  if someone is logged in. Also contains the log out button. 

  March 7 2024 

  Mitchell Seitz
*/

//login page visibility toggle 
$loginVisible = '';
$customerInfoVisible = 'hidden';

if($_SESSION['loggedIn'] == TRUE){
	$loginVisible = "hidden"; //hiding login page
	$customerInfoVisible = '';//showing customer info and logut
}else{
	$loginVisible = ''; //hiding login page
	$customerInfoVisible = 'hidden';//showing customer info and logut
}

?>

<h1 class="pagetitle"> Account Page </h1>

<div class="information">

<!-- Login form, toggled to hidden when not needed. -->
<form action="index.php" method="post"  <?php echo $loginVisible; ?> >
	<input type="hidden" name="action" value="login">
	<br>
	<label>Email: </label>
	<br> 
	<input type="text" name="email" style="font-size: 25; width: 40%;" >
	<br><br>
	<label>Password: </label> 
	<br> 
	<input type="text" name="password" style="font-size: 25; width: 40%;"> 
	<br><br>
	<input type="submit" name="login" value="Login" style="font-size: 25px;" >
</form>
<br>

<!-- Create Acct form, toggled to hidden when not needed. -->
<form action="index.php" method="post"  <?php echo $loginVisible; ?> >
	<input type="hidden" name="action" value="accountCreator">
	<input type="submit" name="login" value="Create Account" style="font-size: 25px;" >
</form>

<!-- Customer information form, contains relevant info about customer echoed from the session-->
<form action="index.php" method="post"  <?php echo $customerInfoVisible; ?> >
	<input type="hidden" name="action" value="editCustomer">
	<label > Email: <?php echo $_SESSION['customer']['email']; ?>  </label><br>
	<label > Phone: <?php echo $_SESSION['customer']['phone'];  ?></label><br>
	<label > Password: ********** </label><br>
	<br>
	<label > First Name: <?php echo $_SESSION['customer']['firstName'];  ?> </label><br>
	<label > Last Name: <?php echo $_SESSION['customer']['lastName'];  ?> </label><br>
	<br>
	<label > Address: <?php echo $_SESSION['customer']['address'];  ?> </label><br>
	<label > City: <?php echo $_SESSION['customer']['city'];  ?> </label><br>
	<label > State/Province: <?php echo $_SESSION['customer']['state'];  ?> </label><br>
	<label > Country: <?php echo $_SESSION['customer']['countryCode'];  ?> </label><br>
	<label > Postal Code: <?php echo $_SESSION['customer']['postalCode'];  ?> </label><br><br>
	<input type="submit" name="edit" value="Edit Customer Information" style="font-size: 20px;" >
</form>
<br>

<!-- View orders button-->
<form action="index.php" method="post"  style="margin-top: 0px" <?php echo $customerInfoVisible; ?> >
	<input type="hidden" name="action" value="viewOrders">
	<input type="submit" name="orders" value="View Past Orders" style="font-size: 20px;">
</form>
<br>

<!-- Logout form, toggled to hidden when not needed. -->
<form action="index.php" method="post"  style="margin-top: 0px" <?php echo $customerInfoVisible; ?> >
	<input type="hidden" name="action" value="logout">
	<input type="submit" name="logout" value="Logout" style="font-size: 35px;" >
</form>

</div>
