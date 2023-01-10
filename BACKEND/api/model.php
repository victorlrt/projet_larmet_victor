<?php

//class client
class Client
{
    public $id;
    public $firstname;
    public $lastname;
    public $zipcode;
    public $tel;
    public $email;
    public $gender;
    public $login;
    public $password;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }
    public function setZipcode($zipcode)
    {
        $this->zipcode= $zipcode;
    }
    public function setTel($tel)
    {
        $this->tel = $tel;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function setGender($gender)
    {
        $this->gender = $gender;
    }
    public function setLogin($login)
    {
        $this->login = $login;
    }
    public function setPassword($password)
    {
        $this->password = $password;
    }

}

class Mushroom {
    public $id;
    public $name;
    public $edible;
    public $poisonous;
    public $img;
    public $description;
    public $toxicity;

    public function setId($id)
    {
        $this->id = $id;
    }
    public function setName($name)
    {
        $this->name = $name;
    }
    public function setEdible($edible)
    {
        $this->edible = $edible;
    }
    public function setPoisonous($poisonous)
    {
        $this->poisonous = $poisonous;
    }
    public function setImg($img)
    {
        $this->img = $img;
    }
    public function setDescription($description)
    {
        $this->description = $description;
    }
    public function setToxicity($toxicity)
    {
        $this->toxicity = $toxicity;
    }
}