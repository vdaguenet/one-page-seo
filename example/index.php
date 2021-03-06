<?php
    include_once __DIR__ . '/../BotDetector.php';

    $detector = new BotDetector();
    $detector->setServerOS($detector::LINUX);
    if($detector->isBot()) {
        $detector->displayStaticContent();
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0,minimum-scale=1.0, maximum-scale = 1.0, user-scalable=no" />

        <!-- facebook meta -->
        <meta property="og:image" content="path/to/share/image"/>
        <meta property="og:title" content="Awesome title"/>
        <meta property="og:url" content="site.url"/>
        <meta property="og:site-name" content="Awesome title"/>
        <meta name="description" content="Awesome description"/>

        <!-- twitter meta -->
        <meta name="twitter:card" content="summary">
        <meta name="twitter:site" content="Site name">
        <meta name="twitter:creator" content="@creator">
        <meta name="twitter:title" content="Awesome title">
        <meta name="twitter:description" content="Awesome description">
        <meta name="twitter:image:src" content="path/to/share/image">

        <title>Awesome website</title>

        <link rel="shortcut icon" href="path/to/favicon.ico" type="image/x-icon">
        <link rel="icon" href="path/to/favicon.ico" type="image/x-icon">
        <!-- <link rel="stylesheet" href="path/to/styles.css" /> -->
        <meta name="fragment" content="!">
    </head>

    <body>
        <!-- Your div where you append your views, e.g. ng-view -->
        <div id="view"></div>

        <!-- <script src="path/to/script.js"></script> -->
    </body>
</html>
