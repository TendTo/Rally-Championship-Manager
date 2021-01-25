# Rally championship manager
Let this web application manage the boring stuff of your rally championship, keeping track of results and points for each rally and stage, so you can be focused on achieving the best TEMPO!!

## :red_circle: Online version!
A live version is available [here](https://rally-championship-manager.herokuapp.com/championship)

## Table of contents

- **[:wrench: Setting up a local istance](#wrench-setting-up-a-local-istance)**
- **[:whale: Setting up a Docker container](#whale-setting-up-a-docker-container)**
- **[:bar_chart: _\[Optional\]_ Setting up testing](#bar_chart-optional-setting-up-testing)**

## :wrench: Setting up a local istance

#### System requirements
- [PHP 7.3+](https://www.php.net/downloads.php)
- [Composer](https://getcomposer.org/download/)
- [node.js](https://nodejs.org/en/)
- [npm](https://www.npmjs.com/)

### Additional requirements
- Php driver for the kind of database you want to use. Something like `php-mysql` for mysql, `php-sqlite3` for sqlite or `php-pgsql` for PostgreSQL
- php-xml
- php-mbstring

### Steps:
- Clone this repository
- **Run** `composer install` to insall all the php dependencies
- **Run** `npm install && npm run dev && npm run dev` to install the js dependencies to use bootstrap
- Rename the _.env.example_ file in _.evn_
- **Run** `php artisan key:generate` to generate a key the application will use
- Make sure you have a database to store the data of the application, and fill the needed info in the _.env_ file or as environment variables
- **Run** `php artisan migrate` to start a database migration
- **Run** `php artisan serve` to launch the web server

## :whale: Setting up a Docker container

#### System requirements
- Docker

### Steps:
- Clone this repository
- Rename the _.env.example_ file in _.evn_
- Make sure you have a database to store the data of the application, and fill the needed info in the _.env_ file or as environment variables
- **Run** `./vendor/bin/sail up` to start the docker containers

## :bar_chart: _[Optional]_ Setting up testing
Some basic tests have already been implemented, but there is no thing like too much testing, so some additions would be welcome.
You can do so by **running**
`php artisan make:test [-u] <subfolder/testName>`

Before starting, you may want to create a testing database with `mkdir -p database && touch database/database.sqlite` and change these settings in the _phpunit.xml_ file:
```xml
<server name="DB_CONNECTION" value="sqlite"/>
<server name="DB_DATABASE" value="database/database.sqlite"/>
```
I'd suggest using a **different database** from the one you use to store data, since a testing session will wipe every previous entry in the database, and this might not be what you want.

To actually start the tests, **run**
`php artisan test`
  
## Credits
- The [Laravel](https://github.com/laravel/laravel) framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
- [Bootswatch (Darkly)](https://bootswatch.com/darkly/) for the css styling