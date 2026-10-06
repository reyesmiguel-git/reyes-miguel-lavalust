<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

$database['main'] = array(
    'driver'   => 'mysql',
    'hostname' => getenv('DB_HOST') ?: '127.0.0.1',
    'username' => getenv('DB_USER') ?: 'root',
    'password' => getenv('DB_PASSWORD') ?: '',
    'database' => getenv('DB_NAME') ?: 'lavalust',
    'port'     => getenv('DB_PORT') ?: 3306,
    'charset'  => 'utf8mb4',
    'collate'  => 'utf8mb4_unicode_ci',
    'dbprefix' => ''
);
