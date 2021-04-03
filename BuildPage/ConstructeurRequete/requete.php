<?php

/**
 *
 * @author 2019
 *        
 */
class requete extends ConstructeurRequete
{
    private $instance;
    public function __construct($table)
    {
        parent::__construct($table); 
        $this->instance = httpRequest::getInstance();
    }
    /**
     */
    public function addConditionPost(...$arg)
    {
        $i = 0;
        switch (count($arg)) {
            case 1:
                $i = 0;
                break;
            case 2:
            case 3:
                $i = 1;
                break;
        }
        $arg[count($arg)] = $this->instance->PostValue($arg[$i]);
        call_user_func_array(array($this, "addCondition"), $arg);
    }


    public function addCondition(...$arg)
    {
        $nmarg = func_num_args();
        
        switch ($nmarg) {
            case 2:
                parent::MaddCondition($arg[0], $arg[1]);
                break;
            case 3:
                $this->addCondition_trie($arg[0], $arg[1], $arg[2]);
                break;
            case 4:
                $this->addCondition_fore($arg[0], $arg[1], $arg[2], $arg[3]);
                break;
        }
    }


    public function addJoin(...$arg)
    {
        $nmarg = func_num_args();
 
        switch ($nmarg) {
            case 3:
                parent::MaddJoin($arg[0], $arg[1], $arg[2]);
                break;
            case 4:
                $this->addJoin_fore($arg[0], $arg[1], $arg[2], $arg[3]);
                break;
            case 5:
                $this->addJoin_five($arg[0], $arg[1], $arg[2], $arg[3], $arg[4]);
                break;
        }
    }
    public function addFeald(...$arg)
    {
        $nmarg = func_num_args();
    
        switch ($nmarg) {
            case 1:
                $this->addFeald_one($arg[0]);
                break;
            case 2:
                $this->addFeald_two($arg[0], $arg[1]);
                break;
        }
    }
    public function addPost(...$arg)
    {
        $arg[count($arg)] = $this->instance->PostValue($arg[count($arg) - 1]);
        call_user_func_array(array($this, "add"), $arg);
    }
    public function add(...$arg)
    {
        $nmarg = func_num_args();
 
        switch ($nmarg) {
            case 2:
                $this->addtwo($arg[0], $arg[1]);
                break;
            case 3:
                parent::Madd($arg[0], $arg[1], $arg[2]);
                break;
        }
    }
}
