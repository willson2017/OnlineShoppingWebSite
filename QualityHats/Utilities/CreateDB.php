<?php
/**
 * Created by PhpStorm.
 * User: Xinyu.Qu
 * Date: 29/09/2017
 * Time: 9:19 AM
 */

$dbhost = 'localhost:3306';  // Server Address
$dbuser = 'root';            // User Name
$dbpass = '';                // mysql password
$con = mysqli_connect($dbhost, $dbuser, $dbpass);

//Database Name
$dbname = "hats1";

if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}
echo 'Connect to server successfully <br/>';

// Create database
if (mysqli_query($con, "create database if not exists $dbname")) {
    echo "Database is created";
} else {
    echo "Error to create database: " . mysqli_error($con);
}

mysqli_select_db($con, $dbname);

$sql_category = "
CREATE TABLE  Category
(
CategoryID int(10) unsigned not null AUTO_INCREMENT,
CategoryName varchar(50)  not null,
primary key (CategoryID)  
)
";
mysqli_query($con, "drop table $sql_category");
mysqli_query($con, $sql_category);
echo "finish creating table Category";
echo "<br />";

$sql_supplier = "
CREATE TABLE  Supplier
(
SupplierID int(10) unsigned not null AUTO_INCREMENT,
Address varchar(50)  not null,
Email  VARCHAR (50)  not null, 
MobilePhone VARCHAR (15) DEFAULT  NULL ,
SupplierName VARCHAR (10) not NULL ,
WorkPhone   VARCHAR  (10) DEFAULT  NULL ,
PRIMARY  KEY (SupplierID) 
)
";
mysqli_query($con, "drop table $sql_supplier");
mysqli_query($con, $sql_supplier);
echo "finish creating table Supplier";
echo "<br />";

$sql_product = "
CREATE TABLE  Products
(
  ProductID   INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  CategoryID  INT(10)          UNSIGNED NOT NULL,
  Description VARCHAR(500)     DEFAULT NULL,
  ImagePath   VARCHAR(1024)    DEFAULT NULL,
  ProductName VARCHAR(100)     DEFAULT NULL,
  SupplierID  INT(10)          UNSIGNED NOT NULL,
  UnitPrice   DECIMAL(18, 2)   DEFAULT NULL,
  PRIMARY KEY (ProductID),
  FOREIGN KEY (CategoryID) REFERENCES Category (CategoryID),
  FOREIGN KEY (SupplierID) REFERENCES Supplier (SupplierID)
)
";
mysqli_query($con, "drop table $sql_product");
mysqli_query($con, $sql_product);
echo "finish creating table product";
echo "<br />";

$sql_Users = "
CREATE TABLE  Users
(
  UserId     INT(10) UNSIGNED        NOT NULL  AUTO_INCREMENT,
  Name        VARCHAR(50)            NOT NULL,
  Email       VARCHAR(200)           NOT NULL,
  Password    VARCHAR(50)            NOT NULL,
  Role        INT(10) UNSIGNED       NOT NULL  DEFAULT '0',
  MobileNo    VARCHAR(20)            DEFAULT NULL,
  Address     VARCHAR(200)           DEFAULT NULL,
  Disabled    ENUM ('true', 'false') NOT NULL  DEFAULT 'false',
  EmailConfirmed    ENUM ('true', 'false') NOT NULL  DEFAULT 'false',
  PRIMARY KEY (UserId)
)
";
mysqli_query($con, "drop table $sql_Users");
mysqli_query($con, $sql_Users);
echo "finish creating table Users";
echo "<br />";

$sql_Orders = "
CREATE TABLE  Orders
(
  OrdersID    INT(10) UNSIGNED          NOT NULL AUTO_INCREMENT,
  Address     VARCHAR(50)               DEFAULT NULL,
  City        VARCHAR(50)               DEFAULT NULL,
  Country     VARCHAR(50)               DEFAULT NULL,
  FirstName   VARCHAR(50)               DEFAULT NULL,
  GST         DECIMAL(18, 2)            NOT NULL,
  GrandTotal  DECIMAL(18, 2)            NOT NULL,
  LastName    VARCHAR(50)               DEFAULT NULL,
  OrderDate   DATE                      NOT NULL,
  Phone       VARCHAR(20)               DEFAULT NULL,
  PostalCode  VARCHAR(20)               DEFAULT NULL,
  Status      VARCHAR(20)               DEFAULT NULL,
  Total       DECIMAL(18, 2)            NOT NULL,
  UserId      INT(10) UNSIGNED          NOT NULL,
  ProductName VARCHAR(100)              DEFAULT NULL,
  PRIMARY KEY (OrdersID),
  FOREIGN KEY (UserId) REFERENCES Users (UserId)
)
";
mysqli_query($con, "drop table $sql_Orders");
mysqli_query($con, $sql_Orders);
echo "finish creating table Orders";
echo "<br />";

$sql_OrderDetail = "
CREATE TABLE  OrderDetail
(
  OrderDetailID INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  OrdersID      INT(10) UNSIGNED NOT NULL,
  ProductID     INT(10) UNSIGNED NOT NULL,
  Quantity      INT(10)          NOT NULL,
  SubTotal      DECIMAL(18, 2)   NOT NULL,
  UnitPrice     DECIMAL(18, 2)   NOT NULL,
  PRIMARY KEY (OrderDetailID),
  FOREIGN KEY (OrdersID) REFERENCES Orders (OrdersID),
  FOREIGN KEY (ProductID) REFERENCES  Products (ProductID)
)
";
mysqli_query($con, "drop table $sql_OrderDetail");
mysqli_query($con, $sql_OrderDetail);
echo "finish creating table OrderDetail";
echo "<br />";

$sql_ShoppingCart = "
CREATE TABLE  ShoppingCart
(
ShoppingCartID VARCHAR (450)  NOT NULL,
PRIMARY  KEY (ShoppingCartID)  
)
";
mysqli_query($con, "drop table $sql_ShoppingCart");
mysqli_query($con, $sql_ShoppingCart);
echo "finish creating table ShoppingCart";
echo "<br />";

$sql_CartItem = "
CREATE TABLE  CartItem
(
  ID          INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  CartID      VARCHAR(500)     DEFAULT NULL,
  COUNT       INT(10)          NOT NULL,
  DateCreated DATE             NOT NULL,
  ProductID   INT(10)          UNSIGNED NOT NULL,
  PRIMARY KEY (ID),
  FOREIGN KEY (ProductID) REFERENCES Products (ProductID)
)
";
mysqli_query($con, "drop table $sql_CartItem");
mysqli_query($con, $sql_CartItem);
echo "finish creating table CartItem";
echo "<br />";
mysqli_close($con);
?>