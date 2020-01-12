<?php
/**
 * CrawledDBRepository.php
 *
 * PHP version 7.2
 *
 * @category Data_Structure
 * @package  App\Crawler\CrawledRepository
 * @author   Marc Jorgensen <marcjorgensen@mail.weber.edu>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/cs4350-fall2019/final-mjorgens
 */

namespace App\Crawler\CrawledRepository;

use App\WebPage;
use App\WebPageInterface;
use Psr\Http\Message\UriInterface;

/**
 * Class CrawledDBRepository
 *
 * Data structure that contains a collection of \WebPageInterface.
 * This implementation is with a database
 *
 * @category Data_Structure
 * @package  App\Crawler\CrawledRepository
 * @author   Marc Jorgensen <marcjorgensen@mail.weber.edu>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/cs4350-fall2019/final-mjorgens
 */
class CrawledDBRepository implements CrawledRepositoryInterface
{
    /**
     * Return all of the WebPageInterface in the repository
     *
     * @return array
     */
    public function all(): array
    {
        $array = [];
        $pages = WebPage::all();

        foreach ($pages as $page) {
            $array[] = $page;
        }

        return $array;
    }

    /**
     * Find the WebPageInterface by the url from the repository.
     * If not returns null.
     *
     * @param UriInterface $url Url to search for
     *
     * @return WebPageInterface|null
     */
    public function find(UriInterface $url): ?WebPageInterface
    {
        return WebPage::where('url', $url)->first();
    }

    /**
     * Add a WebPageInterface to the repository
     *
     * @param WebPageInterface $page Web page to add
     *
     * @return void
     */
    public function add(WebPageInterface $page)
    {
        WebPage::updateOrCreate(['url' => $page->url], ['html' => $page->html]);
    }

    /**
     * Checks if WebPageInterface is in the repository by url
     *
     * @param UriInterface $url Url to search for
     *
     * @return bool
     */
    public function contains(UriInterface $url): bool
    {
        return $this->find($url) !== null;
    }

    /**
     * Returns the number of items in the repository
     *
     * @return int
     */
    public function numOfPages(): int
    {
        return WebPage::all()->count();
    }

    /**
     * Deletes all of the stored pages in the repository
     *
     * @return void
     */
    public function clear()
    {
        WebPage::truncate();
    }
}
