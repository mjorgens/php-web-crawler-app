<?php
/**
 * Crawler.php
 *
 * PHP version 7.2
 *
 * @category Class
 * @package  App\Crawler
 * @author   Marc Jorgensen <marcjorgensen@mail.weber.edu>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/cs4350-fall2019/final-mjorgens
 */

namespace App\Crawler;

use App\Crawler\CrawledRepository\CrawledMemoryRepository;
use App\Crawler\CrawledRepository\CrawledRepositoryInterface;
use App\Crawler\CrawlQueue\CrawlQueue;
use App\Crawler\CrawlQueue\CrawlQueueInterface;
use App\Crawler\LinkParser\LinkParser;
use App\Crawler\PageRequest\PageRequest;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Uri;
use Psr\Http\Message\UriInterface;

/**
 * Class Crawler
 *
 * Class that request an url and then parses the html return for the links
 * and then repeats the process for all the links until the max crawl limit
 * or runs out of links.
 *
 * @category Class
 * @package  App\Crawler
 * @author   Marc Jorgensen <marcjorgensen@mail.weber.edu>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/cs4350-fall2019/final-mjorgens
 */
class Crawler implements CrawlerInterface
{
    /**
     * The base url to crawl
     *
     * @var Uri
     */
    protected $baseUrl;
    /**
     * The max number of urls to crawl
     *
     * @var int
     */
    protected $maxCrawl;
    /**
     * The stored crawled web pages
     *
     * @var CrawledRepositoryInterface
     */
    protected $repository;
    /**
     *  The queue of urls to be crawled
     *
     * @var CrawlQueueInterface
     */
    protected $queue;
    /**
     * The Guzzler\Client for the requests
     *
     * @var Client
     */
    protected $client;

    /**
     * Crawler constructor.
     */
    public function __construct()
    {
        $this->maxCrawl = 20;
        $this->queue = new CrawlQueue();
        $this->repository = new CrawledMemoryRepository();
        $this->baseUrl = new Uri();
        $this->client = new Client();
    }

    /**
     * Static create method to return a new instance of a CrawlerInterface.
     *
     * @return CrawlerInterface
     */
    public static function create(): CrawlerInterface
    {
        return new static();
    }

    /**
     * Getter for $baseUrl
     *
     * @return UriInterface
     */
    public function getBaseUrl(): UriInterface
    {
        return $this->baseUrl;
    }

    /**
     * Setter for $baseURl
     *
     * @param UriInterface $baseUrl The baseUrl to crawl
     *
     * @return CrawlerInterface
     */
    public function setBaseUrl(UriInterface $baseUrl): CrawlerInterface
    {
        $this->baseUrl = $baseUrl;
        return $this;
    }

    /**
     * Getter for $maxCrawl
     *
     * @return int
     */
    public function getMaxCrawl(): int
    {
        return $this->maxCrawl;
    }

    /**
     * Setter for $maxCrawl
     *
     * @param int $maxCrawl The max number to crawl
     *
     * @return CrawlerInterface
     */
    public function setMaxCrawl(int $maxCrawl): CrawlerInterface
    {
        $this->maxCrawl = $maxCrawl;
        return $this;
    }

    /**
     * Getter for $repository
     *
     * @return CrawledRepositoryInterface
     */
    public function getRepository(): CrawledRepositoryInterface
    {
        return $this->repository;
    }

    /**
     * Setter for $repository
     *
     * @param CrawledRepositoryInterface $repository The repository of web pages
     *
     * @return CrawlerInterface
     */
    public function setRepository(CrawledRepositoryInterface $repository): CrawlerInterface
    {
        $this->repository = $repository;
        return $this;
    }

    /**
     * Getter for $client
     *
     * @return Client
     */
    public function getClient(): Client
    {
        return $this->client;
    }

    /**
     * Setter for $client
     *
     * @param Client $client \Guzzle client
     *
     * @return CrawlerInterface
     */
    public function setClient(Client $client): CrawlerInterface
    {
        $this->client = $client;
        return $this;
    }

    /**
     * Method to start the crawler crawling.
     *
     * @param UriInterface $baseUrl The baseUrl to crawl
     *
     * @return CrawlerInterface
     */
    public function startCrawling(UriInterface $baseUrl): CrawlerInterface
    {
        $this->baseUrl = $baseUrl;

        $this->queue->add($this->getBaseUrl());

        $this->startCrawlingQueue();

        return $this;
    }

    /**
     * Protected method that loops thought the url queue
     * and adds the returned web page to the repository
     *
     * @return void
     */
    protected function startCrawlingQueue()
    {
        $this->repository->clear();

        // While the queue is not empty and hasn't hit the max crawl limit
        while (!$this->queue->isEmpty()
            && $this->repository->numOfPages() < $this->getMaxCrawl()) {
            $next = $this->queue->next();

            // Check to see if the url is already in repository
            // and get page from repository
            $page = $this->repository->find($next);

            // If it is not in the repository get the page
            if (!isset($page)) {
                $page = PageRequest::getPage($this->client, $next);
            }

            // Check if the page return is good.
            // If so add to repository and parse links
            if (isset($page)) {
                $this->repository->add($page);

                $links = LinkParser::parseLinks($page->html, new Uri($page->url));

                // Add links to the queue
                foreach ($links as $link) {
                    // Check if link is already in queue
                    if (!$this->queue->contains($link)) {
                        $this->queue->add($link);
                    }
                }
            }
        }
    }
}
