<?php
/**
 * RouteTest.php
 *
 * PHP version 7.2
 *
 * @category Test
 * @package  Tests\Feature
 * @author   Marc Jorgensen <marcjorgensen@mail.weber.edu>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/cs4350-fall2019/final-mjorgens
 */

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class RouteTest
 *
 * Tests for the routes part of the app
 *
 * @category Test
 * @package  Tests\Feature
 * @author   Marc Jorgensen <marcjorgensen@mail.weber.edu>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/cs4350-fall2019/final-mjorgens
 */
class RouteTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test for the GET method of root route
     *
     * @return void
     */
    public function testRootGetRoute()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Enter url to crawl');
        $response->assertSee('Last Pages Crawled');
    }

    /**
     * Test for the POST method of root route
     *
     * @return void
     */
    public function testRootPostMethod()
    {
        $response = $this->post(
            '/', [
            'website' => 'http://example.com',
            'max' => 1]
        );

        $response->assertStatus(200);
        $response->assertSee('http://example.com');
    }
}
