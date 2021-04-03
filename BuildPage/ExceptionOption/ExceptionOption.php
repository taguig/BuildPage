<?php
class ExceptionOption extends Exception {
    public $optionName="";
    function __construct($opn){
        $this->optionName=$opn;
        parent::__construct("le nom n'existe pas ");
    }
}