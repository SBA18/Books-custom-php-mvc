<?php

Config::set('site_name','Books');

Config::set('language', array('en', 'fr'));

//Router. route name => method prefix
Config::set('routes', array(
            'default' => '',
            'admin'   => 'admin_',
));

Config::set('default_route', 'default');
Config::set('default_language', 'en');
Config::set('default_controller', 'books');
Config::set('default_action', 'index');

Config::set('db.host', 'localhost');
Config::set('db.user', 'books');
Config::set('db.password', 'books');
Config::set('db.db_name', 'books');

Config::set('salt', 'jd7sj3sdkd964he7e');


