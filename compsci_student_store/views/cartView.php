<?php
/*
  This is the cart for the program, which contains a list of all items added
  to the cart by the user, as well as buttons for managing the cart. 

  Mitchell Seitz

  March 11 2024
*/

$cartView = '';
$emptyView ='hidden';

if(cartEmpty()){
    $cartView = 'hidden';
    $emptyView ='';
}


?>


<h1 class="pagetitle"> Cart <?php //test code //echo $quantity; ?></h1>

<h3 class="pagetitle" style="color: red; background-color: white;"> <?php echo $capacityReached; ?></h3>

<div class="information" <?php echo $cartView; ?>>

   <style>
        table, th, td {
            border: 1px solid;
            border-collapse: collapse;
        }
   </style>

   <table style="border: 2px solid; width: 100%;">
        <tr>
            <th>Product image</th>
            <th>Product Name </th>
            <th>Cost Per</th>
            <th>View Product</th>
            <th>Quantity</th>
            <th>Cost Per</th>
            <th>Item Total</th>
            <th>Remove</th>
        </tr>
    <?php 

      foreach ($products as $product) {  if($_SESSION[$product['productCode']]){
      ?> 
        <tr>
            <td style="width: 20%;">
                <?php 
                    //the code for extracting the product image
                  $imgName = $product['image'];
                    echo '<img src="img/' . $imgName . '" style="width: 100%;">';
                ?>
            </td> 
            <td >
                <?php 
                    //product name
                    echo " " . $product['name'] . " ";
                ?>
            </td> 
            <td >
                <?php 
                    //product cost
                    echo " $" . $product['price'] . " ";
                ?>
            </td>
            <td >
                <?php
                  //form to display product page 
                  echo '<form action="index.php" method="post">';
                  echo '<input type="hidden" name="action" value="display_product">';
                  echo '<input type="submit" name="submit" value="View Page">';
                  //item information
                  echo '<input type="hidden" name="productName" value="' . $product['name'] . '">';
                  echo '<input type="hidden" name="productCode" value="' . $product['productCode'] . '">';
                  echo '<input type="hidden" name="productDesc" value="' . $product['description'] . '">';
                  echo '<input type="hidden" name="productImage" value="' . $product['image'] . '">';
                  echo '<input type="hidden" name="productPrice" value="' . $product['price'] . '">';
                  echo '</form>';
                ?>
            </td>
            <td >
                <?php 
                    //product quantity
                    echo $_SESSION[$product['productCode']];
                ?>
            </td>  
            <td >
                <?php 
                    //cost for each item 
                    echo "$" . $product['price'];
                ?>
            </td> 
            <td >
                <?php 
                    //cost for number of item in cart 
                    echo "$" . number_format($_SESSION[$product['productCode']] * $product['price'], 2, '.', ''); 
                ?>
            </td> 
            <td >
                <?php 
                  //form to display product page 
                  echo '<form action="index.php" method="post">';
                  echo '<input type="hidden" name="action" value="deleteFromCart">';
                  echo '<input type="submit" name="submit" value="Remove">';
                  echo '<input type="hidden" name="productCode" value="' . $product['productCode'] . '">';
                  echo '</form>';
                ?>
            </td> 
        </tr>
    <?php } } ?> 
    </table>
    <br>

      <!-- Clear cart button-->
   <form action='index.php' method='post'>
        <input type='hidden' name='action' value='clearCart'>
        <input type="submit" name="submit" value="Clear Cart" style="font-size: 35px;">
    </form>
    <br>

    <!-- checkout button -->
    <form action='index.php' method='post'>
        <input type='hidden' name='action' value='checkout'>
        <input type="submit" name="submit" value="Checkout" style="font-size: 35px;">
    </form>
    <br>

</div>

<!-- If cart is empty -->
<div class="information" <?php echo $emptyView; ?>>
    <p> 
        Cart is empty! Please view the product catalog or the product list to add products to your cart.
    </p>
</div>