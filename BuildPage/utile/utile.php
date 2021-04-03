<?php
class utile {
    public Static function getFileExtention($url){
    $urls= explode('/',$url);
    if (strpos($urls[count($urls)-1],'.')!=false){
        $nameFile=explode('.',$urls[count($urls)-1]);
    }else  {
        throw new Exception("cest url n'pas de Extention"); 
    }
 
    return $nameFile[1];
    }

    public Static function getFileName($url){
        $urls= explode('/',$url);
        if (strpos($urls[count($urls)-1],'.')!=false){
            $nameFile=explode('.',$urls[count($urls)-1]);
        }else  {
            throw new Exception("cest url n'pas de name"); 
        }
     
        return $nameFile[0];
        }
}