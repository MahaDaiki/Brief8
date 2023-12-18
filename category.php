<?php
class Category {
    private $catname;	
    private $descrip;	
    private $imgs;	
    private $bl;

    public function __construct( $catname, $descrip, $imgs, $bl ){
        $this->catname = $catname;
        $this->descrip = $descrip;
        $this->imgs = $imgs;
        $this->bl = $bl;
        
    }
    

   
   


    /**
     * Get the value of catname
     */ 
    public function getCatname()
    {
        return $this->catname;
    }

    /**
     * Get the value of descrip
     */ 
    public function getDescrip()
    {
        return $this->descrip;
    }

    /**
     * Get the value of imgs
     */ 
    public function getImgs()
    {
        return $this->imgs;
    }

    /**
     * Get the value of bl
     */ 
    public function getBl()
    {
        return $this->bl;
    }
}
?>