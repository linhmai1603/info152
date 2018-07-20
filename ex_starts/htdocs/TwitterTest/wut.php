<?php
require 'twitteroauth-master/autoload.php';
use Abraham\TwitterOAuth\TwitterOAuth;

/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
$settings = array(
'oauth_access_token' => "866093350939766785-lPdjQhfSzb4TfYDhB0MYpJF4UjoWR1b",
'oauth_access_token_secret' => "hlUlH49Jf8fiGUgJoVP4BZgZrUDg9fYgjTr4j2CsPEHfO",
'consumer_key' => "pZcWCGvvuIOrG8TtaKO563JZ6",
'consumer_secret' => "leFnvSkDUk71rytyyI5tIhh00lJPMCgpoUrXEyp1dTg6jSOBDo"
);
$url = "https://api.twitter.com/1.1/statuses/user_timeline.json";
$requestMethod = "GET";
if (isset($_GET['user']))  {$user = $_GET['user'];}  else {$user  = "iagdotme";}
if (isset($_GET['count'])) {$count = $_GET['count'];} else {$count = 20;}
$getfield = "?screen_name=$user&count=$count";
$twitter = new TwitterOAuth($settings);
$string = json_decode($twitter->setGetfield($getfield)
->buildOauth($url, $requestMethod)
->performRequest(),$assoc = TRUE);
if($string["errors"][0]["message"] != "") {echo "<h3>Sorry, there was a problem.</h3><p>Twitter returned the following error message:</p><p><em>".$string[errors][0]["message"]."</em></p>";exit();}
foreach($string as $items)
    {
        echo "Time and Date of Tweet: ".$items['created_at']."<br />";
        echo "Tweet: ". $items['text']."<br />";
        echo "Tweeted by: ". $items['user']['name']."<br />";
        echo "Screen name: ". $items['user']['screen_name']."<br />";
        echo "Followers: ". $items['user']['followers_count']."<br />";
        echo "Friends: ". $items['user']['friends_count']."<br />";
        echo "Listed: ". $items['user']['listed_count']."<br /><hr />";
    }
?>