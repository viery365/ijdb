<?php
namespace Ninja;

 class EntryPoint{

   private $route;
   private $method;
   private $routes;

   public function __construct(string $route, string $method, \Ninja\Routes $routes){
     $this->route = $route;
     $this->method = $method;
     $this->routes = $routes;
     $this->checkUrl();
   }

   private function checkUrl(){
     if($this->route !== strtolower($this->route)){
       /*if the user types accidentally, for instance, "joke/ediT" this HTTP response 301
       //indicates that this is a permant redirect and the header() re-directs to the correct page (in this case the url
       will be in lowercase because it is the convention followed by this website)
       It also avoids duplication of urls for search engines*/
       http_response_code(301);
       header('location: ' . strtolower($this->route));
     }
   }

   private function loadTemplate($templateFileName, $variables = []){
     //if the array is numeric
     extract($variables);
     // Start the buffer
     ob_start();
     // Include the template. The PHP code will be executed,
     // but the resulting HTML will be stored in the buffer
     // rather than sent to the browser.
     include __DIR__ . '/../../templates/' . $templateFileName;
     // Read the contents of the buffer return it
     return ob_get_clean();
   }

   public function run(){

     $routes = $this->routes->getRoutes();

     $authentication = $this->routes->getAuthentication();

     if(isset($routes[$this->route]['login']) && !$authentication->isLoggedIn()){
       header('location: /login/error');
     }elseif(isset($routes[$this->route]['permissions']) && !$this->routes->checkPermission($routes[$this->route]['permissions'])){
       header('location: /permissions/error');
     }else{
       $controller = $routes[$this->route][$this->method]['controller'];
       $action = $routes[$this->route][$this->method]['action'];

       $page = $controller->$action();

       $title = $page['title'];

       if (isset($page['variables'])){
         $output = $this->loadTemplate($page['template'], $page['variables']);
       }else{
         $output = $this->loadTemplate($page['template']);
       }

       echo $this->loadTemplate('layout.html.php', [
         'loggedIn' => $authentication->isLoggedIn(),
         'output' => $output,
         'title' => $title
       ]);
     }

   }
 }
