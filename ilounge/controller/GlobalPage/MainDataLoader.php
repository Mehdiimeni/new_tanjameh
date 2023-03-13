<?php
// MainDataLoader.php
// update at 7/3/2022

require_once IW_DEFINE_FROM_PANEL . "queryset/CatQuerySetArray.php";
// API Count and Connect

$objAsos = new AsosConnections();
$objAclTools = new ACLTools();
$objTimeTools = new TimeTools();
$Enabled = BoolEnum::BOOL_TRUE();

$ModifyIP = (new IPTools(IW_DEFINE_FROM_PANEL))->getUserIP();
$ModifyTime = $objTimeTools->jdate("H:i:s");
$ModifyDate = $objTimeTools->jdate("Y/m/d");
$ModifyStrTime = $objAclTools->JsonDecode($objTimeTools->getDateTimeNow())->date;

$AllCategoriesContent = $objAsos->CategoriesList();
$ModifyDateNow = $objAclTools->Nu2EN($objTimeTools->jdate("Y/m/d"));


if ($objORM->DataExist("CompanyIdKey = '4a897b83' and ModifyDate != '$ModifyDateNow'", TableIWAPIAllData)) {


    $strExpireDate = date("m-Y");
    $UCondition = " CompanyIdKey = '4a897b83' and ExpireDate = '$strExpireDate' ";
    $USet = " Count = Count + 1 ";
    $objORM->DataUpdate($UCondition, $USet, TableIWAPIAllConnect);

    $UCondition = " CompanyIdKey = '4a897b83' ";
    $USet = "";
    $USet .= " Content = '$AllCategoriesContent' ,";
    $USet .= " ModifyIP = '$ModifyIP' ,";
    $USet .= " ModifyTime = '$ModifyTime' ,";
    $USet .= " ModifyDate = '$ModifyDate' ,";
    $USet .= " ModifyStrTime = '$ModifyStrTime' ";


    $objORM->DataUpdate($UCondition, $USet, TableIWAPIAllData);
} elseif (!$objORM->DataExist("CompanyIdKey = '4a897b83' ", TableIWAPIAllData)) {
    $IdKey = $objAclTools->IdKey();

    $ModifyStrTime = $objAclTools->JsonDecode($objTimeTools->getDateTimeNow())->date;
    $ModifyId = @$objGlobalVar->JsonDecode($objGlobalVar->getIWVarToJson('_IWAdminIdKey'));
    $InSet = "";
    $InSet .= " IdKey = '$IdKey' ,";
    $InSet .= " Enabled = '$Enabled' ,";
    $InSet .= " CompanyIdKey = '4a897b83' ,";
    $InSet .= " ReplacePeriod = 1 ,";
    $InSet .= " Content = '$AllCategoriesContent' ,";
    $InSet .= " ModifyIP = '$ModifyIP' ,";
    $InSet .= " ModifyTime = '$ModifyTime' ,";
    $InSet .= " ModifyDate = '$ModifyDate' ,";
    $InSet .= " ModifyStrTime = '$ModifyStrTime', ";
    $InSet .= " ModifyId = '' ";

    $objORM->DataAdd($InSet, TableIWAPIAllData);
}


$SCondition = " Enabled = $Enabled  and CompanyIdKey = '4a897b83' and ModifyDate = '$ModifyDateNow' ";
$IWAPIAllCategories = $objORM->Fetch($SCondition, 'ModifyDate,Content', TableIWAPIAllData);
$arrAllApiContent = $objAclTools->JsonDecodeArray($objAclTools->deBase64($IWAPIAllCategories->Content));


//Products

