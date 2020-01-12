<?php
/**
 * PageRequest.php
 *
 * PHP version 7.2
 *
 * @category Helper
 * @package  App\Crawler\PageRequest
 * @author   Marc Jorgensen <marcjorgensen@mail.weber.edu>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/cs4350-fall2019/final-mjorgens
 */

namespace App\Crawler\PageRequest;

use App\WebPage;
use App\WebPageInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\UriInterface;

/**
 * Class PageRequest
 *
 * Helper class to retrieve a WebPageInterface from an passed UriInterface
 *
 * @category Helper
 * @package  App\Crawler\PageRequest
 * @author   Marc Jorgensen <marcjorgensen@mail.weber.edu>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/cs4350-fall2019/final-mjorgens
 */
class PageRequest implements PageRequestInterface
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
    public static function getPage(Client $client, UriInterface $url): ?WebPageInterface
    {
        $request = new Request('GET', $url);

        // try and sent the request and if an error return null
        try {
            $response = $client->send($request);
        } catch (RequestException|ConnectException|GuzzleException $e) {
            return null;
        }

        $page = new WebPage();
        $page->url = (string)$request->getUri();
        $page->html = (string)$response->getBody();
        return $page;
    }
}
