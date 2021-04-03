<?php

class buildMenuSImple
{
private $build;
private $nav;
    public function __construct($build)
    {
        $this->nav=new menuPrencipal();
        $this->build=json_decode($build)->menu;
    }
    
    public function getViewMenu(){
        return  $this->nav;
    }
    public function build(){
        $val=null;
       foreach ($this->build as $value) {
           if (isset($value->type)){
               if ($value->type=="i"){
                   $val=new menuItem($value->text,(isset($value->link))?$value->link:"",(isset($value->cssid))?$value->cssId:"",(isset($value->cssclass))?$value->cssclass:"");
                
               }else {
                   $val=new menuSimple((isset($value->link))?$value->link:"",(isset($value->cssid))?$value->cssid:"",(isset($value->cssclass))?$value->cssclass:"");  
               }
               if (isset($value->child)){
                   $this->build_child($value->child, $val);
               }
               if ($val!=null){
                   $this->nav->addView($val);
               }
              
           }
       } 
    }
    private function build_child($child,$view){
        $val=null;
        foreach($child as $value){
            if (isset($value->type)){
                if ($value->type=="i"){
                    $val=new menuItem($value->text,(isset($value->link))?$value->link:"",(isset($value->cssId))?$$value->cssId:"",(isset($value->cssClass))?$$value->cssClass:"");
                    if (isset($value->child)){
                        $this->build_child($value->child, $val);
                    }
                }else {
                    $val=new menuSimple((isset($value->link))?$value->link:"",(isset($value->cssId))?$$value->cssId:"",(isset($value->cssClass))?$$value->cssClass:"");  
                }
                if (isset($value->child)){
                    $this->build_child($value->child, $val);
                }
                if ($val!=null){
                $view->addView($val);
                }
        }
    }
}

}