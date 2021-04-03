<?php


/**
 *
 * @author 2019
 *        
 */
class TextLimage extends BuildView 
{
private $image="";
private $alt="";
    /**
     * {@inheritDoc}
     * @see view::getView()
     */
    public function getView(): string
    {
        $body="";
        $body.=$this->debutBalise();
        $body.='<div class="TextLimage-div TextLimage-ele">';
        foreach ($this->view as $v){
            $body.=$v->getView()."\n";
        }
        $body.="</div>";
        $body.='<div class="TextLimage-div">';
        $body.='<img class="TextLimage-img" src="'.$this->imgToUrlImg($this->image).'"  '.$this->getAlt().'/>';
        $body.="</div>";
        $body.=$this->finBalise();
       
        $this->body=$body;
        return $body;
    }

    private function getAlt(){
        if(!empty($this->alt)){
           return' alt="'.$this->alt.'"';
        }
    }
    /**
     */
    public function __construct($img,$alt="",$id = "", $class = "")
    {
   
        $this->image=$img;
        $this->alt=$alt;
        parent::__construct("div",$id,$class."flex-ligne  TextLimage" );
        $this->addUrlCss("TextLimage");
    
    }
    
}

