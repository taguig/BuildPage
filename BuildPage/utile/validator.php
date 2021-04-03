<?php


/**
 *
 * @author 2019
 *        
 */
class validator
{
    private $nb_function=0;
    private $error=[];
    public function addValidate(callable $fun,...$arg){
        try {
            $this->nb_function++;
            call_user_func_array($fun,$arg);
        }catch (Exception $e){
            $this->error[$this->nb_function]=$e->getTrace()[0];
        }
       
        return $this;
    }
    public function getError(){
        return $this->error;
    }
  
    public function __construct()
    {}
}

