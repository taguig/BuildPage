<?php


class buildLi extends BuildView
{
 private $text;
    public function __construct($text ,$id = "", $class = "")
    {
        $this->text=$text;
        parent::__construct("li", $id , $class );
    }
    public function getView()
    {
        $body="";
        $body.=$this->debutBalise();
        $body.=$this->text;
        foreach ($this->view as $v){
            $body.=$v->getView()."\n";
        }
        $body.=$this->finBalise();
        $this->body=$body;
        return $body;
    }
    
}

