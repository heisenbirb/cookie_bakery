# Cookie Bakery CTF copy.

## Install
1. Install a mysql server, and run said mysql server (e.g. as a homebrew service for macos)
2. Log in to the SQL server and run the following messages to set up tables:

CREATE DATABASE cookie_bakery;

use cookie_bakery

CREATE TABLE users(
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL);

CREATE TABLE messages( 
    author VARCHAR(255), 
    message VARCHAR(255));

NOTE: set a password for the sql server and insert it into handle_database_conn.php

3. install php
4. Install puppeteer with npm
5. navigate to the cookie bakery directory and start a php server with the command 
```php -S 127.0.0.1:8000```
6. That's all, now you just need to enjoy your cookies!
