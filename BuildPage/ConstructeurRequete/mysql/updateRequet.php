<?php


class updateRequet extends Format
{

    public function __construct(ConstructeurRequete $req)
    {
        parent::__construct($req);
        $this->FormatFeald();
        $this->FormatCondition();
    }
    protected  function FormatFeald()
    {
        $feald = $this->req->getFeald();
        foreach ($feald as $keys => $values) {
            foreach ($values  as $key => $value) {
                $this->feald[] = $key . "=:" . $key . "";
                $this->fieldValue[":".$key] = $value;
            }
        }
    }

    public function FormatCondition()
    {
        $cond = $this->req->getCondition();
        foreach ($cond as $key => $values) {
            foreach ($values as  $value) {
                $this->TypeCondition($value['key'], $value['operation'], $value['valeur']);
            }
        }
    }


    public function toString(): string
    {
        $result = "update " . $this->req->getTablename() . "  set   " . $this->fealdToString() . " ";
        if (!empty($this->req->getCondition())) {
            $result .="where ". $this->FormatConditionToString();
        } else {
            throw new \Exception("il ya pas de condition");
        }
        $result .= ";";
       
        return $result;
    }
}
