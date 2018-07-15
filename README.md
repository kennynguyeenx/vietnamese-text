kennynguyeenx/VietnameseText
=============

> Provide some Vietnamese string handling and manipulating functions

Features
--------

- Make a Vietnamese string uppercase
- Make a Vietnamese string lowercase
- No external dependencies.
- PSR-4 compatible.
- Compatible with PHP >= PHP 7.

Installation
------------

You can download VietnameseText through https://github.com/kennynguyeenx/VietnameseText.

VietnameseText requires the Internationalization extension from PHP. Typically you can use the configure option `--enable-intl` while compiling PHP. More information can be found in the [PHP documentation](http://php.net/manual/en/intro.intl.php).
 

Usage
-----

Make a Vietnamese string lowercase:

```php
use use Kennynguyeenx\VietnameseText\VietnameseText;

$vietnameseText = new VietnameseText();
echo $vietnameseText->strToLowerCase('XIN CHÀO CÁC BẠN'); // xin chào các bạn
```

Make a Vietnamese string uppercase:

```php
use use Kennynguyeenx\VietnameseText\VietnameseText;

$vietnameseText = new VietnameseText();
echo $vietnameseText->strToUpperCase('Xin Chào Các Bạn'); // XIN CHÀO CÁC BẠN
```
