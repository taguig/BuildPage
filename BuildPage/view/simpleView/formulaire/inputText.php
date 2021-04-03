<?php


/**
 *
 * @author 2019
 *        
 */
class inputText extends itemFormul
{
    private $type;
 

    /**
     *
     * @param
     *    type 
     *    true=text
     *    false=pasword        
     *            
     *
     *            
     *            
     */
    private $length=0;
    public function __construct(bool $type,$name, $textLabel,$valeur="",$id="",$class="",$data=null)
    {
        parent::__construct($name, $textLabel,$valeur,$id,'inputtext '.$class,$data);
        $this->type=$type;
        $this->addUrlCss("inputtext");
        
       
        
    }
    
    private function typeInput():string{
        return ($this->type)?$this->getAtribut("type", "text"):$this->getAtribut("type", "password");
    }
    protected function inpitItem(){
        return '<div class="item_form_ligne">'."\n".'<input' .$this->atributstyle().'  ' . $this->getVal().$this->getName().' '. $this->typeInput().$this->getClass().$this->getId().' />'."\n".'</div>'."\n";
    }
  
}

