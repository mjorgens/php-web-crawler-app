<?php
/**
 * CrawledDBRepositoryTest.php
 *
 * PHP version 7.2
 *
 * @category Test
 * @package  Tests\Unit
 * @author   Marc Jorgensen <marcjorgensen@mail.weber.edu>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/cs4350-fall2019/final-mjorgens
 */

namespace Tests\Unit;

use App\Crawler\CrawledRepository\CrawledDBRepository;
use App\Crawler\CrawledRepository\CrawledRepositoryInterface;
use App\WebPage;
use GuzzleHttp\Psr7\Uri;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class CrawledDBRepositoryTest
 *
 * Tests for the CrawledDBRepository Class
 *
 * @category Test
 * @package  Tests\Unit
 * @author   Marc Jorgensen <marcjorgensen@mail.weber.edu>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/cs4350-fall2019/final-mjorgens
 */
class CrawledDBRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected $repository;
    protected $url1;
    protected $url2;
    protected $html;
    protected $page1;
    protected $page2;

    /**
     * SetUp method of test
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = new CrawledDBRepository();
        $this->url1 = 'https://example1.com/';
        $this->url2 = 'https://example2.com/';
        $this->html = "<a href='Test'>Test</a>";
        $this->page1 = new WebPage();
        $this->page1->url = $this->url1;
        $this->page1->html = $this->html;
        $this->page2 = new WebPage();
        $this->page2->url = $this->url2;
        $this->page2->html = $this->html;
    }

    /**
     * Test for all() method
     *
     * @return void
     */
    public function testAll()
    {
        $this->repository->add($this->page1);
        $this->repository->add($this->page2);
        $this->assertIsArray($this->repository->all());
        $this->assertSame($this->url1, $this->repository->all()[0]->url);
    }

    /**
     * Test for add() method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->assertSame(0, $this->repository->numOfPages());
        $this->repository->add($this->page1);
        $this->assertSame(1, $this->repository->numOfPages());
        $this->repository->add($this->page1);
        $this->assertSame(1, $this->repository->numOfPages());
    }

    /**
     * Test for contains() method
     *
     * @return void
     */
    public function testContains()
    {
        $this->repository->add($this->page1);
        $this->repository->add($this->page2);
        $this->assertTrue($this->repository->contains(new Uri($this->url1)));
        $this->assertFalse(
            $this->repository
                ->contains(new Uri('https://example3.com/'))
        );
    }

    /**
     * Test for find() method
     *
     * @return void
     */
    public function testFind()
    {
        $this->repository->add($this->page1);
        $this->repository->add($this->page2);
        $this->assertNotNull($this->repository->find(new Uri($this->url1)));
        $this->assertNotNull($this->repository->find(new Uri($this->url2)));
        $this->assertNull($this->repository->find(new Uri('https://example3.com/')));

    }

    /**
     * Test for numOfPages() method
     *
     * @return void
     */
    public function testNumOfPages()
    {
        $this->repository->add($this->page1);
        $this->assertSame(1, $this->repository->numOfPages());
    }

    /**
     * Test for __construct()
     *
     * @return void
     */
    public function testConstruct()
    {
        $this->assertTrue($this->repository instanceof CrawledRepositoryInterface);
        $this->assertTrue($this->repository instanceof CrawledDBRepository);

    }

    /**
     * Test for clear() method
     *
     * @return void
     */
    public function testClear()
    {
        $this->repository->add($this->page1);
        $this->repository->add($this->page2);
        $this->assertSame(2, $this->repository->numOfPages());

        $this->repository->clear();

        $this->assertSame(0, $this->repository->numOfPages());
    }
}
