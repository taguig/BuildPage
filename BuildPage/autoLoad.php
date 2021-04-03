<?php

/** 
 * @author 2019
 * 
 */
class autoLoad
{
    private static $path = [];
    public static function autoLoad()
    {
        spl_autoload_register(function ($class) {

            if (empty(self::$path)) {
                self::$path = self::getPath();
            }
            if (empty(self::$path[$class])) {
             
                throw new Exception("class introuvable :" . $class);
            }
            require_once(self::$path[$class]);
        });
    }

    public static function getPath()
    {
        $path = [];
        $path["deleteRequet"] = "ConstructeurRequete/mysql/deleteRequet.php";
        $path["Format"] = "ConstructeurRequete/mysql/Format.php";
        $path["insertRequete"] = "ConstructeurRequete/mysql/insertRequete.php";
        $path["Requequete"] = "ConstructeurRequete/mysql/Requequete.php";
        $path["selectRequet"] = "ConstructeurRequete/mysql/selectRequet.php";
        $path["updateRequet"] = "ConstructeurRequete/mysql/updateRequet.php";
        $path["ConstructeurRequete"] = "ConstructeurRequete/ConstructeurRequete.php";
        $path["requete"] = "ConstructeurRequete/requete.php";
        
        $path["Event"] = "Event/Event.php";
        $path["MangerEvent"] = "Event/MangerEvent.php";
        $path["httpRequest"] = "http/httpRequest.php";


        $path["Index"] = "page/Index.php";
        $path["buildViewCustome"] = "view/buildView/customBuildView/buildViewCustome.php";
        $path["buildViewItem"] = "view/buildView/customBuildView/buildViewItem.php";
        $path["BuildView"] = "view/BuildView.php";
        
        $path["buildViewForm"] = "view/buildView/buildViewForm.php";
        $path["buildForm"] = "view/complexView/buildForm.php";
        $path["buildSection"] = "view/complexView/buildSection.php";
        $path["buildArticle"] = "view/complexView/buildArticle.php";
        $path["buildHeader"] = "view/complexView/buildHeader.php";
        $path["buildNav"] = "view/complexView/buildNav.php";
        $path["buildFooter"] = "view/complexView/buildFooter.php";
        $path["buildUl"] = "view/complexView/buildUl.php";
        $path["buildLi"] = "view/complexView/buildLi.php";
        
       
        
        $path["inputText"] = "view/simpleView/formulaire/inputText.php";
        $path["itemFormul"] = "view/simpleView/formulaire/itemFormul.php";
        $path["view"] = "view/view.php";
        $path["listOption"] = "view/simpleView/formulaire/listOption.php";
        $path["ColorPike"]="view/simpleView/formulaire/ColorPike.php";
        $path["page"]="page/page.php";
        $path["Home"]="page/page/Home.php";
        $path["error404"]="page/pageErorre/error404.php";
        $path["Data"]="option/Data.php";
        $path["option"]="option/option.php";
        $path["model"]="option/model/model.php";
        $path["PDOMYSQL"]="option/pdo/PDOMYSQL.php";
        
        
        $path["PageCss"]="dynamicCss/superCss/PageCss.php";
        $path["MediaPageCss"]="dynamicCss/superCss/MediaPageCss.php";
        $path["Testcss"]="dynamicCss/Testcss.php";
        
        $path["Iaction"]="ajax/interface/Iaction.php";
        
        $path["validator"]="utile/validator.php";
        $path["fontUrl"]="utile/fontUrl.php";
        $path["cssUrl"]="utile/cssurl.php";
        $path["jsurl"]="utile/jsurl.php";
        $path["utile"]="utile/utile.php";

        $path["IbuildView"]="view/IbuildView.php";
        
        $path["menuItem"] = "view/menuView/menuSimple/menuItem.php";
        $path["menuSimple"] = "view/menuView/menuSimple/menuSimple.php";
        $path["menuPrencipal"] = "view/menuView/menuSimple/menuPrencipal.php";
        $path["buildMenu"] = "view/menuView/menuSimple/buildMenu.php";
        $path["slideView"] = "view/slideView/slideView.php";
        $path["itemSlideView"] = "view/slideView/itemSlideView.php";
        
        $path["linkView"] = "view/simpleView/linkView.php";
        
        
        $path["logoImage"] = "view\headerView\logoHeader\model\logoImage.php";
        $path["logoText"] = "view\headerView\logoHeader\model\logoText.php";
        $path["modelHeader"] = "view\headerView\model\modelHeader.php";
        $path["modelHeader_1"] = "view\headerView\model\modelHeader_1.php";
        $path["builderIcon"] = "view\headerView\icon\builderIcon.php";
        $path["itemIcon"] = "view\headerView\icon\itemIcon.php";
        
        $path["TextLimage"] = "view/complexView/textImage/TextLimage.php";
        
        $path["buildContaineur"] = "view/buildView/buildContaineur.php";
     
        return  $path;
    }
    /**
     */
    public function __construct()
    {
    }
}
