# My first Laravel application using CRUD :joy_cat:

This project is aimed to copy and remake Lynda's PHP exercises from Chapters 15 - 19
while using Laravel 5.3 as the framework. Additionally, Gulp, Sass and Laravel's Blade
and Eloquent ORM is also used.

## Setting up the environment:

* Make sure you have Node.js version 6 or higher
    **node -v**
* (if not already) Install [Composer](https://getcomposer.org/download/) and check if correctly installed:
    **composer**
* Create a new directory in the preferred directory using the CLI:
    **composer create-project laravel/laravel <folder_name>**
* Navigate to the created folder and download npm dependencies with
    **composer install**
* Download Gulp with:
    **npm install --global gulp**
* Install all other npm dependencies as well as Laravel Elixir with
    **npm install**
* Check if Laravel Server can be run:
    **php artisan serve**
* Open **localhost:8000** in the browser
* (Setup up Elixir (follow guide above) for sass and multiple javascript files, etc...)
* Run MySQL and Apache
* Run Gulp (preferably **gulp watch**) on a second CLI so you can run **php artisan serve** on the other

## Tips:

* Setting up Gulp.js with [Laravel's Elixir](https://laravel.com/docs/5.3/elixir#working-with-scripts)
* For [CRUDing](https://scotch.io/tutorials/simple-laravel-crud-with-resource-controllers)
* Shortcut for Resource-Controller:
    **php artisan make:controller <controller_name> --resource**
* For Bootstrap Glyphicons create folder at "/public/fonts/bootstrap" and add this to the Gulp file:
    **mix.copy('node_modules/bootstrap-sass/assets/fonts/bootstrap/','public/fonts/bootstrap');**
* When working with Sessions, Redirects, etc.. add this on top of the Controller
    **use Illuminate\Support\Facades\Validator;**
    **use Illuminate\Support\Facades\Input;**
    **use Illuminate\Support\Facades\Redirect;**
    **use Session;**
* When working on Laravel Blade Forms, "Illuminate/Html" is deprecated so install "Collective/Html"
    Follow this [guide](https://laravelcollective.com/docs/5.2/html)

## Authentication:

* Following this [guide](https://auth0.com/blog/creating-your-first-laravel-app-and-adding-authentication/)
* Configures and creates auth files automatically:
    **php artisan make:auth**
* This creates a bunch of files: "views/auth", adds code to "web.php" and in the controller, etc.
* Migrate the migration data that were already precreated in "database/migrations"
    **php artisan migrate**
* Configure the "LoginController.php" and the "RegisterController.php" files on the "$redirectTo" variable
* Configure the views: "views/auth", "home.blade.php" and "welcome.blade.php"

## Resource - Controller actions:

    Verb | Path | Action | Route Name
    -----|------|--------|-----------
    GET | /my | index | my.index
    GET | /my/create | create | my.create
    POST| /my |  store | my.store
    GET | /my/{my} | show  | my.show
    GET | /my/{my}/edit | edit | my.edit
    PUT/PATCH |/my/{my} | update | my.update
    DELETE | /my/{my} | destroy | my.destroy

## Deploy using Heroku

* Sign up on the [Heroku website](https://id.heroku.com/login)
* Install the Heroku CLI in this [guide](https://devcenter.heroku.com/articles/heroku-command-line)   
* Type in the console to check if setup is successful and to finish insstallation
    **heroku --version**
* Navigate to the project directory and have it in a "*git commit*"-state
* Create a Procfile (tells Heroku what command to use to launch the web server correctly)
    **echo web: vendor/bin/heroku-php-apache2 public/ > Procfile**
* Add and commit once again and create the heroku application
    **heroku create**
* Declare a buildpack (explicitly tells heroku that the app is written in PHP instead of NodeJS)
    **heroku buildpacks:set heroku/php**
* Generate the Laravel encryption key (encrypts user sessions and other information)
    **php artisan key:generate --show** (copy the generated key e.g:**"base64:GpYbrM06CjwxP++I2Y3eccFqTnGfQddQVTNjOuGPcdE="**)
* Set the encrytion key:
    **heroku config:set APP_KEY=...** (Paste encryption key in "...")
* Optional: You might also need to set the same key in "config/app.php" on this line
    "**'key' => env('APP_KEY', 'base64:GpYbrM06CjwxP++I2Y3eccFqTnGfQddQVTNjOuGPcdE='),**"
* Push to Heroku
    **git push heroku master**
* After successful push, you can view your app in the web under the generated URL or with
    **heroku open**
* For debugging errors
    **heroku logs**

## Using PostgreSQL in Heroku
postgresql-spherical-62738 as DATABASE_URL
app = aqueous-cove-69920

* Create a add-on for PostgreSQL (free with significant limitations: limit = 10000 rows)
    **heroku addons:add heroku-postgresql:hobby-dev**
* Follow this schema for the database setting in "**config/database.php**":
```
  'default' => 'pgsql',

  ...

  'pgsql' => [
    'driver'   => 'pgsql',
    'host'     => parse_url(getenv("DATABASE_URL"))["host"],
    'database' => substr(parse_url(getenv("DATABASE_URL"))["path"], 1),
    'username' => parse_url(getenv("DATABASE_URL"))["user"],
    'password' => parse_url(getenv("DATABASE_URL"))["pass"],
    'charset'  => 'utf8',
    'prefix'   => '',
    'schema'   => 'public',
  ],
```


# Laravel PHP Framework

[![Build Status](https://travis-ci.org/laravel/framework.svg)](https://travis-ci.org/laravel/framework)
[![Total Downloads](https://poser.pugx.org/laravel/framework/d/total.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/framework/v/stable.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Unstable Version](https://poser.pugx.org/laravel/framework/v/unstable.svg)](https://packagist.org/packages/laravel/framework)
[![License](https://poser.pugx.org/laravel/framework/license.svg)](https://packagist.org/packages/laravel/framework)

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as authentication, routing, sessions, queueing, and caching.

Laravel is accessible, yet powerful, providing tools needed for large, robust applications. A superb inversion of control container, expressive migration system, and tightly integrated unit testing support give you the tools you need to build any application with which you are tasked.

## Official Documentation

Documentation for the framework can be found on the [Laravel website](http://laravel.com/docs).

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](http://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
