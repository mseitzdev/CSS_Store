<!-- 

Index.php , the main file for the student store

Programmed by Mitchell Seitz, March 6 2024. 

This file will selectively display other files 
containing contents of the website, as well as 
handle processing of user input and function 
calls.

-->

<?php 
// requires the database.php file, which logs us in to the sql database
// also includes functions.php and the methods therein, as well as 
//forcing a secure connection.
require 'data/database.php'; 

session_start();//starting session

//getting input information
$action = filter_input(INPUT_POST, 'action');//getting the action
$contentID = filter_input(INPUT_POST, 'currentID'); //getting the current page on reload

//if the current view is not set, we set it to 0 for our home page.
if (!isset($contentID)) {
  $contentID = 'views/home.php';
}

//displaying appropriate screen based on action 
if($action == 'display_product'){ //product display
    
    //product info get
    $productName = filter_input(INPUT_POST, 'productName');
    $productCode = filter_input(INPUT_POST, 'productCode');
    $productDesc = filter_input(INPUT_POST, 'productDesc');
    $productPrice = filter_input(INPUT_POST, 'productPrice');
    $productImage = filter_input(INPUT_POST, 'productImage');

    $contentID = 'views/productView.php';

}else if($action == 'About'){ //about page display

    $contentID = 'views/about.php';

}else if($action == 'Home'){ //home page display

    $contentID = 'views/home.php';

}else if($action == 'viewAccount' || $action == 'View Account' || $action == 'Account Login'){ //view customer account

    $contentID = 'views/accountView.php';

}else if($action == 'login'){ //logging in the customer and/or displaying the login page

    //collecting given inputs 
    $customerEmail = filter_input(INPUT_POST, 'email');
    $password = filter_input(INPUT_POST, 'password');

    //logging the user in using the customer login method from data/functions.php
    customer_login($customerEmail, $password);

    //wiping login info to prevetn issues
    $customerEmail = NULL;
    $password = NULL;

    $contentID = 'views/accountView.php'; //displaying account method

}else if($action == 'logout'){ //logging out
    
    //logging out using the customer_logout function from data/functions.php
    customer_logout();
    //showing account view 
    $contentID = 'views/accountView.php';

}else if($action == 'editCustomer'){ //bringing to the edit customer screen

    //if the customer is logged in they go to the edit account screen, 
    if($_SESSION['loggedIn'] == TRUE){
        //showing edit account view 
        $contentID = 'views/editAccount.php';
    }else{ //if not logged in they are shown the login screen
        $contentID = 'views/accountView.php'; 
    }

}else if($action == 'saveCustomerInformation'){ //editing customer with collected information

    //if the customer is logged in they go to the edit account screen, 
    if($_SESSION['loggedIn'] == TRUE){

        //getting customer info
        $customerID = $_SESSION['customer']['customerID'];
        $updatedEmail = filter_input(INPUT_POST, 'newEmail');
        $updatedPassword = filter_input(INPUT_POST, 'newPassword');
        $updatedPhone = filter_input(INPUT_POST, 'newPhone');
        $updatedFirstName = filter_input(INPUT_POST, 'newFirstName');
        $updatedLastName = filter_input(INPUT_POST, 'newLastName');
        $updatedAddress = filter_input(INPUT_POST, 'newAddress');
        $updatedCity = filter_input(INPUT_POST, 'newCity');
        $updatedState= filter_input(INPUT_POST, 'newState');
        $updatedPostalCode = filter_input(INPUT_POST, 'newPostalCode');

        //getting country code 
        $updatedCountryCode = filter_input(INPUT_POST, 'countrySelect', FILTER_SANITIZE_STRING);

        //checking info using methods from data/functions.php
        $emailError = checkEmail($updatedEmail);
        $passwordError = checkPassword($updatedPassword);
        $phoneError = checkPhone($updatedPhone);
        //these six peices of information use the same verifier method.
        $firstNameError = checkSix($updatedFirstName);
        $lastNameError = checkSix($updatedLastName);
        $addressError = checkSix($updatedAddress);
        $cityError = checkSix($updatedCity);
        $stateError = checkSix($updatedState);
        $postalCodeError = checkSix($updatedPostalCode);

        //now, we check for error messages. if an error is found, we display the editing page that now echoes the error message.
        if($emailError != NULL || $passwordError != NULL || $phoneError != NULL || $firstNameError != NULL 
            || $lastNameError != NULL || $addressError != NULL || $cityError != NULL || $stateError != NULL || $postalCodeError != NULL){

            //displaying edit account page with errors
            $contentID = 'views/editAccount.php'; 

        }else { //if inputs are good, we update the account and display the info

            //editing user account with verified information.
            if (editUser($customerID, $updatedEmail, $updatedPassword, $updatedPhone,  $updatedFirstName, $updatedLastName , 
                $updatedAddress, $updatedCity, $updatedState, $updatedPostalCode , $updatedCountryCode) == TRUE){

                //logging out 
                customer_logout();
                //logging the user in using the customer login method from data/functions.php and updated info
                customer_login($updatedEmail, $updatedPassword);

                //showing account page
                $contentID = 'views/accountView.php'; 

            }

        }
        
    }

}else if ($action == 'accountCreator'){ //this shows the account creator page

    //displaying create account page with errors
    $contentID = 'views/createAccount.php'; 

}else if ($action == 'createAccount'){ //here, we handle attempts at account creation.

    //if the customer is logged in they go to the edit account screen, 
    if($_SESSION['loggedIn'] != TRUE){

        //getting customer info
        $newEmail = filter_input(INPUT_POST, 'newEmail');
        $newPassword = filter_input(INPUT_POST, 'newPassword');
        $newPhone = filter_input(INPUT_POST, 'newPhone');
        $newFirstName = filter_input(INPUT_POST, 'newFirstName');
        $newLastName = filter_input(INPUT_POST, 'newLastName');
        $newAddress = filter_input(INPUT_POST, 'newAddress');
        $newCity = filter_input(INPUT_POST, 'newCity');
        $newState= filter_input(INPUT_POST, 'newState');
        $newPostalCode = filter_input(INPUT_POST, 'newPostalCode');

        //getting country code 
        $newCountryCode = filter_input(INPUT_POST, 'countrySelect', FILTER_SANITIZE_STRING);

        //checking info using methods from data/functions.php
        $emailError = checkEmail($newEmail);
        $passwordError = checkPassword($newPassword);
        $phoneError = checkPhone($newPhone);
        //these six peices of information use the same verifier method.
        $firstNameError = checkSix($newFirstName);
        $lastNameError = checkSix($newLastName);
        $addressError = checkSix($newAddress);
        $cityError = checkSix($newCity);
        $stateError = checkSix($newState);
        $postalCodeError = checkSix($newPostalCode);

        //now, we check for error messages. if an error is found, we display the editing page that now echoes the error message.
        if($emailError != NULL || $passwordError != NULL || $phoneError != NULL || $firstNameError != NULL 
            || $lastNameError != NULL || $addressError != NULL || $cityError != NULL || $stateError != NULL || $postalCodeError != NULL){

            //displaying create account page with errors
            $contentID = 'views/createAccount.php'; 

        }else { //if inputs are good, we create the account and display the info

            //create user account with verified information.
            if (createUser($newEmail, $newPassword, $newPhone,  $newFirstName, $newLastName , 
                $newAddress, $newCity, $newState, $newPostalCode , $newCountryCode) == TRUE){

                //logging the user in using the customer login method from data/functions.php and updated info
                customer_login($newEmail, $newPassword);

                 //showing account page
                $contentID = 'views/accountView.php'; 

            }else{

                //displaying create account page with errors
                $contentID = 'views/createAccount.php'; 

            }

        }
        
    }else{

        //display acct view if already logged in
        $contentID = 'views/accountView.php'; 

    }
}else if ($action == 'deleteAccount'){ //this deletes the account of the logged in user if they are logged in.

    //if a user is logged in, delete their account.
    if($_SESSION['loggedIn'] == TRUE){
        //delete the user account - they will be removed from the customer table and placed in the deleted customer table.
        delete_account();
        //log out to remove customer data from session
        customer_logout();
    }

    //bring to the view account page.
    $contentID = 'views/accountView.php'; 

}else if ($action == 'Product Catalog'){ //this shows the product catalog page

    //displaying product catalog
    $contentID = 'views/catalogView.php'; 

}else if ($action == 'Sort By Price Ascending'){ //this shows the product catalog page sorted by 

    //sorting by price ascending
    $products = get_productsByPriceASC();

    //displaying product catalog
    $contentID = 'views/catalogView.php'; 

}else if ($action == 'Sort By Price Descending'){ //this shows the product catalog page sorted by price 

    //sorting by price ascending
    $products = get_productsByPriceDESC();

    //displaying product catalog
    $contentID = 'views/catalogView.php'; 

}else if ($action == 'Alphabetical'){ //this shows the product catalog page sorted by price 

    //sorting products alphabetically
    $products = get_productsByAlphabet();

    //displaying product catalog
    $contentID = 'views/catalogView.php'; 

}else if ($action == 'Cart'){ //this shows the cart page 

    //displaying cart
    $contentID = 'views/cartView.php'; 

}else if($action == 'addToCart'){ //adding a product to cart

    $quantity = (int) filter_input(INPUT_POST, 'quantity', FILTER_SANITIZE_STRING);
    $productCode = filter_input(INPUT_POST, 'productCode');

    //adding to cart, sending capacity reached message if cap is reached.
    if(addToCart($productCode, $quantity)){
        //if the add is successful, we

    }else{
        //if the cart is at capacity
        $capacityReached = "Cart capacity is 10 of each item - Cannot add more!";
    }

    //displaying cart
    $contentID = 'views/cartView.php'; 

}else if($action == 'deleteFromCart'){ //delete from cart

    //get product code 
    $productCode = filter_input(INPUT_POST, 'productCode');

    //delete from cart
    removeFromCart($productCode);

    //displaying cart
    $contentID = 'views/cartView.php'; 

}else if($action == 'viewOrders'){ //View orders form, shows previous orders for customer.

    //displaying orders page
    $contentID = 'views/ordersView.php'; 

}else if($action == 'clearCart'){

    //clearing all products from cart
    foreach($products as $product){
        removeFromCart($product['productCode']);
    }

    //displaying cart page
    $contentID = 'views/cartView.php'; 

}else if($action == 'checkout'){

    //displaying checkout page
    $contentID = 'views/checkout.php'; 

}else if($action == 'processOrder'){

    //get input data
    $newAddress = filter_input(INPUT_POST, 'newAddress');
    $newCity = filter_input(INPUT_POST, 'newCity');
    $newState= filter_input(INPUT_POST, 'newState');
    $newPostalCode = filter_input(INPUT_POST, 'newPostalCode');
    $newCountryCode = filter_input(INPUT_POST, 'countrySelect', FILTER_SANITIZE_STRING);

    //checking info using methods from data/functions.php
    $addressError = checkSix($newAddress);
    $cityError = checkSix($newCity);
    $stateError = checkSix($newState);
    $postalCodeError = checkSix($newPostalCode);

    //now, we check for error messages. if an error is found, we display the editing page that now echoes the error message.
    if($addressError != NULL || $cityError != NULL || $stateError != NULL || $postalCodeError != NULL 
       || $_SESSION['loggedIn'] != TRUE || $_SESSION['totalWithoutTax'] == 0 || $_SESSION['totalWithTax'] == 0){

        //displaying checkout with errors.
        $contentID = 'views/checkout.php'; 

    }else{
        //if no issues are found, we process the order.
        newOrder($_SESSION['customer']['customerID'], $_SESSION['contentsString'], $_SESSION['totalWithoutTax'],  
                 $_SESSION['totalWithTax'], $newAddress, $newCity, $newState, $newPostalCode, $newCountryCode);

        //clearing all products from cart
        foreach($products as $product){
            removeFromCart($product['productCode']);
        }

        //wiping session data
        $_SESSION['totalWithoutTax'] = 0;
        $_SESSION['totalWithTax'] = 0;
        $_SESSION['contentsString'] = '';

        //displaying orders page
        $contentID = 'views/ordersView.php'; 
    }
}

//inclding program header
include 'res/header.php'; 

?>

<main>
    
    <?php 
        //this lets us include the currently selected page.
        include $contentID;
    ?>

    <!-- This allows our current page id to persist between forms. -->
    <input type="hidden" name="currentID" value="<?php echo $contentID; ?>" >

</main>

<?php 
//including footer 
include 'res/footer.php'; 
?>