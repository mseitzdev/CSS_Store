<?php 
/*
	This file contains the non-class functions for this program, 
	and has functions that can get products and countries from 
	the database, log the customer in, validate customer input, 
	log the customer out, update customer's code in the database, 
	get customer's orders, delete customers, handle the cart and 
	create new orders, and more.

	Created by Mitchell Seitz

	March 7 2024
*/
 
//this is the function that loads in products from our database and returns them as an array.
function get_products(){
	//now we try and get the products loaded in
	try{
	  global $db;
	  //loading in our products
	  $query = "SELECT * FROM products"; 
	  $statement = $db->prepare($query); 
	  $statement->execute();
	  $products = $statement->fetchAll(); 
	  $statement->closeCursor();

	  //checking to make sure products loaded in
	  if($products == NULL || $products == FALSE){
	  	throw new Exception("Error, Products not loaded.");
	  }else{
	  	return $products; //returning products
	  }
	  
	}catch (Exception $e) {
		session_start();//start session
		//set error message and redirect to error page.
	    $_SESSION['error_message'] = '<br><br> Error: Could not load products from database. <br><br>' . $e->getMessage();
	    header("Location: errorPage.php");
	    return NULL;
	}
}

//gets prodcuts ordered by price Ascending
function get_productsByPriceAsc(){
	//now we try and get the products loaded in
	try{
	  global $db;
	  //loading in our products
	  $query = "SELECT * FROM products ORDER BY price ASC"; 
	  $statement = $db->prepare($query); 
	  $statement->execute();
	  $products = $statement->fetchAll(); 
	  $statement->closeCursor();

	  //checking to make sure products loaded in
	  if($products == NULL || $products == FALSE){
	  	throw new Exception("Error, Products not loaded.");
	  }else{
	  	return $products; //returning products
	  }
	  
	}catch (Exception $e) {
		session_start();//start session
		//set error message and redirect to error page.
	    $_SESSION['error_message'] = '<br><br> Error: Could not load products from database. <br><br>' . $e->getMessage();
	    header("Location: errorPage.php");
	    return NULL;
	}
}

//gets prodcuts ordered by price Descednign
function get_productsByPriceDesc(){
	//now we try and get the products loaded in
	try{
	  global $db;
	  //loading in our products
	  $query = "SELECT * FROM products ORDER BY price DESC"; 
	  $statement = $db->prepare($query); 
	  $statement->execute();
	  $products = $statement->fetchAll(); 
	  $statement->closeCursor();

	  //checking to make sure products loaded in
	  if($products == NULL || $products == FALSE){
	  	throw new Exception("Error, Products not loaded.");
	  }else{
	  	return $products; //returning products
	  }
	  
	}catch (Exception $e) {
		session_start();//start session
		//set error message and redirect to error page.
	    $_SESSION['error_message'] = '<br><br> Error: Could not load products from database. <br><br>' . $e->getMessage();
	    header("Location: errorPage.php");
	    return NULL;
	}
}

//gets prodcuts ordered by price Descednign
function get_productsByAlphabet(){
	//now we try and get the products loaded in
	try{
	  global $db;
	  //loading in our products
	  $query = "SELECT * FROM products ORDER BY name"; 
	  $statement = $db->prepare($query); 
	  $statement->execute();
	  $products = $statement->fetchAll(); 
	  $statement->closeCursor();

	  //checking to make sure products loaded in
	  if($products == NULL || $products == FALSE){
	  	throw new Exception("Error, Products not loaded.");
	  }else{
	  	return $products; //returning products
	  }
	  
	}catch (Exception $e) {
		session_start();//start session
		//set error message and redirect to error page.
	    $_SESSION['error_message'] = '<br><br> Error: Could not load products from database. <br><br>' . $e->getMessage();
	    header("Location: errorPage.php");
	    return NULL;
	}
}

//this is the login function, returns customer information to be handled by index.php
function customer_login($email, $password){
	//now we try and get the customer logged in
	try{
	  //getting database
	  global $db;
	  //loading in our customer
	  $query = "SELECT * FROM customers WHERE email = :email AND password = :password "; 
	  $statement = $db->prepare($query); 
	  $statement->bindValue(':email' , $email);
	  $statement->bindValue(':password' , $password);
	  $statement->execute();
	  $customer = $statement->fetch(); 
	  $statement->closeCursor();

	  //checking to make sure customer valid
	  if($customer == NULL || $customer == FALSE){
	  	//throwing exception
	  	throw new Exception("No customer with matching login information found.");
	  }else{
	  	//toggling data based on customer login success
	  	session_start();
		if($customer == NULL or $customer == FALSE){
		    $_SESSION['loggedIn'] = FALSE;
		}else{
		    $_SESSION['loggedIn'] = TRUE; 
		    //storing customer in session
		    $_SESSION['customer'] = $customer;
		}
	  	return $customer;//returning loaded customer
	  }
	  
	}catch (Exception $e) {
	    session_start();//start session
		//set error message and redirect to error page.
	    $_SESSION['error_message'] = '<br><br>' . $e->getMessage();
	    header("Location: errorPage.php");
	    return NULL;
	}
}


