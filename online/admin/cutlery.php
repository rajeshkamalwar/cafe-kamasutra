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
                    <h1> Cutlery Charge
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="">Menu</li><li class="active">Cutlery Charge</li>
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
                                    <h3 class="box-title">Cutlery Charge</h3>

                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                    <!-- /.box-tools -->
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <blockquote>
                                        

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
                                            <label for="attributes price">Cutlery Charge Option</label>
                                            <input type="radio" id="chargeoption" name="chargeoption" value="free" class="chargeoptionnew" >Free
											<input type="radio" id="chargeoption" name="chargeoption" class="chargeoptionnew"  value="charge">Charge
                                        </div>
												  </div></div>
                                            <div class="row" >
                                                <div class="col-md-6 col-sm-12" id="extra">                                       
                                                   <div  class="form-group" >
                                            <label for="attributes price">Cutlery Charge</label>
                                            <input type="text" class="form-control" id="charge" name="charge" placeholder="For example: 12.00" required>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="attributes Status">Status</label>
                                            <select name="charge" id="charge" class="form-control">
												<option>Active</option>
												<option>Inactive</option>
											</select>
                                        </div>
                                                </div>
                                            </div>
                                            <div class="pull-right">
                                                <button type="button" class="btn btn-primary" id="set_discount_update"><i  class="fa fa-save"></i> Update</button>
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
                    url = b_url + 'cutlery_action.php';
                    var action = 'load';
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {action: action},
                        dataType: "html",
                        success: function (data)
                        {$('#timeset_form').html(data);}
                    });
                }
                
                $(function () {
                    load();
                });
                
                $(document).on('click', '#set_minorder_update', function () {
                    var charge=$('#charge').val();
                    var status=$('#status').val();
 var chargeoption = $("input[name='chargeoption']:checked").val();
                    var action = 'update';
                    url = b_url + 'cutlery_action.php';  //console.log(url);  console.log();
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            action: action,
                            charge:charge,
                            status:status,
							chargeoption:chargeoption
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