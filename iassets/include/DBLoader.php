<?php
//DBLoader.php
$objGlobalVar = new GlobalVarTools();

$objFileToolsDBInfo = (new FileTools(dirname(__FILE__,3) . "/idefine/conf/online.iw"))->KeyValueFileReader();

if ((new IPTools(dirname(__FILE__,3) . "/idefine/"))->getHostAddressLoad() == 'localhost')
    $objFileToolsDBInfo = (new FileTools(dirname(__FILE__,3) . "/idefine/conf/local.iw"))->KeyValueFileReader();

$objORM = new DBORM((new MySQLConnection($objFileToolsDBInfo))->getConn());