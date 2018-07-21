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

- You can download VietnameseText through https://github.com/kennynguyeenx/VietnameseText.

- VietnameseText requires the Internationalization extension and Multibyte String extension from PHP.
 
- Typically you can use the configure option `--enable-intl --enable-mbstring` while compiling PHP. 
More information can be found in the [PHP documentation](http://php.net/manual/en/intro.intl.php).
 

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
Get Vietnamese string length:

```php
use use Kennynguyeenx\VietnameseText\VietnameseText;

$vietnameseText = new VietnameseText();
echo $vietnameseText->strLen('Xin Chào Các Bạn'); // 16
```
Reverse a Vietnamese string:

```php
use use Kennynguyeenx\VietnameseText\VietnameseText;

$vietnameseText = new VietnameseText();
echo $vietnameseText->strRev('Xin Chào'); // oàhC niX
```
Convert a Vietnamese string to an array:

```php
use use Kennynguyeenx\VietnameseText\VietnameseText;

$vietnameseText = new VietnameseText();
var_dump($vietnameseText->strSplit('xin chào')); 
/* 
array(8) {
    [0]=>
    string(1) "x"
    [1]=>
    string(1) "i"
    [2]=>
    string(1) "n"
    [3]=>
    string(1) " "
    [4]=>
    string(1) "c"
    [5]=>
    string(1) "h"
    [6]=>
    string(2) "à"
    [7]=>
    string(1) "o"
}
*/
```
Make a Vietnamese string's first character uppercase:

```php
use use Kennynguyeenx\VietnameseText\VietnameseText;

$vietnameseText = new VietnameseText();
echo $vietnameseText->upperCaseFirst('đại biểu'); // Đại biểu
```