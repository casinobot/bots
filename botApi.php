<?php // callback.php
include '../services/api.php';
require "vendor/autoload.php";
require_once('vendor/linecorp/line-bot-sdk/line-bot-sdk-tiny/LINEBotTiny.php');
$access_token = 'R+ksiFqfirX6YbUbLrX0wURJYEBj1gAq+w4PyZrUxVy+e6cKowvlPd/iwkbtnyZXC+gpL44kRY+YyMjYE9YTOdVoJZTAcX/kHyydVODzsQFullnczyaS6FN7m5rqbAlFMp6Gv0ik1Z+FWc4Y6+JufQdB04t89/1O/w1cDnyilFU=';

$name="Aone";
// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
function regPlay($uid){
  global $access_token;
//   $uid="U1cc479767864cf8c57629e6b1623e2f6";
  $userId=(string)$uid;
  $url = 'https://api.line.me/v2/bot/profile/'.$userId;
//   $url = 'https://api.line.me/v2/bot/group/Cca768dbe769160b0bd462af687250b7f/members/ids';
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
  $u_id=$jsuser['userId'];
  $name=$jsuser['displayName'];
  $urlpic=$jsuser['pictureUrl'];
  $statMsg=$jsuser['statusMessage'];
  // addUser($u_id,$name,$urlpic,$statMsg);
/*---------------------  เอาค่าใน $jsuser ลง DB  --------------------*/
  $user=$name;
  return $user;
  
}
function checkMoney($uId){
  /*global $con;
  $selectUser="SELECT * from tb_user where user_token='$uId'";
  $queryUser=mysqli_query($con,$selectUser);
  $rowUser=mysqli_fetch_array($queryUser);
  $selectAcc="SELECT * from tb_account where user_id='$rowUser[user_id]'";
  $queryAcc=mysqli_query($con,$selectAcc);
  $rowAcc=mysqli_fetch_array($queryAcc);
  $money=$rowAcc['account_total'];*/
  $money=100;
  return $money;
  // $numAcc=$queryAcc->num_rows;
}
function addRound($uId){
  date_default_timezone_set("Asia/Bangkok");
  $date=date("Y-m-d H:i:s");
  // global $con;
  // $selectUser="SELECT * from tb_Admin where admin_token='$uId'";
  // $queryUser=mysqli_query($con,$selectUser);
  // $numUser=$queryUser->num_rows;
  $numUser=1;
  if($numUser>0){
    $numRound=0;
    // $selecetRound="SELECT * from tb_round";
    // $queryRound=mysqli_query($con,$selecetRound);
    // $numRound=$queryRound->num_rows;
    $numRound=$numRound+1;
    $rName="เกมส์ที่".$numRound;
    /*$sqlAddRound="INSERT into tb_round values(null,'$rName',0,0,0,$date)";
    $queryRound=mysqli_query($con,$selecetRound);*/
    return $rName;
  }

}
echo "bot Api1<br>";
?>
