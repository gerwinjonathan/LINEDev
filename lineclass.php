<?php

require_once __DIR__ . '/bot.php';

class Linebot {
    private $channelAccessToken;
    private $channelSecret;
    private $webhookResponse;
    private $webhookEventObj;
    private $APIReply;
    private $APIPush;

    public function __construct() {
        $this->channelAccessToken = Setting::getChannelAccessToken();
        $this->channelSecret = Setting::getChannelSecret();
        $this->APIReply = Setting::getAPIReply();
        $this->APIPush = Setting::getAPIPush();
        $this->webhookResponse = file_get_contents('php://input');
        $this->webhookEventObj = json_decode($this->webhookResponse);
    }

    private function httpPost($api, $body) {
        $ch = curl_init($api);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json; charser=UTF-8',
            'Authorization: Bearer ' . $this->channelAccessToken));
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    public function Reply($text) {
        $api = $this->APIReply;
        $webhook = $this->webhookEventObj;
        $replyToken = $webhook->{"events"}[0]->{"replyToken"};
        $body["replyToken"] = $replyToken;
        $body["messages"][0] = array(
            "type" => "text",
            "text" => $text
        );

        $result = $this->httpPost($api, $body);
        return $result;
    }

    public function getMessageText() {
        $webhook = $this->webhookEventObj;
        $messageText = $webhook->{"events"}[0]->{"message"}->{"text"};
        return $messageText;
    }

    public function postbackEvent() {
        $webhook = $this->webhookEventObj;
        $postback = $webhook->{"events"}[0]->{"postback"}->{"text"};
        return $postback;
    }

    public function getUserId() {
        $webhook = $this->webhookEventObj;
        $userId = $webhook->{"events"}[0]->{"source"}->{"userId"};
        return $userId;
    }

}

?>