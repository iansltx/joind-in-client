Joind.in Client
===============

This is a Guzzle-based API client for joind.in.

To start, `composer require iansltx/joind-in-client`. Then:

```php
<?php

require __DIR__ . '/vendor/autoload.php';

// sets up a client with default params;
// the underlying constructor takes a Guzzle ClientInterface for easier testing
$client = \iansltx\JoindInClient\Client::create();
```
