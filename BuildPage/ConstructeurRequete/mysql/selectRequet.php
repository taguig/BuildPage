<?php


class selectRequet extends Format
{

    public function __construct(ConstructeurRequete $req)
    {
        parent::__construct($req);
        $this->FormatJoin();
        $this->FormatCondition();
    }
    public function toString():string{ 
        $fieldselect=$this->FormatFealdSelect();
        if(empty($fieldselect)){
            $fieldselect="*";
        }
        $result= "select ".$fieldselect." from  ".$this->req->getTablename();
        if (!empty($this->join)){
         $result.=" ".$this->FormatJoinToString();
        }
        if(!empty($this->condition)){
            $result.="  where ".$this->FormatConditionToString();
        }
        if (!empty($this->req->getOrderBy())){
           $result.=" order by ".$this->FormatOrderBy(); 
        }
        if (!empty($this->req->getGroupeBy())){
            $result.=" group by ".$this->req->getGroupeBy();
        }
        $result.=" ;";
        return $result;
    }
}

