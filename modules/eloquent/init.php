<?php
use \Illuminate\Database\Capsule\Manager as Capsule;


$config = Kohana::$config->load('database')->as_array();

$capsule = new Capsule;

$connections = [];
//$connections['default'] = 'mysql';
foreach($config as $key => $connection){
    $driver = $connection['type'] == 'MySQLi' ? 'mysql' : $connection['type'];
    $driver = $connection['type'] == 'PostgreSQL' ? 'pgsql' : $driver;
    $hostname = empty($connection['connection']['hostname']) ? 'localhost' : $connection['connection']['hostname'];

    $connections[$key] = [
        'driver' => $driver,
        'host' => $hostname,
        'database' => $connection['connection']['database'],
        'username' => $connection['connection']['username'],
        'password' => $connection['connection']['password'],
        'charset' => $connection['charset'],
        'collation' => 'utf8_unicode_ci',
        'prefix' => $connection['table_prefix'],
    ];
}
foreach($connections as $name => $connection){
    $capsule->addConnection($connection, $name);
}


// Set the event dispatcher used by Eloquent models... (optional)
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;
$capsule->setEventDispatcher(new Dispatcher(new Container));

// Make this Capsule instance available globally via static methods... (optional)
$capsule->setAsGlobal();

// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
$capsule->bootEloquent();