<?php

require_once(__DIR__ . '/vendor/LINEBotTiny.php');
require_once(__DIR__ . '/vendor/autoload.php');
require_once(__DIR__ . '/config.php');

use Carbon\Carbon;
$channelAccessToken = $CONF['CATBOT_CHANNEL_ACCESS'];
$channelSecret = $CONF['CATBOT_CHANNEL_SECRET'];

$client = new LINEBotTiny($channelAccessToken, $channelSecret);

function sendMessage($destination, $msg) {
	global $client;
	$message = ['to' =>$destination, 'messages' => [['type' => 'text', 'text' => $msg]]];
	$client->pushMessage($message);
}


if(php_sapi_name() == 'cli' && $argv[1] == 'endnotes') {
	//nag for notes
	$nagMessageText = 'Time to make the notes for shield-til-end and break-at-end!';
	//sendMessage( $CONF['COMMANDER_ROOM_ID'], $nagMessageText);
	sendMessage( $CONF['DEBUG_ROOM_ID'], $nagMessageText);
}

if(php_sapi_name() == 'cli' && $argv[1] == 'seasonchange') {
	//nag for screenshots
	$nagMessageText = 'PVP ends in 4 hours - late climbers get ready! :)';
	sendMessage( $CONF['ALPHA_ROOM_ID'], $nagMessageText);
	sendMessage( $CONF['BETA_ROOM_ID'], $nagMessageText);
	sendMessage( $CONF['GAMMA_ROOM_ID'], $nagMessageText);
	sendMessage( $CONF['LATECLIMBER_ROOM_ID'], $nagMessageText);
}
?>
