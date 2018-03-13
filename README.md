
# Dumerz/Auth

a **Laravel** authentication module created from scratch

## Getting Started

This is a simple **authentication module** developed using **Laravel 5.6**. This app is used to manage the authentication functionality in a web application. The module implements the basic principles of **MVC** (Model, View, Controller) and **RESTful** design. This module is not build to be a full stack application but a starting module where you can build your smart ideas. So as a developer like you think, build and share your ideas. 

## Laravel version

This application is build using **Laravel 5.6**

## System dependencies
The following are the required to make sure your host meets the following requirements:

* **PHP >= 7.1.3**
* **OpenSSL PHP Extension**
* **PDO PHP Extension**
* **Mbstring PHP Extension**
* **Tokenizer PHP Extension**
* **XML PHP Extension**
* **Mbstring PHP Extension**
* **Ctype PHP Extension**
* **JSON PHP Extension**
You can also checkout this [link](https://laravel.com/docs/5.6) to know more about Laravel.

## Software Dependencies
The following are other required software in installing this module to your host:

 - [Git](https://git-scm.com/)
 - [Composer](https://getcomposer.org/)
 - [MySQL](https://www.mysql.com/)

## Installation

Navigate to your chosen directory.

    $ cd ./wamp/www

Clone this repositiry to chosen directory.

    $ git clone https://github.com/Dumerz/auth.git
    
Install all dependencies for this module using composer.

    $ composer install


## Database initialization

To initialize the database, you need to do some changes first to **.env.example**

You can copy or rename the file **.env.example** to **.env**

Change the setting for the following parameters depending on your needs

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=homestead
    DB_USERNAME=homestead
    DB_PASSWORD=secret

Run the pre build migrations to build the database scheme for the module

    $ php artisan migrate

## Starting the Server

You now actually have a functional Laravel application. To see it work, you need to start a web server on your development machine, and you dont need a web server to do the job. You can do this by running the following in the application directory:

	$ php artisan serve --host <host.name> --port <port number>

Example

	$ php artisan serve --host "locahost" --port 80

## License

This application is under the MIT License.
You can also check the **License.txt** in the directory for your reference.