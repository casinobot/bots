<?php // callback.php
// include 'conn.php';
require "vendor/autoload.php";
require_once('vendor/linecorp/line-bot-sdk/line-bot-sdk-tiny/LINEBotTiny.php');

$access_token = 'R+ksiFqfirX6YbUbLrX0wURJYEBj1gAq+w4PyZrUxVy+e6cKowvlPd/iwkbtnyZXC+gpL44kRY+YyMjYE9YTOdVoJZTAcX/kHyydVODzsQFullnczyaS6FN7m5rqbAlFMp6Gv0ik1Z+FWc4Y6+JufQdB04t89/1O/w1cDnyilFU=';

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
  $u_id=$jsuser['userId'];
  $name=$jsuser['displayName'];
  $urlpic=$jsuser['pictureUrl'];
  $statMsg=$jsuser['statusMessage'];
//   $sqlAdduser="INSERT INTO tb_user values(null,'$name','$u_id','$urlpic','-')";
//   $queryAdduser=mysqli_query($con,$sqlAdduser);
//   echo "<script>window.location='http://www.casinopanels.com/services/api.php?func=addUser&user=+".$u_id."+&name=+".$name."+&urlpic=+".$urlpic."+&statMsg=+".$statMsg."+';</script>";
  header('Location: http://www.casinopanels.com/services/api.php?func=addUser&user='.$u_id.'&name='.$name.'&urlpic='.$urlpic.'&statMsg='.$statMsg);
/*---------------------  เอาค่าใน $jsuser ลง DB  --------------------*/
  $user=$uid;
  return $user;
  
}
echo "a";
?>
