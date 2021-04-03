<?php

/**
 *
 * @author 2019
 *        
 */
class buildSection extends BuildView
{

    /**
     */
    public function __construct($hauteur=100,$Lareur=100, $id="" , $class="" )
    {
        
      
        parent::__construct("section", $id , "section ".$class );
        $this->addUrlCss("section");
        $this->addAttrStyle("display", "block");
        $this->addAttrStyle("height", $hauteur."vh");
        $this->addAttrStyle("width", $Lareur."%"); 
        if($Lareur != 100){
           $this->addAttrStyle("margin", "0px auto"); 
        }
    }
}

