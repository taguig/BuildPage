<?php

class Event {
    
    private $NameEvent="";
    private $callback;
    private $args=null;
    
    
    function __construct($name,callable  $call){
        
        if (is_callable($call) ){
            $this->callback=$call;
        }else {
            throw new \Exception("c'est pas un callable", 3);
            
        }
        $this->NameEvent=$name;
        
    }
    public function SetArgs(...$args){
       
        $this->args=$args[0];
        
    }
    public function SetCall(callable  $call){
        $this->callback=$call;
        
    }
    public function getName(){
        
        return $this->NameEvent;
    }
    
    public function handele():Event{
        if(!empty($this->callback)){
            call_user_func_array($this->callback,$this->args);
        }else {
            throw new \Exception(" eroor ya pas de function ",4);
        }
        return $this;
    }
    
    
    
    
    
}





?>