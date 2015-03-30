<?php
require_once __DIR__ . '/Client.php';

class BotDetector
{
    const MAC = 'mac';
    const LINUX = 'linux';

    private $client;
    private $serverOS;

    public function __construct() {
        $this->client = new Client();
    }

    public function setServerOS ($os) {
        switch (strtolower($os)) {
            case self::MAC:
                $this->serverOS = self::MAC;
                break;
            case self::LINUX:
                $this->serverOS = self::LINUX;
                break;
            default:
                throw new Exception("BotDetector: this OS is not supported.", 1);
                break;
        }
    }

    public function isBot() {
        // Social media bots
        $bots = json_decode(file_get_contents(__DIR__ . '/bots.json'))->useragents;
        // If its a crawler or a social media bot
        return (isset($_GET['_escaped_fragment_']) ||
            in_array($_SERVER['HTTP_USER_AGENT'], $bots) ||
            strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'twitterbot') !== false ||
            strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'google') !== false  ||
            strpos(strtolower($_SERVER['REMOTE_ADDR']), 'googlebot') !== false
            );
    }

    public function displayStaticContent() {
        if(isset($_GET['_escaped_fragment_'])) {
            // The case of the crawler
            $fragment = $_GET['_escaped_fragment_'];
            $startFragment = substr($fragment, 0, 1);
            if($startFragment != '/') {
                $fragment = '/'.$fragment;
            }
        } else {
            // Social media bot
            $fragment = $_SERVER["REQUEST_URI"];
        }
        $http = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 'https://' : 'http://';
        $url = $http.$_SERVER['HTTP_HOST'].$fragment;

        $this->client->setPhantomJs(__DIR__ . '/phantom/bin/'. $this->serverOS .'/phantomjs');
        $this->client->setScript(__DIR__ . '/phantom/script.js');
        $this->client->setUrl($url);

        echo $this->client->send();
        die();
    }
}