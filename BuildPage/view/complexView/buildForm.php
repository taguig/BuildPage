<?php


/**
 *
 * @author 2019
 *        
 */
class buildForm extends buildViewForm
{
    private $url;
    private  $method;

    /**
     */
    public function __construct($url,$method,$id = "", $class = "")
    {
        parent::__construct($id , $class );
        $this->url=$url;
        $this->method=$method;
    }
    public function addView(IbuildView $view){
        parent::addView($view);
    }
    public function getView()
    {
        $body='<from '.$this->getAtribut("action", $this->url).$this->getAtribut("method", $this->method).'>';
        $body.=parent::getView();
        $body.='</from>';
        return $body;
}
}

