<?php
//
// A very simple PHP example that sends a HTTP POST to a remote site
//
define('API_ACCESS_KEY','AIzaSyCu4hAVR2msOjx7B_eyn95y1kkTqfU1yGM');
    $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
    $token='235zgagasd634sdgds46436';

        $notification = [
                'title' =>'title',
                'body' => 'body of message.',
                'icon' =>'myIcon', 
                'sound' => 'mySound'
            ];
            $extraNotificationData = ["message" => $notification,"moredata" =>'dd'];

            $fcmNotification = [
                //'registration_ids' => $tokenList, //multple token array
                'to'        => $token, //single token
                'notification' => $notification,
                'data' => $extraNotificationData
            ];

            $headers = [
                'Authorization: key=' . API_ACCESS_KEY,
                'Content-Type: application/json'
            ];


            $ch = \curl_init();
            curl_setopt($ch, CURLOPT_URL,$fcmUrl);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
            $result = curl_exec($ch);
            curl_close($ch);
            /*
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL,"http://www.example.com/tester.phtml");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,
            "postvar1=value1&postvar2=value2&postvar3=value3");

// In real life you should use something like:
// curl_setopt($ch, CURLOPT_POSTFIELDS, 
//          http_build_query(array('postvar1' => 'value1')));

// Receive server response ...
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$server_output = curl_exec($ch);

curl_close ($ch);*/

// Further processing ...
if ($result) { echo'ok'; } else { echo'error';  }
?>


