<?php
/**
 * WebPage.php
 *
 * PHP Version 7.2
 *
 * @property string $url
 * @property string $html
 *
 * @category Model
 * @package  App
 * @author   Marc Jorgensen <marcjorgensen@mail.weber.edu>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/cs4350-fall2019/final-mjorgens
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class WebPage
 *
 * Data Model of the web page. It holds the url and html of a crawled page.
 *
 * @property string $url
 * @property string $html
 *
 * @category Model
 * @package  App
 * @author   Marc Jorgensen <marcjorgensen@mail.weber.edu>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/cs4350-fall2019/final-mjorgens
 */
class WebPage extends Model implements WebPageInterface
{
    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = ['url', 'html'];
}
