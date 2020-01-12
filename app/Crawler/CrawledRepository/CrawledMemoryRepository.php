<?php
/**
 * CrawledMemoryRepository.php
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

use App\WebPageInterface;
use GuzzleHttp\Psr7\Uri;
use Psr\Http\Message\UriInterface;

/**
 * Class CrawledMemoryRepository
 *
 * Data structure that contains a collection of WebPageInterface.
 * This implementation is in memory
 *
 * @category Data_Structure
 * @package  App\Crawler\CrawledRepository
 * @author   Marc Jorgensen <marcjorgensen@mail.weber.edu>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/cs4350-fall2019/final-mjorgens
 */
class CrawledMemoryRepository implements CrawledRepositoryInterface
{
    /**
     * All the WebPageInterfaces
     *
     * @var array
     */
    protected $repository;

    /**
     * CrawledMemoryRepository constructor.
     */
    public function __construct()
    {
        $this->repository = [];
    }

    /**
     * Return all of the WebPageInterface in the repository
     *
     * @return array
     */
    public function all(): array
    {
        return $this->repository;
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
        // iterate through the repository
        foreach ($this->repository as $page) {
            // check if the item url is the same url. if so return true
            if ($page->url == (string)$url) {
                return $page;
            }
        }

        return null;
    }

    /**
     * Add a WebPageInterface to the repository
     *
     * @param WebPageInterface $page Web page to add
     *
     * @return void
     */
    public function add(WebPageInterface $page): void
    {
        if (!$this->contains(new Uri($page->url))) {
            $this->repository[] = $page;
        }
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
        return count($this->repository);
    }

    /**
     * Deletes all of the stored pages in the repository
     *
     * @return void
     */
    public function clear()
    {
        $this->repository = array();
    }
}
