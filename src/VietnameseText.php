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

namespace Kennynguyeenx\VietnameseText;

use Normalizer;

/**
 * VietnameseText
 *
 * @package   Kennynguyeenx\VietnameseText
 * @author    Kenny Nguyen <kennynguyeenx@gmail.com>
 * @copyright 2018-2020 Kenny Nguyen
 * @license   http://www.opensource.org/licenses/MIT The MIT License
 */
class VietnameseText
{
    /**
     * @param string $string
     * @return string
     */
    public function trimString(string $string): string
    {
        $string = preg_replace('/\p{C}+/u', "", $string);
        return trim($string);
    }

    /**
     * @param string $string
     * @return string
     */
    public function normalize(string $string): string
    {
        $string = Normalizer::normalize($string, Normalizer::FORM_C);
        $string = preg_replace(
            "/(\t|\n|\v|\f|\r| |\xC2\x85|\xc2\xa0|\xe1\xa0\x8e|\xe2\x80[\x80-\x8D]|\xe2\x80\xa8|\xe2\x80\xa9|"
            . "\xe2\x80\xaF|\xe2\x81\x9f|\xe2\x81\xa0|\xe3\x80\x80|\xef\xbb\xbf)+/",
            " ",
            $string
        );
        return $string;
    }
    
    /**
     * @param string $string
     * @return string
     */
    public function filter(string $string): string
    {
        $string = $this->normalize($string);
        $string = $this->trimString($string);
        return $string;
    }

    /**
     * @param string $string
     * @return string
     */
    public function strToLowerCase(string $string): string
    {
        $string = $this->filter($string);
        $string = mb_strtolower($string);
        return $string;
    }

    /**
     * @param string $string
     * @return string
     */
    public function strToUpperCase(string $string): string
    {
        $string = $this->filter($string);
        $string = mb_strtoupper($string);
        return $string;
    }

    /**
     * @param string $string
     * @return int
     */
    public function strLen(string $string): int
    {
        return mb_strlen($string, 'UTF-8');
    }

    /**
     * @param string $string
     * @return string
     */
    public function strRev(string $string): string
    {
        preg_match_all('/./u', $string, $matches);
        return implode('', array_reverse($matches[0]));
    }

    /**
     * @param string $string
     * @param int $length
     * @return array|false
     */
    public function strSplit(string $string, int $length = 1)
    {
        if ($length == 1) {
            return preg_split('//u', $string, -1, PREG_SPLIT_NO_EMPTY);
        }

        if ($length > 1) {
            $stringLength = $this->strLen($string);
            $resultArray = [];
            for ($i = 0; $i < $stringLength; $i+=$length) {
                $resultArray[] = mb_substr($string, $i, $length, 'UTF-8');
            }

            return $resultArray;
        }

        return false;
    }

    /**
     * @param string $string
     * @return string
     */
    public function upperCaseFirst(string $string): string
    {
        $charArray = $this->strSplit($string);
        $charArray[0] = $this->strToUpperCase($charArray[0]);
        return implode('', $charArray);
    }
}
