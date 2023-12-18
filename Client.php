<?php
class Client{
    private $id;
    private	$fullname;
    private	$username;
    private	$email;
    private	$phonenumber;
    private	$adresse;	
    private $city;
    private	$passw;
    private	$valide;
    public function __construct($id,$fullname,$username,$email,$phonenumber,$adresse,$city,$passw,$valide){
        $this->id = $id;
        $this->fullname = $fullname;
        $this->username = $username;
        $this->email = $email;
        $this->phonenumber = $phonenumber;
        $this->adresse = $adresse;
        $this->city = $city;
        $this->passw = $passw;
        $this->valide = $valide;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of fullname
     */ 
    public function getFullname()
    {
        return $this->fullname;
    }

    /**
     * Get the value of username
     */ 
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get the value of phonenumber
     */ 
    public function getPhonenumber()
    {
        return $this->phonenumber;
    }

    /**
     * Get the value of adresse
     */ 
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Get the value of city
     */ 
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Get the value of passw
     */ 
    public function getPassw()
    {
        return $this->passw;
    }

    /**
     * Get the value of valide
     */ 
    public function getValide()
    {
        return $this->valide;
    }
}