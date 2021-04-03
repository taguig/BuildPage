<?php


/**
 *
 * @author 2019
 *        
 */
class Testcss extends MediaPageCss
{

    /**
     */
    public function __construct()
    {
        parent::__construct("screen","min-width:500px","max-width:700px");
        $this->addClass("header", "background-color", "rgba(0,0,0,0.5)");
 
       
    }
}

