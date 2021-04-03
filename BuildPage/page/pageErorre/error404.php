<?php


/**
 *
 * @author 2019
 *        
 */
class error404 extends page
{
   private  $Eroor;
   public $itemView;
 
    /**
     */
    public function __construct($e)
    {   
        $this->Eroor=$e;
        parent::__construct();
      
    }
    protected   function createView(){
        $this->addJsLib("jquery-3.5.1");
        $this->itemView = new buildForm('google', 'post');
        $this->itemView->addView(new listOption("pay", $this->Eroor->getMessage(), [["valeur" => "bonjpur", "text" => "mmm"], ["valeur" => "bonjour", "text" => "mmmlmm"]], "bonjour"));
        $this->itemView->addView(new  ColorPike("ll", "llll", "#000000"));
        $this->itemView->addView(new  ColorPike("ala ", "ala ", "#000000"));
        
        $this->addView($this->itemView);
   
    }
}

