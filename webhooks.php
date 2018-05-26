<?php

$channelSecret = '551ec4feee0.....43cff0';
$access_token  = '2og9ogezC8k.......5ZUEQQdB04t89/1O/w1cDnyilFU=';

$bot = new BOT_API($channelSecret, $access_token);
  
if (!empty($bot->isEvents)) {
    
  $bot->replyMessageNew($bot->replyToken, json_encode($bot->message));

  if ($bot->isSuccess()) {
    echo 'Succeeded!';
    exit();
  }

  // Failed
  echo $bot->response->getHTTPStatus . ' ' . $bot->response->getRawBody(); 
  exit();
?>
