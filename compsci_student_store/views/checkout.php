<?php
/*
	checkout.php

	this page contains the checkout view, which shows the user their order before checkout takes place.

	March 13 2024.

	Mitchell Seitz.
*/
$checkoutView = 'hidden';
$emptyView = '';

//if the user is logged in, display the checkout page. 
if($_SESSION['loggedIn'] == TRUE && !cartEmpty()){
	//checkout view 
	$checkoutView = '';
	$emptyView = 'hidden';
}

?>

<h1 class="pagetitle"> Checkout </h1>

<!-- checkout view  -->
<div class="information" <?php echo $checkoutView; ?> >

  <label> Order Contents: </label>
  <br>
  <br>

  <?php
  	
  	//cart contents price 
  	$_SESSION['totalWithoutTax'] = 0;
  	$_SESSION['totalWithTax'] = 0;
  	$_SESSION['contentsString'] = '';
  	
  	//processing cart contents
  	global $products;
  	foreach ($products as $product){
  		if($_SESSION[$product['productCode']]){
  			//adding to total price 
  			$_SESSION['totalWithoutTax'] += ($product['price'] * $_SESSION[$product['productCode']]);
  			//adding product names and quantities to the thingy
  			$_SESSION['contentsString'] = $_SESSION['contentsString'] . (string) $_SESSION[$product['productCode']] . " x " .  $product['name'] . ' <br>' ;
  		}
  	}

  	//calculating price with tax
  	$_SESSION['totalWithTax'] = 1.13 * $_SESSION['totalWithoutTax'];

  	echo $_SESSION['contentsString'] . ' <br>';
  	echo 'Before Tax: ' . number_format($_SESSION['totalWithoutTax'], 2, '.', '')  . '<br>';
  	echo 'After Tax: ' . number_format($_SESSION['totalWithTax'], 2, '.', '') ;
	
  ?>
  <br><br>

  <form action="index.php" method="post">
	<input type="hidden" name="action" value="processOrder">

	<label > Address: </label>
	<input type='text' name = 'newAddress' value="<?php echo $_SESSION['customer']['address'];  ?>" ><br>
	<label style="font-size: 12px; color: red;"> <?php echo $addressError; ?></label><br>

	<label > City: </label>
	<input type='text' name = 'newCity' value="<?php echo $_SESSION['customer']['city'];  ?>" ><br>
	<label style="font-size: 12px; color: red;"> <?php echo $cityError; ?></label><br>

	<label > State: </label>
	<input type='text' name = 'newState' value="<?php echo $_SESSION['customer']['state'];  ?>" ><br>
	<label style="font-size: 12px; color: red;"> <?php echo $stateError; ?></label><br>
	
	<label > Postal Code: </label>
	<input type='text' name = 'newPostalCode' value="<?php echo $_SESSION['customer']['postalCode'];  ?>" ><br>
	<label style="font-size: 12px; color: red;"> <?php echo $postalCodeError; ?></label><br>

	<label>Country:</label>
    <select name="countrySelect">
        <!-- Default country, loaded using stored country code and country_from_code function in data/functions.php -->
        <option value="<?php echo $_SESSION['customer']['countryCode']; ?>" selected > 
        	<?php echo country_from_code($_SESSION['customer']['countryCode'])['countryName'];  ?> 
        </option>
        <!-- Loading in all countries  -->
        <?php foreach ($countries as $country) {  ?> 
            <option value="<?php echo $country['countryCode'];?>" > <?php echo $country['countryName'];?> </option>
        <?php } ?>  
    </select>
    <br>
    <br>
	
	<input type="submit" name="edit" value="Complete Order" style="font-size: 20px;" >
	<br>
  </form>

</div>

<!-- No user-->
<div class="information" <?php echo $emptyView; ?> >

  <p> Please log in and place items in cart to order! </p>

</div>