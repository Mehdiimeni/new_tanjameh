<?php
//index.php 


require dirname(__FILE__, 2) ."/vendor/autoload.php";
SessionTools::init();


(new ConfigTools(dirname(__FILE__, 2)."/idefine/"))->StoperCheck(1);
$objFileToolsInit = new FileTools(dirname(__FILE__, 2)."/idefine/" . "conf/init.iw");

(new MakeDirectory)->MKDir(dirname(__FILE__, 2)."/irepository/" . 'log/error/', 'ilounge', 0755);
$objInitTools = new InitTools($objFileToolsInit->KeyValueFileReader(), dirname(__FILE__, 2)."/irepository/" . 'log/error/ilounge/viewerror.log');

(new IWCheckTools((new GlobalVarTools())->GetVarToJson(), dirname(__FILE__, 2)."/idefine/"))->IWKEYShower(dirname(__FILE__, 2)."/idefine/" . "conf/key.iw");
new IPTools(dirname(__FILE__, 2)."/idefine/");

include dirname(__FILE__, 2)."/idefine/" . "lang/" . $objInitTools->getLang() . "_web.php";

$objGlobalVar = new GlobalVarTools();
$objACL = new ACLTools();

if ($objGlobalVar->JsonDecode($objGlobalVar->ServerVarToJson())->HTTP_HOST == 'localhost')
    error_reporting(E_ALL);

require_once dirname(__FILE__, 2)."/idefine/" . 'conf/tablename.php';
require_once dirname(__FILE__, 2)."/idefine/" . 'conf/viewname.php';
require_once dirname(__FILE__, 2)."/idefine/" . 'conf/functionname.php';
require_once dirname(__FILE__, 2)."/idefine/" . 'conf/procedurename.php';
require( dirname(__FILE__, 1)."/core/urls.php");
exit();