<?php
	//get the data from index.html
	$originalValue = filter_input(INPUT_POST, 'original', FILTER_VALIDATE_FLOAT);
	$temperatureType = filter_input(INPUT_POST, 'type',FILTER_SANITIZE_STRING);

	
	if($originalValue === FALSE){
		$errorMessage = 'Input temperature must be a number!!!';
	}else{
		$errorMessage = '';
	}
	if ($errorMessage != ''){
		include('index.php');
		exit();
	}else{
		$errorMessage = '';
		if($temperatureType == 'celsius'){
			$inputTemp = 'Celcius degree';
			$outputTemp = 'Fahrenheit degree';
			$outputTemperature = ($originalValue * (9/5)) +32;
			$formatedOutput = number_format($outputTemperature, 2);
		}else{
			$inputTemp = 'Fahrenheit degree';
			$outputTemp = 'Celcius degree';
			$outputTemperature = ($originalValue - 32) / (9/5);
			$formatedOutput = number_format($outputTemperature, 2);
		}
	}
		
?>
<!DOCTYPE html>
<html>
<head>
    <title>Temperature converter</title>
</head>
<body>
    <main>
        <h1>Temperature Converted Result</h1>

        <label>Input temperature:</label>
        <span><?php echo $originalValue;?></span>&nbsp;&nbsp;<span><?php echo $inputTemp;?></span> 
		
		<br>

        <label>Converted Value:</label>
        <span><?php echo $formatedOutput; ?></span>&nbsp;&nbsp;<span><?php echo $outputTemp;?></span><br>

    </main>
</body></html>

