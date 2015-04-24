SearchtweetsBundle Api
========================

The Synfony2 SearchTweets Api application provides a server interface to the
tweetsbycity angular.js application. It allows to show public tweets on google
map by city



Version 
-------------
Prototype version


How it works
-------------

very easy to understand .... too easy to use

Installation in 4 steps (very easy)
-----------------------------------

Install as a common Symfony2 bundle



1) include in your app/AppKernel.php
------------------------------- 
new Api\SearchtweetsBundle\ApiSearchtweetsBundle(),




2) set db params in your app/config/parameters.yml file
-------------------------------
parameters:
    database_driver: pdo_mysql
    database_host: 127.0.0.1
    database_port: null
    database_name: tweets
    database_user: root
    database_password: root




3) create the db 'tweets' and import the db schema
--------------------------
tweets.sql




4) include in your app/config/routing.yml file
-----------------------------------------------------------------
api_searchtweets:
        resource: "@ApiSearchtweetsBundle/Resources/config/routing.yml"
        prefix:   /




License
-------

This bundle is under the MIT license. 

About
-----

Daniele Centamore
Symfony2 , angular.js, Bootstrap 
daniele.centamore@gmail.com
