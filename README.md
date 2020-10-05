![Master workflow](https://github.com/ava239/task-manager/workflows/Master%20workflow/badge.svg)
[![Maintainability](https://api.codeclimate.com/v1/badges/e441353806d9c0c389db/maintainability)](https://codeclimate.com/github/ava239/task-manager/maintainability)
[![Test Coverage](https://api.codeclimate.com/v1/badges/e441353806d9c0c389db/test_coverage)](https://codeclimate.com/github/ava239/task-manager/test_coverage)

App on Heroku:  
https://ava-task-manager.herokuapp.com/

# Description
Simple Task Manager made with Laravel.  
Task management, with easy to manage task statuses and labels. Registration available, some actions restricted to registered users only.
  
Ready to deploy on Heroku

# Requirements
- PHP 7.4
- Extensions:
    * sqlite3
    * zip
    * pgsql
    * dom
    * fileinfo
    * filter
    * iconv
    * json
    * libxml
    * mbstring
    * openssl
    * pcre
    * PDO
    * Phar
    * SimpleXML
    * tokenizer
    * xml
    * xmlwriter
- Composer
    
# Setup
Server will be available at http://localhost:8000/ (same if you choose to run it in Docker)
### Local SQLite
``` sh
$ make setup
$ make start
```
### Local PostgreSQL/MySQL
- Create database
- Follow steps to install local SQLite version
- Edit **.env**: add your database host, database name, username and password
- Change DB_CONNECTION in **.env** to: *pgsql / mysql* (depending on your choice)
- Run migrations and seeds
``` sh
$ php artisan migrate
$ php artisan db:seed
```

### Docker with PostgreSQL
``` sh
# alternate version of setup, configured for docker
$ make docker-setup

# start docker containers and wait until they are up. Postgres may take some time on first run.
$ make compose-up

# run migrations
$ make compose-migrate
```
There are few commands in Makefile to help you with this setup later.
