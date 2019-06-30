<?php

class Setting {
    public function getChannelAccessToken() {
        $channelAccessToken = "rIX37JjnpzIUGJmtQ/Ba8j1ol55s3AeW5RnSYEnmCBKYWkIb3x5EJ7yukIdruy4GkJKbG60T7tx12kFGOHVWWPqjW8ymuYVtCJhGVLl06ZpO0tCxD9CPDttkUHSRyq1VoDf69/yoihv9t+o6KCUeuAdB04t89/1O/w1cDnyilFU=";
        return $channelAccessToken;
    }

    public function getChannelSecret() {
        $channelSecret = "4aa61850a71d3ccad137b7f2d5d591d6";
        return $channelSecret;
    }

    public function getAPIReply() {
        $api = "https://api.line.me/v2/bot/message/reply";
        return $api;
    }

    public function getAPIPush() {
        $api = "https://api.line.me/v2/bot/message/push";
        return $api;
    }

}