//this is the logout function, logs out customers and updates session as needed. 
function customer_logout(){
	//now we try and get the customer logged in
	$_SESSION['loggedIn'] = FALSE; 
    //storing customer in session
    $_SESSION['customer'] = NULL;
}

//this function gets the countries from the database, for use 
//during account edit/creation and ordering.
function get_countries(){
	session_start();// starting session 
    try{
    	//getting database
	  	global $db;
        //loading in our countries
        $query = "SELECT * FROM countries"; 
        $statement = $db->prepare($query); 
        $statement->execute();
        $countries = $statement->fetchAll(); 
        $statement->closeCursor();

        //if countries load fails
        if($countries == NULL || $countries == FALSE){
		    //throwing exception
	  		throw new Exception("Error: Could not access countries.");
		}else{
			//return countries array
			return $countries;
		}

    }catch (Exception $e){
        session_start();//start session
		//set error message and redirect to error page.
	    $_SESSION['error_message'] = '<br><br> Error: Could not load countries from database. <br><br>' . $e->getMessage();
	    header("Location: errorPage.php");
	    return NULL;
    }
}

//this function gets a country from the country code
function country_from_code($codeIn){
	//trying to get country from code
    try{
    	//getting database
	  	global $db;
        //loading in our countries
        $query = "SELECT * FROM countries WHERE countryCode = :countryCode"; 
        $statement = $db->prepare($query); 
        $statement->bindValue(":countryCode", $codeIn);
        $statement->execute();
        $country = $statement->fetch(); 
        $statement->closeCursor();
        return $country;
    }catch (Exception $e){
    	//return null if no country found
	    return NULL;
    }
}


//this function checks if an email is valid format and not already taken by a user account.
function checkEmail($emailIN){

  //First, we check if the email is valid
  if (!filter_var($emailIN, FILTER_VALIDATE_EMAIL)) {
	return 'Email format invalid.';
  }else{
  	try{
	  //getting database
	  global $db;
	  //loading in our customer's current data
	  $query = "SELECT * FROM customers WHERE email = :email"; 
	  $statement = $db->prepare($query); 
	  $statement->bindValue(':email' , $emailIN);
	  $statement->execute();
	  $customer = $statement->fetch(); 
	  $statement->closeCursor();

	  //checking if email is taken by a different customer
	  session_start();
	  if($customer != NULL && $customer['customerID'] != $_SESSION['customer']['customerID']){ //if email given is already taken by a different acct
	  	return 'Email already registered.';
	  }
    }catch (Exception $e){
      //return error message
      return 'Database Access Failure';
    }
  }

  return NULL; //if no issues are found, return NULL
}

//this function checks if the customer's new/edited password is valid
function checkPassword($passwordIN){
  //checking if password is valid
  if ($passwordIN == NULL || $passwordIN == FALSE || strlen($passwordIN) < 6 || strlen($passwordIN) > 21 ) {
        return "Password must be between 6 and 21 characters.";
    }

  return NULL; //if no issues are found, return NULL
}

//check if phone number is valid
function checkPhone($phoneIN){
  //using regex to decide if the phone number if valid. The pattern is taken from Page 473 of Murach's php and mysql.
  if(preg_match('/^\(\d{3}\) ?\d{3}-\d{4}$/', $phoneIN) != 1){
  	return 'Please check number and format as: (XXX) XXX-XXXX';//error with recomended formatting.
  }

  return NULL; //if no issues are found, return NULL
}

//check if first name, last name, address, city, state/province, and postal code are valid.
function checkSix($inputIN){
  //checking values for valid data
    if ($inputIN == NULL || $inputIN == FALSE || strlen($inputIN) < 1 || strlen($inputIN) > 51) {
        //giving error
        return "Length must be between 1 and 51 characters long. ";
    }

  return NULL; //if no issues are found, return NULL
}


