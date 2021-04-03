<?php


/**
 *
 * @author 2019
 *        
 */
class buildViewForm extends BuildView
{

    /**
     */
    public function __construct( $id = "",$class="")
    {
        parent::__construct("div", $id,  "formul ".$class);
        $this->addUrlCss("buildViewForm");
    }
}

