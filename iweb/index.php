<?php

require_once "../vendor/autoload.php";
SessionTools::init();
require_once "../idefine/conf/root.php";


(new ConfigTools(IW_DEFINE_FROM_PANEL))->StoperCheck(1);
$objFileToolsInit = new FileTools(IW_DEFINE_FROM_PANEL . "conf/init.iw");

(new MakeDirectory)->MKDir(IW_REPOSITORY_FROM_PANEL . 'log/error/', 'iweb', 0755);
$objInitTools = new InitTools($objFileToolsInit->KeyValueFileReader(), IW_REPOSITORY_FROM_PANEL . 'log/error/iweb/viewerror.log');

(new IWCheckTools((new GlobalVarTools())->GetVarToJson(), IW_DEFINE_FROM_PANEL))->IWKEYShower(IW_DEFINE_FROM_PANEL . "conf/key.iw");
new IPTools(IW_DEFINE_FROM_PANEL);

include IW_DEFINE_FROM_PANEL . "lang/" . $objInitTools->getLang() . ".php";
include IW_DEFINE_FROM_PANEL . "lang/pfa.php";

$objGlobalVar = new GlobalVarTools();
$objACL = new ACLTools();

if ($objGlobalVar->JsonDecode($objGlobalVar->ServerVarToJson())->HTTP_HOST == 'localhost')
    error_reporting(E_ALL);

require_once IW_DEFINE_FROM_PANEL . 'conf/tablename.php';
require_once IW_DEFINE_FROM_PANEL . 'conf/viewname.php';
require_once IW_DEFINE_FROM_PANEL . 'conf/functionname.php';
require_once IW_DEFINE_FROM_PANEL . 'conf/procedurename.php';


// Translate part
//include "./view/GlobalPage/Translator.php";


(new FileCaller)->FileIncluderWithControler(IW_MAIN_ROOT_FROM_PANEL . IW_WEB_FOLDER, 'GlobalPage', 'PageLoader');

exit();
