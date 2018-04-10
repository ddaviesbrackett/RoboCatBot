<?php
require_once(__DIR__ . '/vendor/LINEBotTiny.php');
require_once(__DIR__ . '/config.php');
$channelAccessToken = $CONF['CATBOT_CHANNEL_ACCESS'];
$channelSecret = $CONF['CATBOT_CHANNEL_SECRET'];


$client = new LINEBotTiny($channelAccessToken, $channelSecret);
foreach ($client->parseEvents() as $event) {
    switch ($event['type']) {
        case 'message':
            $message = $event['message'];
            switch ($message['type']) {
                case 'text':
                    
                    break;
                default:
                    break;
            }
            $source = $event['source'];
            if(isset($CONF['DEBUG_ECHO']) && isset($event['source']['groupId']) && $event['source']['groupId'] == $CONF['DEBUG_ROOM_ID'])
            {
                $profile = $client->profile($event['source']['userId']);
                error_log('got a message from user ID ' . $event['source']['userId'] . ', displayName '.$profile->displayName.' message '.$message['text']);

                $client->replyMessage([
                    'replyToken' => $event['replyToken'],
                    'messages' => [
                        [
                            'type' => 'text',
                            'text' => 'from user ID:'. $event['source']['userId'] . '
                                echoing: '.$message['text'] .'
                                displayName: '. $profile->displayName
                            ]
                        ]
                    ]);

             }

            break;
        case 'join':
            $source = $event['source'];
            error_log('joined somewhere, type: '.$source['type'].', groupId:'.$source['groupId'].'');
            break;
        default:
            break;
    }
};