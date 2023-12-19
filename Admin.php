<?php
class Admin{ 	

    private $id;
    private	$username;
    private	$email;	
    private	$passw;
    public function __construct($id,$username,$email,$passw){
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->passw = $passw;
        
    }

    

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
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
     * Get the value of passw
     */ 
    public function getPassw()
    {
        return $this->passw;
    }
}