<?php


/**
 *
 * @author 2019
 *        
 */
class model extends requete
{
    
    private $data ;
    /**
     */
    public function __construct($table){
        parent::__construct($table);
    }
    public function select()
    {
        $stat=parent::select();
        $this->data=new Data($stat->fetchAll());
        
        return $this->data;
    }
}

