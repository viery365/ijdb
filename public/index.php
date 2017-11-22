<?php

try {

  include __DIR__ . '/../includes/autoload.php';

//this is still the best way. If the uri ends in '?' the route will not reject it - it just cuts the '?' off
//(unlikely using either trim($string, '/') for both sides of the string or ltrim($string, '/') only);
  $route = ltrim(strtok($_SERVER['REQUEST_URI'], '?'), '/');

  $entryPoint = new \Ninja\EntryPoint($route, $_SERVER['REQUEST_METHOD'], new \Ijdb\IjdbRoutes());

  $entryPoint->run();


} catch (PDOException $e) {
  $title = 'An error has occurred';
  $output = 'Database error: ' . $e->getMessage() . '
  in ' . $e->getFile() . ':' . $e->getLine();
  include __DIR__ . '/../templates/layout.html.php';
}
