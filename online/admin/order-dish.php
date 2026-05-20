<?php
require 'db.php';
include 'config.php';
ob_start();
include 'conform_user.php';


$totlacatid = array();

$list_cat_query = "Select `cat_id`,`cat_name_en` From `categories`";
$menu_order_query = "Select `cat_sort_order` from `menu_order` where `cat_sortorder_id`='1'";
$result_cat_query = $mysqli->query($list_cat_query);
$result_menu_order_query = $mysqli->query($menu_order_query);
$list_dish = $finalstr = $result_diff = '';
$AllCatAvilable='';
if ($result_cat_query->num_rows == 0) {
//no cat found
} else { //cat found
    while ($row = $result_cat_query->fetch_assoc()) {
        //array_push($totlacatid, $row['cat_id']);
       $AllCatAvilable.='<div class="col-md-3 col-sm-12"><a href="'.base_url.'order-dish-indi.php?cat_id='.$row['cat_id'].'"><button type="button" class="btn btn-primary  btn-block margin">'.$row['cat_name_en'].'</button></a></div>';
        
    }
    
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Welcome <?= $name ?> </title>
        <?php include 'header.php'; ?>
        <link rel="stylesheet" href="../../plugins/iCheck/all.css">
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



            #features {
                margin: auto;
                width: 460px;
                font-size: 0.9em;
            }
            .connected, .sortable, .exclude, .handles {
                margin: auto;
                padding: 0;
                width: 100%;
                -webkit-touch-callout: none;
                -webkit-user-select: none;
                -khtml-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
            }
            .sortable.grid {
                overflow: hidden;
            }
            .connected li, .sortable li, .exclude li, .handles li {
                list-style: none;
                border: 1px solid #CCC;
                background: #F6F6F6;


                margin: 5px;
                padding: 5px;
                height: 32px;
            }
            .handles span {
                cursor: move;
            }
            li.disabled {
                opacity: 0.5;
            }
            .sortable.grid li {
                line-height: 80px;
                float: left;
                width: 80px;
                height: 80px;
                text-align: center;
            }
            li.highlight {
                background: #FEE25F;
            }
            #connected {
                width: 440px;
                overflow: hidden;
                margin: auto;
            }
            .connected {
                float: left;
                width: 200px;
            }
            .connected.no2 {
                float: right;
            }
            li.sortable-placeholder {
                border: 1px dashed #CCC;
                background: none;
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
                        Display Order of Menu
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="">Menu</li><li class="active">Display Order of Dish</li>
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
                                    <h3 class="box-title">About Display Order of Dish</h3>

                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                    <!-- /.box-tools -->
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <blockquote>
                                        <p>Some text about display order of dish</p>
                                    </blockquote>
                                </div>
                                <!-- /.box-body -->
                            </div>
                        </div>
                        <!-- /.About section -->
                        <p id="del_notimsg"></p>
                        <div class="col-xs-12">
                            
                            <div class="col-sm-12 col-md-12">
                                <div class="box box-primary">
                                    <div class="box-header">
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                        <section>
                                         
                                                <?php echo $AllCatAvilable; ?> 
                                         
                                        </section>
                                        
                                    </div>
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </div>
                        
                    </div><!-- /.row -->
                </section>
                <!-- /.Inner content -->
            </div>
            <!--// main content -->
            <?php include 'footer.php'; ?>
            <script src="theme_assets/jquery.sortable.js"></script>
            <script>


                $(function () {
                    $('.sortable').sortable();
                    $('.handles').sortable({
                        handle: 'span'
                    });
                    $('.connected').sortable({
                        connectWith: '.connected'
                    });
                    $('.exclude').sortable({
                        items: ':not(.disabled)'
                    });
                });

                $(document).ready(function () {
                    $('#save').click(function () {
                        var column1RelArray = [];
                        $('#oldlist li').each(function () {
                            column1RelArray.push($(this).attr('id'));
                        });
                        //$('#neworder').val('');
                        //$('#neworder').val(column1RelArray);
                        url = b_url + 'order_cat_action.php';
                        var cat_sortorder_action = 'new_sort_order4cat';
                        var newdortorder4cat = column1RelArray;

                        $.ajax({
                            type: "POST",
                            url: url,
                            data: {
                                cat_sortorder_action: cat_sortorder_action,
                                newdortorder4cat: newdortorder4cat,
                            },
                            dataType: "html",
                            success: function (data)
                            {
                                console.log(data);
                                location.reload(true);
                            }
                        });

                    });
                });
            </script>

    </body>
</html>

