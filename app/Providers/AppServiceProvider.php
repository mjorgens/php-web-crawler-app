<?php

namespace App\Providers;

use App\Crawler\CrawledRepository\CrawledDBRepository;
use App\Crawler\CrawledRepository\CrawledMemoryRepository;
use App\Crawler\CrawledRepository\CrawledRepositoryInterface;
use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(CrawledRepositoryInterface::class, function () {
            // To switch between Memory or DB Repository
            // uncomment the one you want to use

             return new CrawledMemoryRepository();
            //return new CrawledDBRepository();
        });

        $this->app->singleton(Client::class, function () {
            return new Client();
        });

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
