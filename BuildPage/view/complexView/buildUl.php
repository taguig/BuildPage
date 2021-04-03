<?php



class buildUl extends BuildView
{

  
    public function __construct( $id = "", $class = "")
    {
        parent::__construct("ul", $id, $class );
    }
    protected function  getBuildItem($text="",$id="",$class=""){
        return new buildLi($text,$id,$class);
    }
    public function addView(IbuildView $view){
        if ($view instanceof buildLi){
            parent::addView($view);
        }else {
              $child=$this->getBuildItem();
              $child->addView($view);
              parent::addView($child);
        }
        
    }
}

