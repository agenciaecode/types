# Common Types

## Requirements
- PHP ^8.1

## Installation
To install this module, run the following command in your terminal:
```bash
composer require agenciaecode/types
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
- Arr
- Boolean
- Byte
- Centimeter
- Cnpj
- Cpf
- Domain
- Email
- Gram
- Gigabyte
- Ip
- Kilobyte
- Kilogram
- Megabyte
- Numeric
- Ounce
- Path
- PhoneNumber
- Pound
- Str
- Url
- ZipCode

## Coming soon
- CreditCard
- Country
- Currency
- Duration
- Foot
- Hour
- Kilometer
- Meter
- Minute
- Password
- Percent
- Second
- Temperature
- Uuid
