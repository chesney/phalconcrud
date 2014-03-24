Phalcon Tutorial
================

Phalcon PHP is a web framework delivered as a C extension providing high
performance and lower resource consumption.

This is a very simple tutorial to understand the basis of work with Phalcon.

Check out a explanation article: http://phalconphp.com/documentation/tutorial

Get Started
-----------

#### Requirements

To run this application on your machine, you need at least:

* PHP >= 5.3.11
* Apache Web Server with mod rewrite enabled
* Phalcon PHP Framework extension enabled (0.5.x)

Get Started on Windows
-------------

#### IIS
- create a new Website on the IIS Server for the tutorial folder
- Point the new Website to the tutorial/public folder
- Import the following rewrite rules :
  
RewriteRule ^(.*)$ index.php?_url=/$1 [QSA,L]

- After this restart IIS

#### PHP
- In the php.ini folder enable the extension 'mbstring'
  extension=php_mbstring.dll
- In the php.ini Set the default charset to utf-8 
- Copy the sql_server PDO dll files to the php/ext folder
- In the php.ini file enable the pdo extension :
  extension=php_sqlsrv_54_ts.dll
  extension=php_pdo_sqlsrv_54_ts.dll  
- After this restart IIS

#### Database
create database test;
go;
use test
go;

create table users(
  id int IDENTITY(1,1) not null primary key,
  name nvarchar(200),
  email nvarchar(200)
);

#### Access the $db connection from anywhere
$di = $this->di
or
$di =  Phalcon\DI::getDefault();
$db = $di->get("db");