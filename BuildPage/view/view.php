<?php

require_once 'view/IbuildView.php';
class view implements IbuildView {
   protected $body="";
   private $dataModel=null;
   protected $Urlcss=[];
   protected $UrlJs=[];
   protected $id="";
   protected $class="";
   protected $attrStyle=[];
   

   public function __construct($dataModel=null,$Urlcss="",$id="",$class=""){
    
           $this->addUrlCss($Urlcss);         
           $this->dataModel=$dataModel;
           $this->id=$id;
           $this->class=$class;
        
    }
    
    protected function imgToUrlImg($img){
      return "/image/".$img;  
    }
    protected function imgToUrlImgView($img){
        return "/imageview/".$img; 
    }
    public function getFont(){
       
    }
    /**
     * {@inheritDoc}
     * @see IbuildView::getValueAtrribueStyle()
     */
    public function getValueAtrribueStyle($prop)
    {
        // TODO Auto-generated method stub
        
    }

    /**
     * {@inheritDoc}
     * @see IbuildView::addParent()
     */
    public function addParent(&$parent)
    {
        // TODO Auto-generated method stub
        
    }

    /**
     * {@inheritDoc}
     * @see IbuildView::getParentView()
     */
    public function getParentView()
    {
        // TODO Auto-generated method stub
        
    }

    /**
     * {@inheritDoc}
     * @see IbuildView::addStyleParent()
     */
    public function addStyleParent($Style)
    {
        // TODO Auto-generated method stub
        
    }

    /**
     * {@inheritDoc}
     * @see IbuildView::getAtrributStyle()
     */
    public function getAtrributStyle(){
        return  $this->attrStyle;
    }

    /**
     * {@inheritDoc}
     * @see IbuildView::GetValueStyleParent()
     */
    public function GetValueStyleParent($propriter)
    {
        // TODO Auto-generated method stub
        
    }

    /**
     * {@inheritDoc}
     * @see IbuildView::updateStyleView()
     */
    public function updateStyleView()
    {
        // TODO Auto-generated method stub
        
    }

    public function addUrlJs($script){
        if (!empty($script)){
            $this->UrlJs[]=$script;
        }
      
    }
    /** 
     * @function addUrlCss
     * @param string $script  url feuille de style
     * @return void
     * ajoute une feuille de style a le view
     */
    public function addUrlCss($script){
        if (!empty($script)){
            $this->Urlcss[]=$script;
        }
        
    }
    
    /**
     * @function removeUrlCss
     * @param string $script  url feuille de style
     * @return void
     * supprime une feuille de style a le view
     */
    public function removeUrlCss($script){
        $this->Urlcss=array_filter( $this->Urlcss,function($s)use($script){
            
            return !($s==$script);
        
        });
    }
    /**
     * @function removeUrlJs
     * @param string $script  url feuille de script
     * @return void
     * ajoute un ficher de script a le view
     */
    public function removeUrlJs($script){
        $this->UrlJs=array_filter( $this->UrlJs,function($s)use($script){
            
            return !($s==$script);
            
        });
    }
    
    /**
     * @function getAtribut
     * @param string $attri  Nom attribue html
     * @param string $val la valeur de l' attrube
     * @return string
     *  formate attribue et sa valeur return exmple attribue=valaleur 
     */
    protected function getAtribut($attri,$val){
        return (!empty($val)?' '.$attri.'="'.$val.'"':"");
    }
    public function addAttrStyle($proprete,$style){
       
        if (!empty($style)){
            $this->attrStyle[$proprete]=$style.';';
        }
       
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
    public function getView():string{
        
       return ''; 
    }
    protected function getClass(){
        return (!empty($this->class)?' class="'.$this->class.'" ':'');
    }
    protected function getId(){
        return (!empty($this->id)?' id="'.$this->id.'" ':'');
    }
    public function getCss(){
        return $this->Urlcss;
    }
    public function  getJs(){
        return $this->UrlJs;
    }
    public function getBody (){
        return $this->body;
    }
    
    public function getAllview()
    {}

}