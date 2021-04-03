<?php


/**
 *
 * @author 2019
 *        
 */
class modelHeader_1 extends modelHeader
{
  
    /**
     */
    private $menuIcon;
    public function __construct($icon=false,$id = "", $class = "")
    {   
        parent::__construct($id , $class." modelHeader_1",$icon );
        $this->addUrlCss("modelHeader_1");
      
        $this->logo=new logoText();
        $this->addView($this->logo);
        $this->logo->ChangeFonteSize("40px");
        $this->menuIcon=new buildContaineur(); 
        $this->menuIcon->addView($this->menu->getView());
        $this->menuIcon->addClassCss("containerIconmenu");
        $this->addView($this->menuIcon);
        (!empty($this->getActiveIcon()))?$this->menuIcon->addView($this->icon):null;
      
    }
    public function textLogo($text){
        $this->logo->setText($text);
    }
    public function linkLogo($link){
        $this->logo->setLink($link);
    }
    

}

