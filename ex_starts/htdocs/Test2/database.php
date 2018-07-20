<html>
<head>
<title> The Employment Database</title>


<style type = "text/css">
/*CSS style*/

/*table style*/
table, td, th {
    border: 1px solid black;
	align: center;
}

table {
	text-align: center;
    border-collapse: collapse;
    width: 30%;
	margin: 0px auto;
}

th {
    height: 50px;
}

</style>
</head>
<?php
$servername = "localhost";
$username = "root";
$password = "password";

//Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

	$dsn = 'mysql:host=localhost;dbname=employment';
	try {
		$db = new PDO($dsn, $username, $password);
	}catch(PDOException $e){
			echo $e->getMessage();
			echo '<hr>';
			echo $e->getTrace();
	}
	
	//query to check married couple in Boston, New York and Atlanta
	echo'<h1 align="center" >Married couple in Boston, New York and Atlanta</h1>'.'</br></br>';
	$sql2 = "SELECT `COL 2`, `COL 3`, `COL 8` FROM `employment-full` WHERE `COL 2` = '9271' OR `COL 2` = '3817' or `COL 2` = '63217'";
	$result2 = $db->query($sql2);
	echo '<table border = "1">';
	echo '<tr><th>ID</th><th>City</th><th>Total Count</th></tr>';
	foreach($result2 as $row){
		echo '<tr><td>' . $row["COL 2"] . '</td><td>' . $row["COL 3"] .'</td><td>' . $row["COL 8"] . '</th></tr>';
	}
	echo '</table>';
	echo'</br></br>';
	
	//query to check Married families with own children under 18 years old
	echo'<h1 align="center" >Top 5 cities that both husband and wife are not in labor force</h1>'.'</br></br>';
	$sql3 = "SELECT `COL 2`, `COL 3`, `COL 24` FROM `employment-full` WHERE `COL 2` NOT IN ('GEO.id2') ORDER BY `COL 24` DESC limit 5";
	$result3 = $db->query($sql3);
	echo '<table border = "1">';
	echo '<tr><th>ID</th><th>City</th><th>Total count</th></tr>';
	foreach($result3 as $row){
		echo '<tr><td>' . $row["COL 2"] . '</td><td>' . $row["COL 3"] .'</td><td>' . $row["COL 24"] . '</th></tr>';
	}
	echo '</table>';
	echo'</br></br>';
	
	//query to check if total number of family is greater than 1 million
	echo'<h1 align="center" >Cities that have more than 1 million families</h1>'.'</br></br>';
	$sql4 = "SELECT `COL 2`, `COL 3`, `COL 4` FROM `employment-full` WHERE `COL 4` >= 1000000";
	$result4 = $db->query($sql4);
	echo '<table border = "1">';
	echo '<tr><th>ID</th><th>City</th><th>Total count</th></tr>';
	foreach($result4 as $row){
		echo '<tr><td>' . $row["COL 2"] . '</td><td>' . $row["COL 3"] .'</td><td>' . $row["COL 4"] . '</th></tr>';
	}
	echo '</table>';

?>