<?php

class Requequete
{
  private $addrese,$bdd,$user,$pw,$port;
  private $pdo,$ConReq=null;
    /**
     * @return mixed
     */
    public function getAddrese()
    {
        return $this->addrese;
    }

/**
     * @return mixed
     */
    public function getBdd()
    {
        return $this->bdd;
    }

/**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

/**
     * @return mixed
     */
    public function getPw()
    {
        return $this->pw;
    
    }

/**
     * @return mixed
     */
    public function getPort()
    {
        return $this->port;
    
    }

/**
     * @param mixed $addrese
     */
    public function setAddrese($addrese,$act=false)
    {
        $this->addrese = 'host='.$addrese;
        if ($act==true){
            $this->MysqlPdoConstruct();
        }
    }

/**
     * @param mixed $bdd
     */
    public function setBdd($bdd,$act=false)
    {
        $this->bdd = 'dbname='.$bdd;
        if ($act==true){
            $this->MysqlPdoConstruct();
        }
    }

/**
     * @param mixed $user
     */
    public function setUser($user,$act=false)
    {
        $this->user = $user;
        if ($act==true){
            $this->MysqlPdoConstruct();
        }
    }

/**
     * @param mixed $pw
     */
    public function setPw($pw,$act=false)
    {
        $this->pw = $pw;
        if ($act==true){
            $this->MysqlPdoConstruct();
        }
    }

/**
     * @param mixed $port
     */
    public function setPort(int $port,$act=false)
    {
        $this->port = $port;
        if ($act==true){
            $this->MysqlPdoConstruct();
        }
    }
    public function commit(){
        $this->pdo->commit();
        $this->pdo->beginTransaction();
    }
    public function rollback (){
        $this->pdo->rollBack();
        $this->pdo->beginTransaction();
    }
    public function __construct($addres,$port,$bdd,$user,$pw)
    {
        $this->setAddrese($addres);
        $this->setPort($port);
        $this->setBdd($bdd);
        $this->setUser($user);
        $this->setPw($pw);
        $this->MysqlPdoConstruct();
    }
    /**
     * metre la requte a execute avec la function execute 
     * 
     * @param ConstructeurRequete $req
     */
    public function setReq(ConstructeurRequete $req){
        switch ($req->getAction()){
            case 'Select':
                $this->ConReq=new selectRequet($req);
                break;
            case 'Create':
                $this->ConReq=new insertRequete($req);
                break;
            case 'Update':
                $this->ConReq=new updateRequet($req); 
                break;
            case 'Delete':
                $this->ConReq=new deleteRequet($req);
                break;
        default: 
            break;
        }
    }
    
    /**
     * executer la requre mis par la function setReq
     */
    public function Execute(){
        if($this->ConReq!=null){
          $req=$this->ConReq->getReq();  
          switch ($req->getAction()){
              case 'Select':
                  $this->ExecuteR();
                  break;
              case 'Create':
              case 'Update':
              case 'Delete':
                  $this->ExecuteCUD();
                  break;
              default:
                  break;
          }
        }else {
            throw new  \Exception("la requte n' pas definie");
        }
        
        
    }
    /**
     * execute requete type licture
     */
    private function ExecuteR(){
        try {
            $statment=$this->pdo->query($this->ConReq->toString());
            $req=$this->ConReq->getReq();
            $req->handel($this->ConReq->toString(),$statment);
        } catch (\Exception $e) {
            $this->rollback();
        }
      
    }
    /**
     * execute les requete type 
     */
    private function ExecuteCUD(){
        try {
            $this->pdo->exec($this->ConReq->toString());
            $req=$this->ConReq->getReq();
            $req->handel($this->ConReq->toString());
        }catch(\Exception $e){
            $this->rollback();
        }
        
    }
    /**
     * inisialiser la la conection
     */
    private  function MysqlPdoConstruct(){
        $dsn='mysql:'.$this->getBdd().';'.$this->getAddrese().':'.$this->getPort();
        try {
            $this->pdo=new \PDO($dsn,$this->getUser(),$this->getPw());
            $this->pdo->beginTransaction();
        } catch (\PDOException  $e) {
            echo 'erreur ';
            die($e->getMessage());
        }
        
    }
}

