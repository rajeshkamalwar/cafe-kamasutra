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
                       Restra Holidays
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="">Menu</li><li class="active">Restra Holidays</li>
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
                                    <h3 class="box-title">About Restra Holidays</h3>

                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                    <!-- /.box-tools -->
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <blockquote>
                                        <p>Few words about restra holidays</p>

                                    </blockquote>
                                </div>
                                <!-- /.box-body -->
                            </div>

                        </div>
                        <!-- /.About section -->
                        
                    </div>

                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <p id="del_notimsg"></p>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body table-responsive no-padding">
                                    <div class="col-sm-12">
                                        <form name="timeset_form" id="timeset_form">
                                            <div class="row">
                                                <div class="col-md-6 col-sm-12">                                       
                                                    <div class="form-group">
                                                        <label for="attributes price">Start off Date</label>
                                                        <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="date" class="form-control pull-right" id="datepicker1" value="<?php echo date("m/d/Y")?>" >
                </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="attributes price">End off Date</label>

                                                        <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="date" class="form-control pull-right" id="datepicker2">
                </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                            <label>Message</label>
                                            <div class="row">
                                                <div class="col-md-6 col-sm-12">
                                                    <textarea class="form-control" rows="2" id="restra_holi_en" name="restra_holi_en"  placeholder="Message in <?= lang1;?>"></textarea>
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <textarea class="form-control" rows="2" id="restra_holi_nl" name="restra_holi_nl"  placeholder="Message in <?= lang2;?>"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                            
                                            <div class="pull-right">
                                                <button type="button" class="btn btn-primary" id="set_time_update"><i  class="fa fa-save"></i> Update</button>
                                            </div>
                                            <br/><br/>
                                        </form>
                                    </div>



                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </div>
                        <div class="col-md-3"></div>
                    </div><!-- /.row -->

                </section>
                <!-- /.Inner content -->
            </div>
            <!--// main content -->

            <?php include 'footer.php'; ?>
            <script type="text/javascript">

                function load() {
                    url = b_url + 'restraholiday_action.php';
                    var action = 'load';
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {action: action},
                        dataType: "html",
                        success: function (data)
                        {
        
        console.log(data);
                            
                            
                            $('#timeset_form').html(data);
                        }
                    });
                }
                
                $(function () {
                    load();
                });
                
                $(document).on('click', '#set_time_update', function () {
                    var date1 = new Date($('#datepicker1').val());
                    var date2 = new Date($('#datepicker2').val());
                    var start_date=[date1.getDate(), date1.getMonth() + 1, date1.getFullYear()].join('-');
                    var end_date=[date2.getDate(), date2.getMonth() + 1, date2.getFullYear()].join('-');
                    var restra_holi_en=$('#restra_holi_en').val();
                    var restra_holi_nl=$('#restra_holi_nl').val();
                    
                    var action = 'update';
                    url = b_url + 'restraholiday_action.php';  //console.log(url);  console.log();
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            action: action,
                            start_date:start_date,
                            end_date:end_date,
                            restra_holi_en:restra_holi_en,
                            restra_holi_nl:restra_holi_nl,
                        },
                        dataType: "html",
                        success: function (data)
                        {
                           // load();
                            $('#del_notimsg').html('');
                            $('#del_notimsg').html(data);
                            $("#del_notimsg").fadeIn(1000);
                            setTimeout(function () {
                                $('#del_notimsg').delay(3000).fadeOut('1000')
                            }, 1000);
                        }
                    });
                    
                });
                
                
                          
        
            </script>
    </body>
</html>