<?php


/**
 *
 * @author 2019
 *        
 */
class menuItem extends buildLi
{   
    

    public function __construct($text,$link="", $id = "", $class = "")
    {
        
        parent::__construct("", $id , $class." itemMenuSimple");
        $this->addUrlCss("SimpleMenuItem");
        $this->addView(new linkView($text,!empty($link)?$link:"#"));
        
    }
    public function addView ($v){
        if ($v instanceof menuSimple){
            $v->addClassCss("downMenu");
        }
        parent::addView($v);
    }

}

