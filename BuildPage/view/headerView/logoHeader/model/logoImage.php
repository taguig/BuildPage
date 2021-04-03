<?php


/**
 *
 * @author 2019
 *        
 */
class logoImage extends view
{
 
    private $urlImage;
    private $link;
    private $alt;
    /**
     *
     * @param
     *            $dataModel
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
    public function __construct($urlImage,$link,$alt="",$width="",$height="")
    {
        if(!empty ($width)){
            $this->addAttrStyle("width", $width);
        }
        if(!empty ($height)){
            $this->addAttrStyle("height", $height);
        }
        $this->link=$link;
        $this->$urlImage=$urlImage;
        parent::__construct($dataModel = null,  "logoImage", "logoImage",  "");
    }
    /**
     * @return mixed
     */
    public function getUrlImage()
    {
        return $this->urlImage;
    }

    /**
     * @return mixed
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @return mixed
     */
    public function getAlt()
    {
        return $this->alt;
    }

    /**
     * @param mixed $urlImage
     */
    public function setUrlImage($urlImage)
    {
        $this->urlImage = $urlImage;
    }

    /**
     * @param mixed $link
     */
    public function setLink($link)
    {
        $this->link = $link;
    }

    /**
     * @param mixed $alt
     */
    public function setAlt($alt)
    {
        $this->alt = $alt;
    }

    public function getView(){
       return '<h1 '.$this->getClass(). '><a   href="'.$this->link.'" '.$this->getId().' >
       <img src="'.$this->urlImage.'" alt="'.$this->alt.'" /> 
       </a></h1>'; 
    }
}

