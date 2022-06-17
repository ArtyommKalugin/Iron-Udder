<?php
 
class User
{  
  public $Name;
  public $SecondName;
  public $ThirdName;
  public $Password;
  public $Email;
  public $BirthDate;
  
  public function ModelState()
  {
    if (empty($this->Name) || empty($this->SecondName) || empty($this->ThirdName) || empty($this->Password) || empty($this->Email) || empty($this->BirthDate)){
      return false;
    }
    return true;
  }
}
 
?>