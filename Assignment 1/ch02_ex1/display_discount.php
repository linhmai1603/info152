<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Product Discount Calculator</title>
    <link rel="stylesheet" type="text/css" href="main.css" />
</head>
<body>
    <div id="content">
        <h1>Product Discount Calculator</h1>
		<?php $product_description = $_POST['product_description']; ?>
		<?php $list_price = $_POST['list_price']; ?>
		<?php $discount_percent = $_POST['discount_percent']; ?>
		<?php $discount_amount = ($discount_percent * $list_price) /100; ?>
		<?php $discount_price = $list_price - $discount_amount; ?>
        <label>Product Description:</label>		
        <span><?php echo $product_description; ?></span><br />

        <label>List Price:</label>
		<?php $list_price_formatted = "$" . $list_price ?>
        <span><?php echo $list_price_formatted; ?></span><br />

        <label>Standard Discount:</label>
		<?php $discount_percent_formatted = "$". $discount_percent ."%" ; ?>
        <span><?php echo $discount_percent_formatted; ?></span><br />

        <label>Discount Amount:</label>
		<?php $discount_formatted = "$" . $discount_amount ?>
        <span><?php echo $discount_formatted; ?></span><br />

        <label>Discount Price:</label>
		<?php $discount_price_formatted = "$" . $discount_price ?>
        <span><?php echo $discount_price_formatted; ?></span><br />

        <p>&nbsp;</p>
    </div>
</body>
</html>