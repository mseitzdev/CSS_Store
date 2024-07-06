Computer Science Student Store

Readme File 

Mitchell Seitz,
March 14, 2024.
____________________________________________________________________________________________

Description:

This is what I would consider the first "Real" website that I've ever made, and it was my 
Final project for the course COMP 3541 at Thompson Rivers University, Published with the 
Permission of my professor for that course, Sarah Carruthers. I got an A+ in the course, 
but it is still not quite a full Functioning web store. To see what I would do to make 
this website into something usable, See the "Possible Upgrades" section of this readme. 

This project is a digital storefront website representing a store catering to computer 
science students. This store allows the user to create, edit, and delete an account,
Browse products and add to your shopping cart, a searchable catalog, and a checkout system 
that can be used to place an order. This program uses the MVC pattern, with the index.php 
file functioning as the main controller and the rest of the program functioning as views 
and database interfaces. 

See folder "compsci_student_store" for source code, and file "compsci_store_database.sql" 
For the SQL database export file.
____________________________________________________________________________________________

Software Requirements for installation: 

XAMPP Version 8.2.4-0 

	This XAMPP Version Contains:

	PHP 8.2.4, 8.1.17 or 8.0.28
	Apache 2.4.56
	MariaDB 5.4.28
	phpMyAdmin 5.2.1
	OpenSSL 1.1.1t

Built and tested with Firefox 123.0.1. on macOS 14.3.1
____________________________________________________________________________________________

Installation Instructions:

Please ensure that XAMPP is installed on your machine. I used XAMPP 8.2.4-0 on macOS 14.3.1, 
however this website should likely be compatible with other operating systems and XAMPP 
versions/server stacks. 

Make sure that all three servers inside of XAMPP are running. To do this, open XAMPP and go 
to the "manage servers" tab, and press the "Start All" button. This should start MySQL 
database, proFTPD, and Apache web server. Once you see they are all running, you can 
move on to the next step.

Once your servers are running, open up your web browser of choice and go to 
https://localhost/phpmyadmin.

From here, go to the "Import" tab, and select the file compsci_store_database.sql from the 
assignment submission folder as the file to import. Click the import button at the bottom
of the screen, and the file will import it's contents. 

Next, find your XAMPP hosting folder. For me, it was /Applications/XAMPP/xamppfiles/htdocs
on macOS, but may be different on other operating systems. Copy/paste the folder 
'compsci_student_store' from the assignment submission folder into this directory. 

Finally, you can enter https://localhost/compsci_student_store/index.php into the web 
browser of your choice and see the website. if all goes well, you will be greeted with 
the welcome screen.
____________________________________________________________________________________________

File Structure and Description:

compsci_store_database.sql - This is the database file for this program. This contains the 
                             code for the orders, cutsomers, products, and deleted customers.
                             Needs to be imported before program use as per instructions above.

compsci_student_store (Folder) - Main folder, contains program files.

	index.php - This page is the main controller for the program, and constructs a view for 
                    the user from the view elements in the views folder, using data accessed via
                    data/functions.php and data/database.php. 

	errorPage.php - This page is the error page for the program, and will be redirected to if
                        operations such as database access fail. 

	views (Folder) - This folder contains the view for the program. These pages do not display 
                         on their own, but are rather included in index.php during normal program 
                         operation. These elements are filled in using data taken from the MySQL
                         database accessed via data/database.php and generated using functions 
                         stored in data/functions.php. 

		home.php - This file contains the home page view.

		about.php - This file contains the about page view.

		productView.php - This file contains the product view, which will be changed as 
                                  as needed to show product information.

		ordersView.php - This file contains the orders view, which will be filled in with 
                                 orders for the current user.

		accountView.php - If the user is logged in, this page displays the user account.
                                  If no user is logged in, it displays the log in form.

		editAccount.php - This view contains the form for editing customer accounts.

		createAccount.php - This view contains the form for creating user accounts.

		checkout.php - This view contains the checkout view, filled in with cart data.

		catalogView.php - This view contains the code for the product catalog, and contains
			          the buttons to sort the products by price ascending or descending, 
                                  as well as alphabetically.

		cartView.php - This view contains the cart view. 

	res (Folder) - This is the folder containing elements that are constant on every page. 

		menu.php - This is the menu program, which constructs a menu using JavaScript, PHP, 
                           HTML, and CSS. 

		main.css - This file contains the CSS for the program. 

		header.php - This file contains the header data, including buttons and menu display. 
                             Also forces a secure connection on all pages, as well as including the 
                             database and functions access.

		footer.php - This file contains the footer data, which is a date and my name.

		csstore.png - This is the store logo, displayed in the header.

	img (Folder) - This folder contains product images.

	data (Folder)

		database.php - This file contains database access code to link us into the database, 
                               as well as including functions.php

		functions.php - This file contains the functions for this program. These are used by 
                                the controller, index.php as well as some view elements to display 
                                necessary data and carry out operations.

