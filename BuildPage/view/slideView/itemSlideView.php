<?php



/**
 *
 * @author 2019
 *        
 */
class itemSlideView extends BuildView
{

private $image;
    public function __construct($urlImage,$parentStyle,$id = "", $class = "")
    {
        $this->image=$urlImage;
        $this->addStyleParent($parentStyle);
        $this->addAttrStyle("background-image", "url(".$this->image.")");
        $this->addAttrStyle("background-size", "100% 100%");
        parent::__construct('div', $id , $class." itemSlideView" );
    }
    public function updateStyleView (){
       $width=intval($this->GetValueStyleParent("width"));
       $this->addAttrStyle("width", $width."% ");
       $this->addAttrStyle("background-position", "0 0");
      
    }
}

