<?php
/*
  This is the product catalog, which contains price, title, and image of each product.
  This is made to allow customers to breifly look at each product before heading to the page.
  You can also sort the products in the menu and catalog if desired. 

  Mitchell Seitz

  March 11 2024
*/
?>

<h1 class="pagetitle"> Product Catalog </h1>

<div class="information" >

   <style> 
   		table, th, td {
  			border: 1px solid;
  			border-collapse: collapse;
		}
   </style>

   <!-- Sorting products in differentn ways. -->
   <label style='font-size: 20px; color:red;'>
    Sorting will also affect ordering in the menu.<br>
    This is intentional, and left in because it is useful.
   </label>
   <br><br>
   <form action="index.php" method="post"> 
      <input type="submit" name='action' value="Sort By Price Ascending" style="font-size: 20px;" >
      <input type="submit" name='action' value="Sort By Price Descending" style="font-size: 20px;" >
      <input type="submit" name='action' value="Alphabetical" style="font-size: 20px;" >
   </form><br>

   <!--Table, holds one row for each product as well as view page button and info. -->
   <table style="border: 2px solid; width: 100%;">
        <tr>
            <th>Product image</th>
            <th>Product Name </th>
            <th>Cost</th>
            <th>View Product</th>
        </tr>
    <?php 
    	//getting each of our products as a list item
    	foreach ($products as $product) {  
    ?> 
        <tr>
            <td style="width: 30%;">
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
        </tr>
    <?php } ?> 
    </table>
    <br><br><br>
</div>