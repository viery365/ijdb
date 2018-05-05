<?php

return [
  'database' => [
    'name' => 'ijdb',
    'username' => 'homestead',
    'password' => 'secret',
    'connection' => 'mysql:host=localhost',
    'options' => [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
      ]
  ]
];
