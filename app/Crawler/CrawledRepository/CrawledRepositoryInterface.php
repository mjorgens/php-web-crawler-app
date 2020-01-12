<?php
/**
 * CrawledRepositoryInterface.php
 *
 * PHP version 7.2
 *
 * @category Interface
 * @package  App\Crawler\CrawledRepositor
 * @author   Marc Jorgensen <marcjorgensen@mail.weber.edu>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/cs4350-fall2019/final-mjorgens
 */

namespace App\Crawler\CrawledRepository;

use App\WebPageInterface;
use Psr\Http\Message\UriInterface;

/**
 * Interface CrawledRepositoryInterface
 *
 * @category Interface
 * @package  App\Crawler\CrawledRepository
 * @author   Marc Jorgensen <marcjorgensen@mail.weber.edu>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/cs4350-fall2019/final-mjorgens
 */
interface CrawledRepositoryInterface
{
    /**
     * Return all of the WebPageInterface in the repository
     *
     * @return array
     */
    public function all(): array;

    /**
     * Find the WebPageInterface by the url from the repository.
     * If not returns null.
     *
     * @param UriInterface $url Url to search for
     *
     * @return WebPageInterface|null
     */
    public function find(UriInterface $url): ?WebPageInterface;

    /**
     * Add a WebPageInterface to the repository
     *
     * @param WebPageInterface $page Web page to add
     *
     * @return void
     */
    public function add(WebPageInterface $page);

    /**
     * Checks if WebPageInterface is in the repository by url
     *
     * @param UriInterface $url Url to search for
     *
     * @return bool
     */
    public function contains(UriInterface $url): bool;

    /**
     * Returns the number of items in the repository
     *
     * @return int
     */
    public function numOfPages(): int;

    /**
     * Deletes all of the stored pages in the repository
     *
     * @return void
     */
    public function clear();
}
