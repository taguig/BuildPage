
<?php

class fontUrl {
    private  $url=[];
    public function __construct(){
        
    }
    public function addFont(IbuildView $v){
       
            $v1=$v->getAllview();
            if (is_array($v1)){
                foreach ($v1 as $val) {
                    $this->addFont($val);
                }
            }
         
      
            if(!empty($v->getFont())){
             
                $this->url=$v->getFont();
               
            }
        
    }

    public function getView(){
        $body="";
        $addurl="/fontview/";
        $uri=dirname (__DIR__);
        $uri.="\\fontview" ;
        foreach ($this->url as $urilink) {
            if (file_exists ($uri."\\".$urilink)){
            $body.='<link rel="stylesheet"  href="'.$addurl.$urilink.'"/>'."\n";
            }
  
        }
        if(strlen($body)>0){
            return $body;
        }
        return null;
    }
}



?>