# PHP Authentication
My work on a [tutorial by Alex Garrett](https://www.youtube.com/playlist?list=PLfdtiltiRHWGKUvioJly40RJZchSG2-34) (Codecourse). Thanks Alex!

## Dependencies
1. [Slim](https://github.com/slimphp/Slim)
2. [Slim Views](https://github.com/slimphp/Slim-Views)
3. [Twig](https://github.com/twigphp/Twig)
4. [PHPMailer](https://github.com/PHPMailer/PHPMailer)
5. [Hassankhan Config](https://packagist.org/packages/hassankhan/config)
6. [Violin](https://github.com/alexgarrett/violin)
7. [Illuminate Database](https://github.com/illuminate/database)
8. [IRCMaxell RandomLib](https://packagist.org/packages/ircmaxell/random-lib)

*Check the Composer file, composer.json, for the dependency list with versions*


## Getting Started
### Database Setup

First Set up a database (Default Name: site).

Create table 'users' with the following structure:

| Column              | Type         | Null | Default            |
|---------------------|--------------|------|--------------------|
| id (Primary, AI)    | int(11)      | No   |                    |
| username            | varchar(32)  | No   |                    |
| email               | varchar(255) | No   |                    |
| first_name          | varchar(64)  | Yes  | NULL               |
| last_name           | varchar(64)  | Yes  | NULL               |
| password            | varchar(255) | No   |                    |
| active              | tinyint(1)   | No   |                    |
| active_hash         | varchar(255) | Yes  | NULL               |
| recover_hash        | varchar(255) | Yes  | NULL               |
| remember_identifier | varchar(255) | Yes  | NULL               |
| remember_token      | varchar(255) | Yes  | NULL               |
| created_at          | timestamp    | No   | CURRENT_TIMESTAMP  |
| updated_at          | timestamp    | Yes  | NULL               |


Create table 'users_permissions' with the following structure:

| Column           | Type       | Null | Default            |
|------------------|------------|------|--------------------|
| id (Primary, AI) | int(11)    | No   |                    |
| user_id          | int(11)    | No   |                    |
| is_admin         | tinyint(4) | No   |                    |
| created_at       | timestamp  | Yes  | CURRENT_TIMESTAMP  |
| updated_at       | timestamp  | Yes  | NULL               |


### Configuration

Go ahead and copy /app/config/development.php.example to development.php:

```
cp /app/config/development.php.example /app/config/development.php
```

#### Take a look at development.php and input your own appropriate parameters within:
1. App URL (app.url)
2. Database Configuration (db)
3. PHPMailer parameters (mail)

You can make multiple configuration files with different filenames and change mode.php to reference the appropriate configuration filename. In the above case, it would be called development.php and have the text `development` within it.

Then you should be good to go, for the most part.


## Progress

#### The Tutorial so far: PHP Authentication by Alex Garrett (Codecourse)
+ Used composer to install dependencies from packagist.org
+ Set up directory structure, Slim framework, .htaccess for public directory
+ Configuration files
+ Created and structured database table Users
+ Used Eloquent to create first database-model, writing some of our own namespaced classes
+ Set up basic routes and views (home) using Slim and Twig
+ Implemented flash messages for user notifications
+ Set up a helper called Hash that allows us to hash passwords for security
+ Register route and view
+ Used Alex Garrett's Violin validation to validate form entries
+ Logging in the user and some session stuff
+ PHPMailer and a couple related classes to send notification emails
+ Email routes and views/templates
+ RandomLib to create random strings for hasing, like in account activation
+ Finished up account activation via email and activate route
+ Created filter middleware in order to protect routes from an authenticated user (Login, Register, Activate) or guest user
+ Created CSRF middleware and implemented it in all existing forms to protect against CSRF attacks
+ Added logout route and appropriate link to navigation
+ Profile pictures from Gravatar by editing User class and navigation template
+ Remember Me function - form, cookie creation/deletion, logic and Logging out
+ User Profile Route, View, and nav link
+ Users List Route, View, and nav link
+ User Permissions - Created table, class, routes, and views for example administrator area
+ Custom 404 page
+ Change password form, route handling, validation, and view

#### Up Next:
+ Recover forgotten password
+ Update user information

#### Todo: A few things I've thought about doing in the future
+ How to handle user statistics
+ How to do testing - unit testing package?
