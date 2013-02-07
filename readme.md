#Laravel 4 - Bootstrap Empowered Application (Stable)

This is a Laravel 4 Bootstrap Application. It is a fork off of [andrew13/Laravel-4-Bootstrap](http://github.com/andrew13/Laravel-4-Bootstrap) which includes Twitter Bootstrap 2.2.2 and it comes as an example application to help you get started. This Empowered version adds 3 additional items for improved development speed. 

**`Laravel-4-Bootstrap-Empowered`** contains Laravel 4 composer modules:

- [Confide](#confide)

- [Ardent](#ardent)

- [PowerPack](#powerpack)

##Requirements

	PHP >= 5.4.0 (Confide requires 5.4, this is an increase over Laravel's 5.3.7 requirement)
	MCrypt PHP Extension

##How to install

	git clone git://github.com/andrew13/Laravel-4-Bootstrap-Empowered.git laravel
	cd laravel
	curl -s http://getcomposer.org/installer | php
	php composer.phar install
	
You might want to make [composer as an alias](http://andrewelkins.com/programming/php/setting-up-composer-globally-for-laravel-4/) for future ease of use.

##Configure
Now that you have the Laravel 4 installed, you need to create a database for it and update the file ***app/config/database.php***

Set the `address` and `name` from the `from` array in `config/mail.php`. Those will be used to send account confirmation and password reset emails to the users.
If you don't set that registration will fail because it cannot send the confirmation email.

##After that, run these commands to create and populate Users table:

	php artisan migrate:install
	php artisan migrate
	php artisan db:seed


## Make sure app/storage is writable by your web server.
If permissions are set correctly:

    chmod -R 775 app/storage

Should work, if not try

    chmod -R 777 app/storage

##Start Page
Navigate to your Laravel 4 website and try to login with the default credentials:

	email : test@test.com
	password : test

Create a new user at /account/register

<a name="confide"></a>
## Confide Authentication Solution

Used for the user auth and registration. In general for user controllers you'll want to use something like the following:

    <?php

    use Zizaco\Confide\ConfideUser;

    class User extends ConfideUser {

    }

For full usage see [Zizaco/Confide Documentation](https://github.com/zizaco/confide)

<a name="ardent"></a>
## Ardent - Used for handling repetitive validation tasks.

Self-validating, secure and smart models for Laravel 4's Eloquent ORM 

For full usage see [Ardent Documentation](https://github.com/laravelbook/ardent) 

<a name="powerpack"></a>
## Laravel 4 PowerPack

Adds string helper classes from Laravel 3 to Laravel 4.

**`laravel4-powerpack`** contains Laravel 4 ports of the following helper classes:

- [HTML](https://github.com/laravelbook/laravel4-powerpack#html_class)

- [Form](https://github.com/laravelbook/laravel4-powerpack#form_class)

- [Str](https://github.com/laravelbook/laravel4-powerpack#str_class)

For full usage see [PowerPack Documentation](https://github.com/laravelbook/laravel4-powerpack)

## License

This is free software distributed under the terms of the MIT license

## Aditional information

Fork of a fork of code that was originally created by [brunogaspar](https://github.com/brunogaspar)

Any questions, feel free to [contact me](http://twitter.com/andrewelkins).
