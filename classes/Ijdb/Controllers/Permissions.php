<?php
namespace Ijdb\Controllers;
use \Ninja\DatabaseTable;

class Permissions {
  private $authorsTable;

  public function __construct(DatabaseTable $authorsTable){
    $this->authorsTable = $authorsTable;
  }

  public function error(){
    return ['template' => 'permissionserror.html.php', 'title' => 'Check your permissions'];
  }

  public function list(){
    $authors = $this->authorsTable->findAll();

    return ['template' => 'authorlist.html.php', 'title' => 'Author List', 'variables' => [
      'authors' => $authors
      ]];
  }

  public function permissions(){
    $author = $this->authorsTable->findById($_GET['id']);

    $reflected = new \ReflectionClass('\Ijdb\Entity\Author');
    $constants = $reflected->getConstants();

    return ['template' => 'permissions.html.php', 'title' => 'Edit Permissions', 'variables' => [
      'author' => $author,
      'permissions' => $constants
      ]];
  }

  public function savePermissions(){
    $author = [
      'id' => $_GET['id'],
      'permissions' => array_sum($_POST['permissions'] ?? [])
    ];

    $this->authorsTable->save($author);

    header('location: /author/list');
  }
}
