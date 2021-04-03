<?php


class insertRequete extends Format
{ 
  

    public function __construct(ConstructeurRequete $req)
    { 
        parent::__construct($req);
      
        
    }

    
    public function toString():string{
        return "insert into `".$this->req->getTablename()."` (".$this->FormatFealdKey().") values (".$this->FormatFealdValue().");";
    }
}

