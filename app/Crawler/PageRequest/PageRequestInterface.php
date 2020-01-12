<?php
/**
 * PageRequestInterface.php
 *
 * PHP version 7.2
 *
 * @category Interface
 * @package  App\Crawler\PageRequest
 * @author   Marc Jorgensen <marcjorgensen@mail.weber.edu>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/cs4350-fall2019/final-mjorgens
 */

namespace App\Crawler\PageRequest;

use App\WebPageInterface;
use GuzzleHttp\Client;
use Psr\Http\Message\UriInterface;

/**
 * Interface PageRequestInterface
 *
 * @category Interface
 * @package  App\Crawler\PageRequest
 * @author   Marc Jorgensen <marcjorgensen@mail.weber.edu>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/cs4350-fall2019/final-mjorgens
 */
interface PageRequestInterface
{
    /**
     * Static method that requests an url and returns a
     * WebPageInterface of the response. If an error occurs
     * it returns null.
     *
     * @param Client       $client Guzzle client
     * @param UriInterface $url    Url to get
     *
     * @return WebPageInterface|null
     */
    public static function getPage(Client $client, UriInterface $url): ?WebPageInterface;
}
