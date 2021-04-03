<?php
class Data {
    private $data;
    private $pointe=-1;
    private $len=0;
    public function __construct($data=null){
        if (!empty($data)){
          $this->data=$data;
          $this->len=count($this->data);
        }
    }
    public function setDData ($d){
        $this->data=$d;
    }
    public function hasNext(){
        if ($this->pointe+1<$this->len){
            return true;
        }
        $this->pointe=-1;
        return false;
    }
    public function Next(){
        $this->pointe++;
        return $this->data[$this->pointe];
    }


}