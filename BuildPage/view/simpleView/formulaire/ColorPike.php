<?php


/**
 *
 * @author 2019
 *        
 */
class ColorPike extends itemFormul
{

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
    public function __construct($name, $textLabel, $valeur = "", $id = "", $class = "", $data = null, $Urlcss = "")
    {
        parent::__construct($name, $textLabel, $valeur , $id = "", "colorPike".$class, $data = null, $Urlcss = "");
        $this->addUrlJs("jquery.minicolors.min");
        $this->addUrlJs("pickcolor");
        $this->addUrlCss("pickercolor");
    }

    /**
     * (non-PHPdoc)
     *
     * @see itemFormul::inpitItem()
     */
    protected function inpitItem()
    {
        return '<div class="item_form_ligne">'."\n".'<input type="text" '.$this->getId().$this->getClass().$this->getVal().'>'."\n".'</div>'."\n";
    }
}

