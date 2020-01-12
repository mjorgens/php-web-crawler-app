<?php
/**
 * CrawlerController.php
 *
 * PHP Version 7.2
 *
 * @category Controller
 * @package  App\Http\Controllers
 * @author   Marc Jorgensen <marcjorgensen@mail.weber.edu>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/cs4350-fall2019/final-mjorgens
 */

namespace App\Http\Controllers;

use App\Crawler\CrawledRepository\CrawledRepositoryInterface;
use App\Crawler\Crawler;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Uri;
use Illuminate\Http\Request;

/**
 * Class CrawlerController
 *
 * Controller class for using the \Crawler class
 *
 * @category Controller
 * @package  App\Http\Controllers
 * @author   Marc Jorgensen <marcjorgensen@mail.weber.edu>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/cs4350-fall2019/final-mjorgens
 */
class CrawlerController extends Controller
{
    /**
     * Crawled repository
     *
     * @var CrawledRepositoryInterface
     */
    protected $repository;
    /**
     *  \Guzzle client
     *
     * @var Client
     */
    protected $client;

    /**
     * CrawlerController constructor.
     *
     * @param CrawledRepositoryInterface $repository Crawled repository
     * @param Client                     $client     \Guzzle client
     */
    public function __construct(CrawledRepositoryInterface $repository, Client $client)
    {
        $this->repository = $repository;
        $this->client = $client;
    }

    /**
     * Method that takes a form request with an url and max number to crawl.
     * Uses the Crawler class and returns the crawled info to a view.
     *
     * @param Request $request HTTP request
     *
     * @return mixed
     */
    public function crawlUrls(Request $request)
    {
        // validate the form info
        $request->validate(
            [
                'website' => 'required|url',
                'max' => 'required|integer|min:0',
            ]
        );

        $url = new Uri($request->input('website'));
        $maxUrls = $request->input('max');


        // Craw the url
        Crawler::create()
            ->setRepository($this->repository)
            ->setClient($this->client)
            ->setMaxCrawl($maxUrls)
            ->startCrawling($url);

        // return the results in the repository in the 'results' view
        return view('single')->withPages($this->repository->all());
    }

    /**
     * Method that returns all the crawled information in repository
     *
     * @return mixed
     */
    public function getUrls()
    {
        return view('single')->withPages($this->repository->all());
    }
}