//edit user function, changes the information for the current user.
function editUser($customerIDIN, $updatedEmail, $updatedPassword, $updatedPhone,  $updatedFirstName, $updatedLastName , 
	              $updatedAddress, $updatedCity, $updatedState, $updatedPostalCode , $updatedCountryCode){
	try{
        global $db;
        session_start();
        //now we edit our customer
        $query = "UPDATE customers
                  SET firstName = :firstName , lastName = :lastName, address = :address, 
                      city = :city, state = :state, postalCode = :postalCode, countryCode = :countryCode, 
                      phone = :phone, email = :email , password = :password
                  WHERE customerID = :customerID";
        $statement = $db->prepare($query);
        $statement->bindValue(':customerID', $customerIDIN);
        $statement->bindValue(':firstName', $updatedFirstName);
        $statement->bindValue(':lastName', $updatedLastName);
        $statement->bindValue(':address', $updatedAddress);
        $statement->bindValue(':city', $updatedCity);
        $statement->bindValue(':state', $updatedState);
        $statement->bindValue(':postalCode', $updatedPostalCode);
        $statement->bindValue(':countryCode', $updatedCountryCode);
        $statement->bindValue(':phone', $updatedPhone);
        $statement->bindValue(':email', $updatedEmail);
        $statement->bindValue(':password', $updatedPassword);
        $statement->execute();
        $statement->closeCursor();

        return TRUE;

    }catch (Exception $e) {
        session_start();//start session
		//set error message and redirect to error page.
	    $_SESSION['error_message'] = '<br><br> Error: Could not edit user in database. <br><br>' . $e->getMessage();
	    header("Location: errorPage.php");
	    return FALSE;
    }
}

//create user function, creates a new user
function createUser($updatedEmail, $updatedPassword, $updatedPhone,  $updatedFirstName, $updatedLastName , 
	              $updatedAddress, $updatedCity, $updatedState, $updatedPostalCode , $updatedCountryCode){
	try{

		//accessing database and session
        global $db;
        session_start();
        //now we edit our customer
        $query = "INSERT INTO customers
                  SET firstName = :firstName , lastName = :lastName, address = :address, 
                      city = :city, state = :state, postalCode = :postalCode, countryCode = :countryCode, 
                      phone = :phone, email = :email , password = :password";
        $statement = $db->prepare($query);
        $statement->bindValue(':firstName', $updatedFirstName);
        $statement->bindValue(':lastName', $updatedLastName);
        $statement->bindValue(':address', $updatedAddress);
        $statement->bindValue(':city', $updatedCity);
        $statement->bindValue(':state', $updatedState);
        $statement->bindValue(':postalCode', $updatedPostalCode);
        $statement->bindValue(':countryCode', $updatedCountryCode);
        $statement->bindValue(':phone', $updatedPhone);
        $statement->bindValue(':email', $updatedEmail);
        $statement->bindValue(':password', $updatedPassword);
        $statement->execute();
        $statement->closeCursor();

        return TRUE;
    }catch (Exception $e) {
        session_start();//start session
		//set error message and redirect to error page.
	    $_SESSION['error_message'] = '<br><br> Error: Could not create user in database. <br><br>' . $e->getMessage();
	    header("Location: errorPage.php");
	    return FALSE;
    }
}

//this function can be used to delete a user account.
function delete_account(){

	//trying to delete user account
    try{

    	//start session and get the customer info 
    	session_start();
    	$id = $_SESSION['customer']['customerID']; 
    	$email = $_SESSION['customer']['email']; 
    	$password = $_SESSION['customer']['password'];
    	$phone = $_SESSION['customer']['phone']; 
    	$firstName = $_SESSION['customer']['firstName'];
    	$lastName = $_SESSION['customer']['lastName'];
    	$address = $_SESSION['customer']['address']; 
    	$city = $_SESSION['customer']['city'];
    	$state = $_SESSION['customer']['state']; 
    	$postalCode = $_SESSION['customer']['postalCode']; 
    	$countryCode = $_SESSION['customer']['countryCode'];

    	//getting database
	  	global $db;

        //adding the customer to the deleted table
        $query = "INSERT INTO deletedCustomers
                  SET customerID = :customerID, firstName = :firstName , lastName = :lastName, address = :address, 
                      city = :city, state = :state, postalCode = :postalCode, countryCode = :countryCode, 
                      phone = :phone, email = :email , password = :password";
        $statement = $db->prepare($query);
        $statement->bindValue(":customerID", $id); 
        $statement->bindValue(":firstName", $firstName);
        $statement->bindValue(":lastName", $lastName);
        $statement->bindValue(":address", $address);
        $statement->bindValue(":city", $city);
        $statement->bindValue(":state", $state);
        $statement->bindValue(":postalCode", $postalCode);
        $statement->bindValue(":countryCode", $countryCode);
        $statement->bindValue(":phone", $phone);
        $statement->bindValue(":email", $email);
        $statement->bindValue(":password", $password);
        $statement->execute();
        $statement->closeCursor();
		
        //deleting the customer from the customer table 
        $query = "DELETE FROM customers
				  WHERE customerID = :customerID ";
		$statement = $db->prepare($query);
        $statement->bindValue(":customerID", $id); 
        $statement->execute();
        $statement->closeCursor();
        
    }catch (Exception $e){
        session_start();//start session
		//set error message and redirect to error page.
	    $_SESSION['error_message'] = '<br><br> Error: Could not delete user from database.<br><br>' . $e->getMessage();
	    header("Location: errorPage.php");
	    return NULL;
    }
}

