<?php


class deleteRequet extends Format
{

    public function __construct(ConstructeurRequete $req)
    {
        parent::__construct($req);
        $this->FormatCondition();
    }
    public function toString():string{
        $condition=$this->FormatConditionToString();
        if (empty($condition)){
            throw new Exception( "il ya pas de condition");
        }
        return "DELETE FROM ".$this->req->getTablename()." where ". $condition;
    }
}

