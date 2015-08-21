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


## Getting it Goin'
Set up a database (Default Name: site) with the following structure:

| Column              | Type         | Null | Default            | Comments |
|---------------------|--------------|------|--------------------|----------|
| id                  | int(11)      | No   |                    |          |
| username            | varchar(32)  | No   |                    |          |
| email               | varchar(255) | No   |                    |          |
| first_name          | varchar(64)  | Yes  | NULL               |          |
| last_name           | varchar(64)  | Yes  | NULL               |          |
| password            | varchar(255) | No   |                    |          |
| active              | tinyint(1)   | No   |                    |          |
| active_hash         | varchar(255) | Yes  | NULL               |          |
| recover_hash        | varchar(255) | Yes  | NULL               |          |
| remember_identifier | varchar(255) | Yes  | NULL               |          |
| remember_token      | varchar(255) | Yes  | NULL               |          |
| created_at          | timestamp    | No   | CURRENT_TIMESTAMP  |          |
| updated_at          | timestamp    | Yes  | NULL               |          |


Go ahead and copy /app/config/development.php.example to development.php,

```
cp /app/config/development.php.example /app/config/development.php
```

 and input your own appropriate parameters within, including the name of your database.

You can make multiple configuration files with different filenames and change mode.php to reference the appropriate configuration filename. In the above case, it would be called development.php and have the following text:

```
development
```

## Up Next

##### The Tutorial so far: PHP Authentication by Alex Garrett (Codecourse)
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

##### Next Section:
Profile pictures
Remember me function

##### Todo: A few things I've thought about doing so far
1. Add first and last names to User, Login route, and all associated views.
2. Allow user to view and edit their profile
3. Allow user to recover their password via hash link
4. API for user statistics?
5. Create administrator user permission
6. Create routes and views appropriate to administrator permission
