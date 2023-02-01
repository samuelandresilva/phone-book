# Phone Book App

This application consists of storing a phone book with contacts. The app was built with CodeIgniter framework vs 4.

**Please** read the user guide for a better explanation of how CI4 works!

## Installation & updates

Clone this project to your local storage with `git clone` then run `composer update` to instal required dependencies.

When updating, check the release notes to see if there are any changes you might need to apply
to your `app` folder. The affected files can be copied or merged from
`vendor/codeigniter4/framework/app`.

## Setup

Copy `env` to `.env` and tailor for your app, specifically the baseURL
and any database settings.

Run the following commands in order to ensure smooth operation of the application.

 - `php spark db:create phonebook` to create the database.
 - `php spark migrate` to migrate all database tables.
 - `php spark db:seed UserSeeder` to create a defaul admin user.
 - `php spark serve` to run application.

**Congratulations! You have just installed the best phone book system**

You can access the application by following the link `http://localhost:8080`
 - email: admin@admin.com
 - password: admin

## Server Requirements

1. Composer version 2.5 or higher
1. PHP version 7.4 or higher is required, with the following extensions installed:

    - [intl](http://php.net/manual/en/intl.requirements.php)
    - [mbstring](http://php.net/manual/en/mbstring.installation.php)

    Additionally, make sure that the following extensions are enabled in your PHP:

    - json (enabled by default - don't turn it off)
    - [mysqlnd](http://php.net/manual/en/mysqlnd.install.php) if you plan to use MySQL
    - [libcurl](http://php.net/manual/en/curl.requirements.php) if you plan to use the HTTP\CURLRequest library