//This is the method to add items to the cart.
function addToCart($productCode, $quantity){

	session_start();

	//if no cart listing exists, create a cart listing in the session.
	if(!isset($_SESSION[$productCode])){
		$_SESSION[$productCode] = 0;
	}

	//updating cart quantity
	$_SESSION[$productCode] += $quantity;

	//check that there is no more than 10 of an item in the cart
	//fix it if there is 
	if($_SESSION[$productCode] > 10){
		$_SESSION[$productCode] = 10;
		return FALSE;
	}

	return TRUE;
}

//removing a product from cart
function removeFromCart($productCode){
	$_SESSION[$productCode] = 0;
}


//check if there are any products in the cart, returns true if cart empty
function cartEmpty(){
	//if cart is empty, this is true.
	$cartEmpty = TRUE;

	//check if product in cart
	global $products;
	session_start();
	foreach($products as $product){
		if($_SESSION[$product['productCode']]){
			$cartEmpty = FALSE;
		}
	}

	return $cartEmpty; //true if cart empty
}

//getting orders from a logged - in customer
function getOrders(){

	//trying to access orders for a customer.
    try{

    	//start session and get the customer info 
    	session_start();
    	$id = $_SESSION['customer']['customerID']; 
    	
    	//getting database
	  	global $db;

        //getting orders from the database, ordered from most to least recent.
        $query = "SELECT * FROM orders WHERE customerID = :customerID ORDER BY orderDate DESC";
        $statement = $db->prepare($query);
        $statement->bindValue(":customerID", $id); 
        $statement->execute();
        $orders = $statement->fetchAll(); 
        $statement->closeCursor();

        //return null if no orders found
        if($orders == FALSE || $orders == NULL){
        	return NULL;
        }

        return $orders;
        
    }catch (Exception $e){
        session_start();//start session
		//set error message and redirect to error page.
	    $_SESSION['error_message'] = '<br><br> Error: Could not get orders from database <br><br>' . $e->getMessage();
	    header("Location: errorPage.php");
	    return NULL;
    }
}

function newOrder($customerID, $contents, $price, $taxedPrice, $address, $city, $state, $postalCode, $countryCode){

	//trying to place new order
    try{

    	//start session
    	session_start();
    	
    	//getting database
	  	global $db;

	  	//now, we try and add an order to the database with the given information.
	  	$query = "INSERT INTO orders
                  SET customerID = :customerID, contents = :contents, address = :address, 
                      city = :city, state = :state, postalCode = :postalCode, 
                      countryCode = :countryCode, price = :price, 
                      taxedPrice = :taxedPrice, orderDate = CURRENT_TIMESTAMP, name = :name";
        $statement = $db->prepare($query);
        $statement->bindValue(":customerID", $customerID); 
        $statement->bindValue(":contents", $contents); 
        $statement->bindValue(":address", $address);
        $statement->bindValue(":city", $city);
        $statement->bindValue(":state", $state);
        $statement->bindValue(":postalCode", $postalCode);
        $statement->bindValue(":countryCode", $countryCode);
        $statement->bindValue(":price", $price);
        $statement->bindValue(":taxedPrice", $taxedPrice);
        $statement->bindValue(":name", ($_SESSION['customer']['firstName'] . " " . $_SESSION['customer']['lastName'] ));
        $statement->execute();
        $statement->closeCursor();

        return TRUE;
        
    }catch (Exception $e){
        session_start();//start session
		//set error message and redirect to error page.
	    $_SESSION['error_message'] = '<br><br> Error: Could not create new order. <br><br>' . $e->getMessage();
	    header("Location: errorPage.php");
	    return FALSE;
    }

}

?>