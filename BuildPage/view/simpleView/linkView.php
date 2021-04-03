<?php


class linkView extends view
{
   private $text;
   public $link;
   public $alt;
   public function __construct( $text,$link,$id = "", $class = "")
    {
      $this->text=$text;
      $this->link=$link;
        parent::__construct($dataModel = null, "" , $id , $class );
    }
    
    public function getView():string{
        
        return '<a  '.$this->getClass(). ' href="'.$this->link.'" '.$this->getId().' >'.$this->text.'</a>'; 
    }
}

