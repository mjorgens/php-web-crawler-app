<?php
/**
 * LinkParserInterface.php
 *
 * PHP version 7.2
 *
 * @category Interface
 * @package  App\Crawler\LinkParser
 * @author   Marc Jorgensen <marcjorgensen@mail.weber.edu>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/cs4350-fall2019/final-mjorgens
 */

namespace App\Crawler\LinkParser;

use Psr\Http\Message\UriInterface;

/**
 * Interface LinkParserInterface
 *
 * @category Interface
 * @package  App\Crawler\LinkParser
 * @author   Marc Jorgensen <marcjorgensen@mail.weber.edu>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/cs4350-fall2019/final-mjorgens
 */
interface LinkParserInterface
{
    /**
     * Static method that takes in a string of html and returns an array of links
     *
     * @param string       $html       The html to parse
     * @param UriInterface $foundOnUrl The base url were it was found
     *
     * @return array
     */
    public static function parseLinks(string $html, UriInterface $foundOnUrl): array;
}
