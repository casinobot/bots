<?php // callback.php
include 'botApi.php';

//require "vendor/autoload.php";
require_once('vendor/linecorp/line-bot-sdk/line-bot-sdk-tiny/LINEBotTiny.php');

$access_token = 'R+ksiFqfirX6YbUbLrX0wURJYEBj1gAq+w4PyZrUxVy+e6cKowvlPd/iwkbtnyZXC+gpL44kRY+YyMjYE9YTOdVoJZTAcX/kHyydVODzsQFullnczyaS6FN7m5rqbAlFMp6Gv0ik1Z+FWc4Y6+JufQdB04t89/1O/w1cDnyilFU=';
$u_id;

// Cca768dbe769160b0bd462af687250b7f   token group chat
// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
    // Loop through each event
    foreach ($events['events'] as $event) {
        // Reply only when message sent is in 'text' format
        if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
            // Get text sent
            $u_id=$event['source']['userId'];
            $name=regPlay($u_id);
            switch ($event['source']['type']) {
                case 'user':
                 $messages = [
                  'type' => 'text',
                  'text' => 'userId: '.$event['source']['userId']
                 ];
                 break;
                case 'room':
                 $messages = [
                  'type' => 'text',
                  'text' => 'roomId: '.$event['source']['roomId'].' userId: '.$event['source']['userId']
                 ];
                 break;
                case 'group':
                    $botMs=strtoupper($event['message']['text']);
                    if($botMs=="PLAY"){
                        $u_id=$event['source']['userId'];
                        $g_id=$event['source']['groupId'];
                        $re=regPlay($u_id);
                        $text="uId : ".$u_id."\ngroupId : ".$g_id."\nName : ".$re; //.$text."คุณ : ".$re;                        
                    }
                    if($botMs[0]=="T"){
                        $t1=0;
                        $t2=0;
                        $t3=0;
                        $t4=0;
                        $tang=explode("-", $botMs);
                        // $tang=split("-", $botMs);
                        for ($i=strlen($tang[0]); $i >0 ; $i--) { 
                           if($tang[0][$i-1]==1) $t1=$tang[1];
                           else if($tang[0][$i-1]==2) $t2=$tang[1];
                           else if($tang[0][$i-1]==3) $t3=$tang[1];
                           else if($tang[0][$i-1]==4) $t4=$tang[1];
                        }
                        if($t1!=0) $text="คุณ ".$name." แทงขา t1";
                        if($t2!=0) $text=$text.",t2";
                        if($t3!=0) $text=$text.",t3";
                        if($t4!=0) $text=$text.",t4";
                        $text=$text." ขาล่ะ".$tang[1]." บาท";
                        // .$t1."\nt2 : ".$t2."\nt3 : ".$t3."\nt4 : ".$t4;
                    }                                         
                    break;                
                default:
                 break;                 
             }
            
            // Get replyToken
            $replyToken = $event['replyToken'];             
            $messages = [
              'type' => 'text',
              'text' => $text
              // 'text' => $ms
              // 'text' => 'groupId: '.$event['source']['groupId']
             ];
            // Make a POST Request to Messaging API to reply to sender
            $url = 'https://api.line.me/v2/bot/message/reply';
            $data = [
                'replyToken' => $replyToken,
                'messages' => [$messages],
            ];
            $post = json_encode($data);
            $headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            $result = curl_exec($ch);
            curl_close($ch);
            echo $result . "\r\n";
        }
    }
    
    
}
echo "OK";
