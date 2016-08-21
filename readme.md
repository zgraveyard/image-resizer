# Image Resizer

This is just a simple CLI application which can be used as simple microservice to get images url from the database
and resize them based on the configureations you have.

## Usage

1. Create a new `.env` file, and you can check `.env.example` to get the values which you can use.
1. You should have a table called images with a field called `original` and another one called `images`.
1. The app will read the values from `original` and save the results as _*JSON*_ value to `images`.
1. The app also will updated a field called `proccessed` which indicate that the file has been processed or not.
1. Check the Schema file `ImagesTable` to know more about the table structure.

## Table Structure

1. Check the Schema file `ImagesTable` to know more about the table structure.

## Commands

The app has two main commands :

1. `process` : which is the main command to process the images, and takes no arguments at all.
1. `setup` : which can create a simple images table which you can use, the default argument is `create` which will create the table, and `drop` which will drop the table.

## How to use it

You need to make sure that the file `resizer` is executable, 
and if you like you can create a cron job which will execute the process the images every min or so.

## License

This code is licensed under the [MIT license](http://opensource.org/licenses/MIT).