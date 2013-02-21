<meta charset="UTF-8">
<?php


/* Load required lib files. */

require_once('twitteroauth/twitteroauth.php');
require_once('config.php');
require_once('db.php');



function getConnectionWithAccessToken($oauth_token, $oauth_token_secret) {
    $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $oauth_token, $oauth_token_secret);
    return $connection;
}
$connection = getConnectionWithAccessToken("1111876974-wLn2RaGT3BNxBTN6OEBMDOt74NsW7JhSt4XeUNF", "MlPTKIlwr6JhFjhDzlbX4YXBYiBvVJpkG9ERoirUjTU");

/* Get user access tokens out of the session. */
@$access_token = $_SESSION['access_token'];

/* Create a TwitterOauth object with consumer/user tokens. */
//$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);

/* If method is set change API call made. Test is called by default. */
//$content = $connection->get('account/verify_credentials');
$statuses=$connection->get('http://search.twitter.com/search.json?q=sigortacı+OR+sigortalatmak+OR+sigortam,');

/*
echo '<pre>';
print_r($statuses);
echo '</pre>';

$tweetMessage = "avs";
$tweedId = "253859936856076288";
$connection->post('statuses/update', array('status' => $tweetMessage));
*/


foreach($statuses->results as $stat){
   $userName = $stat->from_user;
   $tweetId =  $stat->id_str;

    if ($userName !== "" && $tweetId !== ""){
        $count = mysql_num_rows(mysql_query("Select * from tweet where tweetId = '$tweetId'"));

        if ($count < 1 ){
            $mesaj = mysql_fetch_array(mysql_query("Select * from mesaj where onay = 1 ORDER BY RAND() LIMIT 1" ));
            $tweetMessage = '@'.$userName.' '.$mesaj["mesaj"];

            if($connection->post('statuses/update', array('status' => $tweetMessage , 'in_reply_to_status_id' => $tweetId))){
               mysql_query("insert into tweet (tweetId,userName) values ('$tweetId','$userName')");
            }
        }

    }
}





