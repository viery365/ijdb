<?php

return [
  'database' => [
    'name' => 'ijdb',
    'username' => 'ijdbuser',
    'password' => 'mypassword',
    'connection' => 'mysql:host=localhost',
    'options' => [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
      ]
  ]
];
