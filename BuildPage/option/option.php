<?php

/**
 *
 * @author 2019
 *        
 */
class option 
{

    private $data = [];
    private $bdd;
    private $GroupeOption;

    public function __construct(...$GroupeOption)
    {
        $this->GroupeOption = $GroupeOption;
        $this->bdd= new requete("options");
        $this->GetData();
    }

    public function GetData()
    {
        $this->bdd->IntQuery();
        $this->bdd->addFeald("optionGroupe");
        $this->bdd->addFeald("optionName");
        $this->bdd->addFeald("optionValue");
        $this->addConditionIn('optionGroupe', $this->GroupeOption);
        $stat = $this->bdd->select();
       
        while ($result = $stat->fetch(PDO::FETCH_ASSOC)) {
            if (isset($this->data[$result['optionGroupe']]) || ! empty($this->data[$result['optionGroupe']])) {
                $this->data[$result['optionGroupe']][$result['optionName']] = $result['optionValue'];
            } else {
                $this->data[$result['optionGroupe']] = [
                    $result['optionName'] => $result['optionValue']
                ];
            }
        }
      
    }

    public function getGroupeOption($go)
    {
        if (isset($this->data[$go])) {
            return $this->data[$go];
        } else {
            return null;
        }
    }

    public function getvalue($go, $name)
    {
        if (isset($this->data[$go][$name])) {
            return $this->data[$go][$name];
        } else {
            return null;
        }
    }

    private function addConditionIn($key, ...$arg)
    {
        $args = [
            $key
        ];
        $args = array_merge($args, $arg);
        call_user_func_array(array(
            $this->bdd,
            'addConditionIn'
        ), $args);
    }
    private  function existe($go, $no){
        $this->bdd->IntQuery();
        $this->bdd->addCondition("optionName", $no);
        $this->bdd->addCondition("optionGroupe", $go);
        $stat=$this->bdd->select();
        if ($result = $stat->fetch(PDO::FETCH_ASSOC)) {
            return true;
        }
        return false;
    }
    public function insert ($go, $no, $vo){
        
        if (!in_array($go,$this->GroupeOption)){
            
            $this->GroupeOption[]=$go; 
      
        }
            if (!$this->existe($go, $no)){
              $this->bdd->IntQuery();
              $this->bdd->add("optionGroupe",$go);
              $this->bdd->add("optionName",$no);
              $this->bdd->add("optionValue",$vo);
              $this->bdd->create();
              $this->GetData();
            
            }else  {
               
                $this->GetData() ;
                $this->update($go, $no, $vo);
            }
        }
        public function delete($go, $no){
            if (!empty($go) && !empty($no)){
                $this->bdd->IntQuery();
                $this->bdd->addCondition("optionName", $no);
                $this->bdd->addCondition("optionGroupe", $go);
                $this->bdd->delete();
            }
        }
    public function update($go, $no, $vo)
    { 
        if (isset($this->data[$go][$no])) {
           
            $this->bdd->IntQuery();
            $this->bdd->add("optionValue", $vo);
            $this->bdd->addCondition("optionName", $no);
            $this->bdd->addCondition("optionGroupe", $go);
            $this->bdd->update();
            $this->GetData();
        }
    }
    
}

