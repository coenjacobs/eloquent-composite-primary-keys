# Eloquent Composite Primary Keys
A single trait to implement in your Eloquent models to support composite primary keys. The Laravel Schema builder supports creating composite primary keys, but Eloquent models don't support it.

This package is largely inspired by [suggested code on Stack Exchange](https://www.youtube.com/watch?v=MKCu610bfJg) and has also been released in a package with more than this functionality. I needed a separate package for just this purpose.

## Install
Install this package through Composer:
```
composer install coenjacobs/eloquent-composite-primary-keys
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