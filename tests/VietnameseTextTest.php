<?php
/**
 * This file is part of kennynguyeenx/vietnamese-text.
 *
 * (c) Kenny Nguyen <kennynguyeenx@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Kennynguyeenx\VietnameseText\Tests;

use Kennynguyeenx\VietnameseText\VietnameseText;
use PHPUnit\Framework\Assert;
use PHPUnit_Framework_TestCase;

/**
 * VietnameseTextTest
 *
 * @package   Kennynguyeenx\VietnameseText
 * @author    Kenny Nguyen <kennynguyeenx@gmail.com>
 * @copyright 2018-2020 Kenny Nguyen
 * @license   http://www.opensource.org/licenses/MIT The MIT License
 */
class VietnameseTextTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var VietnameseText
     */
    private $vietnameseText;
    
    protected function setUp()
    {
        $this->vietnameseText = new VietnameseText();
    }

    /**
     * @test
     * @covers \Kennynguyeenx\VietnameseText\VietnameseText::filter()
     * @param string $originalString
     * @param string $expectedString
     * @dataProvider filterDataProvider
     */
    public function filter(string $originalString, string $expectedString)
    {
        Assert::assertSame($expectedString, $this->vietnameseText->filter($originalString));
    }

    /**
     * @return array
     */
    public function filterDataProvider(): array
    {
        return [
            'special_characters_for_white_spaces' => [' xin ' . PHP_EOL . 'chào ', 'xin chào'],
            'multiple_white_spaces' => [' xin   chào ', 'xin chào'],
            'white_spaces_at_both_sides' => [' xin chào ', 'xin chào'],
            'white_spaces_at_the_end_of_string' => ['đại biểu ', 'đại biểu'],
            'white_spaces_at_the_beginning_of_string' => [' ối a', 'ối a'],
            'combine_acute_accent' => ['áo dài', 'áo dài']
        ];
    }

    /**
     * @test
     * @covers \Kennynguyeenx\VietnameseText\VietnameseText::strToLowerCase()
     * @param string $originalString
     * @param string $expectedString
     * @dataProvider strToLowerCaseDataProvider
     */
    public function strToLowerCase(string $originalString, string $expectedString)
    {
        Assert::assertSame($expectedString, $this->vietnameseText->strToLowerCase($originalString));
    }

    /**
     * @return array
     */
    public function strToLowerCaseDataProvider(): array
    {
        return [
            'lowercase_with_accent' => ['xin chào các bạn', 'xin chào các bạn'],
            'uppercase_first_letter_of_word_with_accent' => ['Xin Chào Các Bạn', 'xin chào các bạn'],
            'uppercase_with_accent' => ['XIN CHÀO CÁC BẠN', 'xin chào các bạn'],
            'combine_acute_accent' => ['Áo', 'áo']
        ];
    }


    /**
     * @test
     * @covers \Kennynguyeenx\VietnameseText\VietnameseText::strToUpperCase()
     * @param string $originalString
     * @param string $expectedString
     * @dataProvider strToUpperCaseDataProvider
     */
    public function strToUpperCase(string $originalString, string $expectedString)
    {
        Assert::assertSame($expectedString, $this->vietnameseText->strToUpperCase($originalString));
    }

    /**
     * @return array
     */
    public function strToUpperCaseDataProvider(): array
    {
        return [
            'uppercase_with_accent' => ['XIN CHÀO CÁC BẠN', 'XIN CHÀO CÁC BẠN'],
            'uppercase_first_letter_of_word_with_accent' => ['Xin Chào Các Bạn', 'XIN CHÀO CÁC BẠN'],
            'lowercase_with_accent' => ['xin chào các bạn', 'XIN CHÀO CÁC BẠN'],
            'combine_acute_accent' => ['áo', 'ÁO']
        ];
    }

    /**
     * @test
     * @covers \Kennynguyeenx\VietnameseText\VietnameseText::strLen()
     * @param string $originalString
     * @param int $expectedLength
     * @dataProvider strLenDataProvider
     */
    public function strLen(string $originalString, int $expectedLength)
    {
        Assert::assertSame($expectedLength, $this->vietnameseText->strLen($originalString));
    }

    /**
     * @return array
     */
    public function strLenDataProvider(): array
    {
        return [
            'string_with_accent' => ['xin chào các bạn', 16],
            'combine_acute_accent' => ['áo', 2]
        ];
    }

    /**
     * @test
     * @covers \Kennynguyeenx\VietnameseText\VietnameseText::strRev()
     * @param string $originalString
     * @param string $expectedString
     * @dataProvider strRevDataProvider
     */
    public function strRev(string $originalString, string $expectedString)
    {
        Assert::assertSame($expectedString, $this->vietnameseText->strRev($originalString));
    }

    /**
     * @return array
     */
    public function strRevDataProvider(): array
    {
        return [
            'lowercase_with_accent' => ['xin chào', 'oàhc nix'],
            'uppercase_first_letter_of_word_with_accent' => ['Xin Chào', 'oàhC niX'],
            'uppercase_with_accent' => ['XIN CHÀO', 'OÀHC NIX'],
            'combine_acute_accent' => ['áo', 'oá']
        ];
    }

    /**
     * @test
     * @covers \Kennynguyeenx\VietnameseText\VietnameseText::strSplit()
     * @param string $originalString
     * @param int $length
     * @param array $expectedArray
     * @dataProvider strSplitDataProvider
     */
    public function strSplit(string $originalString, int $length, array $expectedArray)
    {
        Assert::assertSame($expectedArray, $this->vietnameseText->strSplit($originalString, $length));
    }

    /**
     * @return array
     */
    public function strSplitDataProvider(): array
    {
        return [
            'lowercase_with_accent_length_1' => ['xin chào', 1, ['x', 'i', 'n' , ' ', 'c', 'h', 'à', 'o']],
            'lowercase_with_accent_less_than_max_length' => ['xin chào', 2, ['xi', 'n ', 'ch', 'ào']],
            'lowercase_with_accent_more_than_max_length' => ['xin chào', 10, ['xin chào']],
            'combine_acute_accent' => ['áo', 1, ['á', 'o']]
        ];
    }

    /**
     * @test
     * @covers \Kennynguyeenx\VietnameseText\VietnameseText::upperCaseFirst()
     * @param string $originalString
     * @param string $expectedString
     * @dataProvider upperCaseFirstDataProvider
     */
    public function upperCaseFirst(string $originalString, string $expectedString)
    {
        Assert::assertEquals('Xin chào', $this->vietnameseText->upperCaseFirst('xin chào'));
        Assert::assertEquals('Đại biểu', $this->vietnameseText->upperCaseFirst('đại biểu'));
        Assert::assertEquals('Ối a', $this->vietnameseText->upperCaseFirst('ối a'));
        // Combining Acute Accent
        Assert::assertSame($expectedString, $this->vietnameseText->upperCaseFirst($originalString));
    }

    /**
     * @return array
     */
    public function upperCaseFirstDataProvider(): array
    {
        return [
            'lowercase_with_accent' => ['xin chào', 'Xin chào'],
            'lowercase_with_đ' => ['đại biểu', 'Đại biểu'],
            'lowercase_with_ố' => ['ối a', 'Ối a'],
            'combine_acute_accent' => ['áo dài', 'Áo dài']
        ];
    }

    /**
     * @test
     * @covers \Kennynguyeenx\VietnameseText\VietnameseText::convertToLatin()
     * @param string $originalString
     * @param $expectedString
     * @dataProvider convertToLatinDataProvider
     */
    public function convertToLatin(string $originalString, $expectedString)
    {
        Assert::assertSame($expectedString, $this->vietnameseText->convertToLatin($originalString));
    }

    /**
     * @return array
     */
    public function convertToLatinDataProvider(): array
    {
        return [
            'uppercase_first_letter_with_accent' => ['Xin chào', 'Xin chao'],
            'uppercase_first_letter_with_đ' => ['Đại biểu', 'Dai bieu'],
            'uppercase_first_letter_with_ố' => ['Ối a', 'Oi a'],
            'combine_acute_accent' => ['Áo', 'Ao']
        ];
    }
}
