# PHP Authentication
My work on a [tutorial by Alex Garrett](https://www.youtube.com/playlist?list=PLfdtiltiRHWGKUvioJly40RJZchSG2-34) (Codecourse). Thanks Alex!

## Getting Started Running Authentication Site

### Dependencies
1. Apache 2
2. MySQL, Postgres, SQLite, or SQL Server
3. PHP 5 >= 5.6.0

### Database Setup

First Set up a database (default Name: site).

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

You can make multiple configuration files with different filenames and change mode.php to reference the appropriate configuration filename. In the above case, mode.php would have the text `development` within it.

Then you should be good to go, for the most part.


## Development
### Dependencies
+ Package Management/Workflow
  1. [Composer](https://getcomposer.org/)
  2. [Gulp](https://github.com/gulpjs/gulp)
    1. [Gulp-SASS](https://github.com/dlmanning/gulp-sass)
    2. [Gulp-Concat](https://github.com/wearefractal/gulp-concat)
  3. [Bower](http://bower.io/)
+ Back-End PHP
  1. [Slim](https://github.com/slimphp/Slim)
  2. [Slim Views](https://github.com/slimphp/Slim-Views)
  3. [Twig](https://github.com/twigphp/Twig)
  4. [PHPMailer](https://github.com/PHPMailer/PHPMailer)
  5. [Hassankhan Config](https://packagist.org/packages/hassankhan/config)
  6. [Violin](https://github.com/alexgarrett/violin)
  7. [Illuminate Database](https://github.com/illuminate/database)
  8. [IRCMaxell RandomLib](https://packagist.org/packages/ircmaxell/random-lib)
+ Front-End
  1. [Foundation](https://github.com/zurb/foundation)
    1. [Jquery](https://jquery.com/)
    2. [Fastclick](https://github.com/ftlabs/fastclick)
    3. [Modernizr](https://github.com/Modernizr/Modernizr)

### Package Configuration Files
See the following package configuration files:
+ composer.json
+ package.json
+ gulpfile.js
+ bower.json

### Styles
Edit /assets/styles/app.scss or /assets/styles/foundation/_settings.scss to add/change custom styles or custom Foundation style settings, respectively.


## Progress

#### Goals:
1. Complete the tutorial with careful consideration for security standards/compliance at each step.
2. Research, test, and throroughly document any newly encountered concepts with a variety of experimental alternate methods.
3. Maintain consistent documentation throughout PHP code.
4. Understand, replicate, then expand upon workflow practices.
5. Have fun!

#### Tutorial: PHP Authentication by Alex Garrett (Codecourse)
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
+ Recover forgotten password - See Validator class (custom rules)+] Update user profile information
+ Fixed redirect statements by prepending return on each one

#### Post-Tutorial Development Notes:
+ Get Foundation 5.5 flowin with Gulp and Bower:
  + Install Bower and initialize Bower project for front-end dependency handling
  + Install npm --global and initialize it
  + Install Gulp using npm --save-dev
  + Install Foundation using gulp
  + Install Gulp dependencies
    + Gulp-SASS
    + Gulp-Concat
  + Create gulpfile and edit it according to Foundation dependencies
  + Create required directories
    + assets/scripts
    + assets/styles
    + assets/styles/foundation/
    + public/css
    + public/js
  + Create assets/styles/foundation/_settings.scss from foundation source (this will be where custom foundation-related settings will be)
  + Create assets/styles/app.scss and import foundation and foundation settings 
  + Link to output css and js in default Authentication template
  + Run Gulp to carry out tasks defined in gulpfile.js
  + Hook Bower to Composer in order to update Bower components every time 'composer update' or 'composer install' is run! (see composer.json)
Note: The reason Foundation drop-down menu links weren't working is because fast-links.js was not included (see Foundation documentation)

+ Todo:
  + Back-End (PHP)
    + Homogenize form validation messages and variable names
    + Confirm new email address upon Update Profile, perhaps via email or duplicate email entry
    + Experiment more with profile pictures and Gravatar
  + Front-End
    + Rearrange links 
      + Place Update Profile and Change Password links in Your Profile page
      + Only give admins access to User list
    + Nav bar styling
    + Throw a wrapper and Foundation-standard classes on the rest
    + Form views customization - Make them look presentable
    + Filler body for example purposes
      + Give a short explanation including security standards adherence, features, and test user account(admin)
  + Development Workflow
    + Make use of defined workflow with gulp watch task

## Thanks!
In the end this will be an example for future development projects/ideas. I had a good time and learned some valuable things about authentication security compliance, Bower/Gulp workflow, and Foundation. I will continue to push updates as I develop and see fit.
