<?php

//Configure database
$database = [
    'db_host'=>'mariadb',
    'db_pass'=>'app',
    'db_user'=>'app',
    'db_base'=>'root',
    'db_port'=>'3306',
];

//Configure Cache
$cache = [
    'redis_host' => 'redis',
    'redis_port' => '6379',
];

//Configure Route default of system
$route_default = [
    'default_route' => 'index',
    'default_controller' => 'home'
];

return array_merge($database, $cache, $route_default);