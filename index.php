<meta charset="UTF-8">
<?php


/* Load required lib files. */

require_once('twitteroauth/twitteroauth.php');
require_once('config.php');




function getConnectionWithAccessToken($oauth_token, $oauth_token_secret) {
    $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $oauth_token, $oauth_token_secret);
    return $connection;
}
$connection = getConnectionWithAccessToken("olusturdugunuz acces tokenn", "olusturdugunuz acces tokenn");

/* Get user access tokens out of the session. */
@$access_token = $_SESSION['access_token'];

/* Create a TwitterOauth object with consumer/user tokens. */
//$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);

/* If method is set change API call made. Test is called by default. */
//$content = $connection->get('account/verify_credentials');
$statuses=$connection->get('http://search.twitter.com/search.json?q=arayacaginiz kelimeler,,');

/*
echo '<pre>';
print_r($statuses);
echo '</pre>';

$tweetMessage = "avs";
$tweedId = "253859936856076288";
$connection->post('statuses/update', array('status' => $tweetMessage));
*/


foreach($statuses->results as $stat){
   echo $stat->from_user;
   echo $stat->id_str;

    
}





