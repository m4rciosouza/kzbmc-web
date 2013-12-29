kzbmc-web
=============================

This is the web version in HTML5 application that enables you to create and manage Business Model Canvas.
It also includes a PHP back-end that contains a RestFull API to communicate with the front-end.
Business Model Canvas is a strategic management and entrepreneurial tool. It allows you to describe, design, challenge, invent, and pivot your business model.

### Highlights

 * Based on AngularJS (http://angularjs.org) for logic and interface development
 * Based on Yeoman (http://yeoman.io) to control the development workflow
 * Based on Bootstrap (http://getbootstrap.com) for interface design 
 * Uses Laravel (http://laravel.com) to the RestFull API and database persistence

### How to run it

Inside your web server root folder
```
git clone git@github.com:m4rciosouza/kzbmc-web.git
cd kzbmc-web
composer install
```
To create the database tables
```
php artisan migrate
```
To populate with sample data
```
php artisan db:seed
```
To run the unit tests ( you must have installed phpunit )
```
phpunit
```
Access your webserver URL from your web browser

### License

[BSD license](http://opensource.org/licenses/bsd-license.php)