<?php

/**
 *
 * @author 2019
 *        
 */
class logoText extends view
{

    private $text;

    private $link;

    /**
     */
    public function __construct($fontName = "", $size = "3rem", $link = "")
    {
        $this->addAttrStyle("font-family", $fontName);
        $this->addAttrStyle("font-size", $size);
        $this->addAttrStyle("color", "#fff");
        $this->setLink($link);
        parent::__construct(null, "", "", "logoText");
    }
    public function changeFontName($font){
        $this->addAttrStyle("font-family", $font);
    }
    
    public function ChangeFonteSize($size){
        $this->addAttrStyle("font-size", $size);
    }
    
    public function setText($text)
    {
        $this->text = $text;
    }

    public function setLink($link)
    {
        $this->link = $link;
    }

    public function getView():string 
    {
        return '<h1  ' . $this->atributstyle() . '  ' .$this->getId(). ' '.$this->getClass().' >
   <a  style="text-decoration: none;"  href="' . $this->link . '">
' . $this->text . '</a>  </h1>';
    }
}

