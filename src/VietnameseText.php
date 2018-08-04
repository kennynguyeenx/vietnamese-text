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
     * @var array
     */
    private $upperCaseVietnameseCharacters = ['À', 'Á', 'Ạ', 'Ả', 'Ã', 'Â', 'Ầ', 'Ấ', 'Ậ', 'Ẩ', 'Ẫ', 'Ă', 'Ằ', 'Ắ',
        'Ặ', 'Ẳ', 'Ẵ', 'È', 'É', 'Ẹ', 'Ẻ', 'Ẽ', 'Ê', 'Ề', 'Ế', 'Ệ', 'Ể', 'Ễ', 'Ì', 'Í', 'Ị', 'Ỉ', 'Ĩ', 'Ò', 'Ó', 'Ọ',
        'Ỏ', 'Õ', 'Ô', 'Ồ', 'Ố', 'Ộ', 'Ổ', 'Ỗ', 'Ơ', 'Ờ', 'Ớ', 'Ợ', 'Ở', 'Ỡ', 'Ù', 'Ú', 'Ụ', 'Ủ', 'Ũ', 'Ư', 'Ừ',
        'Ứ', 'Ự', 'Ử', 'Ữ', 'Ỳ', 'Ý', 'Ỵ', 'Ỷ', 'Ỹ', 'Đ'];

    /**
     * @var array
     */
    private $lowerCaseVietnameseCharacters = ['à', 'á', 'ạ', 'ả', 'ã', 'â', 'ầ', 'ấ', 'ậ', 'ẩ', 'ẫ', 'ă', 'ằ', 'ắ',
        'ặ', 'ẳ', 'ẵ', 'è', 'é', 'ẹ', 'ẻ', 'ẽ', 'ê', 'ề', 'ế', 'ệ', 'ể', 'ễ', 'ì', 'í', 'ị', 'ỉ', 'ĩ', 'ò', 'ó', 'ọ',
        'ỏ', 'õ', 'ô', 'ồ', 'ố', 'ộ', 'ổ', 'ỗ', 'ơ', 'ờ', 'ớ', 'ợ', 'ở', 'ỡ', 'ù', 'ú', 'ụ', 'ủ', 'ũ', 'ư', 'ừ', 'ứ',
        'ự', 'ử', 'ữ', 'ỳ', 'ý', 'ỵ', 'ỷ', 'ỹ', 'đ'];

    /**
     * @param string $string
     * @return string
     */
    private function trimString(string $string): string
    {
        $string = preg_replace('/\p{C}+/u', "", $string);
        return trim($string);
    }

    /**
     * @param string $string
     * @return string
     */
    private function normalize(string $string): string
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
    private function filter(string $string): string
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
        $string = strtolower($string);
        $numCharacter = count($this->upperCaseVietnameseCharacters);
        for ($i = 0; $i < $numCharacter; ++$i) {
            $string = preg_replace('/(' . $this->upperCaseVietnameseCharacters[$i] .')/u',
                $this->lowerCaseVietnameseCharacters[$i], $string);
        }

        return $string;
    }

    /**
     * @param string $string
     * @return string
     */
    public function strToUpperCase(string $string): string
    {
        $string = $this->filter($string);
        $string = strtoupper($string);
        $numCharacter = count($this->lowerCaseVietnameseCharacters);
        for ($i = 0; $i < $numCharacter; ++$i) {
            $string = preg_replace('/(' . $this->lowerCaseVietnameseCharacters[$i] .')/u',
                $this->upperCaseVietnameseCharacters[$i], $string);
        }

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
