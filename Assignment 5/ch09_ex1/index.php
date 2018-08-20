<?php
if (isset($_POST['action'])) {
    $action =  $_POST['action'];
} else {
    $action =  'start_app';
}

switch ($action) {
    case 'start_app':
        $message = 'Enter some data and click on the Submit button.';
        break;
    case 'process_data':
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        /*************************************************
         * validate and process the name
         ************************************************/
        // 1. make sure the user enters a name
		if (empty($name)){
			$message = 'Please enter a name.';
		}
        // 2. display the name with only the first letter capitalized
		else{
			$name = ucfirst(strtolower($name));
			$i = strpos($name, ' ');
			$nameEdited = substr($name, 0, $i);	
			$message = "Name: " .$nameEdited . "\n";		
		}
        /*************************************************
         * validate and process the email address
         ************************************************/
        // 1. make sure the user enters an email
		if (empty($email)){
			$message = 'Please enter an email.';
			echo ($message . '345');
		}
        // 2. make sure the email address has at least one @ sign and one dot character
		else if (strpos($email, '@') == false || strpos($email, ".") == false){
				$message = 'The entered email is not in the correct format.';
			
		}else {
			$message = $message . "Email: " .$email . "\n"; 
		}
        /*************************************************
         * validate and process the phone number
         ************************************************/
        // 1. make sure the user enters at least seven digits, not including formatting characters
		if	(strlen($phone) < 7){
			$message = 'The phone number must be at least seven digits.';
		}
        // 2. format the phone number like this 123-4567 or this 123-456-7890
		else{
			if(strlen($phone) == 7){
				$part1 = substr($phone, 0, 3);
				$part2 = substr($phone, 3);
				$format = $part1 . '-' . $part2;	
				$message = $message . "Phone Number:" .$format;
			}else{	
				$part1 = substr($phone, 0, 3);
				$part2 = substr($phone, 3, 3);
				$part3 = substr($phone, 6);
				$format = $part1 . '-' . $part2 . '-' . $part3;	
				$message = $message ."Phone Number: " .$format;
			}
		}
        /*************************************************
         * Display the validation message
         ************************************************/
        //$message = "This page is under construction.\n" .
        //           "Please write the code that process the data.";

        break;
}
include 'string_tester.php';
?>