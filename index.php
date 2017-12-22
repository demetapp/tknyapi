<?php


$access_token="EAACNa3KvCn0BAGoXq6gWR8uC5bvf0Nacgy5HQ9dwLk0x9CATOvrcyqDgTLRYBRYzqZBAGlv7TtRnNvZBHGCMdCQ1zOS2DZC9XbOwG53i3Y40rO0MpBTG5wZAyIhZAOzzUeSRZAtYJIFYrFnfHJZBSqRyhb5etDwa6NDOej8QUAXIwZDZD";

$verify_token=null;

if(isset($_REQUEST['hub_mode']) && $_REQUEST['hub_mode']== 'subscribe'){

$challenge = $_REQUEST['hub_challenge'];
$hub_verify_token = $_REQUEST['hub_verify_token'];

if($hub_verify_token === $verify_token)
{
header('HTTP/1.1 200 OK');
echo $challenge;
die;

}


}

$input = json_decode(file_get_contents('php://input'),true);

$sender = $input['entry'][0]['messagging'][0]['sender'][id];

$message = isset ($input['entry'][0]['messaging'][0]['message'][0]['text'])? 

$input['entry'][0]['messaging'][0]['message'][0]['text']: '';


if($message)
{
$message_to_reply = "this is the message to send back";

$url = "https://graph.facebook.com/v2.6/me/messages?access_token=".$access_token;

$jsonData = '{

"recipient":{

"id":"'.$sender.'"},
"message":{

"text":"'.$message_to_reply.'"

}


}';

$ch = curl_init($url);
curl_setopt($ch,CURLOPT_POST,1);
curl_setopt($ch,CURLOPT_POSTFIELDS,$jsonData);
curl_setopt($ch,CURLOPT_HTTPHEADER,array('Content-Type: application/json'));
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);

$result = curl_exec($ch);

curl_close($ch);



}





?>
