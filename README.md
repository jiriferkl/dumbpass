# Dumbpass #

[![Latest Stable Version](https://poser.pugx.org/jiriferkl/dumbpass/v/stable)](https://packagist.org/packages/jiriferkl/dumbpass)
[![Build Status](https://travis-ci.org/jiriferkl/dumbpass.svg?branch=master)](https://travis-ci.org/jiriferkl/dumbpass)
[![PHPStan](https://img.shields.io/badge/PHPStan-enabled-brightgreen.svg?style=flat)](https://github.com/phpstan/phpstan)
[![License](https://poser.pugx.org/jiriferkl/dumbpass/license)](https://packagist.org/packages/jiriferkl/dumbpass)

Smart control of dumb passwords. Guard your users from security problems by preventing them from having dumb passwords.

## Introduction ##

This package can be used to verify the user password. It checks list of **10,000 worst passwords** as analyzed by an IT security analyst.

With this package you have to set absolutely nothing. **Everything is pre-set.** But you can set everything you like.

This package
* **Checks password strength** (length, numbers, capital letters..) Default settings is bellow.
* Checks list of **10,000 worst passwords**
* Returns result in **simple object** which contains:
    * boolean result variable
    * array with error messages (If any)
* **Default language is EN** but you can choose another (examples bellow)

## Install ##

Via composer
```bash
composer require jiriferkl/dumbpass
```
You must have **PHP 7.0**.

## Use ##

Default setting is:
* Minimum length 9 characters
* Password has to contain at least one number
* Password has to contain at least one capital letter
* Password has to contain at least one lower case letter
* Password has to contain at least one special character
* Password has to be original not just too common

So it is very simple:

```php
$pass = 'P@ss_wo!rd!5';

$result = DumbPass::verify($pass);
```

## I don't want to use default setting ##
So go ahead.

```php
$pass = 'P@ss_wo!rd!5';

$criteria = new Criteria();
$criteria->enforceCapitalChars(TRUE)
	->enforceNumberChars(TRUE)
	->enforceSpecialChars(TRUE)
	->enforceLowerCaseChars(TRUE)
	->allowCommonPassCheck(TRUE)
	->setLength(8);

$result = DumbPass::verify($pass, $criteria);
```

## Can I choose different language please? ##
Yes.

```php
$pass = 'P@ss_wo!rd!5';

//null -> default object
$result = DumbPass::verify($pass, NULL, Localization::get(Localization::CZ));
```

## My language isn't an option ##
Well you have two options:
* Send pull request (It's easy and it's only a few lines.)
* Implements interface and make your own Messages class. It has one simple method.

```php
$pass = 'P@ss_wo!rd!5';

$messages = new Messages(); //implements IMessage

//null -> default object
$result = DumbPass::verify($pass, NULL, NULL, $messages);
```

Now the messages are in your language. Congrats.

## Do you have your own most common password list? ##
OK.

```php
$pass = 'P@ss_wo!rd!5';

$passList = new PassList(); //implements IPassList

//null -> default object
$result = DumbPass::verify($pass, NULL, NULL, NULL, $passList);
```

## Test ##

```bash
composer test
```