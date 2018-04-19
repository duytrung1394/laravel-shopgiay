<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## laravel-shopgiay ##
Xây dựng site bán giày với laravel Shoppingcart

### Installation ###

* type `git clone https://github.com/duytrung1394/laravel-shopgiay.git projectname` to clone the repository 
* type `cd projectname`
* type `composer install`
* copy *.env.example* to *.env*
* type `php artisan key:generate`to generate secure key in *.env* file
* if you use MySQL in *.env* file :
   * set DB_CONNECTION
   * set DB_DATABASE
   * set DB_USERNAME
   * set DB_PASSWORD
* because `php artisan migrate` command isn't working. In your database, import `shoppingcart.sql` in 'public/shoppingcart.sql'
* edit *.env* for emails configuration
* project using laravel scout and ships with an Algolia driver, you need config ALGOLIA_KEY :
    * You can create a free account : https://www.algolia.com/
    * browse to https://www.algolia.com/api-keys and copy your Application ID and Admin API Key and put them in your .env file like this:
        `ALGOLIA_APP_ID=YOUR_ALGOLIA_APP_ID'
        `ALGOLIA_SECRET=YOUR_ALGOLIA_SECRET`

### Features ###
* Home page
* Category produts
* Product detail
* Shopping cart
* Checkout basic
* Login and register
* Admin dashboard with users, category, product, brand, statistics,...

