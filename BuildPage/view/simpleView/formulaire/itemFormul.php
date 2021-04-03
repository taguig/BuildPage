<?php


/**
 *
 * @author 2019
 *        
 */
abstract class itemFormul extends view
{
    private  $name;
    private $textLabel;
    private $valeur;
    /**
     *
     * @param
     *            $data
     *            
     * @param
     *            $Urlcss
     *            
     * @param
     *            $id
     *            
     * @param
     *            $class
     *            
     */
    public function __construct($name,$textLabel,$valeur="",$id = "", $class = "",$data = null, $Urlcss = "")
    {

        parent::__construct($data, $Urlcss,  $id, $class);
        $this->name=$name;
        $this->textLabel=$textLabel;
        $this->valeur=$valeur;
    }
    protected function getName(){
        return $this->getAtribut("name", $this->name);
    }
    protected function getVal(){
        return $this->getAtribut("value", $this->valeur);
    }
    private function forLab(){
        return (!empty($this->id)?'for="'.$this->id.'"':"");
    }
    protected function getLabel(){
     return '<div class="item_form_ligne">'."\n".'<label  '.$this->forLab().'>'.$this->textLabel. ' </label>'."\n".'</div>'."\n";   
    }
    protected abstract  function inpitItem();
    public function getView():string{
        
        return  '<div class="item_form">'."\n".$this->getLabel().$this->inpitItem().'</div>'."\n";
    }
    
}

