<?php


class Format
{
    protected $req;
    protected $condition = [];
    protected $conditionValue = [];
    protected $fieldValue = [];
    protected $feald = [];
    protected $join = [];
    public function __construct(ConstructeurRequete $req)
    {
        $this->req = $req;
    }
    public function getParamExe()
    {
        $Param = [];
    
        if (count($this->fieldValue) > 0) {
          
            $Param = array_merge($Param, $this->fieldValue);
        }
        if (count($this->conditionValue) > 0) {
          
            $Param = array_merge($Param, $this->conditionValue);
         
        }

        return $Param;
    }
    public function getReq()
    {
        return $this->req;
    }
    public function FormatCondition()
    {
        $cond = $this->req->getCondition();
        foreach ($cond as $key => $values) {
            foreach ($values as  $value) {
                $this->TypeCondition($key . "." . $value['key'], $value['operation'], $value['valeur']);
            }
        }
    }
    protected function TypeCondition($key, $operation, $valeur)
    {
        if (strpos($operation, "in")!==false && strpos($operation, "not") === false) {
            $this->FormatConditionIn($key, $valeur);
        } else if (strpos($operation, "in")!==false && strpos($operation, "not")!==false) {
            $this->FormatConditionNotIn($key, $valeur);
        } else if (strpos($operation, "like")!==false) {
            $this->FormatCondtionLike($key, $valeur);
        } else if (strpos($operation, "between")!==false) {
        } else {
            $this->FormatConditionSimple($key, $operation, $valeur);
        }
    }

    private function FormatConditionBetween($key, $valeur)
    {
        if (is_array($valeur) && count($valeur) != 0) {
            $this->condition[] = $key . " between " . $this->remplacePointForAS($key) . "0  and   " . $this->remplacePointForAS($key) . "1";
            $this->conditionValue[$this->remplacePointForAS($key) . "0"] = $valeur[0];
            $this->conditionValue[$this->remplacePointForAS($key) . "1"] = $valeur[1];
        } else {
            throw new \Exception("la condtion between n'ais pas corect");
        }
    }
    private function FormatConditionSimple($key, $operation, $valeur)
    {
        $this->condition[] = $key . $operation . $this->remplacePointForAS($key) . " ";
        $this->conditionValue[$this->remplacePointForAS($key)] = $valeur;
    }
    private function FormatCondtionLike($key, $valeur)
    {
        $this->condition[] = $key . "  like %" . $this->remplacePointForAS($key);
        $this->conditionValue[$this->remplacePointForAS($key)] = $valeur;
    }

    private function FormatConditionIn($key, $valeur)
    {
        $val = $this->Vkey($key, $valeur, count($valeur));
        $this->condition[] = $key . " in (" . implode(" , ", $val[1]) . ") ";
        $this->conditionValue = array_merge($this->conditionValue, $val[0]);
    }
    private function remplacePointForAS($val)
    {
        return  ":" . str_replace(".", "AS", $val);
    }
    private function Vkey($key, $value, $Vn)
    {
        $Vkey = [];
        $Akeys = [];
        for ($i = 0; $i < $Vn; $i++) {
            $Vkey[$this->remplacePointForAS($key . $i)] = $value[$i];
            $Akeys[] = $this->remplacePointForAS($key . $i);
        }
        
        return [$Vkey, $Akeys];
    }
    private function FormatConditionNotIn($key, $valeur)
    {

        $val = $this->Vkey($key, $valeur, count($valeur));
        $this->condition[] = $key . " not in (" . implode(" , ", $val[1]) . ") ";
        $this->conditionValue = array_merge($this->conditionValue, $val[0]);
    }
    protected  function FormatFeald()
    {
        $feald = $this->req->getFeald();
        foreach ($feald as $keys => $values) {
            foreach ($values  as $key => $value) {
                $this->feald[] = $keys . "." . $key . "='" . $value . "'";
            }
        }
    }

    protected function implode($sep, $arr)
    {
        // ici un prob
        $result = "";
        foreach ($arr as $key => $value) {
            foreach ($value as $val) {
                $result .= $key . "." . $val . $sep;
            }
        }
        return substr($result, 0, strlen($result) - 2);
    }
    protected function FormatFealdSelect(): string
    {

        return $this->implode(" , ", $this->req->getFealdSelect());
    }
    protected function FormatJoin()
    {
        $join = $this->req->getJoin();
        foreach ($join as $keys => $values) {
            foreach ($values as $key => $value) {
                $this->join[] = $value["direction"] . " join " . $value["tablejoin"] . "  on " . $value["table"] . "." . $value["feald"] . "=" . $value["tablejoin"] . "." . $value["fealdjoin"] . "  ";
            }
        }
    }
    protected function FormatJoinToString(): string
    {
        return implode(" ", $this->join);
    }
    protected function FormatFealdKey()
    {
        $feald = $this->req->getFeald();
        $fealdkey = [];
        foreach ($feald as $keys => $values) {
            foreach ($values  as $key => $value) {
                $fealdkey[] = "`" . $key . "`";
            }
        }
        return  implode(" , ", $fealdkey);
    }

    protected function FormatFealdValue()
    {
        $feald = $this->req->getFeald();
        $fealdValue = [];
        foreach ($feald as $keys => $values) {
            foreach ($values  as $key => $value) {
                $fealdValue[] = $this->remplacePointForAS($key);
                $this->fieldValue[$this->remplacePointForAS($key)] = $value;
            }
        }
        return  implode(" , ", $fealdValue);
    }

    protected function fealdToString()
    {
        return implode(" , ", $this->feald);
    }

    protected function FormatConditionToString(): string
    {

        return   implode(" && ", $this->condition);
    }
    protected function FormatOrderBy(){
        $result=[];
        $arr=$this->req->getOrderBy();
        foreach ($arr as $key=>$val){
            $result[]=$key." ".$val; 
        }
        return   implode(" , ", $result);
    }
}
