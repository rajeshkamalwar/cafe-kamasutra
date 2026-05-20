<?php
require 'db.php';
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
            .nav-tabs-custom > .nav-tabs > li.active {

    border-top-color: #dd4b39 !important;
.modal{z-index: 9999999999 !important;}
}
        </style>

    </head>
    <body class="hold-transition <?= theme_skin ?> sidebar-mini">

        <?php
//require 'add_member.php';
        ?>
        <div class="wrapper">
            <div class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
                <!-- left-fixed -navigation--><?php include 'left-nav.php'; ?><!-- /.left-fixed -navigation-->
            </div>
            <!-- header-starts --><?php include 'top-strip-menu.php'; ?><!-- /.header-starts -->
            <?php
            //include 'function.php';
            ?>

            <!-- main content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Bulk Import Members
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="">Menu</li><li class="active">Bulk Import Members</li>
                    </ol>
                </section>


                
                <!-- Inner content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12 col-md-3"></div>
                        <div class="col-xs-12 col-md-6">
                            <div class="box box-primary ">
                                <div class="box-header">
                                    <div class="row"> 
                                        <div class="col-lg-12">
                                            <h3 class="box-title"></h3>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body no-padding"><form action="" method="post" name="upload_excel" enctype="multipart/form-data">
<!--                                        <div class="col-md-2"></div>
                                        <div class="col-md-8">Select Excel file to bluk upload</div>
                                        <div class="col-md-2"></div>-->
                                        <div class="col-md-2"></div>
                                        <div class="col-md-8">
                                            <div class="form-group compose-right">
                                            <div class="btn btn-default btn-file">
                                                <i class="fa fa-paperclip"></i> Select File
                                                <input type="file" name="file">
                                            </div>
                                           <button style="background-color:#333;color:#fff" type="submit" id="submit" name="Import" class="btn  btn-flat btn-lg pull-right button-loading" data-loading-text="Loading...">Upload</button>
                                       </div>
                                       </div>
                                       <div class="col-md-2"></div>
                                    </form> 
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-3"></div>
                    </div>
        
        
        <div class="row">

                        <div class="col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                                  <h3 class="box-title">Bulk Import Report</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body table-responsive">
        <?php 
        include 'import.php';
        ?>
        </div>
        </div>
        </div>
        </div>
            </section><!-- /.Inner content -->

            </div>

            <!--// main content -->

            <?php include 'footer.php'; ?>
            <script>
  $(function () {
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
    })
  })
</script>



    </body>
</html>

