<?php
//index.php 

require dirname(__FILE__, 1) ."/vendor/autoload.php";
SessionTools::init();


(new ConfigTools(dirname(__FILE__, 1)."/idefine/"))->StoperCheck(1);
$objFileToolsInit = new FileTools(dirname(__FILE__, 1)."/idefine/" . "conf/init.iw");

(new MakeDirectory)->MKDir(dirname(__FILE__, 1)."/irepository/" . 'log/error/', 'iweb', 0755);
$objInitTools = new InitTools($objFileToolsInit->KeyValueFileReader(), dirname(__FILE__, 1)."/irepository/" . 'log/error/iweb/viewerror.log');

(new IWCheckTools((new GlobalVarTools())->GetVarToJson(), dirname(__FILE__, 1)."/idefine/"))->IWKEYShower(dirname(__FILE__, 1)."/idefine/" . "conf/key.iw");
new IPTools(dirname(__FILE__, 1)."/idefine/");

include dirname(__FILE__, 1)."/idefine/" . "lang/" . $objInitTools->getLang() . "_web.php";

$objGlobalVar = new GlobalVarTools();
$objACL = new ACLTools();

if ($objGlobalVar->JsonDecode($objGlobalVar->ServerVarToJson())->HTTP_HOST == 'localhost')
    error_reporting(E_ALL);

require_once dirname(__FILE__, 1)."/idefine/" . 'conf/tablename.php';
require_once dirname(__FILE__, 1)."/idefine/" . 'conf/viewname.php';
require_once dirname(__FILE__, 1)."/idefine/" . 'conf/functionname.php';
require_once dirname(__FILE__, 1)."/idefine/" . 'conf/procedurename.php';
require( dirname(__FILE__, 1)."/iweb/core/urls.php");
exit();