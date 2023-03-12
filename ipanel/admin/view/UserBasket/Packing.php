<?php
//Packing.php

include IW_ASSETS_FROM_PANEL . "include/PageUnity.php";
?>
<!DOCTYPE html>
<?php echo $objIpanelViewUnity->tagHtmlPart(); ?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="fontiran.com:license" content="Y68A9">
    <?php echo $objIpanelViewUnity->tagFavicon(FA_LC["theme_color"], FA_LC["tile_color"]); ?>
    <?php echo $objIpanelViewUnity->tagTitlePart(); ?>

    <!-- Bootstrap -->
    <link href="<?php echo(IW_PANEL_THEME_FROM_PANEL); ?>vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <?php if ($objInitTools->getLanguageDirection() == 'rtl') { ?>
        <link href="<?php echo(IW_PANEL_THEME_FROM_PANEL); ?>vendors/bootstrap-rtl/dist/css/bootstrap-rtl.min.css"
              rel="stylesheet">
    <?php } ?>
    <!-- Font Awesome -->
    <link href="<?php echo(IW_PANEL_THEME_FROM_PANEL); ?>vendors/font-awesome/css/font-awesome.min.css"
          rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo(IW_PANEL_THEME_FROM_PANEL); ?>vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="<?php echo(IW_PANEL_THEME_FROM_PANEL); ?>vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css"
          rel="stylesheet">
    <!-- iCheck -->
    <link href="<?php echo(IW_PANEL_THEME_FROM_PANEL); ?>vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="<?php echo(IW_PANEL_THEME_FROM_PANEL); ?>vendors/bootstrap-daterangepicker/daterangepicker.css"
          rel="stylesheet">

    <!-- iCheck -->
    <link href="<?php echo(IW_PANEL_THEME_FROM_PANEL); ?>vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- Datatables -->
    <link href="<?php echo(IW_PANEL_THEME_FROM_PANEL); ?>vendors/datatables.net-bs/css/dataTables.bootstrap.min.css"
          rel="stylesheet">
    <link href="<?php echo(IW_PANEL_THEME_FROM_PANEL); ?>vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css"
          rel="stylesheet">
    <link href="<?php echo(IW_PANEL_THEME_FROM_PANEL); ?>vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css"
          rel="stylesheet">
    <link href="<?php echo(IW_PANEL_THEME_FROM_PANEL); ?>vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css"
          rel="stylesheet">
    <link href="<?php echo(IW_PANEL_THEME_FROM_PANEL); ?>vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css"
          rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo(IW_PANEL_THEME_FROM_PANEL); ?>build/css/custom.min.css" rel="stylesheet">
