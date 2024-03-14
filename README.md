# Master-Sushi-Chef
Website created for SDEV 328 using Fat-free and MVC, as well as GitHub. This is a sushi restaurant website to order food with many features.
@Authors: Kayley Young, Levi Miller
1. Our project includes classes, controller, model, and views. Within our model directory we have a data-layer.php that manages the data, including database interactions. We have a validate.php that handles data validation, and business logic implementation.The controllers directory holds the controller.php that manages the flow of data between the model and the view, The views directory has all the html pages and handles the presentation layer of the application, providing the user interface for interacting with the system. Views are responsible for rendering data from the model in a user-friendly format.
2. In index.php, each view page has a route created that gets sent to the controllers directory controller.php to be able to render the page and add data to the session array and manages the flow of data between the model and the view.
3. In our model/data-layer.php all functions but the last 2 are using PDO and prepared statements
4. Inside model/data-layer.php the loadOrders() function pulls the orders saved inside the database and returns the rows of orders made by that userid. saveOrder() function saves the order form information from the user that was saved into the order object (Order.php class)
5. Both team members have an equal amount of history commits on github with clear descriptions on what was completed.
https://github.com/kayleyyoung253/Master-Sushi-Chef
6. We utilized multiple classes found inside the classes directory, including user.php, order.php and user_updates.php. Inheritance relationship is made in the user_updates class as the child to the parent class user.php which saves if the user checks if they want updates when making an account. User_updates object is used in the makeAccount() function in controller.php.
7. PHPDocs can be seen throughout the project. All functions contain a phpdoc above them with the description, parameters, and return if applicable, especially in the controller.php, data-layer.php and all classes
8. Has form validation in the controller.php in the makeAccount() and the checkout(). Validate.php is the class containing the functions to validate the data being passed into makeAccount and checkout.
9. We used clean and clear code and provided comments through the project. Phpdocs and htmldocs are utilized throughout each file to ensure readability and is easy to pick up new code when other members add to it. Repeat tags are utilized so code is not repetitive. Data-layer.php contains getAppetizers() and getRolls() function to allow repeat tags in the order form
10. We put many hours and lots of effort into this project, you can see that throughout the entire project. We took time to make sure our code was clean and both team members frequently went through code to clean up testing comments and added documentation where needed. Every view page created was checked with html5.validator.nu and corrected any errors that generated.

