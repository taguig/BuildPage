<?php

class PageCss
{

    private $pageId = [];

    private $pageClass = [];

    private $pageTag = [];

    protected $idResult = "";

    protected $classResult = "";

    protected $tagResult = "";
    protected $font=[];

    public function __construct()
    {
 
        header("Content-type: text/css; charset: UTF-8");
    }
    
    public function addId($id, $proprite, $value)
    {
        if (! isset($this->pageId[$id])) {
            $this->pageId[$id] = [
                $proprite => $value
            ];
            $this->pageId[$id]["-moz-".$proprite] = $value;
            $this->pageId[$id]["-o-".$proprite] = $value;
            $this->pageId[$id]["-webkit-".$proprite] = $value;
            $this->pageId[$id]["-ms-".$proprite] = $value;
            $this->pageId[$id]["-khtml-".$proprite] = $value;
        } else {
            $this->pageId[$id][$proprite] = $value;
            $this->pageId[$id]["-moz-".$proprite] = $value;
            $this->pageId[$id]["-o-".$proprite] = $value;
            $this->pageId[$id]["-webkit-".$proprite] = $value;
            $this->pageId[$id]["-ms-".$proprite] = $value;
            $this->pageId[$id]["-khtml-".$proprite] = $value;
        }
    }

    public function addTag($tag, $proprite, $value)
    {
        if (! isset($this->pageTag[$tag])) {
            $this->pageTag[$tag] = [
                $proprite => $value
            ];
            $this->pageId[$tag]["-moz-".$proprite] = $value;
            $this->pageId[$tag]["-o-".$proprite] = $value;
            $this->pageId[$tag]["-webkit-".$proprite] = $value;
            $this->pageId[$tag]["-ms-".$proprite] = $value;
            $this->pageId[$tag]["-khtml-".$proprite] = $value;
        } else {
            $this->pageId[$tag][$proprite] = $value;
            $this->pageId[$tag]["-moz-".$proprite] = $value;
            $this->pageId[$tag]["-o-".$proprite] = $value;
            $this->pageId[$tag]["-webkit-".$proprite] = $value;
            $this->pageId[$tag]["-ms-".$proprite] = $value;
            $this->pageId[$tag]["-khtml-".$proprite] = $value;
            
        }
    }

    public function addClass($class, $proprite, $value)
    {
        if (! isset($this->pageClass[$class])) {
            $this->pageClass[$class] = [
                $proprite => $value
            ];
            $this->pageClass[$class]["-moz-".$proprite] = $value;
            $this->pageClass[$class]["-o-".$proprite] = $value;
            $this->pageClass[$class]["-webkit-".$proprite] = $value;
            $this->pageClass[$class]["-ms-".$proprite] = $value;
            $this->pageClass[$class]["-khtml-".$proprite] = $value;
        } else {
            $this->pageClass[$class][$proprite] = $value;
            $this->pageClass[$class]["-moz-".$proprite] = $value;
            $this->pageClass[$class]["-o-".$proprite] = $value;
            $this->pageClass[$class]["-webkit-".$proprite] = $value;
            $this->pageClass[$class]["-ms-".$proprite] = $value;
            $this->pageClass[$class]["-khtml-".$proprite] = $value;
        }
    }

    private function genereId($name)
    {
        $id = "#" . $name . " {\n";
        foreach ($this->pageId[$name] as $key => $value) {
            $id .= $key . " : " . $value . ";\n";
        }
        $id .= "}\n";
        return $id;
    }

    private function genereClass($name)
    {
        $class = "." . $name . " {\n";
        foreach ($this->pageClass[$name] as $key => $value) {
            $class .= $key . " : " . $value . ";\n";
        }
        $class .= "}\n";
        return $class;
    }
    private function genereTag($name)
    {
        $tag =  $name . " {\n";
        foreach ($this->pageTag[$name] as $key => $value) {
            $tag .= $key . " : " . $value . ";\n";
        }
        $tag .= "}\n";
        return $tag;
    }
    protected function generaiteAllTag()
    {
        $result = "";
        foreach ($this->pageTag as $key => $val) {
            $result .= $this->genereTag($key) . "\n";
        }
        $this->tagResult = $result;
    }
    protected function generaiteAllId()
    {
        $result = "";
        foreach ($this->pageId as $key => $val) {
            $result .= $this->genereId($key) . "\n";
        }
        $this->idResult = $result;
    }

    protected function generaiteAllClass()
    {
        $result = "";
        foreach ($this->pageClass as $key => $val) {
            $result .= $this->genereClass($key) . "\n";
        }
        $this->classResult = $result;
    }

    public function cssView()
    { 
        $this->generaiteAllClass();
        $this->generaiteAllId();
        $this->generaiteAllTag();
       return $this->idResult . "\n" . $this->classResult. "\n" .$this->tagResult;
    }
}
