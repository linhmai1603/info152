<?php
	if(!isset($searchString)) {
		$searchString ='';
	}
?>
<!DOCTYPE html>
<style ="text/css">
.wrapper {
    text-align: center;
}

.button {
    position: absolute;
    top: 50%;
}
</style>

<html>
    <head>
        <title>Search in a MySQL Database</title>
		<meta charset="utf-8">
    </head>
    <body>
		<h2 style= "text-align: center" >Twitter Search Database</h2>
		<form class = "wrapper" name = "search" action="searchDBFunct.php" method="post">
			<h3>
		Database:&nbsp;&nbsp;&nbsp;&nbsp; <input type="text" name = "dbname" value = "twitter"></input><br/>
			</h3>
		<label>Enter a SQL query in the box: ShowDatabases, Select, Show Tables, or Desc [Table]</label><br>
		<textarea rows ="5" cols ="60" name= "query"> SELECT * FROM tweets</textarea><br>	
			<h3>
				<input type="submit" name = "btnSummit" value = "Execute Query"> </input>
			</h3>
		</form>
    </body>
</html>