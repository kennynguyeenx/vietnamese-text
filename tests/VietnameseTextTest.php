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
     * @covers \Kennynguyeenx\VietnameseText\VietnameseText::strToLowerCase()
     */
    public function strToLowerCase()
    {
        Assert::assertEquals('xin chào các bạn', $this->vietnameseText->strToLowerCase('xin chào các bạn'));
        Assert::assertEquals('xin chào các bạn', $this->vietnameseText->strToLowerCase('Xin Chào Các Bạn'));
        Assert::assertEquals('xin chào các bạn', $this->vietnameseText->strToLowerCase('XIN CHÀO CÁC BẠN'));
    }
  
    /**
     * @test
     * @covers \Kennynguyeenx\VietnameseText\VietnameseText::strToUpperCase()
     */
    public function strToUpperCase()
    {
        Assert::assertEquals('XIN CHÀO CÁC BẠN', $this->vietnameseText->strToUpperCase('xin chào các bạn'));
        Assert::assertEquals('XIN CHÀO CÁC BẠN', $this->vietnameseText->strToUpperCase('Xin Chào Các Bạn'));
        Assert::assertEquals('XIN CHÀO CÁC BẠN', $this->vietnameseText->strToUpperCase('XIN CHÀO CÁC BẠN'));
    }

    /**
     * @test
     * @covers \Kennynguyeenx\VietnameseText\VietnameseText::strLen()
     */
    public function strLen()
    {
        Assert::assertEquals(16, $this->vietnameseText->strLen('xin chào các bạn'));
    }

    /**
     * @test
     * @covers \Kennynguyeenx\VietnameseText\VietnameseText::strRev()
     */
    public function strRev()
    {
        Assert::assertEquals('oàhc nix', $this->vietnameseText->strRev('xin chào'));
        Assert::assertEquals('oàhC niX', $this->vietnameseText->strRev('Xin Chào'));
        Assert::assertEquals('OÀHC NIX', $this->vietnameseText->strRev('XIN CHÀO'));
    }

    /**
     * @test
     * @covers \Kennynguyeenx\VietnameseText\VietnameseText::strSplit()
     */
    public function strSplit()
    {
        Assert::assertEquals(['x', 'i', 'n' , ' ', 'c', 'h', 'à', 'o'], $this->vietnameseText->strSplit('xin chào'));
        Assert::assertEquals(['xi', 'n ', 'ch', 'ào'], $this->vietnameseText->strSplit('xin chào', 2));
        Assert::assertEquals(['xin chào'], $this->vietnameseText->strSplit('xin chào', 10));
    }

    /**
     * @test
     * @covers \Kennynguyeenx\VietnameseText\VietnameseText::upperCaseFirst()
     */
    public function upperCaseFirst()
    {
        Assert::assertEquals('Xin chào', $this->vietnameseText->upperCaseFirst('xin chào'));
        Assert::assertEquals('Đại biểu', $this->vietnameseText->upperCaseFirst('đại biểu'));
        Assert::assertEquals('Ối a', $this->vietnameseText->upperCaseFirst('ối a'));
    }
}
