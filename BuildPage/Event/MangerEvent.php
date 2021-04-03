<?php

/*
 * ici problemme de conception
 * il doit avoir de 
 * 
 */
require_once 'Event/Event.php';
class MangerEvent {
    private $listLsenners=[];
    function __construct(){
        
    }
    public  function emit($event,&...$args){
        if(array_key_exists($event,$this->listLsenners)){
            $listLsenner=$this->listLsenners[$event];
            $listLsenner->SetArgs($args);
            $listLsenner->handele();
        }
        
    }
    private function MakeEvent($event,callable $call){
        return new Event($event, $call);
    }
    public function on($event,callable $call){
        if (is_string($event)){
            $this->listLsenners[$event]=$this->MakeEvent($event, $call);
            
        }else {
            $event->SetCall($call);
            $this->listLsenners[$event->getName()]=$event;
            
        }
        
    }
    
}


?>