<?php

$channelSecret = '45c7d0c08388a9499cc434c975a4898a
';
$access_token  = '9b8Kvo72cNV+WCaYMPLzdQpYCpjCWtANVmdgs/koNKIAunT0CtAD4p2NYDallTCdC+gpL44kRY+YyMjYE9YTOdVoJZTAcX/kHyydVODzsQEsWUR0AP92ZBXC8/Kk9tImGYVEwn2UkFir/GF1XObPQAdB04t89/1O/w1cDnyilFU=';

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
