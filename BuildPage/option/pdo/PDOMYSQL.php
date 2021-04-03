<?php


/**
 *
 * @author 2019
 *        
 */
class PDOMYSQL extends PDO
{


    public function __construct($host,$dbname,$user,$passwd)
    {
        parent::__construct('mysql:host='.$host.';dbname='.$dbname, $user, $passwd );
    }
}

