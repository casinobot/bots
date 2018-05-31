<?php // callback.php

require "vendor/autoload.php";
require_once('vendor/linecorp/line-bot-sdk/line-bot-sdk-tiny/LINEBotTiny.php');

$access_token = '9b8Kvo72cNV+WCaYMPLzdQpYCpjCWtANVmdgs/koNKIAunT0CtAD4p2NYDallTCdC+gpL44kRY+YyMjYE9YTOdVoJZTAcX/kHyydVODzsQEsWUR0AP92ZBXC8/Kk9tImGYVEwn2UkFir/GF1XObPQAdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
function regPlay($uid){
//   $uid="U1cc479767864cf8c57629e6b1623e2f6";
  $url = 'https://api.line.me/v2/bot/profile/'.$uid;
  $headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  $result = curl_exec($ch);
  echo curl_error($ch);
  curl_close($ch);
  $jsuser=json_decode($result, true);
//   echo $jsuser['displayName'];
/*---------------------  เอาค่าใน $jsuser ลง DB  --------------------*/
  $user=$uid;
  return $user;
}
echo "tt ok";
?>
