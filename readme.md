# My simple Laravel 5.3 Application using CRUD :joy_cat:
![Sandbox](/resources/images/sandbox-banner.jpg)

# Introduction:

This project aims to copy and remake Lynda's PHP exercises from Chapters 15 - 19
while using Laravel 5.3 as the framework and serves as a reference. Additionally,
Gulp, Sass,  Laravel's Blade and Eloquent ORM are also used as well as deployment
using the free services of Heroku and PostgreSQL.

Most of the words written in **bold** are either commands to be written in the CLI,
code snippets or file paths.

This application is relatively rudimentary and should just showcase a simple CRUD pattern with the technologies
mentioned above. A preview of this webapp can be seen [here](https://aqueous-cove-69920.herokuapp.com/).

You will first land on Laravel's pre-made index page, however, there are 2 links on the upper right corner
where you can either register a fake account with a fake email or login with the fake email. Once registered,
you will be redirected to the homepage where you can create, edit, delete or just see subjects, which
can have additional pages belonging to a subject, which again CRUD can be performed on.

![example](/resources/images/example.png)

Database is currently set to Heroku's PostgreSQL. To change it back to MySQL for local
development, go to "/config/database.php" and change
" **'default' => 'pgsql',** " to " **'default' => 'mysql',** ".

## Setting up the environment:

* Make sure you have [Node.js](https://nodejs.org/en/) version 6 or higher:
    * **node -v**
* (if not already) Install [Composer](https://getcomposer.org/download/) and check if correctly installed:
    * **composer**
* Create a new directory in the preferred directory using the CLI:
    * **composer create-project laravel/laravel folder_name**
* Navigate to the created folder and download npm dependencies with:
    * **composer install**
* Download Gulp for Sass and other organizing tasks and Bower for easy Front-End dependency inclusion with:
    * **npm install --global gulp bower**
* Install all other npm dependencies as well as Laravel's Elixir:
    * **npm install**
* Configure/create Bower config file ".bowerrc" to place dependencies somewhere else other than root:
```
  {
    "directory": "resource/assets/js"
  }
```
* You will need to add the above path inside your project’s ".gitignore" file as well.
* Install Front-end dependencies if needed (e.g. AngularJS, etc..):
    * **bower install angular angular-bootstrap angular-resource bootstrap moment**
* Check if Laravel Server can be run (CTRL+C to cancel):
    * **php artisan serve**
* Open **localhost:8000** in the browser
* (Setup up Elixir (follow guide above) for sass and multiple javascript files, etc...)
* Run MySQL and Apache
* Create your Database either in the CLI, using Eloquent or phpMyAdmin
* Setup your environment variables in the ".env" file in the root directory according to the one you are using:
  ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=s02_laravel_migration
    DB_USERNAME=root
    DB_PASSWORD=
  ```
* Run the following command for Laravel to keep track, which migration have already run:
    * **php artisan migrate:install**
* Run Gulp to load Bootstrap and jQuery
    * **gulp**

## Workflow:

* Create your database schema using the built-in [migration](https://laravel.com/docs/5.3/migrations) template:
    * **php artisan make:migration migration_name** (Choose a plural name for the table)
    * **php artisan make:migration create_users_table --create=users** (to generate a prefilled stub for "users")
* Migrate the schema to the database and check the database if a table was created:
    * **php artisan migrate**
* Defining a model for a table and simultaneously create a migration for it:
    * **php artisan make:model User --migration** (Choose the singular form for the model according to a created table)
* Creating default/dummy values in the database can be achieved through [seeding](https://laravel.com/docs/5.3/seeding):
    * **php artisan make:seeder UsersTableSeeder** (Plural name like the table name)
* Create the view in the directory "/resources/views" while following [Blade guidelines](https://laravel.com/docs/5.3/blade)
* Shortcut for Resource-Controller (see table below for API):
    * **php artisan make:controller UserController --resource** (It is advised to use capital singular and postfix it with 'Controller')
* Create some simple routes in the "/routes/web.php" file for some testing and try deploying a prototype to Heroku as early as possible to minimize debugging later on.
* Double check your API routes paths you have made:
    * **php artisan route:list**
* Setting up Gulp.js with [Laravel's Elixir](https://laravel.com/docs/5.3/elixir#working-with-scripts)
* Run Gulp (preferably **gulp watch**) on a second CLI so you can run "**php artisan serve**" on the other
* For [CRUDing](https://scotch.io/tutorials/simple-laravel-crud-with-resource-controllers)
* For Bootstrap Glyphicons create folder at "/public/fonts/bootstrap" and add this to the Gulp file:
    * **mix.copy('node_modules/bootstrap-sass/assets/fonts/bootstrap/','public/fonts/bootstrap');**
* When working with Sessions, Redirects, etc.. add this on top of the Controller:
    * **use Illuminate\Support\Facades\Validator;**
    * **use Illuminate\Support\Facades\Input;**  
    * **use Illuminate\Support\Facades\Redirect;**  
    * **use Session;**
* When working on Laravel Blade Forms, "Illuminate/Html" is deprecated so install "Collective/Html" Follow this [guide](https://laravelcollective.com/docs/5.2/html)

## Resource Controller API:

    Verb | Path | Action | Route Name
    -----|------|--------|-----------
    GET | /my | index | my.index
    GET | /my/create | create | my.create
    POST| /my |  store | my.store
    GET | /my/{my} | show  | my.show
    GET | /my/{my}/edit | edit | my.edit
    PUT/PATCH |/my/{my} | update | my.update
    DELETE | /my/{my} | destroy | my.destroy

## Authentication:

* Following this [guide](https://auth0.com/blog/creating-your-first-laravel-app-and-adding-authentication/)
* Configures and creates auth files automatically:
    * **php artisan make:auth**
* This creates a bunch of files: "views/auth", adds code to "web.php" and in the controller, etc.
* Migrate the migration data that were already created before in "database/migrations":
    * **php artisan migrate**
* Configure the "LoginController.php" and the "RegisterController.php" files on the "$redirectTo" variable
* Configure the views: "views/auth", "home.blade.php" and "welcome.blade.php"

## Deploy using Heroku

* Sign up in the [Heroku website](https://id.heroku.com/login)
* Install the Heroku CLI following this [guide](https://devcenter.heroku.com/articles/heroku-command-line)   
* Type in the console to check if setup is successful and to finish insstallation:
    * **heroku --version**
* Navigate to the project directory and have it in a "*git commit*"-state
* Create a Procfile (tells Heroku what command to use to launch the web server correctly):
    * **echo web: vendor/bin/heroku-php-apache2 public/ > Procfile**
* Add and commit once again and create the heroku application:
    * **heroku create**
* Declare a buildpack (explicitly tells heroku that the app is written in PHP instead of NodeJS):
    * **heroku buildpacks:set heroku/php**
* Generate the Laravel encryption key (encrypts user sessions and other information):
    * **php artisan key:generate --show** (copy the generated key e.g:**"base64:GpYbrM06CjwxP++I2Y3eccFqTnGfQddQVTNjOuGPcdE="**)
* Set the encryption key:
    * **heroku config:set APP_KEY=...** (Paste encryption key in "...")
* Optional: You might also need to set the same key in "config/app.php" on this line:
    * " **'key' => env('APP_KEY', 'base64:GpYbrM06CjwxP++I2Y3eccFqTnGfQddQVTNjOuGPcdE='),** "
* Push to Heroku:
    * **git push heroku master**
* After successful push, you can view your app in the web under the generated URL or with:
    * **heroku open**
* For debugging errors:
    * **heroku logs**

## Using PostgreSQL in Heroku

> **Heroku / PostgreSQL information used here:**
> * postgresql-spherical-62738 as DATABASE_URL
> * app = aqueous-cove-69920

* The following is taken from this [guide](http://www.easylaravelbook.com/blog/2015/01/31/deploying-a-laravel-application-to-heroku/)
* Make sure you have made migration files for the database
* Create an add-on for PostgreSQL (free with significant limitations: limit = 10000 rows):
    * **heroku addons:add heroku-postgresql:hobby-dev**
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
* To check your pgsql information if you want to add the it directly to the snippet above:
    * **heroku config --app lit-retreat-6653 | grep DATABASE_URL**
* Commit changes and push to Heroku and finally migrate your database:
    * **heroku run php artisan migrate --app app_name**
* You should now have a working app when viewing in the browser:
    * **heroku open**

***

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
