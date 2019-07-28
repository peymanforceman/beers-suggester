
## Coding Challenge - Beer Suggester

This is a backend coding challenge based on PunkIPA  https://punkapi.com/documentation/v2, using Laravel framework.

### How to install
1. `composer install`
2.  change `.env.example` File to `.env` and setup `.env` database information
3. Edit `phpunit.xml` , and set `DB_DATABASE` according to your test database information. ( make sure you setup a testing database for unit and feature tests.)
3. run command : `php artisan key:generate`
4. run command : `php artisan migrate`
6. run command : `php artisan serve`
7. open web server
8. Click `Update Database` from Header ( top right position ), to download beers from punk api and put them into our own Database.

The app has 2 endpoints:

1- API endpoint
 - Returns a JSON response with suggestion array of beers
 - The JSON will contain only id, name, tagline, image and abv
 - The suggestions are sorted by ascending ABV
 
2- HTML endpoint
- Input fields for the above parameters
- Returns a basic grid datatable containing the results sort by ascending ABV

### Unit & Feature Tests
This project includes all phpunit and feature tests for both API and Web environment.
- for testing after installation just run: `phpunit` in your command line.
## Description

I used a database updater for making app a lot quicker and decreasing the amount of http requests to the PunkAPI . This way we can avoid unnecessary requests to PunkAPI and increase speed, using our own database queries.


### Backend Framework : Laravel 5.8

Backend Used Libraries / Frameworks :
- https://github.com/laravel/laravel

Frontend Used Libraries / Frameworks :
- https://github.com/DataTables/DataTables
- https://github.com/ColorlibHQ/AdminLTE
- Bootstrap3 https://github.com/twbs/bootstrap