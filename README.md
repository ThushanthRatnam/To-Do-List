## Project and Requirements 

This is a simple To-Do application usiing laravel application which consist of user registration,login.
user can create,update,view,delete To-Do lists and To-Do items.
user can mark an item as completed and it will show as seperate view

Basic Requierements: 


- PHP version 7.4 or greater.
- Laravel version 8.0.
- MySql Database.

## Set-up To-Do project using Laravel

- composer create-project laravel/laravel:^8.0 to-do-app
- cd to-do-app.
- php artisan serve.
- composer require laravel/ui.
- npm install && npm run dev
- create Database.
- set up .env file with appropriate databse credentials.
- php artisan make:migration create_role_items_table (create migrations for needed).
- php artisan migrate.
- php artisan make:controller Admin/ItemController (To create controllers).
- php artisan make:model ModellName (To create controllers).
- composer require "laravelcollective/html" (add third party libraries - optional)


## pages

- login page
- Register page
- Dashboard
- To-Do List page
- To-Do Item page

## DB

Dump DB has attached into a folder name "DB".

## seeding

Roles Data has been Seeded using below commands.
- php artisan make:seeder SeedName
- php artisan db:seed --class=SeedName

