<?php


abstract class page
{

    protected static $css;

    protected static $js;

    protected static $fontView;

    protected $view = [];

    protected $Meta = [];

    protected $lang = "fr";

    protected $http;

    protected $titre = '';

    private $LibJs = [];

    private $LibCss = [];

    protected $readerJs = [];

    protected $redesctionUrl = "";

    protected $pageError;

    public function __construct()
    {
        $this->addCssLib("all");
        $this->http = httpRequest::getInstance();
        if (empty(self::$css)) {
            self::$css = new cssUrl();
        }
        if (empty(self::$js)) {
            self::$js = new jsurl();
        }
        if (empty(self::$fontView)) {
            self::$fontView = new fontUrl();
        }
        if (! $this->isRedirection()) {
            $this->createView();
            $this->createBildViewDynamicCss();
        }
        
    }
    private function createBildViewDynamicCss(){
        $dyScriptCss=BuildView::getDynamicCss();
        if (!empty($dyScriptCss)){
            foreach ($dyScriptCss as $value) {
               $this->addDynamiqueCss($value);
            }
        }
    }
    public function addReaderJs($scriptjs)
    {
        if (strrpos($scriptjs, ".js",0)==false){
            $scriptjs.=".js";
        }
        if (file_exists("readJs\\" . $scriptjs )) {
            $this->readerJs[$scriptjs] = "readJs\\" . $scriptjs ;
        }
    }

    public function getParam($name)
    {
        return $this->http->getParam($name);
    }

    public function getError()
    {
        return $this->pageError;
    }

    public function addMetaData($name, $containe)
    {
        $this->Meta[$name] = $containe;
    }

    public function ifRedirection($erorr)
    {
        if ($this->isRedirection()) {
            $page = $this->getRedirection();
            try {
                return new $page();
            } catch (Exception $e) {
                $pageErro = $this->getError();
                return (! empty($pageErro)) ? new $pageErro($e) : new $erorr($e);
            }
        } else {
            return $this;
        }
    }

    public function viewMetaData(): string
    {
        $result = "";
        foreach ($this->Meta as $key => $value) {
            $result .= '<meta name' . '="' . $key . '"  content="' . $value . '" />'."\n";
        }
        return $result;
    }

    public function addView(IbuildView $v)
    {
        $this->view[] = $v;
        self::$js->addJs($v);
        self::$css->addClass($v);
        self::$fontView->addFont($v);
    }

    protected abstract function createView();

    protected function redirection($red)
    {
        $this->redesctionUrl = $red;
    }

    public function getRedirection()
    {
        return $this->redesctionUrl;
    }

    public function isRedirection()
    {
        if (empty($this->redesctionUrl)) {
            return false;
        } else {
            return true;
        }
    }

    public function getbody()
    {
        $body = "";
        foreach ($this->view as $value) {
            $body .= $value->getView() . "\n";
        }
        $body .= $this->getjsPage();
        $body .= self::$js->getView();
        $body .= $this->readyJsView();
        return $body;
    }

    private function readyJsView()
    {
        $result = "";
        if (! empty($this->readerJs)) {
            $result = "<script type=\"text/javascript\">
                      window.addEventListener(\"DOMContentLoaded\", function(event){\n";
            foreach ($this->readerJs as $file) {
                $result .= file_get_contents($file)."\n";
            }

            $result .= "\n});\n</script>";

            return $result;
        } else {
            return "";
        }
    }

    private function getjsPage()
    {
        $body = "";
        foreach ($this->LibJs as $uri) {
            $body .= '<script type="text/javascript" src="' . $uri . '"></script>' . "\n";
        }
        return $body;
    }

    private function getcssPage()
    {
        $body = "";
        foreach ($this->LibCss as $uri) {
            $body .= '<link rel="stylesheet" type="text/css" href="' . $uri . '">'."\n";
        }
        return $body;
    }

    public function addCssLibExterne($lib)
    {
        $this->LibCss[] = $lib;
    }

    public function addJsLibExterne($lib)
    {
        $this->LibJs[] = $lib;
    }

    private function addcss($addurl, $lib)
    {
        $initurls = $addurl;
        $uri = dirname(__DIR__);
        $uri .= "\\" . $addurl;
        $addurl = "/" . $addurl . "/";
        if (strpos($lib, ".css") !== false) {
            if (file_exists($uri . "\\" . $lib)) {
                $this->LibCss[] = $addurl . $lib;
            }
        } else {

            if (file_exists($uri . "\\" . $lib . ".css")) {
                $this->LibCss[] = $initurls . "/" . $lib . ".css";
            }
        }
    }

    private function addLibcss($addurl, $lib)
    {
        $initurls = $addurl;
        $uri = dirname(__DIR__);
        $uri .= "\\" . $addurl;
        $addurl = "/" . $addurl . "/";
        if (strpos($lib, ".css") !== false) {
            if (file_exists($uri . "\\" . $lib)) {
                $this->LibCss[] = "/" .$initurls . "/" . $lib;
            }
        } else {
            if (file_exists($uri . "\\" . $lib . ".css")) {
                $this->LibCss[] = "/" .$initurls . "/" . $lib . ".css";
            }
        }
    }

    private function DynamiqueCss($addurl, $lib)
    {
        $initurls = $addurl;
        $uri = dirname(__DIR__);
        $uri .= "\\" . $addurl;
        $addurl = "/" . $addurl . "/";
        if (strpos($lib, ".css") !== false) {
            if (file_exists($uri . "\\" . $lib)) {
                $this->LibCss[] = "/" .$initurls . "/" . $lib;
            }
        } else {
            if (file_exists($uri . "\\" . $lib . ".php")) {
                if (!in_array("/" .$initurls . "/" . $lib . ".css", $this->LibCss)){
                    $this->LibCss[] = "/" .$initurls . "/" . $lib . ".css";
                }
                
            }
        }
    }

    public function addCssLib($lib)
    {
        $addurl = "LibCssPage";
        $this->addLibcss($addurl, $lib);
    }

    public function addDynamiqueCss($csspage)
    {
        $addurl = "dynamicCss";
        $this->DynamiqueCss($addurl, $csspage);
    }

    public function getTite()
    {
        return $this->titre;
    }

    public function setTitre($Ntitre)
    {
        $this->titre = $Ntitre;
    }

    public function addJsLib($lib)
    {
        $addurl = "/LibJsPage/";
        $uri = dirname(__DIR__);
        $uri .= "\\LibJsPage";
        if (strpos($lib, ".js") !== false) {
            if (file_exists($uri . "\\" . $lib)) {
                $this->LibJs[] = $addurl . $lib;
            }
        } else {
            if (file_exists($uri . "\\" . $lib . ".js")) {
                $this->LibJs[] = $addurl . $lib . ".js";
            }
        }
    }

    public function getHeader()
    {
        $header = '<!DOCTYPE html>
<html lang="' . $this->lang . '">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>' . $this->getTite() . '</title>' ."\n". $this->viewMetaData() ."\n".self::$fontView->getView()."\n". self::$css->getView() ."\n". $this->getcssPage() ."\n". '
</head>' . "\n";
        return $header;
    }
}