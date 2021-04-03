<?php

/**
 *
 * @author 2019
 *        
 */
class buildMenu
{

    private $nav;

    private $listItem = [];

    private $listView = [];

    private $listGroupItem = [];

    /**
     */
    public function __construct($id = "", $class = "")
    {
        $this->nav = new menuPrencipal($id,$class);
 
         
                  $this->addGroupItem("Cimema", '{"type":"item",
            "text":"action"
           }','{
           "type":"item",
            "text":"amour"
           }','{
           "type":"item",
            "text":"aventure"
           }');
           
                  $this->addGroupItem("zic", '{"type":"item","text":"classic"}','{"type":"item","text":"Jazz"}');
                  $this->changeMenuSizeFont("12px");
                  $this->build('{"text":"home","link":"/Home"}','{"text":"Musique","child":"zic"}','{"text":"Cimema","child":"Cimema"}','{"text":"Culture"}');
    }
    public function changeMenuSizeFont ($size) {
        $this->nav->addAttrStyle("font-size", $size);
    } 

    public function addView($name, $view)
    {
        $this->listView[$name] = $view;
    }

    public function addItem($name, $Str)
    {
        $this->listItem[$name] = $Str;
    }

    public function addGroupItem($name, ...$Str)
    {
        
        $this->listGroupItem[$name] = '{ "child":[' . implode(',', $Str)  . '] }';
    }

    public function build(...$build)
    {
        $view = null;
        $child = null;
        foreach ($build as $item) {
            $child = json_decode($item);
            $view = new menuItem($child->text, (isset($child->link)) ? $child->link : "", (isset($child->cssid)) ? $child->cssid : "", (isset($child->cssclass)) ? $child->cssclass : "");
            $this->nav->addView($view);
            if (isset($child->child)) {
                $this->buildChild($view, $child->child);
            }
        }
    }

    protected function transformStringToObj($childs)
    {
        $obj = null;
        if (gettype($childs) == "string") {
            $obj = json_decode($this->listGroupItem[$childs]);
        }
        return $obj;
    }

    private function buildChild($parent, $childs)
    {
        $obj = $this->transformStringToObj($childs);
        $i = null;
        $chi = null;
        $viewGlobal = new menuSimple();
        if ( gettype($obj->child) == "array") {
            foreach ($obj->child as $Item) {
                if ($Item->type == "item") {
                    $chi = new menuItem($Item->text, (isset($Item->link)) ? $Item->link : "", (isset($Item->cssid)) ? $Item->cssid : "", (isset($Item->cssclass)) ? $Item->cssclass : "");
                    $viewGlobal->addView($chi);
                    if (isset($Item->child)) {
                        $this->buildChild($chi, $Item->child);
                    }
                } else if ($Item->type == "view") {
                    $viewGlobal->addView($this->listView[$Item->name]);
                }
            }
            $parent->addView($viewGlobal);
        }
    }
    public function getView(){
        return $this->nav;
    }
}

