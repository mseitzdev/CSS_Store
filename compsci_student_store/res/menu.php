<!-- 

menu.php

This page holds the code for the menu and navigation system of our website.

The code for this page is a mish-mash of code that I have created myself, and the 
side menus given on w3 schools, sources here: 

1: https://www.w3schools.com/howto/howto_js_sidenav.asp
2: https://www.w3schools.com/howto/howto_js_dropdown_sidenav.asp

created by Mitchell Seitz, using above material, in march 2024.

 -->

<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  font-family: "Lato", sans-serif;
}

/* This is the general formatting for the sidenav */
.sidenav {
  height: 100%;
  width: 0;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #111;
  overflow-x: hidden;
  transition: 0.3s;
  padding-top: 60px;
}

/*General formatting for links and dropdown buttons*/
.sidenav a, .dropdown-btn {
  padding: 8px 8px 8px 32px;
  text-decoration: none;
  font-size: 25px;
  color: steelblue;
  display: block;
  transition: 0.3s;
}

/* makes sure the <a> tag links center */
.sidenav a{
  position: relative;
  left: 50%;
  margin-left: -100px;
}

/* Style the  dropdown button */
 .dropdown-btn {
  border: none;
  background: none;
  width:100%;
  cursor: pointer;
  outline: none;
}

/* Turning text white on hover*/
.sidenav a:hover, .dropdown-btn:hover, .sidenav input:hover{
  color: #f1f1f1;
}

/*formatting for the input forms of our lists*/
.sidenav input{
  text-decoration: none;
  font-size: 20px;
  color: steelblue;
  display: block;
  transition: 0.3s;
  border: none;
  background-color: #111;
  padding: 8px 8px 8px 32px;
}

/* 
Dropdown container (hidden by default). 
*/
.dropdown-container {
  display: none;
  background-color: #111;

  /*This fixes the position relative to the container, and centers the options*/
  position: relative;
  /*left: 50%;
  margin-left: -100px;*/
  
}

/* close button formatting */
.sidenav .closebtn {
  position: absolute;
  top: 0;
  right: 25px;
  font-size: 36px;
  margin-left: 50px;
}

/* more general formatting */
@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}


</style>
</head>
<body>

<div id="mySidenav" class="sidenav">

  <!-- This is the home button, which will show the home content. -->
  <form action="index.php" method="post" name="action" >
      <input type="submit" name="action" value="Home" style="font-size:25px; position: relative; left: 50%; margin-left: -100px;">
  </form>

  <!-- This is the close button -->
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

  <!-- This is the cart button -->
  <form action="index.php" method="post" name="action" >
      <input type="submit" name="action" value="Cart" style="font-size:25px; position: relative; left: 50%; margin-left: -100px;">
  </form>

  <!-- This is the Account button, which will show the account/login page. -->
  <form action="index.php" method="post" name="action" >
      <input type="hidden" name="action" value="viewAccount">
      <input type="submit" name="submit" value="Account" style="font-size:25px; position: relative; left: 50%; margin-left: -100px;">
  </form>

  <!-- This is the product catalog button -->
  <form action="index.php" method="post" name="action" >
      <input type="submit" name="action" value="Product Catalog" style="font-size:25px; position: relative; left: 50%; margin-left: -100px;">
  </form>

  <!-- dropdown menu -->
  <button class="dropdown-btn">Products List ▼</button>
  <div class="dropdown-container">
    <!-- Forms containing options for products -->
      <?php
        try{
          //loading in our products from the database
          //adding each item to the list 
          foreach ($products as $product){
            echo '<form action="index.php" method="post">';
            echo '<input type="hidden" name="action" value="display_product">';
            //item information
            echo '<input type="submit" name="productName" value="' . $product['name'] . '">';
            echo '<input type="hidden" name="productCode" value="' . $product['productCode'] . '">';
            echo '<input type="hidden" name="productDesc" value="' . $product['description'] . '">';
            echo '<input type="hidden" name="productImage" value="' . $product['image'] . '">';
            echo '<input type="hidden" name="productPrice" value="' . $product['price'] . '">';
            echo '</form>';
          }
          
        }catch (Exception $e){ //if database cannot be accessed, we put up an error.
          echo '<input type="submit" name="action" value="Database Error">';
        }
      ?>
  </div>

  <!-- This is the  about menu link-->
  <form action="index.php" method="post" name="action" >
      <input type="submit" name="action" value="About" style="font-size:25px; position: relative; left: 50%; margin-left: -100px;">
  </form>


</div>

<!-- This is the code for the menu symbol, you can add text  -->
<span style="font-size:40px;cursor:pointer;" onclick="openNav()"> &#9776; </span>

<script>
function openNav() {
  //alter this width to change the width of the sidenav when open
  document.getElementById("mySidenav").style.width = "400px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}

/* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content
This allows the user to have multiple dropdowns without any conflict */
var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var dropdownContent = this.nextElementSibling;
    if (dropdownContent.style.display === "block") {
      dropdownContent.style.display = "none";
    } else {
      dropdownContent.style.display = "block";
    }
  });
}
</script>