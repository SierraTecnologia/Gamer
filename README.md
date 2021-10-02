# SierraTecnologia Gamer

**SierraTecnologia Gamer** Various functionality, and basic controller included out-of-the-box.

[![Packagist](https://img.shields.io/packagist/v/sierratecnologia/gamer.svg?label=Packagist&style=flat-square)](https://packagist.org/packages/sierratecnologia/gamer)
[![Scrutinizer Code Quality](https://img.shields.io/scrutinizer/g/sierratecnologia/gamer.svg?label=Scrutinizer&style=flat-square)](https://scrutinizer-ci.com/g/sierratecnologia/gamer/)
[![Travis](https://img.shields.io/travis/sierratecnologia/gamer.svg?label=TravisCI&style=flat-square)](https://travis-ci.org/sierratecnologia/gamer)
[![StyleCI](https://styleci.io/repos/60968880/shield)](https://styleci.io/repos/60968880)
[![License](https://img.shields.io/packagist/l/sierratecnologia/gamer.svg?label=License&style=flat-square)](https://github.com/sierratecnologia/gamer/blob/master/LICENSE)

[x] Point Transaction system for laravel X

## Installation

Install via `composer require sierratecnologia/gamer`

And then include the service provider within `app/config/app.php`.

```php
'providers' => [
    Gamer\GamerProvider::class
];
```

At last you need to publish and run the migration.
```
php artisan vendor:publish --provider="Gamer\GamerProvider" && php artisan migrate
```

-----

### Setup a Model
```php
<?php

namespace App;

use Gamer\Contracts\Pointable;
use Gamer\Traits\Pointable as PointableTrait;
use Illuminate\Database\Eloquent\Model;

class User extends Model implements Pointable
{
    use PointableTrait;
}
```

### Add Points
```php
$user = User::first();
$amount = 10; // (Double) Can be a negative value
$message = "The reason for this transaction";

//Optional (if you modify the point_transaction table)
$data = [
    'ref_id' => 'someReferId',
];

$transaction = $user->addPoints($amount,$message,$data);

dd($transaction);
```

### Get Current Points
```php
$user = User::first();
$points = $user->currentPoints();

dd($points);
```

### Get Transactions
```php
$user = User::first();
$user->transactions;

//OR
//$user['transactions'] = $user->transactions(2)->get(); //Get last 2 transactions

dd($user);
```

### Count Transactions
```php
$user = User::first();
$user['transactions_total'] = $user->countTransactions();

dd($user);
```

### Connecting to Pointagram

Add pointagram token to your .env
```
SERVICES_POINTAGRAM_KEY=token_aqui_blalblabla
```

## Changelog

Refer to the [Changelog](CHANGELOG.md) for a full history of the project.


## Support

The following support channels are available at your fingertips:

- [Chat on Slack](https://bit.ly/sierratecnologia-slack)
- [Help on Email](mailto:help@sierratecnologia.com.br)
- [Follow on Twitter](https://twitter.com/sierratecnologia)


## Contributing & Protocols

Thank you for considering contributing to this project! The contribution guide can be found in [CONTRIBUTING.md](CONTRIBUTING.md).

Bug reports, feature requests, and pull requests are very welcome.

- [Versioning](CONTRIBUTING.md#versioning)
- [Pull Requests](CONTRIBUTING.md#pull-requests)
- [Coding Standards](CONTRIBUTING.md#coding-standards)
- [Feature Requests](CONTRIBUTING.md#feature-requests)
- [Git Flow](CONTRIBUTING.md#git-flow)


## Security Vulnerabilities

If you discover a security vulnerability within this project, please send an e-mail to [help@sierratecnologia.com.br](help@sierratecnologia.com.br). All security vulnerabilities will be promptly addressed.


## About SierraTecnologia

SierraTecnologia is a software solutions startup, specialized in integrated enterprise solutions for SMEs established in Rio de Janeiro, Brazil since June 2008. We believe that our drive The Value, The Reach, and The Impact is what differentiates us and unleash the endless possibilities of our philosophy through the power of software. We like to call it Innovation At The Speed Of Life. That’s how we do our share of advancing humanity.


## License

This software is released under [The MIT License (MIT)](LICENSE).

(c) 2008-2020 SierraTecnologia, Some rights reserved.
