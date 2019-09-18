# Eloquent Composite Primary Keys
A single trait to implement in your Eloquent models to support composite primary keys. The Laravel Schema builder supports creating composite primary keys, but Eloquent models don't support it.

This package is largely inspired by [suggested code on Stack Exchange](https://stackoverflow.com/a/36995763/526501) and has also been released in a package with more than this functionality. I needed a separate package for just this purpose.

## IMPORTANT: This is now read-only
I have decided to make this project read-only and not further work on this. There are a bunch of performance related downsides when doing this in Laravel, which make it no longer fun and rewarding for me to work on.

In case you still want to use this functionality in Laravel, you can have a look at the [LaravelTreats package](https://github.com/mopo922/LaravelTreats/tree/master/src/Model#laraveltreatsmodeltraitshascompositprimarykey) which contains similar functionality.

## Install
Install this package through Composer:
```
composer require coenjacobs/eloquent-composite-primary-keys
```

Make sure you have a database schema that supports composite primary keys, for example via a migration:
```php
Schema::create('products', function (Blueprint $table) {
    $table->integer('first_key');
    $table->integer('another_key');
    $table->primary(['first_key', 'another_key']);
    $table->timestamps();
});
```

Use the trait on the Eloquent model you wish to have composite primary keys on:
```php
namespace App;

use Illuminate\Database\Eloquent\Model;
use CoenJacobs\EloquentCompositePrimaryKeys\HasCompositePrimaryKey;

class Product extends Model
{
	use HasCompositePrimaryKey;

```

Next, you set the `$primaryKey` property on your Eloquent model to an array containing the field names that together form your composite primary key:
```php
protected $primaryKey = array('first_key', 'another_key');
```
