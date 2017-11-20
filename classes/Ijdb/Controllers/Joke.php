<?php
namespace Ijdb\Controllers;
use \Ninja\DatabaseTable;
use \Ninja\Authentication;

class Joke{
  private $jokesTable;
  private $authorsTable;
  private $categoriesTable;
  private $authentication;

  public function __construct(DatabaseTable $jokesTable, DatabaseTable $authorsTable, DatabaseTable $categoriesTable, Authentication $authentication){
    $this->jokesTable = $jokesTable;
    $this->authorsTable = $authorsTable;
    $this->categoriesTable = $categoriesTable;
    $this->authentication = $authentication;
  }

  public function home(){
    $title = 'Internet Joke Database';
    return ['template' => 'home.html.php', 'title' => $title];
  }

  public function list(){
    $page = $_GET['page'] ?? 1;
    $offset = ($page-1)*10;
    if(isset($_GET['category'])){
      $category = $this->categoriesTable->findById($_GET['category']);
      $jokes = $category->getJokes(10, $offset);
      $totalJokes = $category->getNumJokes();
    }else{
      $jokes = $this->jokesTable->findAll('jokedate DESC, id DESC', 10, $offset);
      $totalJokes = $this->jokesTable->total();
    }

    $title = 'Joke list';

    $author = $this->authentication->getUser();

    return ['template' => 'jokes.html.php', 'title' => $title, 'variables' => [
      'jokes' => $jokes,
      'totalJokes' => $totalJokes,
      'user' => $author,
      'categories' => $this->categoriesTable->findAll(),
      'currentPage' => $page,
      'categoryId' => $_GET['category'] ?? null
      ]];
  }

  public function delete(){
    $author = $this->authentication->getUser();

    //Security breach
    //If someone tries to edit a joke that is not his via the console changing the action and value attributes
    //Ex: On the joke list page, it is possible to change the value of a delete form I have permissions to one that I don't and then press that same delete button
    if(isset($_POST['id'])){
      $check = $author->ownsJokePermission($_POST['id'], \Ijdb\Entity\Author::DELETE_JOKES);
      if(!$check){
        return header('location: /joke/list');
      }
    }

    $this->jokesTable->delete($_POST['id']);
    header('location: /joke/list');
  }

  public function saveEdit(){
    $author = $this->authentication->getUser();

    //Security breach
    //If someone tries to edit a joke that is not his via the console changing the action and value attributes
    //Ex: action="http://192.168.10.10/joke/edit?id=21"....value="21"
    if(isset($_GET['id'])){
      $check = $author->ownsJokePermission($_GET['id'], \Ijdb\Entity\Author::EDIT_JOKES);
      if(!$check){
        //I could also return something like a template with the message: "You are not allowed to do this"
        //and even logout the session
        return header('location: /joke/list');
      }
    }

    $joke = $_POST['joke'];
    $joke['jokedate'] = new \DateTime;

    $jokeEntity = $author->addJoke($joke);
    //Reset of the categories for each joke
    $jokeEntity->clearCategories();
    foreach($_POST['category'] as $categoryId){
      $jokeEntity->addCategory($categoryId);
    }
    header('location: /joke/list');
  }

public function edit(){
    $author = $this->authentication->getUser();
    $categories = $this->categoriesTable->findAll();

    if(isset($_GET['id'])){
      $joke = $this->jokesTable->findById($_GET['id']);
    }

    $title = 'Edit joke';

    return ['template' => 'editjoke.html.php', 'title' => $title, 'variables' => [
        'joke' => $joke ?? null,
        'user' => $author,
        'categories' => $categories
        ]];
  }

}
