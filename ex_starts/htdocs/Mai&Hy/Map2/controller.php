<?php

// database settings 
	$username = 'root';
	$password = 'password';
	$dbname = 'test';
	$host = 'localhost';
//Data from index.php	

	$mLatLang	= explode(',',$_POST["latlang"]);
	$mLat 		= filter_var($mLatLang[0], FILTER_VALIDATE_FLOAT);
	$mLng 		= filter_var($mLatLang[1], FILTER_VALIDATE_FLOAT);
//mysqli
$mysqli = new mysqli($host, $username, $password, $dbname);

if (mysqli_connect_errno()) 
{
	echo '<h3>There is an error. Could not connect to the database</h3>';
	exit();
}

if($_POST) //run only if there's a post data
{

	$request = $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'; 
	if (!$request){ 
		echo '<h3>There is an error. Request must come from ajax</h3>';
		exit();	
	}
	
	//Delete Marker
	if(isset($_POST["del"]) && $_POST["del"]==true)
	{
		$results = $mysqli->query("DELETE FROM map_markers WHERE lat=$mLat AND lng=$mLng");
		if (!$results) {  
		  echo '<h3>There is an error. Could not delete marker</h3>';
		  exit();
		} 
		exit("Done!");
	}
	//Insert marker

	$mName 		= filter_var($_POST["name"], FILTER_SANITIZE_STRING);
	$mAddress 	= filter_var($_POST["address"], FILTER_SANITIZE_STRING);
	$mType		= filter_var($_POST["type"], FILTER_SANITIZE_STRING);
	$results = $mysqli->query("INSERT INTO map_markers(name, address, lat, lng, type) VALUES ('$mName','$mAddress',$mLat, $mLng, '$mType')");
	if (!$results) {  
		 echo 'There is an error. Could not insert marker to the database</h3>';; 
		  exit();
	} 
	
	$output = '<h1 class="marker-heading">'.$mName.'</h1><p>'.$mAddress.'</p>';
	exit($output);
}


//Create a new DOMDocument object
$dom = new DOMDocument("1.0");
$node = $dom->createElement("map_markers"); //Create new element node
$parnode = $dom->appendChild($node); //make the node show up 

// Select all the rows in the markers table
$results = $mysqli->query("SELECT * FROM map_markers WHERE 1");
if (!$results) {  
	header('HTTP/1.1 500 Error: Could not get markers!'); 
	exit();
} 

//set document header to text/xml
header("Content-type: text/xml"); 

// Iterate through the rows, adding XML nodes for each
while($obj = $results->fetch_object())
{
  $node = $dom->createElement("map_marker");  
  $newnode = $parnode->appendChild($node);   
  $newnode->setAttribute("name",$obj->name);
  $newnode->setAttribute("address", $obj->address);  
  $newnode->setAttribute("lat", $obj->lat);  
  $newnode->setAttribute("lng", $obj->lng);  
  $newnode->setAttribute("type", $obj->type);	
}

echo $dom->saveXML();
