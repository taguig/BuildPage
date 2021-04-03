<?php

/** 
 * @author 2019
 * 
 */
class BuildView implements IbuildView
{
    protected $body="";
    protected $Urlcss=[];
    protected $UrlJs=[];
    protected $view=[];
    protected $tag;
    protected $class;
    protected $id;
    protected $attrStyle=[];
    protected static $font;
    protected static $dynamicCss=[];
    private $attrStyleParent=[];
    private $parentView=null;
    /**
     */
    public function  getValueAtrribueStyle($prop){
        if (isset($this->attrStyle[$prop])){
            return $this->attrStyle[$prop];
        }
    }
    public function __construct($tag,$id="",$class="")
    {
      $this->tag=$tag; 
      if(!empty($id)){
          $this->id=$id;
      }
      if(!empty($class)){
          $this->class=$class;
      }
      if (!is_array(self::$font)){
        self::$font=[];
      }
    }
    public function getAtrributStyle(){
       return  $this->attrStyle; 
    }
    
    public function addStyleParent($Style){
      $this->attrStyleParent=$Style;  
    }
    public function  addParent (&$parent){
        $this->parentView=$parent;
    }
    
    public function getParentView(){
        if ( $this->parentView ==null || empty($this->parentView)){
         return false;
        }

        return $this->parentView;
    }
    public function GetValueStyleParent ($propriter){
        if (is_array($this->attrStyleParent) && !empty($this->attrStyleParent)){
            if (isset($this->attrStyleParent[$propriter])){
                return $this->attrStyleParent[$propriter];
            }
        }
    }
    public function updateStyleView(){
        
    }
    protected function imgToUrlImg($img){
        return "/image/".$img;
    }
    protected function imgToUrlImgView($img){
        return "/imageview/".$img;
    }
    public function removeView($v){
        for ($i=0;$i<count($this->view);$i++) {
            if ($this->view[$i]==$v){
                unset($this->view[$i]);
                return ;
            }
        }
    }
    public static function getDynamicCss (){
        return self::$dynamicCss;
    }
    public function addDynamicCss($scriptDynamic){
      if (!in_array($scriptDynamic,self::$dynamicCss)){
        self::$dynamicCss[]=$scriptDynamic;
      }    
    }

  
   public function addClassCss($class){
    if(!empty($this->class)){
        $this->class.=" ".$class;
    }else {
        $this->class=$class;
    }
   }  
    public function getAllview(){
        return $this->view;
    }
    public function addUrlFont($link){
     self::$font[utile::getFileName($link)]=$link;
    }
    public function getFont(){
        return self::$font;
     }
    public function addUrlJs($script){
        $this->UrlJs[]=$script;
    }
    public function addUrlCss($script){
        $this->Urlcss[]=$script;
    }
    public function removeUrlCss($script){
        $this->Urlcss=array_filter( $this->Urlcss,function($s)use($script){
            
            return !($s==$script);
            
        });
    }
    public function removeUrlJs($script){
        $this->UrlJs=array_filter( $this->UrlJs,function($s)use($script){
            
            return !($s==$script);
            
        });
    }
    /**
     * (non-PHPdoc)
     *
     * @see IbuildView::getJs()
     */
    
    public function getJs()
    {
        
        return $this->UrlJs;
    }
    
    public function addView(IbuildView $view){
        $view->updateStyleView();
      $this->view[]=$view;
      
    }

    /**
     * (non-PHPdoc)
     *
     * @see IbuildView::getCss()
     */
    public function getCss()
    {
    return $this->Urlcss;
    }

    /**
     * (non-PHPdoc)
     *
     * @see IbuildView::getBody()
     */
    public function getBody()
    {
        return $this->body;
    }

    public function addAttrStyle($proprete,$style){
        $this->attrStyle[$proprete]=$style.';';
    }
    protected function atributstyle(){
        $val=[];
        if(count($this->attrStyle)>0){
            foreach ($this->attrStyle as $key => $value) {
            $val[]=$key.':'.$value;
            }

            return ' style="'.implode(" ", $val).'"';
            }
           
        }
    
    protected function attribut(){
        return "";
    }

    protected function atributId(){
        return (!empty($this->id))?' id="'.$this->id.'" ':"";
    }
    protected function atributclass(){
        return (!empty($this->class))?' class="'.$this->class.'" ':"";
    }
    protected function debutBalise(){
        return '<'.$this->tag.$this->attribut().$this->atributId().$this->atributclass().$this->atributstyle().'>'."\n";
    }
    protected function finBalise (){
        return  '</'.$this->tag.'>'."\n";
    }
    protected function getAtribut($attri,$val){
        return (!empty($val)?' '.$attri.'="'.$val.'"':"");
    }
    public function getView()
    {
        $body="";
        $body.=$this->debutBalise();
        foreach ($this->view as $v){
            $body.=$v->getView()."\n";
        }
        $body.=$this->finBalise();
        $this->body=$body;
        return $body;
    }
}

