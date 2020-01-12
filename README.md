# CS 4350 Final Project

## Project Description
Most of the code I wrote for the project is in the `app/Crawler` directory except the
model of the web page in `app/`. Crawler class is the main logic for the crawler.
PageRequest and LinkParser are helper classes. PageRequest takes in an url and returns
the a results. LinkParser just takes in a string of html and returns the links contained.
CrawlerQueue and CrawledRepository are the data structures. CrawlerQueue holds all the
urls that are to be requested. CrawledRepository holds all of the crawled results. There
are two implementations of CrawledRepository, one that uses an array and one that uses 
a database. 

## Installation
Clone the project
```shell script
git clone https://github.com/mjorgens/php-web-crawler-app
```
Change directories
```shell script
cd php-web-crawler-app
```
Install dependencies
```shell script
composer install
```
Create a new .env (linux or mac)
```shell script
cp .env.example .env
```
Edit .env and add your db settings
```dotenv
DB_CONNECTION=mysql
DB_HOST=<ip>
DB_PORT=3306
DB_DATABASE=<database>
DB_USERNAME=<user>
DB_PASSWORD=<password>
```
Generate app key
```shell script
php artisan key:generate
```
Setup the data tables
```shell script
php artisan migrate
```

## Configuration
To configure which CrawledRepository implementation. Comment/Uncomment the return
statement in `app/Providers/AppServiceProvider.php` line 24 or 25.

## Local Serving
The app entry point is `public/index.php`.
So to serve it locally
```shell script
php -S localhost:8000 public
```
or with artisan
```shell script
php artisan serve
```

## Testing
### Description
I have included both unit tests and simple feature tests. The unit tests 
test all of the classes in my crawler library. The feature tests test
the routes of the app and if the app runs.

### Run the tests
To run the tests enter the command
```shell script
vendor/bin/phpunit
```

### Code coverage
I included only the parts of the app that I wrote code. So mainly in 
the `app\Crawler` and `app\Http\Controllers` directories.

The code coverage report is located at `storage\logs\coverage`.