foreach ($arrAllApiContent["navigation"] as $AllApi1) {
    foreach ($AllApi1["children"] as $AllApi2) {

        if (is_array($AllApi2['children']) and count($AllApi2['children']) <= 1)
            continue;

        foreach ($AllApi2['children'] as $AllApi3) {
            if (is_array($AllApi3['link']) and count($AllApi3['link']) > 2) {

                if ($AllApi3['link']['categoryId'] != '' and $AllApi3['link']['webUrl']) {
                    $parts = parse_url($AllApi3['link']['webUrl']);
                    $parts['path'] = str_replace('"', "", $parts['path']);
                    $parts['path'] = str_replace("'", "", $parts['path']);
                    $arrPath = array_filter(explode("/", $parts['path']));
                    unset($arrPath[count($arrPath)]);


                    $IdKey = $objAclTools->IdKey();
                    $CategoryId = $AllApi3['link']['categoryId'];
                    $strAddress = $AllApi3['link']['webUrl'];
                    $strTitle = $AllApi3['content']['title'];
                    $strTitle = str_replace('"', "", $strTitle);
                    $strTitle = str_replace("'", "", $strTitle);

                    if (!$objORM->DataExist("CategoryId = '$CategoryId'", TableIWAPIAllCat)) {

                        $TypeSet = 'Product';
                        if (in_array($arrPath[2], ARR_PRIORITY2))
                            $TypeSet = 'Tag';


                        $InSet = "";
                        $InSet .= " IdKey = '$IdKey' ,";
                        $InSet .= " Enabled = '$Enabled' ,";
                        $InSet .= " Address = '$strAddress' ,";
                        $InSet .= " CategoryId = '$CategoryId' ,";
                        $InSet .= " Main = '$arrPath[1]' ,";
                        $InSet .= " Sub = '$arrPath[2]' ,";
                        $InSet .= " TypeSet = '$TypeSet' ,";
                        $InSet .= " Title = '$strTitle' ,";
                        $InSet .= " ModifyIP = '$ModifyIP' ,";
                        $InSet .= " ModifyTime = '$ModifyTime' ,";
                        $InSet .= " ModifyDate = '$ModifyDate' ,";
                        $InSet .= " ModifyStrTime = '$ModifyStrTime' ";

                        if (isset($arrPath[3]))
                            $InSet .= ", Sub2 = '$arrPath[3]' ";
                        if (isset($arrPath[4]))
                            $InSet .= ", Sub3 = '$arrPath[4]' ";
                        if (isset($arrPath[5]))
                            $InSet .= ", Sub4 = '$arrPath[5]' ";


                        $objORM->DataAdd($InSet, TableIWAPIAllCat);
                        $SubRootLocalName = '';

                    } elseif ($objORM->DataExist("CategoryId = '$CategoryId' and Sub != '$arrPath[2]' ", TableIWAPIAllCat)) {

                        $TypeSet = 'Product';
                        if (in_array($arrPath[2], ARR_PRIORITY2))
                            $TypeSet = 'Tag';


                        $USet = "";
                        $USet .= " Address = '$strAddress' ,";
                        $USet .= " CategoryId = '$CategoryId' ,";
                        $USet .= " Main = '$arrPath[1]' ,";
                        $USet .= " Sub = '$arrPath[2]' ,";
                        $USet .= " TypeSet = '$TypeSet' ,";
                        $USet .= " Title = '$strTitle' ,";
                        $USet .= " ModifyIP = '$ModifyIP' ,";
                        $USet .= " ModifyTime = '$ModifyTime' ,";
                        $USet .= " ModifyDate = '$ModifyDate' ,";
                        $USet .= " ModifyStrTime = '$ModifyStrTime' ";


                        if (isset($arrPath[3]))
                            $USet .= ", Sub2 = '$arrPath[3]' ";
                        if (isset($arrPath[4]))
                            $USet .= ", Sub3 = '$arrPath[4]' ";
                        if (isset($arrPath[5]))
                            $USet .= ", Sub4 = '$arrPath[5]' ";

                        $objORM->DataUpdate("CategoryId = '$CategoryId'", $USet, TableIWAPIAllCat);

                    }


                }

            }


            if (is_array($AllApi3['children']) and count($AllApi3['children']) <= 1)
                continue;

            foreach ($AllApi3['children'] as $AllApi4) {
                if (is_array($AllApi4['link']) and count($AllApi4['link']) > 2) {

                    if ($AllApi4['link']['categoryId'] != '' and $AllApi4['link']['webUrl']) {
                        $parts = parse_url($AllApi4['link']['webUrl']);
                        $arrPath = array_filter(explode("/", $parts['path']));
                        unset($arrPath[count($arrPath)]);


                        $IdKey = $objAclTools->IdKey();
                        $CategoryId = $AllApi4['link']['categoryId'];
                        $strAddress = $AllApi4['link']['webUrl'];
                        $strTitle = $AllApi4['content']['title'];
                        $strTitle = str_replace('"', "", $strTitle);
                        $strTitle = str_replace("'", "", $strTitle);

                        if (!$objORM->DataExist("CategoryId = '$CategoryId'", TableIWAPIAllCat)) {

                            $TypeSet = 'Product';
                            if (in_array($arrPath[2], ARR_PRIORITY2))
                                $TypeSet = 'Tag';


                            $InSet = "";
                            $InSet .= " IdKey = '$IdKey' ,";
                            $InSet .= " Enabled = '$Enabled' ,";
                            $InSet .= " Address = '$strAddress' ,";
                            $InSet .= " CategoryId = '$CategoryId' ,";
                            $InSet .= " Main = '$arrPath[1]' ,";
                            $InSet .= " Sub = '$arrPath[2]' ,";
                            $InSet .= " TypeSet = '$TypeSet' ,";
                            $InSet .= " Title = '$strTitle' ,";
                            $InSet .= " ModifyIP = '$ModifyIP' ,";
                            $InSet .= " ModifyTime = '$ModifyTime' ,";
                            $InSet .= " ModifyDate = '$ModifyDate' ,";
                            $InSet .= " ModifyStrTime = '$ModifyStrTime' ";

                            if (isset($arrPath[3]))
                                $InSet .= ", Sub2 = '$arrPath[3]' ";
                            if (isset($arrPath[4]))
                                $InSet .= ", Sub3 = '$arrPath[4]' ";
                            if (isset($arrPath[5]))
                                $InSet .= ", Sub4 = '$arrPath[5]' ";


                            $objORM->DataAdd($InSet, TableIWAPIAllCat);
                            $SubRootLocalName = '';

                        } elseif ($objORM->DataExist("CategoryId = '$CategoryId' and Sub != '$arrPath[2]' ", TableIWAPIAllCat)) {

                            $TypeSet = 'Product';
                            if (in_array($arrPath[2], ARR_PRIORITY2))
                                $TypeSet = 'Tag';


                            $USet = "";
                            $USet .= " Address = '$strAddress' ,";
                            $USet .= " CategoryId = '$CategoryId' ,";
                            $USet .= " Main = '$arrPath[1]' ,";
                            $USet .= " Sub = '$arrPath[2]' ,";
                            $USet .= " TypeSet = '$TypeSet' ,";
                            $USet .= " Title = '$strTitle' ,";
                            $USet .= " ModifyIP = '$ModifyIP' ,";
                            $USet .= " ModifyTime = '$ModifyTime' ,";
                            $USet .= " ModifyDate = '$ModifyDate' ,";
                            $USet .= " ModifyStrTime = '$ModifyStrTime' ";


                            if (isset($arrPath[3]))
                                $USet .= ", Sub2 = '$arrPath[3]' ";
                            if (isset($arrPath[4]))
                                $USet .= ", Sub3 = '$arrPath[4]' ";
                            if (isset($arrPath[5]))
                                $USet .= ", Sub4 = '$arrPath[5]' ";

                            $objORM->DataUpdate("CategoryId = '$CategoryId'", $USet, TableIWAPIAllCat);

                        }


                    }
                }


                if (is_array($AllApi4['children']) and count($AllApi4['children']) <= 1)
                    continue;


                foreach ($AllApi4['children'] as $AllApi5) {
                    if (is_array($AllApi5['link']) and count($AllApi5['link']) > 2) {
                        if ($AllApi5['link']['categoryId'] != '' and $AllApi5['link']['webUrl']) {
                            $parts = parse_url($AllApi5['link']['webUrl']);

                            $stePath = str_replace('"', "", $parts['path']);
                            $stePath = str_replace("'", "", $stePath);

                            $arrPath = array_filter(explode("/", $stePath));


                            unset($arrPath[count($arrPath)]);


                            $IdKey = $objAclTools->IdKey();
                            $CategoryId = $AllApi5['link']['categoryId'];
                            $strAddress = $AllApi5['link']['webUrl'];
                            $strTitle = $AllApi5['content']['title'];
                            $strTitle = str_replace('"', "", $strTitle);
                            $strTitle = str_replace("'", "", $strTitle);


                            if (!$objORM->DataExist("CategoryId = '$CategoryId'", TableIWAPIAllCat)) {

                                $TypeSet = 'Product';
                                if (in_array($arrPath[2], ARR_PRIORITY2))
                                    $TypeSet = 'Tag';


                                $InSet = "";
                                $InSet .= " IdKey = '$IdKey' ,";
                                $InSet .= " Enabled = '$Enabled' ,";
                                $InSet .= " Address = '$strAddress' ,";
                                $InSet .= " CategoryId = '$CategoryId' ,";
                                $InSet .= " Main = '$arrPath[1]' ,";
                                $InSet .= " Sub = '$arrPath[2]' ,";
                                $InSet .= " TypeSet = '$TypeSet' ,";
                                $InSet .= " Title = '$strTitle' ,";
                                $InSet .= " ModifyIP = '$ModifyIP' ,";
                                $InSet .= " ModifyTime = '$ModifyTime' ,";
                                $InSet .= " ModifyDate = '$ModifyDate' ,";
                                $InSet .= " ModifyStrTime = '$ModifyStrTime' ";

                                if (isset($arrPath[3]))
                                    $InSet .= ", Sub2 = '$arrPath[3]' ";
                                if (isset($arrPath[4]))
                                    $InSet .= ", Sub3 = '$arrPath[4]' ";
                                if (isset($arrPath[5]))
                                    $InSet .= ", Sub4 = '$arrPath[5]' ";


                                $objORM->DataAdd($InSet, TableIWAPIAllCat);
                                $SubRootLocalName = '';

                            } elseif ($objORM->DataExist("CategoryId = '$CategoryId' and Sub != '$arrPath[2]' ", TableIWAPIAllCat)) {

                                $TypeSet = 'Product';
                                if (in_array($arrPath[2], ARR_PRIORITY2))
                                    $TypeSet = 'Tag';

                                $USet = "";
                                $USet .= " Address = '$strAddress' ,";
                                $USet .= " CategoryId = '$CategoryId' ,";
                                $USet .= " Main = '$arrPath[1]' ,";
                                $USet .= " Sub = '$arrPath[2]' ,";
                                $USet .= " TypeSet = '$TypeSet' ,";
                                $USet .= " Title = '$strTitle' ,";
                                $USet .= " ModifyIP = '$ModifyIP' ,";
                                $USet .= " ModifyTime = '$ModifyTime' ,";
                                $USet .= " ModifyDate = '$ModifyDate' ,";
                                $USet .= " ModifyStrTime = '$ModifyStrTime' ";


                                if (isset($arrPath[3]))
                                    $USet .= ", Sub2 = '$arrPath[3]' ";

                                if (isset($arrPath[4]))
                                    $USet .= ", Sub3 = '$arrPath[4]' ";
                                if (isset($arrPath[5]))
                                    $USet .= ", Sub4 = '$arrPath[5]' ";

                                $objORM->DataUpdate("CategoryId = '$CategoryId'", $USet, TableIWAPIAllCat);

                            }


                        }
                    }


                    if (is_array($AllApi5['children']) and count($AllApi5['children']) <= 1)
                        continue;


                }


            }


        }

    }

}

