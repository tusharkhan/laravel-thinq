# LaravelThinq

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Build Status][ico-travis]][link-travis]
[![StyleCI][ico-styleci]][link-styleci]

This is where your description should go. Take a look at [contributing.md](contributing.md) to see a to do list.

## Installation

Via Composer

``` bash
$ composer require 64robots/laravelthinq
```

## Usage

```
php artisan vendor:publish --provider="R64\LaravelThinq\LaravelThinqServiceProvider"

```

Add this to `.env`

```
THINQ_ACCOUNT_ID=Your thinq account id
THINQ_API_KEY=Your thinq api key
THINQ_API_USERNAME=Your thinq api username

```

Use as notification

```php
<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use R64\LaravelThinq\ThinqChannel;
use R64\LaravelThinq\ThinqMessage;

class TestThinq extends Notification
{
    use Queueable;

    public $silent = true; //if silent true, the service does not throw error

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [ThinqChannel::class];
    }

    public function toThinq($notifiable)
    {
        return new ThinqMessage('Send test sms', '122233333', '133333333');
    }

}

```

Use standalone 

```php
$message = new ThinqMessage('Send test sms', '122233333', '133333333');

new Thinq()
    ->setMessage($message)
    ->sendSms() //throws error
    ->sendSilentSms() //does not throw error
```

## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [contributing.md](contributing.md) for details and a todolist.

## Security

If you discover any security related issues, please email kliment.lambevski@gmail.com instead of using the issue tracker.

## Credits

- [Kliment Lambevski][link-author]
- [All Contributors][link-contributors]

## License

MIT. Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/r64/laravelthinq.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/r64/laravelthinq.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/r64/laravelthinq/master.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/12345678/shield

[link-packagist]: https://packagist.org/packages/r64/laravelthinq
[link-downloads]: https://packagist.org/packages/r64/laravelthinq
[link-travis]: https://travis-ci.org/r64/laravelthinq
[link-styleci]: https://styleci.io/repos/12345678
[link-author]: https://github.com/r64
[link-contributors]: ../../contributors]
