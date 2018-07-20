<?php
	ini_set("auto_detect_line_endings", true);
	$file = fopen("Employment.csv","r");
	$row = 1;
	if($file){
		while(($data = fgetcsv($file, 4096, ",")!== false){
			$num = count($data);
			echo "<p> $num fields in line $row: <br /></p>\n";
			$row++;
			for ($i=0; $i < $num; $i++){
				echo $data[$c] . "<br /> \n";	
			}
		}
	}
	fclose($file);
?>