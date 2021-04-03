<?php

require_once 'http/httpRequest.php';
class jsurl
{

    private $url=[];
    public function __construct()
    {
        
    }
    public function addJs(IbuildView $v){
       
            $v1=$v->getAllview();
            if (is_array($v1)){
            foreach ($v1 as $val) {
                $this->addJs($val);
            }
            }
      
        if(!isset($this->url[get_class($v)])  && !empty($v->getJs())){
            $this->url[get_class($v)]=$v->getJs();
        }
        
    }
    public function getView(){
        $body="";
        $addurl="/jsview/";
        $uri=dirname (__DIR__);
        $uri.="\\jsview" ;
      
        foreach ($this->url as $urijss) {
            if (empty($urijss)){
                continue;
            }
            foreach ($urijss as $urijs) {
             
            if(strpos($urijs, ".js") !== false){
                if (file_exists ($uri."\\".$urijs)){
                    $body.='<script type="text/javascript" src="'.$addurl.$urijs.'"></script>'."\n";
                }
            }else {
                
                if (file_exists ($uri.'\\'.$urijs.'.js')){
                    
                    $body.='<script type="text/javascript" src="'.$addurl.$urijs.'.js"></script>'."\n";
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

