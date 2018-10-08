<?php
	if(!isset($searchWord)) {
		$searchWord ='';
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
        <title>Twiter search</title>
		<meta charset="utf-8">
    </head>
    <body>
		<h2 style= "text-align: center" >Twitter Search</h2>
		<form class = "wrapper" name = "search" action="controller.php" method="post">
			<h3>
		Search:&nbsp;&nbsp;&nbsp;&nbsp; <input type="text" name = "search" value = "<?php echo htmlspecialchars($searchWord)?>"></input><br />
			</h3>
			
		<h3>
				<input type="submit" name = "btnSummit" value = "Search"> </input>
			</h3>
		</form>
    </body>
</html>