</head>
<!-- /header content -->
<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col hidden-print">
            <div class="left_col scroll-view">
                <?php (new FileCaller)->FileIncluderWithControler(IW_PANEL_FROM_PANEL . 'admin/', 'GlobalPage', 'PanelPageTitle'); ?>

                <div class="clearfix"></div>

                <!-- menu profile quick info -->
                <?php (new FileCaller)->FileIncluderWithControler(IW_PANEL_FROM_PANEL . 'admin/', 'GlobalPage', 'MenuProfileQuickInfo'); ?>

                <!-- /menu profile quick info -->

                <br/>

                <!-- sidebar menu -->
                <?php (new FileCaller)->FileIncluderWithControler(IW_PANEL_FROM_PANEL . 'admin/', 'GlobalPage', 'SiderbarMenu'); ?>
                <!-- /sidebar menu -->

                <!-- /menu footer buttons -->
                <?php (new FileCaller)->FileIncluderWithControler(IW_PANEL_FROM_PANEL . 'admin/', 'GlobalPage', 'MenuFooterButtons'); ?>
                <!-- /menu footer buttons -->
            </div>
        </div>

        <!-- top navigation -->
        <?php (new FileCaller)->FileIncluderWithControler(IW_PANEL_FROM_PANEL . 'admin/', 'GlobalPage', 'TopNavigation'); ?>
        <!-- /top navigation -->
        <!-- /header content -->

        <!-- page content -->
        <div class="right_col" role="main">
            <div class="">

                <?php (new FileCaller)->FileIncluderWithControler(IW_PANEL_FROM_PANEL . 'admin/', 'GlobalPage', 'PageTitleTop'); ?>
                <div class="clearfix"></div>

                <div id="wizard" class="form_wizard wizard_horizontal">
                    <ul class="wizard_steps">
                        <li>
                            <a href="?ln=&part=UserBasket&page=AllBasket" class="disabled">
                                <span class="step_no">1</span>
                                <span class="step_descr">
                                              در انتظار<br/>
                                              <small>خریدهای در انتظار تایید</small>
                                          </span>
                            </a>
                        </li>
                        <li>
                            <a href="?ln=&part=UserBasket&page=AllSorting" class="disabled">
                                <span class="step_no">2</span>
                                <span class="step_descr">
                                              سورتینگ<br/>
                                              <small>کالاهای رسیده</small>
                                          </span>
                            </a>
                        </li>
                        <li>
                            <a href="?ln=&part=UserBasket&page=AllPacking" class="selected">
                                <span class="step_no">3</span>
                                <span class="step_descr">
                                              پکینگ<br/>
                                              <small>سیستم پکینگ</small>
                                          </span>
                            </a>
                        </li>
                        <li>
                            <a href="?ln=&part=UserBasket&page=Booking" class="disabled">
                                <span class="step_no">4</span>
                                <span class="step_descr">
                                              بوکینگ<br/>
                                              <small>سیستم بوکینگ</small>
                                          </span>
                            </a>
                        </li>
                        <li>
                            <a href="?ln=&part=UserBasket&page=Dispatch" class="disabled">
                                <span class="step_no">5</span>
                                <span class="step_descr">
                                              دیسپچ<br/>
                                              <small>سیستم دیسپچ</small>
                                          </span>
                            </a>
                        </li>
                        <li>
                            <a href="?ln=&part=UserBasket&page=Delivery" class="disabled">
                                <span class="step_no">6</span>
                                <span class="step_descr">
                                              دلیوری<br/>
                                              <small>بسته های رسیده</small>
                                          </span>
                            </a>
                        </li>
                        <li>
                            <a href="?ln=&part=UserBasket&page=Claim" class="disabled">
                                <span class="step_no">7</span>
                                <span class="step_descr">
                                              Claim<br/>
                                              <small>بسته های نرسیده</small>
                                          </span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="row">


                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">

                                <small><?php echo @$strPageDescription ?></small>

                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                           aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li>
                                                <a href="<?php echo $objGlobalVar->setGetVar('list', 'export', array('act')); ?>"><?php echo FA_LC["list_export_mode"]; ?></a>
                                            </li>
                                            <li>
                                                <a href="<?php echo $objGlobalVar->setGetVar('list', 'extend', array('act')); ?>"><?php echo FA_LC["list_extend_mode"]; ?></a>
                                            </li>
                                            <li>
                                                <a href="<?php echo $objGlobalVar->setGetVar('list', 'normal', array('act')); ?>"><?php echo FA_LC["list_normal_mode"]; ?></a>
                                            </li>
                                        </ul>
                                    </li>

                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <form class="form-horizontal form-label-left input_mask" method="post" action="">
                                <div class="x_content">
                                    <?php  (new FileCaller)->FileIncluderWithControler(IW_PANEL_FROM_PANEL . 'admin/', 'GlobalPage', 'ListTableType'); ?>
                                    <thead>
                                    <?php echo $strListHead; ?>
                                    </thead>

                                    <?php echo $strListBody; ?>

                                    </table>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"><?php echo FA_LC["weight"]; ?>

                                    </label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input name="PackWeight" value="<?php echo($ListItem->PackWeight); ?>" class="date-picker form-control col-md-7 col-xs-12"
                                                type="text">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"><?php echo FA_LC["description"]; ?>
                                    </label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                            <textarea name="Description" class="form-control" rows="3"
                                                      placeholder="<?php echo FA_LC["description"]; ?>"><?php echo($ListItem->Description); ?></textarea>
                                    </div>
                                </div>

                                <button type="submit" name="SubmitM" value="A"
                                        class="btn btn-success"><?php echo FA_LC["send"]; ?></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <?php (new FileCaller)->FileIncluderWithControler(IW_PANEL_FROM_PANEL . 'admin/', 'GlobalPage', 'FooterContent'); ?>
        <!-- /footer content -->
    </div>
</div>
<?php (new FileCaller)->FileIncluderWithControler(IW_PANEL_FROM_PANEL . 'admin/', 'GlobalPage', 'LockScreen'); ?>

