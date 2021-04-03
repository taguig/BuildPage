<?php

require_once("page.php");
/**
 *
 * @author 2019
 *        
 */
class Index extends page
{
    public $itemView;
    /**
     */
    public function __construct()
    {
       
        parent::__construct();
    }

    // ICI EN CREE LA PAGE avec createView

    protected function  createView()
    {
        $section1=new buildSection(100,100);
       $menu=new buildMenu();
       $menu->changeMenuSizeFont("12px");
       $headern=new modelHeader_1(true);
       $headern->setMenu($menu);
       $headern->addItemIcon(new itemIcon("fas fa-search"));
       $headern->addItemIcon(new itemIcon("fab fa-twitter"));
       $headern->addItemIcon(new itemIcon("fab fa-facebook-square"));
       $headern->textLogo("TAGUIG");
       $header=new slideView(false);
       $headerItem=new itemSlideView('image/cinema.jpg',$section1->getAtrributStyle());
       $headerItem1=new itemSlideView('image/musique.jpg',$section1->getAtrributStyle());
       $headerItem2=new itemSlideView('image/culture.png',$section1->getAtrributStyle());
       $header->addHeader($headern);
       $header->addView($headerItem);
       $header->addView($headerItem1);
       $header->addView($headerItem2);
       $section1->addView($header);
       $this->addView($section1);
        $this->addJsLib("jquery-3.5.1");
        $this->setTitre("mon site ");
        $this->addMetaData('og:url', 'facebook');
        $this->addMetaData('fg:url', 'facebook');
        $this->addMetaData('pg:url', 'facebook');
        $this->addMetaData('description', 'facebook');

 
   
  
    }

}
