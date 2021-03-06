## Laravel Notifications Logger

![PHP Composer](https://github.com/ArtARTs36/laravel-notifications-logger/workflows/Testing/badge.svg?branch=master)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
<a href="https://poser.pugx.org/artarts36/laravel-notifications-logger/d/total.svg">
<img src="https://poser.pugx.org/artarts36/laravel-notifications-logger/d/total.svg" alt="Total Downloads">
</a>

This PHP package provides logging all notifications from your Laravel Application.

### Installation:

- Run: `composer require artarts36/laravel-notifications-logger`

- Add to providers: `\ArtARTs36\LaravelNotificationsLogger\Providers\NotificationsLoggerProvider`

- Run: `php artisan vendor:publish --tag=notifications_logger`

- Run `php artisan migrate`

### Configuration

#### Services Configuration

Path to package configuration: `config/notifications_logger.php`.

Logger considers your application's services ([System](./src/Models/System.php)).

You can configure service recognition in section "**system_mapping**".

**Key** is regular expression for notification title.
**Value** is service name.

Example: 

    'system_mapping' => [
        'subject_system' => [
            '/([a-z]*), you have to account for yesterday/i' => 'time-tracking-system',
        ],
    ],