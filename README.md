One Page SEO
===========
Serve static content of a one-page website to crawlers.

Installation
============
## Via Composer
```
composer require vdaguenet/one-page-seo
```

Usage
============
Add the following line on top of your `index.php`
```php
include_once __DIR__ . '/OnePage-SEO/BotDetector.php';

$detector = new BotDetector();
$detector->setServerOS($detector::LINUX);
if($detector->isBot()) {
    $detector->displayStaticContent();
}
```

In your javascript, add the following line when you are sure **your content is appended**
```js
if(typeof window.callPhantom === 'function') window.callPhantom();
```

What is included ?
==================
PhantomJS:
- for mac in version 2.0.0
- for linux in version 1.9.8

You can download other build from [official reposiory](https://bitbucket.org/ariya/phantomjs/downloads)
