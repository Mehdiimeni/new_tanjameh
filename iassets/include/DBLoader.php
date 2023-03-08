<?php
//DBLoader.php
$objGlobalVar = new GlobalVarTools();
$objFileToolsDBInfo = (new FileTools(IW_DEFINE_FROM_PANEL . "conf/online.iw"))->KeyValueFileReader();

if ((new IPTools(IW_DEFINE_FROM_PANEL))->getHostAddressLoad() == 'localhost')
    $objFileToolsDBInfo = (new FileTools(IW_DEFINE_FROM_PANEL . "conf/local.iw"))->KeyValueFileReader();

//var_dump($objFileToolsDBInfo);
//exit();
$objORM = new DBORM((new MySQLConnection($objFileToolsDBInfo))->getConn());