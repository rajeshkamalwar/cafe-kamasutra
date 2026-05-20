<?php
require 'db.php';
include 'config.php';
ob_start();
include 'conform_user.php';


$cat_id=$_GET['cat_id'];

$list_dish = $finalstr = $result_diff = '';
$totladishid = array();
//Query for get dish list where $cat_id is assigned.
$query4getdishlist="SELECT `dish_id`,`dish_name_en` FROM `dish` WHERE CONCAT(',', categry_id, ',') like '%,$cat_id,%'";

//query to know is this cat_id already in dish_order
$checkquery = "Select `do_id` from `dish_order` where `do_cat_id`='$cat_id'";
$result_checkquery = $mysqli->query($checkquery);
$var_updatORinsert='';
if ($result_checkquery->num_rows == 0) {$var_updatORinsert='insert';}else{$var_updatORinsert='update';}

$dish_order_query = "Select `do_dish_sort_order` from `dish_order` where `do_cat_id`='$cat_id'";
$result_dish_order_query = $mysqli->query($dish_order_query);

$result_query4getdishlist = $mysqli->query($query4getdishlist);
if ($result_query4getdishlist->num_rows == 0) {
//no dish in this cat found
} else { //dish found in this cat
    while ($row = $result_query4getdishlist->fetch_assoc()) {
        array_push($totladishid, $row['dish_id']);
}
$dish_sortorderlist = $result_dish_order_query->fetch_assoc();

if (strlen($dish_sortorderlist['do_dish_sort_order']) > 0) {
    $dish_sortorderlist1 = explode(",", $dish_sortorderlist['do_dish_sort_order']);
        $result_diff = array_diff($totladishid, $dish_sortorderlist1);

        if (!empty($result_diff)) { // difference found
            $finalstr1 = implode(",", $dish_sortorderlist1);
            $finalstr2 = implode(",", $result_diff);
            if (strlen($finalstr1) > 0 && strlen($finalstr2) > 0) {
                $finalstr = $finalstr1 . ',' . $finalstr2;
            }
        } else { // Difference not found
            $finalstr = implode(",", $dish_sortorderlist1);
        }
}
else {
        $finalstr = implode(",", $totladishid);
    }
    $final_query = '';
    if (!empty($finalstr)) {
        $final_query = "SELECT `dish_id`,`dish_name_en` FROM `dish` WHERE `dish_id` IN (" . $finalstr . ") ORDER BY FIELD(`dish_id`," . $finalstr . ")";
    }
    
   
    $result_cat_query1 = $mysqli->query($final_query);
    if ($result_cat_query1->num_rows > 0) {
        while ($row1 = $result_cat_query1->fetch_assoc()) {
            $list_dish .= '<li id="' . $row1['dish_id'] . '" draggable="true">' . $row1['dish_name_en'] . '</li>';
        }
    }
     //echo $final_query."<br/>".$list_dish;die();
    
}





/*
$list_cat_query = "Select `cat_id`,`cat_name_en` From `categories`";
$menu_order_query = "Select `cat_sort_order` from `menu_order` where `cat_sortorder_id`='1'";
$result_cat_query = $mysqli->query($list_cat_query);
$result_menu_order_query = $mysqli->query($menu_order_query);
$list_dish = $finalstr = $result_diff = '';

if ($result_cat_query->num_rows == 0) {
//no cat found
} else { //cat found
    while ($row = $result_cat_query->fetch_assoc()) {
        array_push($totlacatid, $row['cat_id']);
    }
    $cat_sortorderlist = $result_menu_order_query->fetch_assoc();
    if (strlen($cat_sortorderlist['cat_sort_order']) > 0) {
        $cat_sortorderlist1 = explode(",", $cat_sortorderlist['cat_sort_order']);
        $result_diff = array_diff($totlacatid, $cat_sortorderlist1);

        if (!empty($result_diff)) { // difference found
            $finalstr1 = implode(",", $cat_sortorderlist1);
            $finalstr2 = implode(",", $result_diff);
            if (strlen($finalstr1) > 0 && strlen($finalstr2) > 0) {
                $finalstr = $finalstr1 . ',' . $finalstr2;
            }
        } else { // Difference not found
            $finalstr = implode(",", $cat_sortorderlist1);
        }
    } else {
        $finalstr = implode(",", $totlacatid);
    }
    $final_query = '';
    if (!empty($finalstr)) {
        $final_query = "SELECT `cat_id`,`cat_name_en` FROM `categories` WHERE `cat_id` IN (" . $finalstr . ") ORDER BY FIELD(`cat_id`," . $finalstr . ")";
    }
    
    $result_cat_query1 = $mysqli->query($final_query);
    if ($result_cat_query1->num_rows > 0) {
        while ($row1 = $result_cat_query1->fetch_assoc()) {
            $list_dish .= '<li id="' . $row1['cat_id'] . '" draggable="true">' . $row1['cat_name_en'] . '</li>';
        }
    }
}*/


?>
<input type="hidden" id="get_var" value="<?=$cat_id;?>"/>
<input type="hidden" id="get_var_upin" value="<?=$var_updatORinsert;?>"/>

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
                        <li class="">Menu</li><li class="active">Display Order of Menu</li>
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
                                    <h3 class="box-title">About Display Order of Menu</h3>

                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                    <!-- /.box-tools -->
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <blockquote>
                                        <p>Some text about display order of menu</p>
                                    </blockquote>
                                </div>
                                <!-- /.box-body -->
                            </div>
                        </div>
                        <!-- /.About section -->
                        <p id="del_notimsg"></p>
                        <div class="col-xs-12">
                            <div class="col-sm-12 col-md-3"></div>
                            <div class="col-sm-12 col-md-6">
                                <div class="box box-primary">
                                    <div class="box-header">
                                    </div>
                                    <!-- /.box-header -->
									<?php $cat_query = $mysqli->query("select * from categories where cat_id = '$cat_id' ");                
										      $row_cat = $cat_query->fetch_assoc(); ?>
										<h3><?php echo $row_cat['cat_name_en']; ?></h3>
                                    <div class="box-body">
                                        <section>
                                            <ul class="sortable list catlist" id="oldlist">
                                                <?php echo $list_dish; ?> 
                                            </ul>
                                        </section>
                                        <button id="save" type="button" class="btn btn-primary "><i class="fa fa-save"></i> Save</button>
                                        <input type="hidden" id="neworder" value="">
                                    </div>
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </div>
                        <div class="col-sm-12 col-md-3"></div>
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
                        url = b_url + 'order_dish_action.php';
                        var cat_sortorder_action = 'new_sort_order4dish';
                        
                        var newdortorder4cat = column1RelArray;
                        var cat_id=$('#get_var').val();
                        var get_var_upin=$('#get_var_upin').val();

                        $.ajax({
                            type: "POST",
                            url: url,
                            data: {
                                cat_id:cat_id,
                                get_var_upin:get_var_upin,
                                cat_sortorder_action: cat_sortorder_action,
                                newdortorder4cat: newdortorder4cat,
                            },
                            dataType: "html",
                            success: function (data)
                            {
                               
    location.reload(true);

                            }
                        });

                    });
                });
            </script>

    </body>
</html>

