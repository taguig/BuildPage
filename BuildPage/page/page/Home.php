<?php

/**
 *
 * @author 2019
 *        
 */
class Home extends \page
{
    public $itemView;

    /**
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * (non-PHPdoc)
     *
     * @see page::createView()
     */
    protected function createView()
    {
       
        $tlimage=new TextLimage("2.jpg");
        
        $section1=new buildSection(120);
        $section2=new buildSection(80);
        $this->addJsLib("jquery-3.5.1");
        $this->addCssLib("bootstrap");
        $this->addReaderJs("test");
        $this->setTitre("mon site ");
        $this->addMetaData('og:url', 'facebook');
        $this->addMetaData('fg:url', 'facebook');
        $this->addMetaData('pg:url', 'facebook');
        $this->addMetaData('descripttion', 'facebook');
        $this->itemView = new buildForm('google', 'post',"form");
        $inp=new inputText(true, "tag", "coll", "d");
        $inp->addAttrStyle("color", "red");
        $inp->addAttrStyle("text-align", "right");
       
        $this->itemView->addView($inp);
   
        $this->itemView->addView(new inputText(true, "tag", "bill", "d"));
        $this->itemView->addView(new inputText(false, "togggggg", "sdfsdfsd", "d"));
        $this->itemView->addView(new inputText(true, "bill", "annaba", "brahim"));
        $section1->addView($this->itemView);
        $tlimage->addView($this->itemView);
        $this->addView($section1);
        $section2->addView($tlimage);
        $this->addView($section2);
    }
}

