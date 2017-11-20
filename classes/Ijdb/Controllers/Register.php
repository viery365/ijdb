<?php
namespace Ijdb\Controllers;
use \Ninja\DatabaseTable;

class Register {
  private $authorsTable;

  public function __construct(DatabaseTable $authorsTable){
    $this->authorsTable = $authorsTable;
  }

  public function registrationForm(){
    return ['template' => 'register.html.php', 'title' => 'Register an Account'];
  }

  public function success(){
    return ['template' => 'registersuccess.html.php', 'title' => 'Registration Successful'];
  }

  public function registerUser(){
    $author = $_POST['author'];

    //Assume the data is valide to begin with
    $valid = true;
    $errors = [];

    //But if any of the fields have been left blank set $valid to false

    if(empty($author['name'])){
      $valid = false;
      $errors[] = 'Name cannot be blank';
    }

    if(empty($author['email'])){
      $valid = false;
      $errors[] = 'Email cannot be blank';
      //email validation
    }elseif(filter_var($author['email'], FILTER_VALIDATE_EMAIL) == false){
      $valid = false;
      $errors[] = 'Invalid Email Address';
    }else{
      //if the email is not blank and it is valid:
      //convert the email to lowercase
      $author['email'] = strtolower($author['email']);
      if(count($this->authorsTable->find('email', $author['email'])) > 0){
        $valid=false;
        $errors[] = 'The email address is already registered';
      }
    }

    if(empty($author['password'])){
      $valid = false;
      $errors[] = 'Password cannot be blank';
    }
    //if $valid is still true, no fields were blank and the data can be added
    if($valid == true){
      //Hash the password before saving it into the Database
      $author['password'] = password_hash($author['password'], PASSWORD_DEFAULT);
      //When submitted the $author variable now contains a lowercase value for email and a hashed password
      $this->authorsTable->save($author);

      header('Location: /author/success');
    }else{
      //if the data is not valid, show the form again
      return ['template' => 'register.html.php', 'title' => 'Register an Account', 'variables' => [
        'errors' => $errors,
        'author' => $author
        ]];
    }

  }
}