//Brands
foreach ($arrAllApiContent["brands"] as $AllApi1) {
    foreach ($AllApi1["children"] as $AllApi2) {

        if (is_array($AllApi2['link']) and count($AllApi2['link']) > 2) {

            if ($AllApi2['link']['categoryId'] != '' and $AllApi2['link']['webUrl']) {
                $parts = parse_url($AllApi2['link']['webUrl']);
                $parts['path'] = str_replace('"', "", $parts['path']);
                $parts['path'] = str_replace("'", "", $parts['path']);
                $arrPath = array_filter(explode("/", $parts['path']));
                unset($arrPath[count($arrPath)]);


                $IdKey = $objAclTools->IdKey();
                $CategoryId = $AllApi2['link']['categoryId'];
                $strAddress = $AllApi2['link']['webUrl'];
                $strTitle = $AllApi2['content']['title'];
                $strTitle = str_replace('"', "", $strTitle);
                $strTitle = str_replace("'", "", $strTitle);

                if (!$objORM->DataExist("CategoryId = '$CategoryId'", TableIWAPIAllCat)) {

                    $InSet = "";
                    $InSet .= " IdKey = '$IdKey' ,";
                    $InSet .= " Enabled = '$Enabled' ,";
                    $InSet .= " Address = '$strAddress' ,";
                    $InSet .= " CategoryId = '$CategoryId' ,";
                    $InSet .= " Main = '$arrPath[1]' ,";
                    $InSet .= " Sub = '$arrPath[2]' ,";
                    $InSet .= " TypeSet = 'Brand' ,";
                    $InSet .= " Title = '$strTitle' ,";
                    $InSet .= " ModifyIP = '$ModifyIP' ,";
                    $InSet .= " ModifyTime = '$ModifyTime' ,";
                    $InSet .= " ModifyDate = '$ModifyDate' ,";
                    $InSet .= " ModifyStrTime = '$ModifyStrTime' ";

                    if (isset($arrPath[3]))
                        $InSet .= ", Sub2 = '$arrPath[3]' ";
                    if (isset($arrPath[4]))
                        $InSet .= ", Sub3 = '$arrPath[4]' ";
                    if (isset($arrPath[5]))
                        $InSet .= ", Sub4 = '$arrPath[5]' ";


                    $objORM->DataAdd($InSet, TableIWAPIAllCat);
                    $SubRootLocalName = '';

                } elseif ($objORM->DataExist("CategoryId = '$CategoryId' and Sub != '$arrPath[2]' ", TableIWAPIAllCat)) {

                    $USet = "";
                    $USet .= " Address = '$strAddress' ,";
                    $USet .= " CategoryId = '$CategoryId' ,";
                    $USet .= " Main = '$arrPath[1]' ,";
                    $USet .= " Sub = '$arrPath[2]' ,";
                    $USet .= " TypeSet = 'Brand' ,";
                    $USet .= " Title = '$strTitle' ,";
                    $USet .= " ModifyIP = '$ModifyIP' ,";
                    $USet .= " ModifyTime = '$ModifyTime' ,";
                    $USet .= " ModifyDate = '$ModifyDate' ,";
                    $USet .= " ModifyStrTime = '$ModifyStrTime' ";


                    if (isset($arrPath[3]))
                        $USet .= ", Sub2 = '$arrPath[3]' ";
                    if (isset($arrPath[4]))
                        $USet .= ", Sub3 = '$arrPath[4]' ";
                    if (isset($arrPath[5]))
                        $USet .= ", Sub4 = '$arrPath[5]' ";

                    $objORM->DataUpdate("CategoryId = '$CategoryId'", $USet, TableIWAPIAllCat);

                }


            }

        }

        if (is_array($AllApi2['children']) and count($AllApi2['children']) <= 1)
            continue;

        foreach ($AllApi2['children'] as $AllApi3) {
            if (is_array($AllApi3['link']) and count($AllApi3['link']) > 2) {

                if ($AllApi3['link']['categoryId'] != '' and $AllApi3['link']['webUrl']) {
                    $parts = parse_url($AllApi3['link']['webUrl']);
                    $parts['path'] = str_replace('"', "", $parts['path']);
                    $parts['path'] = str_replace("'", "", $parts['path']);
                    $arrPath = array_filter(explode("/", $parts['path']));
                    unset($arrPath[count($arrPath)]);


                    $IdKey = $objAclTools->IdKey();
                    $CategoryId = $AllApi3['link']['categoryId'];
                    $strAddress = $AllApi3['link']['webUrl'];

                    if (!$objORM->DataExist("CategoryId = '$CategoryId'", TableIWAPIAllCat)) {

                        $InSet = "";
                        $InSet .= " IdKey = '$IdKey' ,";
                        $InSet .= " Enabled = '$Enabled' ,";
                        $InSet .= " Address = '$strAddress' ,";
                        $InSet .= " CategoryId = '$CategoryId' ,";
                        $InSet .= " Main = '$arrPath[1]' ,";
                        $InSet .= " Sub = '$arrPath[2]' ,";
                        $InSet .= " TypeSet = 'Brand' ,";
                        $InSet .= " Title = '$strTitle' ,";
                        $InSet .= " ModifyIP = '$ModifyIP' ,";
                        $InSet .= " ModifyTime = '$ModifyTime' ,";
                        $InSet .= " ModifyDate = '$ModifyDate' ,";
                        $InSet .= " ModifyStrTime = '$ModifyStrTime' ";

                        if (isset($arrPath[3]))
                            $InSet .= ", Sub2 = '$arrPath[3]' ";
                        if (isset($arrPath[4]))
                            $InSet .= ", Sub3 = '$arrPath[4]' ";
                        if (isset($arrPath[5]))
                            $InSet .= ", Sub4 = '$arrPath[5]' ";


                        $objORM->DataAdd($InSet, TableIWAPIAllCat);
                        $SubRootLocalName = '';

                    } elseif ($objORM->DataExist("CategoryId = '$CategoryId' and Sub != '$arrPath[2]' ", TableIWAPIAllCat)) {

                        $USet = "";
                        $USet .= " Address = '$strAddress' ,";
                        $USet .= " CategoryId = '$CategoryId' ,";
                        $USet .= " Main = '$arrPath[1]' ,";
                        $USet .= " Sub = '$arrPath[2]' ,";
                        $USet .= " TypeSet = 'Brand' ,";
                        $USet .= " Title = '$strTitle' ,";
                        $USet .= " ModifyIP = '$ModifyIP' ,";
                        $USet .= " ModifyTime = '$ModifyTime' ,";
                        $USet .= " ModifyDate = '$ModifyDate' ,";
                        $USet .= " ModifyStrTime = '$ModifyStrTime' ";


                        if (isset($arrPath[3]))
                            $USet .= ", Sub2 = '$arrPath[3]' ";
                        if (isset($arrPath[4]))
                            $USet .= ", Sub3 = '$arrPath[4]' ";
                        if (isset($arrPath[5]))
                            $USet .= ", Sub4 = '$arrPath[5]' ";

                        $objORM->DataUpdate("CategoryId = '$CategoryId'", $USet, TableIWAPIAllCat);

                    }


                }

            }


            if (is_array($AllApi3['children']) and count($AllApi3['children']) <= 1)
                continue;

            foreach ($AllApi3['children'] as $AllApi4) {
                if (is_array($AllApi4['link']) and count($AllApi4['link']) > 2) {

                    if ($AllApi4['link']['categoryId'] != '' and $AllApi4['link']['webUrl']) {
                        $parts = parse_url($AllApi4['link']['webUrl']);
                        $parts['path'] = str_replace('"', "", $parts['path']);
                        $parts['path'] = str_replace("'", "", $parts['path']);
                        $arrPath = array_filter(explode("/", $parts['path']));
                        unset($arrPath[count($arrPath)]);


                        $IdKey = $objAclTools->IdKey();
                        $CategoryId = $AllApi4['link']['categoryId'];
                        $strAddress = $AllApi4['link']['webUrl'];
                        $strTitle = $AllApi4['content']['title'];
                        $strTitle = str_replace('"', "", $strTitle);
                        $strTitle = str_replace("'", "", $strTitle);

                        if (!$objORM->DataExist("CategoryId = '$CategoryId'", TableIWAPIAllCat)) {

                            $InSet = "";
                            $InSet .= " IdKey = '$IdKey' ,";
                            $InSet .= " Enabled = '$Enabled' ,";
                            $InSet .= " Address = '$strAddress' ,";
                            $InSet .= " CategoryId = '$CategoryId' ,";
                            $InSet .= " Main = '$arrPath[1]' ,";
                            $InSet .= " Sub = '$arrPath[2]' ,";
                            $InSet .= " TypeSet = 'Brand' ,";
                            $InSet .= " Title = '$strTitle' ,";
                            $InSet .= " ModifyIP = '$ModifyIP' ,";
                            $InSet .= " ModifyTime = '$ModifyTime' ,";
                            $InSet .= " ModifyDate = '$ModifyDate' ,";
                            $InSet .= " ModifyStrTime = '$ModifyStrTime' ";

                            if (isset($arrPath[3]))
                                $InSet .= ", Sub2 = '$arrPath[3]' ";
                            if (isset($arrPath[4]))
                                $InSet .= ", Sub3 = '$arrPath[4]' ";
                            if (isset($arrPath[5]))
                                $InSet .= ", Sub4 = '$arrPath[5]' ";


                            $objORM->DataAdd($InSet, TableIWAPIAllCat);
                            $SubRootLocalName = '';

                        } elseif ($objORM->DataExist("CategoryId = '$CategoryId' and Sub != '$arrPath[2]' ", TableIWAPIAllCat)) {

                            $USet = "";
                            $USet .= " Address = '$strAddress' ,";
                            $USet .= " CategoryId = '$CategoryId' ,";
                            $USet .= " Main = '$arrPath[1]' ,";
                            $USet .= " Sub = '$arrPath[2]' ,";
                            $USet .= " TypeSet = 'Brand' ,";
                            $USet .= " Title = '$strTitle' ,";
                            $USet .= " ModifyIP = '$ModifyIP' ,";
                            $USet .= " ModifyTime = '$ModifyTime' ,";
                            $USet .= " ModifyDate = '$ModifyDate' ,";
                            $USet .= " ModifyStrTime = '$ModifyStrTime' ";


                            if (isset($arrPath[3]))
                                $USet .= ", Sub2 = '$arrPath[3]' ";
                            if (isset($arrPath[4]))
                                $USet .= ", Sub3 = '$arrPath[4]' ";
                            if (isset($arrPath[5]))
                                $USet .= ", Sub4 = '$arrPath[5]' ";

                            $objORM->DataUpdate("CategoryId = '$CategoryId'", $USet, TableIWAPIAllCat);

                        }


                    }
                }


                if (is_array($AllApi4['children']) and count($AllApi4['children']) <= 1)
                    continue;


                foreach ($AllApi4['children'] as $AllApi5) {
                    if (is_array($AllApi5['link']) and count($AllApi5['link']) > 2) {
                        if ($AllApi5['link']['categoryId'] != '' and $AllApi5['link']['webUrl']) {
                            $parts = parse_url($AllApi5['link']['webUrl']);
                            $parts['path'] = str_replace('"', "", $parts['path']);
                            $parts['path'] = str_replace("'", "", $parts['path']);
                            $arrPath = array_filter(explode("/", $parts['path']));
                            unset($arrPath[count($arrPath)]);


                            $IdKey = $objAclTools->IdKey();
                            $CategoryId = $AllApi5['link']['categoryId'];
                            $strAddress = $AllApi5['link']['webUrl'];
                            $strTitle = $AllApi5['content']['title'];
                            $strTitle = str_replace('"', "", $strTitle);
                            $strTitle = str_replace("'", "", $strTitle);

                            if (!$objORM->DataExist("CategoryId = '$CategoryId'", TableIWAPIAllCat)) {

                                $InSet = "";
                                $InSet .= " IdKey = '$IdKey' ,";
                                $InSet .= " Enabled = '$Enabled' ,";
                                $InSet .= " Address = '$strAddress' ,";
                                $InSet .= " CategoryId = '$CategoryId' ,";
                                $InSet .= " Main = '$arrPath[1]' ,";
                                $InSet .= " Sub = '$arrPath[2]' ,";
                                $InSet .= " TypeSet = 'Brand' ,";
                                $InSet .= " Title = '$strTitle' ,";
                                $InSet .= " ModifyIP = '$ModifyIP' ,";
                                $InSet .= " ModifyTime = '$ModifyTime' ,";
                                $InSet .= " ModifyDate = '$ModifyDate' ,";
                                $InSet .= " ModifyStrTime = '$ModifyStrTime' ";

                                if (isset($arrPath[3]))
                                    $InSet .= ", Sub2 = '$arrPath[3]' ";
                                if (isset($arrPath[4]))
                                    $InSet .= ", Sub3 = '$arrPath[4]' ";
                                if (isset($arrPath[5]))
                                    $InSet .= ", Sub4 = '$arrPath[5]' ";


                                $objORM->DataAdd($InSet, TableIWAPIAllCat);
                                $SubRootLocalName = '';

                            } elseif ($objORM->DataExist("CategoryId = '$CategoryId' and Sub != '$arrPath[2]' ", TableIWAPIAllCat)) {

                                $USet = "";
                                $USet .= " Address = '$strAddress' ,";
                                $USet .= " CategoryId = '$CategoryId' ,";
                                $USet .= " Main = '$arrPath[1]' ,";
                                $USet .= " Sub = '$arrPath[2]' ,";
                                $USet .= " TypeSet = 'Brand' ,";
                                $USet .= " Title = '$strTitle' ,";
                                $USet .= " ModifyIP = '$ModifyIP' ,";
                                $USet .= " ModifyTime = '$ModifyTime' ,";
                                $USet .= " ModifyDate = '$ModifyDate' ,";
                                $USet .= " ModifyStrTime = '$ModifyStrTime' ";


                                if (isset($arrPath[3]))
                                    $USet .= ", Sub2 = '$arrPath[3]' ";
                                if (isset($arrPath[4]))
                                    $USet .= ", Sub3 = '$arrPath[4]' ";
                                if (isset($arrPath[5]))
                                    $USet .= ", Sub4 = '$arrPath[5]' ";

                                $objORM->DataUpdate("CategoryId = '$CategoryId'", $USet, TableIWAPIAllCat);

                            }


                        }
                    }


                    if (is_array($AllApi5['children']) and count($AllApi5['children']) <= 1)
                        continue;


                }


            }


        }

    }

}





