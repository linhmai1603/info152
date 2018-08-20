<?php
if (isset($_POST['action'])) {
    $action =  $_POST['action'];
} else {
    $action =  'start_app';
}

switch ($action) {
    case 'start_app':

        // set default invoice date 1 month prior to current date
        $interval = new DateInterval('P1M');
        $default_date = new DateTime();
        $default_date->sub($interval);
        $invoice_date_s = $default_date->format('n/j/Y');

        // set default due date 2 months after current date
        $interval = new DateInterval('P2M');
        $default_date = new DateTime();
        $default_date->add($interval);
        $due_date_s = $default_date->format('n/j/Y');

        $message = 'Enter two dates and click on the Submit button.';
        break;
    case 'process_data':
        $invoice_date_s = $_POST['invoice_date'];
        $due_date_s = $_POST['due_date'];
		$message = '';
        // make sure the user enters both dates
		if(empty($invoice_date_s) or empty($due_date_s)){
			$message = 'Please enter both dates.';
		}
        // convert date strings to DateTime objects
        // and use a try/catch to make sure the dates are valid
		$invoice_dateTime = new DateTime($invoice_date_s);
		$invoice_d = $invoice_dateTime->format('d');
		$invoice_m = $invoice_dateTime->format('m');
		$invoice_y = $invoice_dateTime->format('Y');
		$due_dateTime = new DateTime($due_date_s);
		$due_d = $due_dateTime->format('d');
		$due_m = $due_dateTime->format('m');
		$due_y = $due_dateTime->format('Y');
		if (checkdate($invoice_m,$invoice_d,$invoice_y) == false|| checkdate($due_m, $due_d, $due_y) == false){
			$message = 'Please enter valid dates.';		
			}
			
        // make sure the due date is after the invoice date
		$time_span = $due_dateTime->diff($invoice_dateTime);
		$num_days = $time_span->days;
		if ($num_days < 0){
			$message = 'Due date needs to be after the invoice date.';
		}	
        // format both dates
		$invoice_date_f = $invoice_dateTime->format('F d , Y');
		$due_date_f = $due_dateTime->format('F d , Y');
        // get the current date and time and format it
		$now = new DateTime();
		$tz = new DateTimeZone('America/New_York');
		$now->setTimezone($tz);
		$current_date_f = $now->format('F d, Y');
		$current_time_f = $now->format('H:i:s');
        // get the amount of time between the current date and the due date
        // and format the due date message
		$time_span2 = $due_dateTime->diff($now);
		if ($due_dateTime < $now){
			$due_date_message = 'This invoice is due in: ' . $time_span2->format('%Y years, %m months, and %d days overdue.');
		}else{
			$due_date_message = 'This invoice is due in: ' . $time_span2->format('%Y years, %m months, and %d days.');
		}	
        break;
}
include 'date_tester.php';
?>