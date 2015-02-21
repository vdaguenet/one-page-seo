OnePage-SEO
===========
Serve static content of a one-page website to crawlers.

Usage
============
Place `/phantom` directory, `Client.php` and `detection.php` wherever you want on your server.

Place `static.php` in the same directory of your `index.php`. Then set path to PhantomJS. Don't forget to **select the build corresponding to your server**.
```php
$client->setPhantomJs(__DIR__ . '/phantom/bin/linux/phantomjs');
$client->setScript(__DIR__ . '/phantom/script.js');
```

Add the following line on top of your `index.php`
```php
include_once __DIR__ . '/detection.php';
```

Finally, in your javascript, add the following line when you are sure **your content is appended**
```js
if(typeof window.callPhantom === 'function') window.callPhantom();
```

What is included ?
==================
PhantomJS:
- for mac in version 2.0.0
- for linux in version 1.9.8

You can download other build from [official reposiory](https://bitbucket.org/ariya/phantomjs/downloads)