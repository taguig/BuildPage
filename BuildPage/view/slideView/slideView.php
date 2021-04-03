<?php


/**
 *
 * @author 2019
 *        
 */
class slideView extends BuildView
{

    /**
     */
    private $header;
  
    public function __construct( $defile=false,$id = "", $class = "")
    {
        if (!$defile){
             $this->addUrlJs("slideView");
             $this->addUrlCss("SlideView");
        }else {
            $this->addUrlCss("SlideViewAnimationOpacyty");
            $this->addUrlJs("SlideViewAnimationOpacyty");
        }
     

        parent::__construct("div", $id , $class." SlideView" );
    }
    private function getViewHeader(){
        if (empty($this->header)){
            return "";
        }else {
           
            return $this->header->getView();
        }
    }
    public function getAllview(){
        $views=parent::getAllview();
        $views[]=$this->header;
        return $views;
    }
    public function addHeader($header){
        $this->header=$header;
    }
    public function addView($view){
        if ($view instanceof itemSlideView){
           parent::addView($view); 
          
        }
    }
    public function updateStyleView (){
        
    }
    private function listViewButtom(){
        $count=count($this->view);
        $result="";
        $result=str_repeat('<span class="selectItemNav" >'."\n".'</span>'."\n",$count);   
        return $result;
    }
    public function getView()
    {
        $body="";
        $body.=$this->debutBalise();
        $body.=$this->getViewHeader();
        $body.='<div class="slideViewListItem" >';
        foreach ($this->view as $v){
            $body.=$v->getView()."\n";
        }
        $body.='</div>';
        $body.='<div id="slideViewNav" >
    <a class="slideViewLeft ItemNav" href=""><</a>
    <a class="slideViewRight ItemNav" href="">></a>
    </div>';
    $body.='<div class="navSelectItem">';
    $body.=$this->listViewButtom();
    $body.='</div>';
        $body.=$this->finBalise();
        $this->body=$body;
        return $body;
    }
}

