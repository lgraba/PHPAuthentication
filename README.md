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
Email Templates