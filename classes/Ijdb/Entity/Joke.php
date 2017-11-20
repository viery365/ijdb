<?php
namespace Ijdb\Entity;

class Joke {
  public $id;
  public $authorid;
  public $jokedate;
  public $joketext;
  private $authorsTable;
  private $author;
  private $jokeCategoriesTable;

  public function __construct(\Ninja\DatabaseTable $authorsTable, \Ninja\DatabaseTable $jokeCategoriesTable){
    $this->authorsTable = $authorsTable;
    $this->jokeCategoriesTable = $jokeCategoriesTable;
  }

  public function getAuthor(){
    //transparent caching
    if(empty($this->author)){
      $this->author = $this->authorsTable->findById($this->authorid);
    }
    return $this->author;
  }

  public function addCategory($categoryId){
    $jokeCat = ['jokeid' => $this->id, 'categoryid' => $categoryId];
    $this->jokeCategoriesTable->save($jokeCat);
  }

  public function hasCategory($categoryId){
    $jokeCategories = $this->jokeCategoriesTable->find('jokeid', $this->id);

    foreach($jokeCategories as $jokeCategory){
      if($jokeCategory->categoryid == $categoryId){
        return true;
      }
    }
  }

  public function clearCategories(){
    $this->jokeCategoriesTable->deleteWhere('jokeid', $this->id);
  }
}
