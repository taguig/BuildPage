<?php

class cssUrl {
    private $url=[];
    public function __construct(){
        
    }
    public function addClass(IbuildView $v){
       
            $v1=$v->getAllview();
            if (is_array($v1)){
                foreach ($v1 as $val) {
                    $this->addClass($val);
                }
            }
         
      
            if(!isset($this->url[get_class($v)])  && !empty($v->getCss())){
                $this->url[get_class($v)]=$v->getCss();
            }
        
    }

    public function getView(){
        $body="";
        $addurl="/cssview/";
        $uri=dirname (__DIR__);
        $uri.="\\cssview" ;
        foreach ($this->url as $uricsss) {
            foreach ($uricsss as $uricss) {
            
            if(strpos($uricss, ".css") !== false){
                if (file_exists ($uri."\\".$uricss)){
                    $body.='<link rel="stylesheet" type="text/css" href="'.$addurl.$uricss.'">'."\n";
                }
            }else {
                
                if (file_exists ($uri.'\\'.$uricss.'.css')){
                   
                    $body.='<link rel="stylesheet" type="text/css" href="'.$addurl.$uricss.'.css">'."\n";
                }
       
            }
        }
        }
        if(strlen($body)>0){
            return $body;
        }
        return null;
    }
}