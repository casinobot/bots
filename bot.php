<?php
include 'connect.php';
$access_token = 'W/nKmceuLG15lpwaeOccm29Y6QS5jO4nFfEy7b7od76ElvLtP6W7LyTPmRcRxBWXC+gpL44kRY+YyMjYE9YTOdVoJZTAcX/kHyydVODzsQFdEgu6JSdcbTG7WoWzL6ChjxABI7l9JAn6D/8tTyjv7QdB04t89/1O/w1cDnyilFU=';
// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true); 
if (!is_null($events['events'])) {
 // Loop through each event
 foreach ($events['events'] as $event) {
  // Reply only when message sent is in 'text' format
  if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
   // Get text sent
   $text = $event['message']['text'];
   $Str_file = explode(",",$text);
   $query=$conn->prepare("SELECT * from [ehongdb].[dbo].[EMPLOYEE] where US_NAME='$Str_file[0]' and US_PASSWD='$Str_file[1]'");
   $query->execute();
   $fecthUL=$query->fetch();
    $numRows=$query->rowCount();
    $lineId="";
       $breakswitch=false;
    if ($numRows!=0 && $fecthUL['EM_STATUS']!="RS") {
      $queryU=$conn->prepare("SELECT * from [ServicesRepaired].[dbo].[repaire] where emp_id='$Str_file[0]'");
      $queryU->execute();
      $numRowsU=$queryU->rowCount();
      $fetchUl=$queryU->fetch();
      if($numRowsU==0){
        $lnI=$event['source']['userId'];
        $queryUln=$conn->prepare("SELECT * from [ServicesRepaired].[dbo].[repaire] where line_id like '$lnI'");
        $queryUln->execute();
        $numRowsUln=$queryUln->rowCount();
        $fetchUlln=$queryUln->fetch();
        if($numRowsUln==0){
            $lineId=$event['source']['userId'];
            $ms="บันทึกข้อมูลเรียบร้อย\nเข้าใช้ระบบทาง GooGle Chrome";
             switch ($event['source']['type']) {
                case 'user':
                 $messages = [
                  'type' => 'text',
                  'text' => $ms
                  //'text' => 'userId: '.$event['source']['userId']
                 ];
                 break;
                case 'room':
                 $messages = [
                  'type' => 'text',
                  'text' => $ms
                  //'text' => 'roomId: '.$event['source']['roomId'].' userId: '.$event['source']['userId']
                 ];
                 break;
                case 'group':
                 $messages = [
                  'type' => 'text',
                  'text' => $ms
                  //'text' => 'groupId: '.$event['source']['groupId']
                 ];
                 break;
                
                default:
                 # code...
                 break;                 
             }
             $add=$conn->prepare("INSERT into [ServicesRepaired].[dbo].[repaire](emp_id,line_id) values ('$Str_file[0]','$lineId')");
             $add->execute();
        }else{
            switch ($event['source']['type']) {
              case 'user':
               $messages = [
                'type' => 'text',
                //'text' => 'userId: '.$event['source']['userId']
                'text' => 'line นี้ได้สมัครใช้งานเรียบร้อยแล้ว'
               ];
               break;
              case 'room':
               $messages = [
                'type' => 'text',
                'text' => 'line ี้ได้สมัครใช้งานเรียบร้อยแล้ว'
                //'text' => 'roomId: '.$event['source']['roomId'].' userId: '.$event['source']['userId']
               ];
               break;
              case 'group':
               $messages = [
                'type' => 'text',
                'text' => 'line ี้ได้สมัครใช้งานเรียบร้อยแล้ว'
                //'text' => 'groupId: '.$event['source']['groupId']
               ];
               break;
              
              default:
               # code...
               break;
           }

        }         
     }else{       
        switch ($event['source']['type']) {
          case 'user':
           $messages = [
            'type' => 'text',
            //'text' => 'userId: '.$event['source']['userId']
            'text' => 'รหัสี้ได้สมัครใช้งานเรียบร้อยแล้ว'
           ];
           break;
          case 'room':
           $messages = [
            'type' => 'text',
            'text' => 'รหัสี้ได้สมัครใช้งานเรียบร้อยแล้ว'
            //'text' => 'roomId: '.$event['source']['roomId'].' userId: '.$event['source']['userId']
           ];
           break;
          case 'group':
           $messages = [
            'type' => 'text',
            'text' => 'รหัสี้ได้สมัครใช้งานเรียบร้อยแล้ว'
            //'text' => 'groupId: '.$event['source']['groupId']
           ];
           break;
          
          default:
           # code...
           break;
       }
     }
    }else {
      $txt1="รหัสพนักงานไม่ถูกต้อง\nใส่ รหัสพนักงาน,รหัสผ่าน\nเช่น A000,B000 \nหรือท่านไม่มีสิทธิ์เข้าใช้งาน";
      switch ($event['source']['type']) {
          case 'user':
           $messages = [
            'type' => 'text',
            //'text' => 'userId: '.$event['source']['userId']
            'text' => $txt1
          ];
          case 'room':
           $messages = [
            'type' => 'text',
            'text' => $txt1
            //'text' => 'roomId: '.$event['source']['roomId'].' userId: '.$event['source']['userId']
           ];
           break;
          case 'group':
           $messages = [
            'type' => 'text',
            'text' => $txt1
            //'text' => 'groupId: '.$event['source']['groupId']
           ];
           break;
          
          default:
           # code...
           break;
       }
    }
   // $user=$event['source']['userId'];
   // Build message to reply back
   // $messages = [
   //  'type' => 'text',
   //  'text' => $text."\n".$jsuser['displayName']."\n".$jsuser['pictureUrl']."\n".$jsuser['statusMessage']
   // ];
   
   // array_push($messages, ['type' => 'text','text' => 'uid \n '.$user]);
   
   // Get replyToken
   $replyToken = $event['replyToken'];
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
   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
   $result = curl_exec($ch);
   echo curl_error($ch);
   echo $result . "\r\n";
   curl_close($ch);
  }
 }
}
?>