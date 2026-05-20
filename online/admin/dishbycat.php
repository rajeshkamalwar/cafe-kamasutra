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
            a:hover,a:focus{font-family: 'Source Sans Pro','Helvetica Neue',Helvetica,Arial,sans-serif;
    font-weight: 400;font-size:14px;
    text-decoration: none;
    outline: none;
}
.vertical-tab{
    display: table;font-family: 'Source Sans Pro','Helvetica Neue',Helvetica,Arial,sans-serif;
    font-weight: 400;font-size:14px;
/*    border-right: 8px solid #3c8dbc;*/
}
.vertical-tab .nav-tabs{
    display: table-cell;
    min-width: 28%;
    border-bottom: none;
    border-right: 8px solid #3c8dbc;
}
.vertical-tab .nav-tabs li{
    float: none;
    vertical-align: top;
}
.vertical-tab .nav-tabs li a{
    display: block;
    padding: 16px;
    margin-right: 0;
    /*font-size: 16px;*/
    font-weight: 600;
    color: #fff;
    /*text-transform: uppercase;*/
    background: #1a2226;
    border: none;
    border-radius: 0;
    position: relative;font-family: 'Source Sans Pro','Helvetica Neue',Helvetica,Arial,sans-serif;
    font-weight: 400;font-size:14px;
}
.vertical-tab .nav-tabs li a:hover,
.vertical-tab .nav-tabs li.active a{
    background: #3c8dbc;
    border: none;
    color: #fff;
}
.vertical-tab .nav-tabs li.active a:after{
    content: "";
    width: 20px;
    height: 20px;
    background: linear-gradient(225deg,#3c8dbc 49%, transparent 50%);
    position: absolute;
    top: 50%;
    right: -16px;
    transform: translateY(-50%) rotate(45deg);
}
.vertical-tab .tab-content{
    display: table-cell;
    padding: 15px 20px;
    font-size: 15px;
    color: #272e38;
    letter-spacing: 1px;
    line-height: 25px;
    text-align: justify;
    vertical-align: top;
    width:75%;
}
.vertical-tab .tab-content h3{
    padding-bottom: 10px;
    margin: 0 0 10px 0;
    font-weight: 600;
    color: #3c8dbc;
    text-transform: uppercase;
    border-bottom: 1px solid #3c8dbc;
    
    font-family: 'Source Sans Pro','Helvetica Neue',Helvetica,Arial,sans-serif;
    font-weight: 600;font-size:22px;
}

.tab-pane ul
{list-style: none;padding:0px;}
.tab-pane ul li{background-color: #ecf0f5;
    margin-bottom: 5px;
    padding: 5px 10px;text-transform:capitalize !important;}

.tab-pane ul li {}
@media only screen and (max-width: 479px){
    .vertical-tab{
        border-right: none;
        border-bottom: 8px solid #3c8dbc;
    }
    .vertical-tab .nav-tabs{
        display: block;
        margin: 0 -10px;
        border-right: none;
    }
    .vertical-tab .nav-tabs li{ margin-bottom: 10px; }
    .vertical-tab .nav-tabs li:last-child{ margin-bottom: 0; }
    .vertical-tab .nav-tabs li a{ padding: 10px; }
    .vertical-tab .nav-tabs li.active a:after{ display: none; }
    .vertical-tab .tab-content{
        display: block;
        padding: 15px 0;
    }
    .vertical-tab .tab-content h3{ font-size: 18px; }
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
              <div class="pull-right box-tools">
                <button type="button" id="refersh" class="btn btn-primary "><i  class="fa fa-refresh"></i> Refresh</button>
                
              </div>
              <!-- /. tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body pad">
              
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
                        dataType: "html",
                        success: function (data)
                        {
                            
        //console.log(data);
        $('.pad').fadeIn(3000);
        $('.pad').html(data);
        
                        }
                    });
                }

                

                $(function () {
                    load();
                });
                
                $(document).on('click', '#refersh', function () {
                    load();
                });
                
               
            </script>


    </body>
</html>

