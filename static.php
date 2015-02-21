<?php
require_once 'php/OnePage-SEO/Client.php';

$client = new Client();
$client->setPhantomJs(__DIR__ . '/phantom/bin/mac/phantomjs');
// or
// $client->setPhantomJs(__DIR__ . '/phantom/bin/linux/phantomjs');
$client->setScript(__DIR__ . '/phantom/script.js');
$url = $_GET['url'];
$client->setUrl($url);

$html = $client->send();

// Set correct URL
$re = "/<meta property=\"og:url\" content=\"[a-zA-Z:\\/\\/#!-_]*\">/";
$html = preg_replace($re, '<meta property="og:url" content="'.$url.'">', $html);

echo $html;
