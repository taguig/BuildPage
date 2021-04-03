<?php


/**
 *
 * @author 2019
 *        
 */
class MediaPageCss extends PageCss
{
    private $typeMedia;
    private $arg;
    private const media=["all","print","screen","speech"];

    /**
     */
    public function __construct($type,...$arg)
    {
        parent::__construct();
        $this->typeMedia=in_array($type, MediaPageCss::media)?$type:"all";
       $this->arg=$arg;
       
    }
    public function cssView(){
        $result="";
        $arg=array_map(function ($item){
            return " (".$item.") ";
        }, $this->arg);

        $result.="\n@media ".$this->typeMedia." and ".implode("and", $arg)." {\n";
        $result.=parent::cssView()."\n";
        $result.="}\n";
        return $result;
        
    }
}

