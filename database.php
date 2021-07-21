<?php
try{ 
$host = "localhost";
$username = "root";
$password = "";
$charset = "utf8";
$dbname = "finedini_database";

$dsn = "mysql:host=$host;charset=$charset";
$pdoObj = new PDO($dsn, $username, $password);
$pdoObj->setAttribute(PDO::ATTR_ERRMODE,
PDO::ERRMODE_EXCEPTION);
$dbQuery= "CREATE DATABASE IF NOT EXISTS `$dbname`
           DEFAULT CHARACTER SET utf8
           COLLATE utf8_persian_ci;";

$pdoObj->query($dbQuery);
$pdoObj->query("use `$dbname`;");

$UsersTbl= "CREATE TABLE IF NOT EXISTS Users(
    ID int(11) NOT NULL auto_increment,
    Password varchar(200) NOT NULL,
    Name varchar(100) NOT NULL,
    PhoneNumber varchar(12) NOT NULL ,
    Date DATETIME NOT NULL,
    Access varchar(10) NOT NULL DEFAULT 1,
    Request varchar(10) NOT NULL DEFAULT 0,
    PRIMARY KEY (ID)
    )";
    $results = $pdoObj->query($UsersTbl);

$FoodTbl= "CREATE TABLE IF NOT EXISTS Food(
     FoodID int(11) NOT NULL auto_increment,
     Name varchar(100) NOT NULL,
     Price int(200),
     ImageURL varchar(100) NOT NULL,
     Category varchar(20) NOT NULL,
     FoodDate DATETIME NOT NULL,
     PRIMARY KEY (FoodID)
     )";
     $results = $pdoObj->query($FoodTbl);

$OrdersTbl= "CREATE TABLE IF NOT EXISTS Orders(
     OrderID int(11) NOT NULL auto_increment,
     Name varchar(100) NOT NULL,
     Price int(200),
     ImageURL varchar(100) NOT NULL,
     Category varchar(20) NOT NULL,
     Reception int(2) NOT NULL DEFAULT 0 ,
     UID int(11) NOT NULL,
     FID int(11) NOT NULL,
     OrderDate DATETIME NOT NULL,
     PRIMARY KEY (OrderID),
     FOREIGN KEY (UID) REFERENCES Users (ID) ON DELETE RESTRICT ON UPDATE CASCADE,
     FOREIGN KEY (FID) REFERENCES Food (FoodID) ON DELETE RESTRICT ON UPDATE CASCADE
     )";
     $results = $pdoObj->query($OrdersTbl);

     $select = "SELECT * FROM Users";
                $selectResult= $pdoObj->query($select);
                $c = $selectResult->rowCount();

                $Date = date("Y-m-d H:m:s");
                $ManagementName = "سجاد رعیت";
                $ManagementPhoneNumber = "09170022767";
                $ManagementPassword = "1234";
                $ManagementGmail = "raeyatsajjad@gmail.com";
                $ManagementAddress = "مرودشت - خیابان اصلی";
                $ManagementAccess = 2;

                if($c == 0){
                  $insert = "INSERT INTO Users
                  (Name, Password, PhoneNumber, Access, Date)
                  VALUES (?, ?, ?, ?, ?)";
                  $insertStmnt = $pdoObj->prepare($insert);
                  $insertStmnt->execute([$ManagementName,$ManagementPassword,$ManagementPhoneNumber,$ManagementAccess,$Date]);
                }
}catch(PDOExeption $e){
    echo $e->getMessage();
}

?>