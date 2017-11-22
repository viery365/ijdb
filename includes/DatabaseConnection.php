<?php

$config = require 'config.php';

$config = $config['database'];

$pdo = new PDO(
  $config['connection'] . ';dbname=' . $config['name'],
        $config['username'],
        $config['password'],
        $config['options']
);
