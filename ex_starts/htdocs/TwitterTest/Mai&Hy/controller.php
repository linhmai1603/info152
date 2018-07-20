<?php
	include 'database.php';
	include 'functions.php';
	include 'index.php';

require 'twitteroauth-master/autoload.php';
use Abraham\TwitterOAuth\TwitterOAuth;

$searchWord = $_POST['search'];


define('CONSUMER_KEY', 'pZcWCGvvuIOrG8TtaKO563JZ6');
define('CONSUMER_SECRET', 'leFnvSkDUk71rytyyI5tIhh00lJPMCgpoUrXEyp1dTg6jSOBDo');
define('ACCESS_TOKEN', '866093350939766785-lPdjQhfSzb4TfYDhB0MYpJF4UjoWR1b');
define('ACCESS_TOKEN_SECRET', 'hlUlH49Jf8fiGUgJoVP4BZgZrUDg9fYgjTr4j2CsPEHfO');

function search(array $query)
{
  $twitter = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET);
  return $twitter->get('search/tweets', $query);
}
 
$query = array(
  "q" => "$searchWord",
); 
  
$results = search($query); 


echo'<hr>';


$objects = tweets2array($results);

echo 'Total tweets: '.count($objects);
echo '<br>';


$database = new Database('twitter');

$table = 'tweets';

$database ->insertTweets($objects);
$database ->close();
echo '<br>';



?>

