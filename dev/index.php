<?php
  require_once __DIR__ . "/BotDomParser.php" ;

  $file = __DIR__ . '/../bots_new.json';
  $botList = [];
  $countError = 0;
  $MAX_ERROR  = 5;
  $crawler = new BotDomParser();

  // Check if the file where store UAs exists
  if (file_exists($file)) {
    $fileContent = json_decode(file_get_contents($file));
  }

  // Check if it is an update or all the bot name list must be done
  if (isset($fileContent) && count($fileContent) > 0) {
    $listArray = json_decode(json_encode($fileContent), true);
    $crawler->setBotList($listArray);
  } else {
    $crawler->parseBotNames();
  }

  //  Get UAs for given bot name
  $botList = $crawler->getBotList();
  foreach ($botList as $botName => $value) {
    // we already have information about this bot
    if (count($botList[$botName]) > 0) continue;

    $res = $crawler->parseBotUA($botName);

    if (true !== $res) $countError++;
    if ($countError >= $MAX_ERROR) {
      echo "Too many errors. Script stop" . PHP_EOL;
      break;
    }
  }

  file_put_contents($file, json_encode($crawler->getBotList()));