<?php


/**
 *
 * @author 2019
 *        
 */
class buildViewCustome extends BuildView
{
    public  $build;
   /** 
    * a bousin de bostrap et jqurey
    */
    /**
     * 
     * @param bool $fluid
     * @param string $id
     */
    public function __construct(bool $fluid,$id="")
    {
        parent::__construct("div",$id , $fluid?"container-fluid":"container");
        
        $this->build=new buildViewItem();
         parent::addView($this->build);
    }
    public function addView(IbuildView $view){
        $this->build->addView($view);
    }
}

