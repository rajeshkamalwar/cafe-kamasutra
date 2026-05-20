<?php
include 'db.php';
include 'config.php';
ob_start();
include 'conform_user.php';

if(isset($_POST['submit'])){
	$preorder = $_POST['preorder'];
	$query = $mysqli->query("UPDATE `worktimecheck` SET `preorder`='".$preorder."' where id='1'");
	
}
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
                    <h1> Pre Order
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="">Menu</li><li class="active">Pre Order</li>
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
                                    <h3 class="box-title">Pre Order</h3>

                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                    <!-- /.box-tools -->
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                 
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
                                   
                                </div>
                              
                                <div class="box-body table-responsive no-padding">
                                    <div class="col-sm-12">
                                        <form method="POST">
                                            <div class="row">
                                                <div class="col-md-6 col-sm-12">                                       
                                                   <div class="form-group">
                                            <label for="attributes price">Preorder Option </label>
											<?php $que = $mysqli->query("select * from `worktimecheck` where `id` = '1' ");
                                              $row = $que->fetch_assoc();
                                            ?>	 
                                            <input type="checkbox"  id="preorder" name="preorder" value="1" <?php if($row['preorder']=='1'){  ?> checked="" <?php } ?> >
                                        </div>
                                      
                                                </div>
                                                
                                            </div>
                                            
                                            
                                            <div class="pull-right">
                                                <button type="submit" class="btn btn-primary" name="submit"><i  class="fa fa-save"></i> Submit</button>
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
            
    </body>
</html>