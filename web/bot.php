<?php 

ob_start();

$API_KEY = '1493291816:AAGt_rXHbSfLbCWujGk7ZI-PzxAArrG0qzI';
##------------------------------##
define('API_KEY',$API_KEY);
function bot($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}
 function sendmessage($chat_id, $text, $model){
 bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>$text,
 'parse_mode'=>$mode
 ]);
 }
//====================Tikapp======================//
$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$message_id = $message->message_id;
$from_id = $message->from->id;
$chat_id = $message->chat->id;
$first_name = $message->from->first_name;
$last_name = $message->from->last_name;
$username = $message->from->userame;
$text = $message->text;
$reply = $update->message->reply_to_message;
$video = $message->video;
$ADMIN = 000000;
//====================Tikapp======================//
if($text == '/start'){
bot('sendmessage',[
 'chat_id'=>$chat_id,
 'text'=>"Hemlo",
'reply_to_message_id'=>$message_id,
 ]);
}
if($text !== '/start'){
$vo = file_get_contents('http://tts.baidu.com/text2audio?lan=en&ie=UTF-8&text='.urlencode($text));
 file_put_contents('in.ogg',$vo);
 bot('sendvoice',[
 'chat_id'=>$chat_id,
'reply_to_message_id'=>$message_id,
 'voice'=>new CURLFile('in.ogg'),
 ]);
 unlink('in.ogg');
 }
