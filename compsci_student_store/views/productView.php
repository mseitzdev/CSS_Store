<h1 class="pagetitle"> <?php echo $productName; ?> </h1>

<div class="information">
   <img src="<?php echo 'img/' . $productImage; ?>" alt="Product Image" style="width: 30%;border: 7px solid black;">
   <br><br>
   <?php echo $productDesc; ?>
   <br><br>
   <?php echo $productPrice; ?>
   <br>

   <!-- Add product to cart-->
   <form action="index.php" method="post"  <?php echo $customerInfoVisible; ?> >
      <input type="hidden" name="action" value="addToCart">
      <input type="hidden" name="productCode" value="<?php echo $productCode; ?>">
      <br>
      <label>Quantity:</label>
       <select name="quantity">
           <!-- Loading quanity options , numbers 1 - 10-->
           <?php for ($count = 1; $count <= 10; $count++) {  ?> 
               <option value="<?php echo $count; ?>" > <?php echo $count; ?> </option>
           <?php } ?>  
       </select>
       <br>
       <br>
      <input type="submit" name="edit" value="Add to Cart" style="font-size: 20px;" >
   </form>
   <br>

</div>