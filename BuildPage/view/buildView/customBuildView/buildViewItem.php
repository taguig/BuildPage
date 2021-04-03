<?php


/**
 *
 * @author 2019
 *        
 */
class buildViewItem extends BuildView
{
private $Nview=0;
    /**
     */
    public function __construct()
    {
        parent::__construct("div","","row");
    }
    public function addView(IbuildView $view){

        parent::addView($view);
        $this->Nview++;
    }
    private function colmd(){
       $md=0;
       if ( 12 % $this->Nview==0){
           $md=12/$this->Nview ;
       }else {
           $md=(12-(12 % $this->Nview))/$this->Nview;
       }
       return ($md>0)?" col-md-".$md." ":" ";
    }
    
    public function getView()
    {
       $body="";
       $body.=$this->debutBalise();
       foreach ($this->view as $v){
           $body.='<div class="'.$this->colmd().'">';
           $body.=$v->getView()."\n";
           $body.='</div>'."\n";
       }
       $body.=$this->finBalise();
       $this->body=$body;
       return $body;
    }
}