____________________________________________________________________________________________

Possible Upgrades:

- Make behaviour more standard, like not wiping all input forms when faulty data is input. 

- Clean up the CSS for this program - I noticed while adapting this into my portfolio website 
That a lot of CSS was redundant or could be done a better way. See the mseitz.dev repo for 
What this project became!

- Move some of the information that is stored as form data into the session, and change things 
Up so that the forwards/back buttons work well. The MVC model is cool but I could have 
Implemented in a way that allows for more usability.

- Make the database more complex, like having different tables for order items rather than 
Recording them as part of a text file in the order itself. 

- Add an administration system in the website, that way store employees, admins, etc can 
Handle issues, update and change things, etc without having to reach into the sql database 
Or source code directly. This could include changing/managing orders, adding new products, 
Etc.

- Create a more modern, engaging design, as the current one is very basic and is more meant 
As a simple scaffolding to support the system. 

____________________________________________________________________________________________

Other information:

See the file Database_Diagram.jpg for a database diagram. 

The file compsci_store_database.sql is the SQL database export file for the project.

The folder compsci_student_store contains the source code for this website, and should be 
copy-pasted into your server's apache root directory to be used.

____________________________________________________________________________________________

Pitch and Demonstration Video:

Please watch the final presentation video at this link:

https://youtu.be/pZSa_yPSQQQ 

The video is also available for download at this link:

https://drive.google.com/drive/folders/15IQ6ryFc54CZflxB0uzCjAT9-pP7PbKS?usp=sharing

Video Pitch Script:

What is the project about?

	This project is a simulated storefront. Called the "Computer Science Student Store", it 
	is a mock up store selling typical computer-science student needs like coffee and advil, 
	as well as fictional products like the "spice melange" from Dune and 'compound V' from 
	The Boys. Users can browse products via the product catalog or the list in the menu, 
	and sort products in these views by price or alphabetical order. Products can be added
	to the cart, and purchased by logging in to a new or existing user account and going
	through the checkout process.

Why have you selected this project?

	I selected this project because I was interested in exploring the idea of MVC design 
	and wanted to explore it through a familiar style of program as what we worked with 
	during assignments one through three. 

What is the benefit of your application?
	
	This application is a basic storefront, and serves as an effecitve prototype for an 
	actual online store. This application allows for the creation, update, and deletion
	of user accounts, as well as the placing of "orders" for things that a computer 
	science student is likely to want, as well as some fictional products intended to 
	give us a quick laugh.

What technologies and techniques have you used in your project related to this course?
	
	I designed this program to function according to the MVC model as much as possible, 
	using the main page, index.php in conjuncton with the file data/functions.php as the 
	controller, files in the views and img folder as views, and the database imported from
	compsci_store_database.sql as the model.

	The program is constructed mainly using PHP code, with HTML and CSS sparingly used as 
	scaffolding to hold the outputs of PHP. The database for this program is programmed 
	using SQL, and is kept intentionally simple. The side menu is programmed using 
	JavaScript, and populates the list using products taken from the SQL database.

	This program uses Create operations on the database to create user accounts and orders,
	Update operations to update user accounts, Read operations to get products, orders, 
	users, and country data from the database, and Delete operations to delete user accounts.
	Regex is used to validate phone numbers, and filters are used for emails. Users can choose 
	to sort products in the catalog and menu list by price ascending or descending, or by 
	alphabetical order. Orders are sorted in the order view from most to least recent.

	User login and cart information is held in the session, and the contents of the cart and 
	user login state influence how the pages appear and what they show. Secure connection is 
	forced on all pages. 


