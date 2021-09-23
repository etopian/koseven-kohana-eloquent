# koseven-kohana-eloquent

A simple module which allows you to add Laravel ORM Eloquent to your Kohana / Koseven install.

```
composer require illuminate/database
```

Copy this module to the modules directory and enable it in your bootstrap.php

Create a new directory application/classes/Models to hold your ORM models.

Create a new model for instance a application/classes/Models/File.php

The class name follows Kohana's standard. Eloquent uses the class name to determine the table, because of this
you will need to manually specify the name of the table. To refence the model in eloquent relations use Models_Files::class.

You can use the model in your controller by class name, i.e. new Models_Files()

```php
<?php
use Illuminate\Database\Eloquent\Model;

class Models_Files extends Model
{
    protected $table = 'files';
    public $timestamps = false;
}
```

You can also use the Capsule class to access the query builder.

See:
https://github.com/illuminate/database

```php
use Illuminate\Database\Capsule\Manager as Capsule;

$users = Capsule::table('users')->where('votes', '>', 100)->get();

$results = Capsule::select('select * from users where id = ?', [1]);

```



