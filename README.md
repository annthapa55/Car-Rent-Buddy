# My-Rent-Buddy

## Requirements

WampServer or a similar web development platform. 

## Introduction
As a solution to the major assignment of Web Server Programming (MTS9307) subject, a website “My Rent Buddy” has been developed using the concepts of 
object-oriented PHP and MySQL database. The main purpose of the website is to facilitate car rental services.

The website allows the user to register or log in to the system. There are two types of users viz. Administrator and Renter. As an administrator, a user can list 
all rented cars and all available cars, add cars, and search for a car with the combination of car plate number, model, or type. Similarly, as a renter, a user 
can list all available cars, list the car that he/she has previously rented, search for a car, rent a car, and return the rented car.


## Running Code
Step 1:
First, the database should be created. This can be done either by importing the database from “my_rent_buddy.sql” or running the PHP script files located at the 
folder “Database and Table Creation” in sequential order indicated at filename. For instance, 1createDatabase.php must be run first, then 
2createTableUserType.php second and so forth.

Step 2:
After creating the database, the PHP script “myRentBuddyTemplate.php” must be run as it is the landing page of the website
