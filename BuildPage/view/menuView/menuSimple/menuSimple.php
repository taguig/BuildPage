<?php


class menuSimple extends buildUl
{


    public function __construct($id = "", $class = "")
    {
       
        parent::__construct($id , $class );
    }
    
    protected function  getBuildItem($text="",$id="",$class=""){
        return new menuItem($text,$id,$class);
    }
    
    protected function getChildView($i){
        if(count($this->view)-1<$i || isset($this->view[$i]) ){
            return $this->view[$i];
        }else  {
            return null;
        }
    }
    public function addChildItem($i,$view){
        $v=$this->getChildView($i);
        if($v!=null){
            $v->addView($view);
            return true;
        }else {
           return false; 
        }
     }
    
}

