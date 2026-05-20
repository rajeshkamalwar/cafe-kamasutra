<?php
include 'db.php';
include 'config.php';
ob_start();
include 'conform_user.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Welcome <?= $name ?> </title>
        <?php include 'header.php'; ?>
        <style>
            .example-modal .modal {
                position: relative;
                top: auto;
                bottom: auto;
                right: auto;
                left: auto;
                display: block;
                z-index: 1;
            }
            .example-modal .modal {
                background: transparent !important;
            }
            .btn-social-icon > :first-child {
                font-size: 14px !important;
            }

        </style>
    </head>
    <body class="hold-transition <?= theme_skin ?> sidebar-mini">
        


        <div class="wrapper">
            <div class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
                <!-- left-fixed -navigation--><?php include 'left-nav.php'; ?><!-- /.left-fixed -navigation-->
            </div>
            <!-- header-starts --><?php include 'top-strip-menu.php'; ?><!-- /.header-starts -->


            <!-- main content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Time Setting
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="">Menu</li><li class="active">Time Setting</li>
                    </ol>
                </section>



                <!-- Inner content -->
                <section class="content">

                    <div class="row">
                        <!-- About section -->
                        <div class="col-xs-12">
                            <div class="box box-default collapsed-box">
                                <div class="box-header with-border">
                                    <i class="fa fa-bullhorn"></i>
                                    <h3 class="box-title">About Time Setting</h3>

                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                    <!-- /.box-tools -->
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <blockquote>
                                        <p>Few words about time setting</p>

                                    </blockquote>
                                </div>
                                <!-- /.box-body -->
                            </div>

                        </div>
                        <!-- /.About section -->
                        
                    </div>

                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <p id="del_notimsg"></p>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body table-responsive no-padding">
                                    <div class="col-sm-12">
                                        <form name="timeset_form" id="timeset_form">
                                            <table class="table table-hover" id="list_data">
                                                <thead>
                                                <th>Day</th>
                                                <th>First Shift</th>
                                                <th>Is First Shift Close</th>
                                                <th>Second Shift</th>
                                                <th>Is Second Shift Close</th>
                                                <!--<th>Is Close</th>-->
                                                </thead>
                                                <tbody id="time_tbl">
                                                    
                                                </tbody>
                                            </table><div class="pull-right">
