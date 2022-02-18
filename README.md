# laravel-row-catcher
catch row when work with Countable data.

This package provider a simple way to catch failures and successful rows when work on large amount of data without stoping saving or lost important info.

### here is An Example of using it

```
$users = User::get();

RowCatcher::startCatching($users)->each(fn($user) => $user->sendNewsLaterMail())
```
So in the end, This will Catch any failure row and will not stop excuting when any row for some reasons failed

# Requirments
- laravel 9
- php 8.1

# installation
 You can install the package via composer:
 
 ```
 composer require aabadawy/laravel-row-catcher
 ```
