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
                        Dish By Categories
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="">Menu</li><li class="active">Dish By Categories</li>
                    </ol>
                </section>



                <!-- Inner content -->
                <section class="content">

                    <div class="row">
                        <!-- Attributes action --><?php //include 'attributes_actions.php';                              ?><!-- Attributes action -->
                        <!-- About section -->
                        <div class="col-xs-12">
                            <div class="box box-default collapsed-box">
                                <div class="box-header with-border">
                                    <i class="fa fa-bullhorn"></i>
                                    <h3 class="box-title">About Dish By Categories</h3>

                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                    <!-- /.box-tools -->
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <blockquote>
                                        <p>Some text about Dish By Categories</p>

                                    </blockquote>
                                </div>
                                <!-- /.box-body -->
                            </div>

                        </div>
                        <!-- /.About section -->
                        <p id="welcmtxt_notimsg"></p>
                    </div>

                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-primary">
            <div class="box-header">
<!--              <h3 class="box-title">Bootstrap WYSIHTML5
                <small>Simple and fast</small>
              </h3>-->
              <!-- tools box -->
<!--              <div class="pull-right box-tools">
                <button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                  <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-default btn-sm" data-widget="remove" data-toggle="tooltip"
                        title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>-->
              <!-- /. tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body pad">
              <form>
                  <div class="form-group">
                                            <label for="attributes name">Welcome Text</label>
                                            <div class="row">
                                                <div class="col-md-6 col-sm-12">
                  
                <textarea id="welcm_txt_en" name="welcm_txt_en" class="form-control" placeholder="Welcome text here in <?= lang1;?>"
                          style="width: 100%; height: 150px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea></div>
                                                <div class="col-md-6 col-sm-12">
                          <textarea id="welcm_txt_nl" name="welcm_txt_nl" class="form-control" placeholder="Welcome text here in <?= lang2;?>"
                                    style="width: 100%; height: 150px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea></div></div></div>
                          <input type="button" name="submit" id="update_welcmtxt" class="btn btn-primary" value="Submit" />
                          
              </form>
            </div>
          </div>
                            <!-- /.box -->
                        </div>
                    </div><!-- /.row -->

                </section>
                <!-- /.Inner content -->


                

                

            </div>

            <!--// main content -->

            <?php include 'footer.php'; ?>
            <script type="text/javascript">

                function load() {
                    
                    url = b_url + 'dishbycat_action.php';
                    var dishbycat_action = 'load';
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {dishbycat_action: dishbycat_action},
                        dataType: "json",
                        success: function (data)
                        {   $('#welcm_txt_en').html(data["welcm_en"]);
                        }
                    });
                }

                

                $(function () {
                    load();
                });
                
               
            </script>


    </body>
</html>

