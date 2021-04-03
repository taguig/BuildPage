<?php




class ConstructeurRequete
{

    private $condition = [];
    private $fealdSelect = [];
    private $join = [];
    private $feald = [];
    private $tablename;
    private $event;
    private $orderby=[];
    private $groupBy="";
    private static $pdo;


    public function addOrderByTable($table,$field,$order){
        if (!empty($table)){
            $table=$this->tablename;
        }
        $this->orderby[$table.".".$field]=$order;
    }
    public function getGroupeBy(){
        return $this->groupBy;
    }
    
    public function addOrderBy($field,$order){
      $this->addOrderByTable("", $field, $order);  
    }
    public function addGroupbyTable($table,$field){
        if (!empty($table)){
            $table=$this->tablename;
        }
        $this->groupBy=$table.".".$field;
    }
    public function getOrderBy(){
        return $this->orderby;
    }
    /**
     * @return mixed
     */
    public function getCondition()
    {
        return $this->condition;
    }

    /**
     * @return mixed
     */
    public function getFealdSelect()
    {
        return $this->fealdSelect;
    }

    /**
     * @return mixed
     */
    public function getJoin()
    {
        return $this->join;
    }

    /**
     * @return mixed
     */
    public function getFeald()
    {
        return $this->feald;
    }

    /**
     * @return mixed
     */
    public function getTablename()
    {
        return $this->tablename;
    }

    /**
     * @return string
     */


    function __construct($table)
    {
        $this->tablename = $table;
        $this->event = new \MangerEvent();
    }
    public static function setPdo($pdo)
    {
        self::$pdo = $pdo;
    }
    public function IntQuery()
    {
        $this->condition = [];
        $this->fealdSelect = [];
        $this->join = [];
        $this->feald = [];
    }
    /**
     * ajouter une condition
     * @param String $key
     * @param String $value
     */
    protected function MaddCondition($key, $value)
    {
        $this->addCondition_trie($key, "=", $value);
    }

    protected function addJoin_five($tablejon, $fealdJoin, $table, $feald, $direction)
    {
        $this->event->emit("addJoin", $tablejon, $fealdJoin, $table, $feald, $direction);
        if (!isset($this->join[$tablejon][$table])) {
            $this->join[$tablejon][$table] = array("tablejoin" => $tablejon, "fealdjoin" => $fealdJoin, "table" => $table, "feald" => $feald, "direction" => $direction);
        }
    }
    protected function addJoin_fore($tablejon, $fealdJoin, $table, $feald)
    {
        $this->addJoin_five($tablejon, $fealdJoin, $table, $feald, "left");
    }
    protected function MaddJoin($tablejoin, $fealdjoin, $feald)
    {
        $this->addJoin_fore($tablejoin, $fealdjoin, $this->tablename, $feald);
    }

    protected function addCondition_fore($table, $key, $operation, $value)
    {
        $Outaccept = true;
        $this->event->emit("addCondition", $key, $operation, $value, $Outaccept);
        if ($Outaccept) {
            if (!empty($table) && $table != null) {
                $this->condition[$table][] = array("key" => $key, "operation" => $operation, "valeur" => $value);
            } else {
                $this->condition[$this->tablename][] = array("key" => $key, "operation" => $operation, "valeur" => $value);
            }
        }
    }
    protected function addCondition_trie($key, $operation, $value)
    {
        if (is_array($value)){
            $value=$value[0];
        }
        $this->addCondition_fore(null, $key, $operation, $value);
    }

    public function addConditionNotIn($key, ...$arg)
    {
        $this->addCondition($key, "not in", $arg);
    }



    public function addConditionIn($key, ...$arg)
    {
        $this->addCondition_trie($key, "in", $arg);
    }

    public function addFeald(...$arg)
    {
        switch (count($arg)) {
            case 1:
                $this->addFeald_one($arg[0]);
                break;
            case 2:
                $this->addFeald_two($arg[0], $arg[1]);
                break;
        }
    }

    protected function addFeald_two($table, $feald)
    {
        $this->event->emit("addFeald", $table, $feald);
        $this->fealdSelect[$table][] = $feald;
    }


    protected function addFeald_one($feald)
    {
        $this->addFeald_two($this->tablename, $feald);
    }


    protected function Madd($table, $fieald, $value)
    {
        $this->feald[$table][$fieald] = $value;
    }
    protected function addtwo($fieald, $value)
    {
        $this->Madd($this->tablename, $fieald, $value);
    }
    public function create()
    {
        if (!self::pdoExiceteOrNull()) {
            $obj = new insertRequete($this);
            $stat = self::$pdo->prepare($obj->toString());
            $stat->execute($obj->getParamExe());
            $this->event->emit("Create", $this, $stat);
            return $stat;
        }
    }
    public function update()
    {
        if (!self::pdoExiceteOrNull()) {
            $obj = new updateRequet($this);
            $stat = self::$pdo->prepare($obj->toString());
            $stat->execute($obj->getParamExe());
            $this->event->emit("Update", $this, $stat);
        }
    }
    public function select()
    {
        if (!self::pdoExiceteOrNull()) {
            $obj = new selectRequet($this);
            $req = $obj->toString();
            $stat = self::$pdo->prepare($req);
            $stat->execute($obj->getParamExe());
            $this->event->emit("Select", $this, $stat, $req);
            return $stat;
        }
    }
    public function delete()
    {
        if (!self::pdoExiceteOrNull()) {
            $obj = new deleteRequet($this);
            $stat = self::$pdo->prepare($obj->toString());
            $stat->execute($obj->getParamExe());
            $this->event->emit("Delete", $this, $stat);
            return $stat;
        }
    }

    public function  on($action, callable $fun)
    {
        $this->event->on($action, $fun);
    }
    public static function pdoExiceteOrNull()
    {
        if (isset(self::$pdo)  || empty(self::$pdo) || self::$pdo == null) {
            return false;
        } else {
            return true;
        }
    }
}
