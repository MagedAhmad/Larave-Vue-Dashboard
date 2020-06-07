# Laravel Vue admin Dashboard
[![Build Status](https://travis-ci.org/MagedAhmad/Larave-Vue-Dashboard.svg?branch=master)](https://travis-ci.org/MagedAhmad/Larave-Vue-Dashboard)

Project is build to ease the steps you take to initialize your new project without adding too much functionality that you don't even know what's going behind the scenes. it's meant to be simple-efficient and cover all you need to start off fast ..

## Key Features & included packages

- Adminlte as your dashboard theme.
- Vue Router.
- Apis & laravel Passport.
- VForm + Sweet alert.
- User Roles/Permissions.
- Control Users (CRUD).

## installation 

First off clone the project `cd` into it then run
```
composer install
cp .env.example .env
php artisan key:generate
npm install
```
open `.env` to enter your DB credentails then run 
```
php artisan migrate
```

And you are all set to go 