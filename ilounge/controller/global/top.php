<?php
///controller/global/top.php


 function get_website_data()
{ 
    include dirname(__FILE__,4) . "/iassets/include/DBLoader.php";
    $Enabled = BoolEnum::BOOL_TRUE();

   return  @$objORM->Fetch(" Enabled = $Enabled ", '*', TableIWWebSiteInfo);
}

function get_website_alert($type)
{ 
    include dirname(__FILE__,4) . "/iassets/include/DBLoader.php";
    $Enabled = BoolEnum::BOOL_TRUE();

   return  @$objORM->Fetch(" Enabled = $Enabled and alert_type = '$type' ", '*', TableIWWebSiteAlert);
}

