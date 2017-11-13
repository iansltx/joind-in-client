Joind.in Client
===============

This is a Guzzle-based API client for joind.in. Note that this readme is valid
PHP code, so you can run it to see the library in action (hence the ?> tags).

To start, `composer require iansltx/joind-in-client`. Then:

```php
<?php

require __DIR__ . '/vendor/autoload.php';

// sets up a client with default params;
// the underlying constructor takes a Guzzle ClientInterface for easier testing
$client = \iansltx\JoindInClient\Client::create();

$schedule = $client->getScheduleByEventId(6476); // pull the php[world] schedule

?>
```

A Schedule is an event collection that implements Countable and read-only
ArrayAccess, plus a few convenience methods, containing Event objects. 
Events implement __toString() and jsonSerialize(). Both return a string
suitable for display, so if you want more data in your JSON blob
you'll want to pull data out of each Event manually.

```
<?php

date_default_timezone_set('America/New_York');
print("Next up: " . $schedule->filterOutBefore(new \DateTimeImmutable('2017-11-14 09:55:55'))[5] . ".\n");

?>
```