<?php
require_once 'autoLoad.php';
autoLoad::autoLoad();
$http = httpRequest::getInstance();
$http->activerSesstion();
$http->ExtracteData();
$http->router();
?>
