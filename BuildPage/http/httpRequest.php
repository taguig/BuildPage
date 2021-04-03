<?php

class httpRequest
{

    static $instance;

    private $param = [];

    private $adressePage = [];

    private $dosser = [
        "cssview",
        "jsview",
        "LibCssPage",
        "LibJsPage",
        "pagejs",
        "fontview"
    ];
private $imageDir=[
    "image",
    "imageview"
];
    private $contentType = [
        "js" => "application/javascript",
        "css" => "text/css",
        "ttf" => "application/x-font-truetype",
        "woff2" => "font/woff2"
    ];
    private $contentTypeImage = [ 
        "png" => "image/png",
        "jpg"=>"image/jpeg"
    ];

    public static function getInstance()
    {
        if (empty(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }


    public function ExtracteData()
    {
        $data = explode("/", $_SERVER["REQUEST_URI"]);
        array_map(function ($a) {
            if (stripos($a, "-") != false && stripos($a, ".") == false) {
                $tempdata = explode("-", $a);
                $this->setParam($tempdata[0], $tempdata[1]);
            } else if (!empty($a)) {
                $this->setAdressePage($a);
            }
        }, $data);
    }

    private function classPage()
    {
        $page = array_map(function ($item) {
            return str_replace(".","",ucfirst($item));
        }, $this->adressePage);
           
        return implode("", $page);
    }

    private function classCss()
    {
            return  ucfirst(str_replace(".css", "", $this->adressePage [count($this->adressePage)-1]));
    }

    public function router()
    {  
    
        if (!isset($this->adressePage[0]) && empty($this->adressePage[0])) {
           
            $this->adressePage[0] = "index";
          
        } if(in_array("ajax",$this->adressePage)){
        
            $this->ajaxRequire($this->adressePage[0], $this->adressePage[1]);
        }else if (in_array($this->adressePage[0], $this->imageDir)){
            $this->imageRequire($this->adressePage[0], $this->adressePage[1]);
        }
        else if (in_array($this->adressePage[0], $this->dosser)) {
            $this->dymamicRequire($this->adressePage[0], $this->adressePage[1]);
        }else if (in_array("dynamicCss",$this->adressePage)) {
            $this->pageCssView();
        }
        else {
            $this->pageView();
        }
    }
  
    private  function dymamicRequire($racine,$ficher){
        if(file_exists($racine. '/' .$ficher)){
            $type =$this->getContentType($ficher);
            if ($type!=false){
                header('Content-Type:' .$type );
                require_once ($racine. '/' .$ficher );
            }
           
            
        }else {
            throw new Exception("le ficher ".$ficher." n'exite pas");
        }
       
    }
    private  function dymamicRequireFont($racine,$ficher){
        if(file_exists($racine. '/' .$ficher)){
            $type =$this->getContentType($ficher);
            if ($type!=false){
                header('Content-Type:' .$type );
                require_once ($racine. '/' .$ficher );
            }
            
            
        }else {
            throw new Exception("le ficher ".$ficher." n'exite pas");
        }
        
    }
    private  function imageRequire($racine,$ficher){
        
        if(file_exists($racine. '/' .$ficher)){
            $type =$this->getContentTypeImage($ficher);
            if ($type!=false){
                header('Content-Type:' .$type );
                echo file_get_contents($racine. '/' .$ficher );
            }
           
        }else {
            throw new Exception("le ficher ".$ficher." n'exite pas");
        }
       
    }
    private function ajaxRequire($racine,$ficher){
        if(file_exists($racine. '/' .$ficher.".php")){
            header('Content-Type: application/json');
            require_once ($racine. '/' .$ficher.".php" );
            $ajax=new $ficher();
            echo json_encode($ajax->DoRequest($this));
        }else {
            throw new Exception("l'action ".$ficher." n'exite pas");
        }
       
    }
    private function pageCssView()
    {
        $page = $this->classCss();
        try {
            $p = new $page();
          echo  $p->cssView();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    private function getContentType($namefile)
    {
        $name = substr($namefile, strripos ($namefile, "."));
        $name = str_replace(".", "", $name);
       
        if (isset($this->contentType[trim($name)])){
            return $this->contentType[trim($name)];
        }else {
            return false;
        }
        
    }
    private function getContentTypeImage($namefile)
    {
        $name = substr($namefile, - 3);
        $name = str_replace(".", "", $name);
        if (isset($this->contentTypeImage[strtolower(trim($name))])){
            return $this->contentTypeImage[strtolower(trim($name))];
        }else {
            return false;
        }
        
    }
    private function pageView()
    {
        $page = $this->classPage();
        try {
            $p = new $page();
        } catch (Exception $e) {
            $p = new error404($e);
        }

        $p = $p->ifRedirection("error404");
        echo $p->getHeader();
        ?>
<body>
    <?php
        echo $p->getbody();
        ?>
       </body>
</html>
<?php
    }

    private function setAdressePage($val)
    {
        $this->adressePage[] = $val;
    }

    public function getAdressePage($i)
    {
        return $this->adressePage[$i];
    }

    public function GetValue($key)
    {
        if (isset($_GET[$key]) && ! empty($_GET[$key])) {
            return $_GET[$key];
        }
        return false;
    }

    public function PostValue($key)
    {
        if (isset($_POST[$key]) && ! empty($_POST[$key])) {
            return $_POST[$key];
        }
        return false;
    }

    public function setParam($name, $value)
    {
        $this->param[$name] = $value;
    }

    public function getParam($name)
    {
        if (isset($this->param[$name])) {
            return $this->param[$name];
        }
        return "";
    }

    public function getParamGet($name)
    {
        if (isset($_GET[$name])) {
            return $_GET[$name];
        }
    }

    public function getUriPath()
    {
        return $_SERVER["SERVER_NAME"];
    }

    public function getAddUrl()
    {
        $adr = str_replace("/", "", $_SERVER["REQUEST_URI"]);
        $adr = str_replace("-", "", $adr);
        $adr = str_replace(".php", "", $adr);
        if (empty($adr)) {
            return "index";
        }
        return $adr;
    }

    public function IPclient()
    {
        $ipkeys = array(
            'REMOTE_ADDR',
            'HTTP_CLIENT_IP',
            'HTTP_X_FORWARDED_FOR',
            'HTTP_X_FORWARDED',
            'HTTP_FORWARDED_FOR',
            'HTTP_FORWARDED',
            'HTTP_X_CLUSTER_CLIENT_IP'
        );
        foreach ($ipkeys as $value) {
            if (isset($_SERVER[$value]) && ! empty($_SERVER[$value])) {
                return $_SERVER[$value];
            }
        }
        return false;
    }

    public function changeSession()
    {}

    public function activerSesstion()
    {
        session_start();
    }
}
