<?php
	if(!isset($originalValue)) {
		$originalValue ='';
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
        <title>Temperature conversion</title>
		<meta charset="utf-8">
    </head>
    <body>
		<h2 style= "text-align: center" >Temperature Conversion</h2>
			    <?php if (!empty($errorMessage)) { ?>
        <p class="error" style ="text-align: center; color:red; font-size:24px;"><?php echo htmlspecialchars($errorMessage); ?></p>
			<?php } ?>
		<form class = "wrapper" name = "converter" action="converter.php" method="post">
			<h3>
		Original Temperature:&nbsp;&nbsp;&nbsp;&nbsp; <input type="text" name = "original" value = "<?php echo htmlspecialchars($originalValue)?>"></input><br />
			</h3>
		<select name = "type"> 
				<option name="Select temperature type" disabled>Please select the type of the temperature to convert from </option>
				<option value ="celsius">Celsius</option>
				<option value ="fahrenheit">Fahrenheit</option>
		<br />
		</select>
		<h3>
				<input type="submit" name = "btnSummit" value = "Summit"> </input>
			</h3>
		</form>
    </body>
</html>
