<?php 
/**
 * Twitter API SEARCH
 * Selim Hallaç
 * selimhallac@gmail.com
 */

include "twitteroauth/twitteroauth.php";
include 'database.php';
include 'functions.php';
$consumer_key = "pZcWCGvvuIOrG8TtaKO563JZ6";
$consumer_secret = "leFnvSkDUk71rytyyI5tIhh00lJPMCgpoUrXEyp1dTg6jSOBDo";
$access_token = "866093350939766785-lPdjQhfSzb4TfYDhB0MYpJF4UjoWR1b";
$access_token_secret = "hlUlH49Jf8fiGUgJoVP4BZgZrUDg9fYgjTr4j2CsPEHfO";

$twitter = new TwitterOAuth($consumer_key,$consumer_secret,$access_token,$access_token_secret);

$tweets = $twitter->get('https://api.twitter.com/1.1/search/tweets.json?q=merhaba&result_type=recent&count=20');

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Twitter API SEARCH</title>
</head>
<body>
<?php 
	if(isset($_POST['keyword'])){
		$tweets = $twitter->get('https://api.twitter.com/1.1/search/tweets.json?q=' .$POST['keyword'] . '&result_type=recent&count=50');
	}
	foreach ($tweets as $tweet) { 
		foreach ($tweet as $t){
			echo '<img src="' .$t->user->profile_image_url. '"/> ' .$t -> text . '<br>.';
		}
		?>
<?php } ?>
  

</body>
</html>