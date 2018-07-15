<?php
/**
 * This file is part of kennynguyeenx/VietnameseText.
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
    private $upperCaseVietnameseCharacters = ['À', 'Á', 'Ạ', 'Ả', 'Ã', 'Â', 'Ầ', 'Ấ', 'Ậ', 'Ẩ', 'Ẫ', 'Ă', 'Ằ', 'Ắ', 'Ặ', 
                                                'Ẳ', 'Ẵ', 'È', 'É', 'Ẹ', 'Ẻ', 'Ẽ', 'Ê', 'Ề', 'Ế', 'Ệ', 'Ể', 'Ễ', 'Ì', 'Í', 
                                                'Ị', 'Ỉ', 'Ĩ', 'Ò', 'Ó', 'Ọ', 'Ỏ', 'Õ', 'Ô', 'Ồ', 'Ố', 'Ộ', 'Ổ', 'Ỗ', 'Ơ', 
                                                'Ờ', 'Ớ', 'Ợ', 'Ở', 'Ỡ', 'Ù', 'Ú', 'Ụ', 'Ủ', 'Ũ', 'Ư', 'Ừ', 'Ứ', 'Ự', 'Ử', 
                                                'Ữ', 'Ỳ', 'Ý', 'Ỵ', 'Ỷ', 'Ỹ', 'Đ'];

    /**
     * @var array
     */
    private $lowerCaseVietnameseCharacters = ['à', 'á', 'ạ', 'ả', 'ã', 'â', 'ầ', 'ấ', 'ậ', 'ẩ', 'ẫ', 'ă', 'ằ', 'ắ', 'ặ', 
                                                'ẳ', 'ẵ', 'è', 'é', 'ẹ', 'ẻ', 'ẽ', 'ê', 'ề', 'ế', 'ệ', 'ể', 'ễ', 'ì', 'í', 
                                                'ị', 'ỉ', 'ĩ', 'ò', 'ó', 'ọ', 'ỏ', 'õ', 'ô', 'ồ', 'ố', 'ộ', 'ổ', 'ỗ', 'ơ', 
                                                'ờ', 'ớ', 'ợ', 'ở', 'ỡ', 'ù', 'ú', 'ụ', 'ủ', 'ũ', 'ư', 'ừ', 'ứ', 'ự', 'ử', 
                                                'ữ', 'ỳ', 'ý', 'ỵ', 'ỷ', 'ỹ', 'đ'];

    /**
     * @param string $text
     * @return string
     */
    private function trimText(string $text): string
    {
        $text = preg_replace('/\p{C}+/u', "", $text);
        return trim($text);
    }

    /**
     * @param string $text
     * @return string
     */
    private function normalize(string $text): string
    {
        $text = Normalizer::normalize($text, Normalizer::FORM_C);
        $text = preg_replace(
            "/(\t|\n|\v|\f|\r| |\xC2\x85|\xc2\xa0|\xe1\xa0\x8e|\xe2\x80[\x80-\x8D]|\xe2\x80\xa8|\xe2\x80\xa9|\xe2\x80\xaF|" 
          . "\xe2\x81\x9f|\xe2\x81\xa0|\xe3\x80\x80|\xef\xbb\xbf)+/",
            " ",
            $text
        );
        return $text;
    }
    
    /**
     * @param string $text
     * @return string
     */
    private function filter(string $text): string
    {
        $text = $this->normalize($text);
        $text = $this->trimText($text);
        return $text;
    }

    /**
     * @param string $text
     * @return string
     */
    public function strToLowerCase(string $text): string
    {
        $text = $this->filter($text);
        $text = strtolower($text);
        $numCharacter = count($this->upperCaseVietnameseCharacters);
        for ($i = 0; $i < $numCharacter; ++$i) {
            $text = preg_replace('/(' . $this->upperCaseVietnameseCharacters[$i] .')/u',
                $this->lowerCaseVietnameseCharacters[$i], $text);
        }

        return $text;
    }

    /**
     * @param string $text
     * @return string
     */
    public function strToUpperCase(string $text): string
    {
        $text = $this->filter($text);
        $text = strtoupper($text);
        $numCharacter = count($this->lowerCaseVietnameseCharacters);
        for ($i = 0; $i < $numCharacter; ++$i) {
            $text = preg_replace('/(' . $this->lowerCaseVietnameseCharacters[$i] .')/u',
                $this->upperCaseVietnameseCharacters[$i], $text);
        }

        return $text;
    }
}
