<?php


/**
 *
 * @author 2019
 *        
 */
class builderIcon extends BuildView
{

    /**
     */
    public function __construct( $id = "", $class = "")
    {
        parent::__construct("div", $id, $class ." buildIcon");
        $this->addUrlCss("font-awesome.min");
    }
    public function addView($v){
        if ($v instanceof itemIcon){
            parent::addView($v);
        }
    }
}

