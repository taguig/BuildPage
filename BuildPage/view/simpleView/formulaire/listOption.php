<?php


/**
 *
 * @author 2019
 *        
 */
class listOption extends itemFormul
{

  public $datalist;
  public $select;
    public function __construct($name, $textLabel,$datalist ,$select,$id = "", $class = "", $data = null, $Urlcss = "")
    {
        parent::__construct($name, $textLabel, "",$id = "", "listoption ".$class,$data);
        $this->addUrlCss("listOption");
        $this->datalist=$datalist;
        $this->select=$select;
    }
    private function dataToview(){
        $body="";
        if (is_array($this->datalist)){
       
            foreach ($this->datalist as $data) {
                $body.=$this->selectView($data);
            }
        }
        return $body;
    }
    private function selectView($data){
        if (($data["valeur"]===$this->select)){
            return  "<option value=\"".$data["valeur"]."\"  selected>".$data["text"]."</option>";  
        }else {
            return  "<option value=\"".$data["valeur"]."\" >".$data["text"]."</option>"; 
        }
       
    }
    protected function inpitItem()
    {
        $body='<div class="item_form_ligne">'."\n".'<select '.$this->getName().' '.$this->getClass().$this->getId().' >';
        $body.=$this->dataToview();
        $body.='<select /></div>';
        return $body;
    }

}