<button type="button" id="refersh" class="btn btn-primary "><i  class="fa fa-refresh"></i> Refresh</button>
                                                <button type="button" class="btn btn-primary" id="set_time_update"><i  class="fa fa-save"></i> Save</button>
                                            </div>
                                            <br/><br/>
                                        </form>
                                    </div>



                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </div>
                        <div class="col-md-2"></div>
                    </div><!-- /.row -->

                </section>
                <!-- /.Inner content -->


            </div>

            <!--// main content -->

            <?php include 'footer.php'; ?>
            <script type="text/javascript">

                function load() {
                    url = b_url + 'timesetting_action.php';
                    var action = 'load';
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {action: action},
                        dataType: "html",
                        success: function (data)
                        {   //console.log(data);
                            $('#time_tbl').html('');
                            
                            
                            $('#time_tbl').html(data);
                        }
                    });
                }

                $(function () {
                    load();
                });

                $(document).on('click', '#set_time_update', function () {
                    
                    var mon_open1 = $("#mon_open1 option:selected").val();      var tue_open1 = $("#tue_open1 option:selected").val();
                    var mon_close1 = $("#mon_close1 option:selected").val();    var tue_close1 = $("#tue_close1 option:selected").val();
                    var mon_open2 = $("#mon_open2 option:selected").val();      var tue_open2 = $("#tue_open2 option:selected").val();
                    var mon_close2 = $("#mon_close2 option:selected").val();    var tue_close2 = $("#tue_close2 option:selected").val();

                    var wed_open1 = $("#wed_open1 option:selected").val();      var thu_open1 = $("#thu_open1 option:selected").val();
                    var wed_close1 = $("#wed_close1 option:selected").val();    var thu_close1 = $("#thu_close1 option:selected").val();
                    var wed_open2 = $("#wed_open2 option:selected").val();      var thu_open2 = $("#thu_open2 option:selected").val();
                    var wed_close2 = $("#wed_close2 option:selected").val();    var thu_close2 = $("#thu_close2 option:selected").val();

                    var fri_open1 = $("#fri_open1 option:selected").val();      var sat_open1 = $("#sat_open1 option:selected").val();
                    var fri_close1 = $("#fri_close1 option:selected").val();    var sat_close1 = $("#sat_close1 option:selected").val();
                    var fri_open2 = $("#fri_open2 option:selected").val();      var sat_open2 = $("#sat_open2 option:selected").val();
                    var fri_close2 = $("#fri_close2 option:selected").val();    var sat_close2 = $("#sat_close2 option:selected").val();

                    var sun_open1 = $("#sun_open1 option:selected").val();
                    var sun_close1 = $("#sun_close1 option:selected").val();
                    var sun_open2 = $("#sun_open2 option:selected").val();
                    var sun_close2 = $("#sun_close2 option:selected").val();

                    var mon_shift1close = '';   var mon_shift2close = '';
                    var tue_shift1close = '';   var tue_shift2close = '';
                    var wed_shift1close = '';   var wed_shift2close = '';
                    var thu_shift1close = '';   var thu_shift2close = '';
                    var fri_shift1close = '';   var fri_shift2close = '';
                    var sat_shift1close = '';   var sat_shift2close = '';
                    var sun_shift1close = '';   var sun_shift2close = '';
                    if ($("#mon_shift1close").prop('checked') == true) {mon_shift1close = 'close';} else {mon_shift1close = 'open';}
                    if ($("#tue_shift1close").prop('checked') == true) {tue_shift1close = 'close';} else {tue_shift1close = 'open';}
                    if ($("#wed_shift1close").prop('checked') == true) {wed_shift1close = 'close';} else {wed_shift1close = 'open';}
                    if ($("#thu_shift1close").prop('checked') == true) {thu_shift1close = 'close';} else {thu_shift1close = 'open';}
                    if ($("#fri_shift1close").prop('checked') == true) {fri_shift1close = 'close';} else {fri_shift1close = 'open';}
                    if ($("#sat_shift1close").prop('checked') == true) {sat_shift1close = 'close';} else {sat_shift1close = 'open';}
                    if ($("#sun_shift1close").prop('checked') == true) {sun_shift1close = 'close';} else {sun_shift1close = 'open';}
                    
                    if ($("#mon_shift2close").prop('checked') == true) {mon_shift2close = 'close';} else {mon_shift2close = 'open';}
                    if ($("#tue_shift2close").prop('checked') == true) {tue_shift2close = 'close';} else {tue_shift2close = 'open';}
                    if ($("#wed_shift2close").prop('checked') == true) {wed_shift2close = 'close';} else {wed_shift2close = 'open';}
                    if ($("#thu_shift2close").prop('checked') == true) {thu_shift2close = 'close';} else {thu_shift2close = 'open';}
                    if ($("#fri_shift2close").prop('checked') == true) {fri_shift2close = 'close';} else {fri_shift2close = 'open';}
                    if ($("#sat_shift2close").prop('checked') == true) {sat_shift2close = 'close';} else {sat_shift2close = 'open';}
                    if ($("#sun_shift2close").prop('checked') == true) {sun_shift2close = 'close';} else {sun_shift2close = 'open';}

                    var action = 'update';
                    url = b_url + 'timesetting_action.php';  //console.log(url);  console.log();
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            action: action,
                            mon_open1: mon_open1, mon_close1: mon_close1, mon_open2: mon_open2, mon_close2: mon_close2,
                            tue_open1: tue_open1, tue_close1: tue_close1, tue_open2: tue_open2, tue_close2: tue_close2,
                            wed_open1: wed_open1, wed_close1: wed_close1, wed_open2: wed_open2, wed_close2: wed_close2,
                            thu_open1: thu_open1, thu_close1: thu_close1, thu_open2: thu_open2, thu_close2: thu_close2,
                            fri_open1: fri_open1, fri_close1: fri_close1, fri_open2: fri_open2, fri_close2: fri_close2,
                            sat_open1: sat_open1, sat_close1: sat_close1, sat_open2: sat_open2, sat_close2: sat_close2,
                            sun_open1: sun_open1, sun_close1: sun_close1, sun_open2: sun_open2, sun_close2: sun_close2,

                            mon_shift2close:mon_shift2close, tue_shift2close:tue_shift2close, wed_shift2close:wed_shift2close,
                            thu_shift2close:thu_shift2close, fri_shift2close:fri_shift2close, sat_shift2close:sat_shift2close,
                            sun_shift2close:sun_shift2close,
                            
                            mon_shift1close:mon_shift1close, tue_shift1close:tue_shift1close, wed_shift1close:wed_shift1close,
                            thu_shift1close:thu_shift1close, fri_shift1close:fri_shift1close, sat_shift1close:sat_shift1close,
                            sun_shift1close:sun_shift1close,
                        },
                        dataType: "html",
                        success: function (data)
                        {
                            load();
                            $('#del_notimsg').html('');
                            $('#del_notimsg').html(data);
                            $("#del_notimsg").fadeIn(1000);
                            setTimeout(function () {
                                $('#del_notimsg').delay(3000).fadeOut('1000')
                            }, 1000);
                        }
                    });
                });
                
                $(document).on('click', '#refersh', function () {
                    load();
                });
            </script>
    </body>
</html>