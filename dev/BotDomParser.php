<?php

require_once __DIR__ . "/../vendor/autoload.php";

use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\CssSelector\CssSelector;

/**
*
*/
class BotDomParser
{

  private $botList;
  private $currentBotName;

  public function __construct()
  {
    $this->currentBotName = '';
    $this->botList = [];
  }

  public function getBotList() {
    return $this->botList;
  }

  public function setBotList($newBotList) {
    $this->botList = $newBotList;
  }

  /**
   * Find bot names in the given DOM
   *
   * @param  [type] $dom [description]
   * @return void
   */
  public function parseBotNames() {
    $dom = $this->getDom('https://udger.com/resources/ua-list/crawlers');

    if (false === $dom) {
      throw new Exception("Fail to load bot list DOM.", E_WARNING);
    }

    $crawler = new Crawler();
    $crawler->addContent($dom);
    $crawler->filter('body #container table tr td > a')->each(function($node, $i) {
      $botName = $node->text();
      $this->addBotName($botName);
    });
  }

  /**
   * Get useragents of the given bot
   *
   * @param  [type] $botName [description]
   * @return void
   */
  public function parseBotUA($botName) {
    $dom = $this->getDom('https://udger.com/resources/ua-list/bot-detail?bot=' . $botName);

    if (false === $dom) {
      echo "Can not parse DOM" . PHP_EOL;
      return false;
    }

    $this->currentBotName = $botName;
    $crawlerBot = new Crawler();
    $crawlerBot->addContent($dom);
    $crawlerBot->filter('body #container table tr td > a')->each(function($el, $i) {
      if (strpos($el->attr('href'), '/resources/online-parser') !== false) {
        $botUA = $el->text();
        $this->addBotUA($botUA);
      }
    });

    return true;
  }

  private function addBotName($name) {
    $this->botList[$name] = [];
    echo "Add bot " . $name . PHP_EOL;
  }

  private function addBotUA($ua) {
    $this->botList[$this->currentBotName][] = $ua;
    echo "Add UA for bot " . $this->currentBotName . PHP_EOL;
  }

  /**
   * Get the dom tree of a given url
   *
   * @param  [type] $url [description]
   * @return [string] $dom
   */
  private function getDom($url) {
    $ch = curl_init();
    $timeout = 5;
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    $dom = curl_exec($ch);
    curl_close($ch);

    return $dom;
  }
}