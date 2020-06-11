# Laravel Vue admin Dashboard
[![Build Status](https://travis-ci.org/MagedAhmad/Larave-Vue-Dashboard.svg?branch=master)](https://travis-ci.org/MagedAhmad/Larave-Vue-Dashboard)

This light boilerplate saves you tons of time. Instead of investing time in doing the frontend – backend integration, you have a boilerplate which does the heavy lifting for you. 

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
php artisan db:seed
```

And you are all set to go 