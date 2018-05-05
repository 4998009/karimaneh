<?php

if (!defined('Hello')){
    echo "Forbidden Request";
    exit;
}

global $config;

$config['db']['host'] = 'localhost';
$config['db']['user'] = 'root';
$config['db']['pass'] = '';
$config['db']['name'] = 'karimaneh';

$config['base'] = '/karimaneh';