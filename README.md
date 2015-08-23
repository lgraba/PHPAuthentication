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
[x] Used composer to install dependencies from packagist.org
[x] Set up directory structure, Slim framework, .htaccess for public directory
[x] Configuration files
[x] Created and structured database table Users
[x] Used Eloquent to create first database-model, writing some of our own namespaced classes
[x] Set up basic routes and views (home) using Slim and Twig
[x] Implemented flash messages for user notifications
[x] Set up a helper called Hash that allows us to hash passwords for security
[x] Register route and view
[x] Used Alex Garrett's Violin validation to validate form entries
[x] Logging in the user and some session stuff
[x] PHPMailer and a couple related classes to send notification emails
[x] Email routes and views/templates
[x] RandomLib to create random strings for hasing, like in account activation
[x] Finished up account activation via email and activate route
[x] Created filter middleware in order to protect routes from an authenticated user (Login, Register, Activate) or guest user
[x] Created CSRF middleware and implemented it in all existing forms to protect against CSRF attacks
[x] Added logout route and appropriate link to navigation
[x] Profile pictures from Gravatar by editing User class and navigation template
[x] Remember Me function - form, cookie creation/deletion, logic and Logging out
[x] User Profile Route, View, and nav link
[x] Users List Route, View, and nav link
[x] User Permissions - Created table, class, routes, and views for example administrator area
[x] Custom 404 page
[x] Change password form, route handling, validation, and view
[x] Recover forgotten password - See Validator class (custom rules)
[x] Update user profile information
[x] Fixed redirect statements by prepending return on each one

#### My own stuff (this will simply be my own development notes here):
+ Get Foundation 5.5 flowin with Gulp
  + In the base application directory:
    1. 'npm install --global gulp'
      + Did this do shit?
    2. 'npm init'
      + Fill out the silly details
      + It's neat that it auto-detects the Git repo
      + Create package.json
    3. 'npm install gulp --save-dev'
      + Creates /node_modules/
    4. Create gulpfile.js
	  + Within, require gulp and define a test task
	  + Run it by typing 'gulp' in shell
    5. Create /assets and /public/css, /public/js directories
      + Make /public/css/test.css
      + Link to test.css in default template ( {{ baseUrl }}{{ urlFor('home') }}path/to/css )
        + urlFor works better, since we're going to put css/js in css/js directory in public/
    6. Foundation classed HTML
      + Input basic foundation nav-bar HTML in /app/views/partials/navigation.php
    7. Create /assets/scripts and /assets/styles
    8. Create gulp styles task to pull in styles, and a gulp default task to run styles task in gulpfile.js
    9. Install gulp SASS: 'npm install gulp-sass --save-dev'
      + See this in package.json
    10. Install gulp-concat: 'npm install gulp-concat --save-dev'
    11. Use gulp SASS in gulpfile.js, use it to pipe /assets/styles/app.scss through SASS and return it
    12. Use gulp-concat in gulpfile.js, see it there
    13. Can now run 'gulp' in shell to carry out the aforementioned instructions
    14. Include foundation stuff
      + Include foundation paths in gulpfile
      + Import foundation and foundation settings in app.scss
    15. 'gulp' will now place foundation settings, foundation framework, and app.scss into app.css
  + Awesome!!!
  + Now we can include custom foundation settings
    1. Create /assets/styles/foundation
    2. Create _settings.scss and copy foundation/scss/foundation/_settings.scss
  + Now I transition Authentication's navigation over to foundation styles


#### Up Next:

#### Todo: A few things I've thought about doing in the future
+ Homogenize form validation messages and variable names
+ Rearrange links and redirects (Ex: Place Update Profile and Change Password links in Your Profile)
+ Confirm new email address via email upon Update Profile