<!-- jQuery -->
<script src="<?php echo(IW_PANEL_THEME_FROM_PANEL); ?>vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="<?php echo(IW_PANEL_THEME_FROM_PANEL); ?>vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="<?php echo(IW_PANEL_THEME_FROM_PANEL); ?>vendors/fastclick/lib/fastclick.js"></script>
<!-- NProgress -->
<script src="<?php echo(IW_PANEL_THEME_FROM_PANEL); ?>vendors/nprogress/nprogress.js"></script>
<!-- bootstrap-progressbar -->
<script src="<?php echo(IW_PANEL_THEME_FROM_PANEL); ?>vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
<!-- iCheck -->
<script src="<?php echo(IW_PANEL_THEME_FROM_PANEL); ?>vendors/iCheck/icheck.min.js"></script>

<!-- bootstrap-daterangepicker -->
<script src="<?php echo(IW_PANEL_THEME_FROM_PANEL); ?>vendors/moment/min/moment.min.js"></script>

<script src="<?php echo(IW_PANEL_THEME_FROM_PANEL); ?>vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

<!-- iCheck -->
<script src="<?php echo(IW_PANEL_THEME_FROM_PANEL); ?>vendors/iCheck/icheck.min.js"></script>
<!-- Datatables
<script language="JavaScript">
    $(document).ready(function() {
        $('#datatable-responsive').DataTable( {
            "order": [[ 0, "desc" ]]
        } );
    } );
</script>
-->
<script>

    $(document).ready( function () {
        var table = $('#datatable-responsive').DataTable( {
            paging: false,
            order:false
        });
    } );

    $('.col-master').click(function(){
        var idx = $(this).parent().index();
        $('table td:nth-child(' + (idx + 1) + ') input.child').prop('checked', this.checked)
    })

    $('.row-master').click(function(){
        $(this).closest('tr').find('input.child').prop('checked', this.checked)
    });

    $('.child').change(function(){
        var $tr = $(this).closest('tr')
        $tr.find('input.row-master').prop('checked', $tr.find('.child').not(':checked').length == 0);

        var idx = $(this).parent().index(), $tds = $('table td:nth-child(' + (idx + 1) + ')');
        $tds.find('input.col-master').prop('checked', $tds.find('input.child').not(':checked').length == 0)
    })


    $(document).ready(function () {
        $("#checkAll").change(function () {
            $("input:checkbox").prop('checked', $(this).prop("checked"));
        });
        $('.chk').on('click', function () {
            if ($('.chk:checked').length == $('.chk').length) {
                $('#checkAll').prop('checked', true);
            } else {
                $('#checkAll').prop('checked', false);
            }
        });
    });

    // product image modal

    $('.pimagemodalclass').click(function(e) {
        $('#PImageModal img').attr('src', $(this).attr('data-img-url'));
    });

</script>
<script src="<?php echo(IW_PANEL_THEME_FROM_PANEL); ?>vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo(IW_PANEL_THEME_FROM_PANEL); ?>vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="<?php echo(IW_PANEL_THEME_FROM_PANEL); ?>vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo(IW_PANEL_THEME_FROM_PANEL); ?>vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
<script src="<?php echo(IW_PANEL_THEME_FROM_PANEL); ?>vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="<?php echo(IW_PANEL_THEME_FROM_PANEL); ?>vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo(IW_PANEL_THEME_FROM_PANEL); ?>vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo(IW_PANEL_THEME_FROM_PANEL); ?>vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
<script src="<?php echo(IW_PANEL_THEME_FROM_PANEL); ?>vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="<?php echo(IW_PANEL_THEME_FROM_PANEL); ?>vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo(IW_PANEL_THEME_FROM_PANEL); ?>vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
<script src="<?php echo(IW_PANEL_THEME_FROM_PANEL); ?>vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
<script src="<?php echo(IW_PANEL_THEME_FROM_PANEL); ?>vendors/jszip/dist/jszip.min.js"></script>
<script src="<?php echo(IW_PANEL_THEME_FROM_PANEL); ?>vendors/pdfmake/build/pdfmake.min.js"></script>
<script src="<?php echo(IW_PANEL_THEME_FROM_PANEL); ?>vendors/pdfmake/build/vfs_fonts.js"></script>

<!-- Custom Theme Scripts -->
<script src="<?php echo(IW_PANEL_THEME_FROM_PANEL); ?>build/js/custom.min.js"></script>
<script src="<?php echo(IW_PANEL_JSON_FROM_PANEL); ?>MenuViewProducts.js"></script>


</body>
</html>




