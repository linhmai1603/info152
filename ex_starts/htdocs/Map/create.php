<?php 
 
  include 'connect.php';
   
  $createmaptable = 'CREATE TABLE IF NOT EXISTS maps (
  ID int AUTO_INCREMENT,
  PRIMARY KEY (ID),
  centerLat decimal (5,3),
      centerLong decimal (6,3),
      zoom  tinyint
  );';
 
  if(!$result = $con->query($createmaptable)){
    die('There was an error running the query [' . $con->error . ']');
  }
 
  $createmappointtable = 'CREATE TABLE IF NOT EXISTS mappoints (
  ID int AUTO_INCREMENT,
  PRIMARY KEY (ID),
      mapID int, 
  pointLat decimal (5,3),
      pointLong decimal (6,3),
      pointText text
  );';
 
  if(!$result = $con->query($createmappointtable)){
    die('There was an error running the query [' . $con->error . ']');
  }
 
 <?php 
 
  include 'connect.php';
   
  $createmaptable = 'CREATE TABLE IF NOT EXISTS maps (
  ID int AUTO_INCREMENT,
  PRIMARY KEY (ID),
  centerLat decimal (5,3),
      centerLong decimal (6,3),
      zoom  tinyint
  );';
 
  if(!$result = $con->query($createmaptable)){
    die('There was an error running the query [' . $con->error . ']');
  }
 
  $createmappointtable = 'CREATE TABLE IF NOT EXISTS mappoints (
  ID int AUTO_INCREMENT,
  PRIMARY KEY (ID),
      mapID int, 
  pointLat decimal (5,3),
      pointLong decimal (6,3),
      pointText text
  );';
 
  if(!$result = $con->query($createmappointtable)){
    die('There was an error running the query [' . $con->error . ']');
  }
 
?>
?>