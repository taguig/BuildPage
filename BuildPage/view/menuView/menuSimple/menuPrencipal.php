<?php


class menuPrencipal extends buildNav
{
 private $menu;
    public function __construct($id = "", $class = "")
    {
        parent::__construct($id , $class );
        $this->menu=new menuSimple("","menuPrencipal" );
        $this->addUrlCss("menuPrencipal");
        parent::addView($this->menu);
     
    }
    public function addView($v){
      $this->menu->addView($v);
    }
    public function getMenu(){
      return $this->menu;  
    }

}

