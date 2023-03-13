<?php
//PageLoader.php

include IW_ASSETS_FROM_PANEL . "include/PageAction.php";

if (@$_GET['ProductList'] != null) {
    (new FileCaller)->FileIncluderWithControler(IW_MAIN_ROOT_FROM_PANEL . IW_WEB_FOLDER, 'Product', 'Category2');
    exit();
}

if (@$objGlobalVar->JsonDecode($objGlobalVar->GetVarToJson())->part == null) {


    if (@$_GET['Category'] != null) {
        (new FileCaller)->FileIncluderWithControler(IW_MAIN_ROOT_FROM_PANEL . IW_WEB_FOLDER, 'Product', 'Category');
        exit();
    }



    if (@$_GET['Search'] != null) {
        (new FileCaller)->FileIncluderWithControler(IW_MAIN_ROOT_FROM_PANEL . IW_WEB_FOLDER, 'Product', 'Search');
        exit();
    }


    if (@$_GET['Gender'] != null) {
        (new FileCaller)->FileIncluderWithControler(IW_MAIN_ROOT_FROM_PANEL . IW_WEB_FOLDER, 'First', 'Root');
        exit();
    }

    (new FileCaller)->FileIncluderWithControler(IW_MAIN_ROOT_FROM_PANEL . IW_WEB_FOLDER, 'First', 'First');
    exit();

} else {


    $strPart = $objGlobalVar->CleanUrlDirMaker(@$objGlobalVar->JsonDecode($objGlobalVar->GetVarToJson())->part);
    $strPage = $objGlobalVar->CleanUrlDirMaker(@$objGlobalVar->JsonDecode($objGlobalVar->GetVarToJson())->page);
    $strModify = @$objGlobalVar->JsonDecode($objGlobalVar->GetVarToJsonNoSet())->modify;
    if ($strPart != null and $strPage != null) {
        if ($strModify == null) {
            (new FileCaller)->FileIncluderWithControler(IW_MAIN_ROOT_FROM_PANEL . IW_WEB_FOLDER, $strPart, $strPage);
        } else {
            (new FileCaller)->FileModifyIncluderWithControler(IW_MAIN_ROOT_FROM_PANEL . IW_WEB_FOLDER, $strPart, $strPage, $strModify);
        }
    }else
    {
        (new FileCaller)->FileIncluderWithControler(IW_MAIN_ROOT_FROM_PANEL . IW_WEB_FOLDER, 'First', 'First');
    }
    exit();

}

