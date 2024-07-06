<?php
/*
  This is the edit account page. Allows logged in users to edit their account

  March 11 2024 

  Mitchell Seitz
*/

//login page visibility toggle 
$customerInfoVisible = 'hidden';
//toggling view
if($_SESSION['loggedIn'] != TRUE){
	$customerInfoVisible = '';//showing customer info and logut
}else{
	$customerInfoVisible = 'hidden';//showing customer info and logut
}

//loading countries in from database
$countries = get_countries();

?>

<h1 class="pagetitle"> Create Account Page </h1>

<div class="information">

<!-- Customer information form, contains relevant info about customer echoed from the session-->
<form action="index.php" method="post"  <?php echo $customerInfoVisible; ?> >
	<input type="hidden" name="action" value="createAccount">
	<label > Email: </label>
	<input type='text' name = 'newEmail' value="" > <br>
	<label style="font-size: 12px; color: red;"> <?php echo $emailError; ?></label><br>

	<label > Password: </label>
	<input type='text' name = 'newPassword' value="" ><br>
	<label style="font-size: 12px; color: red;"> <?php echo $passwordError; ?></label><br>

	<label > Phone (XXX) XXX-XXXX: </label>
	<input type='text' name = 'newPhone' value="" ><br>
	<label style="font-size: 12px; color: red;"> <?php echo $phoneError; ?></label><br>

	<label > First Name: </label>
	<input type='text' name = 'newFirstName' value="" ><br>
	<label style="font-size: 12px; color: red;"> <?php echo $firstNameError; ?></label><br>

	<label > Last Name: </label>
	<input type='text' name = 'newLastName' value="" ><br>
	<label style="font-size: 12px; color: red;"> <?php echo $lastNameError; ?></label><br>

	<label > Address: </label>
	<input type='text' name = 'newAddress' value="" ><br>
	<label style="font-size: 12px; color: red;"> <?php echo $addressError; ?></label><br>

	<label > City: </label>
	<input type='text' name = 'newCity' value="" ><br>
	<label style="font-size: 12px; color: red;"> <?php echo $cityError; ?></label><br>

	<label > State: </label>
	<input type='text' name = 'newState' value="" ><br>
	<label style="font-size: 12px; color: red;"> <?php echo $stateError; ?></label><br>
	
	<label > Postal Code: </label>
	<input type='text' name = 'newPostalCode' value="" ><br>
	<label style="font-size: 12px; color: red;"> <?php echo $postalCodeError; ?></label><br>

	<label>Country:</label>
    <select name="countrySelect">
        <!-- Loading in all countries  -->
        <?php foreach ($countries as $country) {  ?> 
            <option value="<?php echo $country['countryCode'];?>" > <?php echo $country['countryName'];?> </option>
        <?php } ?>  
    </select>
    <br>
    <br>
	
	<input type="submit" name="edit" value="Create Account" style="font-size: 20px;" >
</form>
<br>

</div>