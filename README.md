<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>


### Steps to install the project 
- Create Database and copy .env.example to .env file 

-Configure App_Url , Database connection

-composer install

-php artisan migrate 
-php artisan passport:client --personal

-php artisan key:generate

-php artisan storage:link

-chmod -R 777 storage bootstrap/cache

-php artisan serve

## To run the unit test run command : 

-php artisan test --filter=CreateRegisterTest

-php artisan test --filter=CreateProductTest

-php artisan test --filter=FeatureProductTest 

## Steps to use postman

-import the collection from line : https://planetary-satellite-949024.postman.co/workspace/Mafatih-Seeker~2fb769a9-897b-45f8-9d52-be2e693892d1/collection/2150891-e8f0ab25-f2b2-48eb-8aca-7dcb3af72583?action=share&creator=2150891&active-environment=2150891-73eade19-d3b8-4064-8ee4-7331684dee47

-create enviroment : izam 

-create paramter base_url and set it to http://izam.mydragonflys.com/ or localhost

create paramter token 

