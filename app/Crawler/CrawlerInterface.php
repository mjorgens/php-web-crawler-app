<?php
/**
 * CrawlerInterface.php
 *
 * PHP version 7.2
 *
 * @category Interface
 * @package  App\Crawler
 * @author   Marc Jorgensen <marcjorgensen@mail.weber.edu>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/cs4350-fall2019/final-mjorgens
 */

namespace App\Crawler;

use App\Crawler\CrawledRepository\CrawledRepositoryInterface;
use GuzzleHttp\Client;
use Psr\Http\Message\UriInterface;

/**
 * Interface CrawlerInterface
 *
 * @category Interface
 * @package  App\Crawler
 * @author   Marc Jorgensen <marcjorgensen@mail.weber.edu>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/cs4350-fall2019/final-mjorgens
 */
interface CrawlerInterface
{
    /**
     * Static create method to return a new instance of a CrawlerInterface.
     *
     * @return CrawlerInterface
     */
    public static function create(): CrawlerInterface;

    /**
     * Method to start the crawler crawling.
     *
     * @param UriInterface $baseUrl The baseUrl to crawl
     *
     * @return CrawlerInterface
     */
    public function startCrawling(UriInterface $baseUrl): CrawlerInterface;

    /**
     * Getter for $baseUrl
     *
     * @return UriInterface
     */
    public function getBaseUrl(): UriInterface;

    /**
     * Setter for $baseURl
     *
     * @param UriInterface $baseUrl The baseUrl to crawl
     *
     * @return CrawlerInterface
     */
    public function setBaseUrl(UriInterface $baseUrl): CrawlerInterface;

    /**
     * Getter for $maxCrawl
     *
     * @return int
     */
    public function getMaxCrawl(): int;

    /**
     * Setter for $maxCrawl
     *
     * @param int $maxCrawl The max number to crawl
     *
     * @return CrawlerInterface
     */
    public function setMaxCrawl(int $maxCrawl): CrawlerInterface;

    /**
     * Getter for $repository
     *
     * @return CrawledRepositoryInterface
     */
    public function getRepository(): CrawledRepositoryInterface;

    /**
     * Setter for $repository
     *
     * @param CrawledRepositoryInterface $repository The repository of web pages
     *
     * @return CrawlerInterface
     */
    public function setRepository(CrawledRepositoryInterface $repository): CrawlerInterface;

    /**
     * Getter for $client
     *
     * @return Client
     */
    public function getClient(): Client;

    /**
     * Setter for $client
     *
     * @param Client $client \Guzzle client
     *
     * @return CrawlerInterface
     */
    public function setClient(Client $client): CrawlerInterface;
}
