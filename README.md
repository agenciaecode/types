# Common Types

## Requirements
- PHP ^8.1

## Installation
To install this module, run the following command in your terminal:
```bash
composer require mkioschi/types
```

## Basic usage
```php
$email = Email::from('email@domain.com');
echo $email->getHiddenFormat(); // Output: e***l@d********m
```

## Common methods
Every type have at least the following common methods:
```php
 - public static function from(...$args)
 - public static function tryFrom(...$args)
 - public static function innFrom(...$args)
 - public static function isValid(...$args)
 - public function equals($value)
 - public function getValue(...$args)
 - public function __toString(...$args)
```

## Available Types
- Boolean
- Byte
- Centimeter
- CreditCard (coming soon)
- Cnpj
- Country (coming soon)
- Cpf
- Currency (coming soon)
- Duration (coming soon) Input: 25:35:12
- Email
- Foot (coming soon)
- Gram
- Gigabyte
- Hour (coming soon)
- Integer (coming soon)
- Ip (coming soon)
- Kilobyte
- Kilogram (coming soon)
- Kilometer (coming soon)
- Meter (coming soon)
- Megabyte
- Minute (coming soon)
- Password (coming soon)
- Path (coming soon)
- Percent (coming soon)
- PhoneNumber
- Pound (coming soon)
- Second (coming soon)
- Str
- Temperature (coming soon)
- Url (coming soon)
- Uuid (coming soon)
- ZipCode