<?php


/**
 *
 * @author 2019
 *        
 */
class modelHeader extends BuildView
{
    protected $menu;
    protected $logo;
    protected $icon;
    protected $activeIcon=false;
   
    /**
     */
    public function __construct( $id = "", $class = "",$icone=false)
    {
        $this->menu=new buildMenu();
        $this->activeIcon($icone);
        parent::__construct("div", $id , $class." header");
        
    }
    private function activeIcon($i){
        $this->activeIcon=$i;
      ($this->activeIcon)?$this->icon=new builderIcon():null;
    }
 
    protected function getActiveIcon(){
        return $this->activeIcon;
    }
    public function addItemIcon($v){
        if ($this->getActiveIcon()){
            $this->icon->addView($v);
        }
    }
    public function addMenuGroupItem($name, ...$Str) {
        $param_arr=array_merge(array($name),$Str);
       call_user_func_array(array($this->menu,"addGroupItem") , $param_arr);
    }
    public function addMenuView($name, $view){
        $param_arr=array ($name, $view);
        call_user_func_array(array($this->menu,"addView") , $param_arr);
    }
    public function buildMenu(...$arg){
        call_user_func_array(array($this->menu,"build") , $arg);
    }
    public function setMenu($menu){
        if($menu instanceof buildMenu){
            $this->menu=new $menu;
        }
    }
    public function getMenu (){
        return $this->menu;
    }
 
    public function getLogo(){
        return $this->logo;
    }
}

