<?php


/**
 *
 * @author 2019
 *        
 */
class slideArticle extends BuildView
{

    /**
     */
    public $Container;
    public function __construct( $id , $class )
    { 
        $this->Container=new buildContaineur("div","","listArticleslide");
        parent::__construct("div", $id , $class." Articleslide" );
        $this->addUrlCss("Articleslide");
    }
}

