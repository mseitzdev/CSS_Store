<?php
/*
  This is the previous orders page, which shows the orders already made by the customer.

  Mitchell Seitz

  March 11 2024
*/

//extracting orders 
$orders = getOrders();

//toggling view 
if($orders == NULL){
  $ordersView = 'hidden';
  $emptyView = '';
}else{
  $ordersView = '';
  $emptyView = 'hidden';
}

?>


<h1 class="pagetitle"> Your Orders </h1>

<div class="information" <?php echo $ordersView; ?> >

  <?php

    //displaying information for each order.
    foreach ($orders as $order){
      echo '<div style="border: 2px solid black; max-width: 100%"> <br>';
      echo '<h3> Order ID: ' . $order['orderID'] . ' </h3> <br>';
      echo '<p> Order Date: ' . $order['orderDate'] . '</p> <br>';
      echo '<p> Order Contents: </p> <br>';
      echo '<p>' . $order['contents'] . '</p> <br>'; 
      echo '<p> Price Before Tax: ' . $order['price'] . '</p> <br>'; 
      echo '<p> Price After Tax: ' . $order['taxedPrice'] . '</p> <br>'; 
      echo '<p style="font-weight: bold"> Ship to: </p> <br>'; 
      echo '<p> Ship To: ' . $order['name'] . '</p> <br>'; 
      echo '<p> Address: ' . $order['address'] . '</p> <br>'; 
      echo '<p> City: ' . $order['city'] . '</p> <br>'; 
      echo '<p> State/Province: ' . $order['state'] . '</p> <br>'; 
      echo '<p> Country: ' . country_from_code($order['countryCode'])['countryName'] . '</p> <br>'; 
      echo '<p> Postal Code: ' . $order['postalCode'] . '</p> <br>'; 
      echo '</div> <br>';
      
    }

  ?>

</div>

<!-- No orders view -->
<div class="information" <?php echo $emptyView; ?> >

  <p> No orders! Please add items to your cart and go through checkout to order products. </p>

</div>

