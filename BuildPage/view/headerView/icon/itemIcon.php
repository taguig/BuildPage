<?php


/**
 *
 * @author 2019
 *        
 */
class itemIcon extends view
{

  protected $url;
  protected $icon;
  public function __construct( $icon,$url="",$id = "", $class = "")
    {
        parent::__construct(null,"icon", $id , $class." icon" );
        
        $this->url=$url;
        $this->icon=$icon;
    }
    protected function getClass(){
        return (!empty($this->class)?$this->class:'');
    }
    public function getView():string{
        return '<i class="'.$this->icon.' '.$this->getClass().'" >'.((!empty($this->url))?'<a href="'.$this->url.'" ></a>':"")."</i>";
    }
}

