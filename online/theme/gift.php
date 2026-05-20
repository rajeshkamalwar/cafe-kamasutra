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
                        Gift Item
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="">Menu</li><li class="active">Gift Item</li>
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
                                    <h3 class="box-title">About Gift Item</h3>

                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                    <!-- /.box-tools -->
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <blockquote>
                                        <p>Some text about gift items</p>

                                    </blockquote>
                                </div>
                                <!-- /.box-body -->
                            </div>

                        </div>
                        <!-- /.About section -->
                        <p id="del_notimsg"></p>
                    </div>

                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <div class="row"> 
                                        <div class="col-lg-8">
                                            <h3 class="box-title">Available Gift Items</h3>
                                        </div>
                                        <div class="col-lg-4 ">

                                            <div class="pull-right">
                                                <button type="button" id="refersh" class="btn btn-primary "><i  class="fa fa-refresh"></i> Refresh</button>
                                                <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#modal-add"><i  class="fa fa-plus"></i> Add New</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body table-responsive no-padding">
                                    <div class="col-sm-12">
                                        <table class="table table-hover" id="list_data">

                                        </table>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </div>
                    </div><!-- /.row -->

                </section>
                <!-- /.Inner content -->


                <!-- Add Modal -->
                <div class="modal fade" id="modal-add">
                    <div class="modal-dialog"><!-- modal-dialog -->
                        <div class="modal-content"><!-- modal-content -->
                            <form method="post" > 
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Add New Gift Item</h4>
                                </div>
                                <div class="modal-body">
                                    <!--<p>One fine body&hellip;</p>-->
                                    <p id="notimsg"></p>
                                    <div class="box-body">
                                        <div class="form-group">
                                            
                                            <div class="row">
                                                <div class="col-md-6 col-sm-12">
                                                    <label for="min_odr_amunt">Minimum Order Amount</label>
                                                    <input type="text" class="form-control" id="add_min_odr_amunt" name="add_min_odr_amunt" placeholder="Minimum Amount" >
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <label for="max_odr_amunt">Maximum Order Amount</label>
                                                    <input type="text" class="form-control" id="add_max_odr_amunt" name="add_max_odr_amunt" placeholder="Maximum Amount" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="message">Message</label>
                                            <input type="text" class="form-control" id="add_msg" name="add_msg" placeholder="Cart Message" >
                                        </div>
                                        <div class="form-group">
                                            <label for="">Gift Item Name</label>
                                            <div class="row">
                                                <div class="col-md-6 col-sm-12">
                                                    <label for="gift1"></label>
                                                    <input type="text" class="form-control" id="add_gift1" name="add_gift1" placeholder="Gift Item" >
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <label for="gift1"></label>
                                                    <input type="text" class="form-control" id="add_gift2" name="add_gift2" placeholder="Gift Item" >
                                                </div></div>
                                                 <div class="row">
                                                     <div class="col-md-6 col-sm-12">
                                                    <label for="gift1"></label>
                                                    <input type="text" class="form-control" id="add_gift3" name="add_gift3" placeholder="Gift Item" >
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <label for="gift1"></label>
                                                    <input type="text" class="form-control" id="add_gift4" name="add_gift4" placeholder="Gift Item" >
                                                </div></div>
                                            <div class="row">
                                            <div class="col-md-6 col-sm-12">
                                                    <label for="gift1"></label>
                                                    <input type="text" class="form-control" id="add_gift5" name="add_gift5" placeholder="Gift Item" >
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <label for="gift1"></label>
                                                    <input type="text" class="form-control" id="add_gift6" name="add_gift6" placeholder="Gift Item" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.box-body -->
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default pull-left" id="add_cancel" data-dismiss="modal">Close</button>
                                    <!--<button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Add</button>-->
                                    <input type="button" name="submit" id="add_gift_form" class="btn btn-primary" value="Submit" />
                                </div>
                            </form>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div>
                <!-- /.Add Modal -->

                <!-- View Modal -->
                <div class="modal fade" id="modal-view">
                    <div class="modal-dialog"><!-- modal-dialog -->
                        <div class="modal-content"><!-- modal-content -->
                            <form method="post" > 
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">View Gift's Details</h4>
                                </div>
                                <div class="modal-body">
                                    <!--<p>One fine body&hellip;</p>-->

                                    <div class="box-body" id="view_gift_data">

                                    </div>
                                    <!-- /.box-body -->
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default pull-left"  data-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div>
                <!-- /.View Modal -->

                <!-- Edit Modal -->
                <div class="modal fade" id="modal-edit">
                    <div class="modal-dialog"><!-- modal-dialog -->
                        <div class="modal-content"><!-- modal-content -->
                            <form method="post" > 
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Edit Gift Details</h4>
                                </div>
                                <div class="modal-body">
                                    <!--<p>One fine body&hellip;</p>-->
                                    <p id="edit_notimsg"></p>
                                    <div class="box-body" id="edit_gift_control">



                                    </div>
                                    <!-- /.box-body -->
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default pull-left" id="edit_cancel" data-dismiss="modal">Close</button>
                                    <!--<button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Add</button>-->
                                    <input type="button" name="submit" id="edit_gift_form" class="btn btn-primary" value="Update" />
                                </div>
                            </form>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div>
                <!-- /.Edit Modal -->

                <!-- Delete Modal -->
                <div class="modal modal-danger fade" id="modal-delete">
                    <div class="modal-dialog"><!-- modal-dialog -->
                        <div class="modal-content"><!-- modal-content -->
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Delete Gift Item</h4>
                                <form role="form">
                            </div>
                            <div class="modal-body">
                                <p>Are you sure?<br/>You are going to delete item. This operation can not be undo.</p>
                                <input type="hidden" value="" id="dele_hidden">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default " id="del_close" data-dismiss="modal">Close</button>
                                <button type="button" id="del_rec" class="btn btn-outline pull-left"><i class="fa fa-trash"></i> Delete</button>
                                </form>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div>
                <!-- /.Delete Modal -->

            </div>

            <!--// main content -->

            <?php include 'footer.php'; ?>
            <script type="text/javascript">

                function load() {
                    url = b_url + 'gift_actions.php';
                    var gift_action = 'load';
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {gift_action: gift_action},
                        dataType: "html",
                        success: function (data)
                        {   //console.log(data);
                            $('#list_data').html('');
                            $('#list_data').html(data);
                        }
                    });
                }

                function clear() {
                    $("#add_min_odr_amunt").val('');
                    $("#add_max_odr_amunt").val('');
                    $("#add_msg").val('');
                    $("#add_gift1").val('');
                    $("#add_gift2").val('');
                    $("#add_gift3").val('');
                    $("#add_gift4").val('');
                    $("#add_gift5").val('');
                    $("#add_gift6").val('');
                    }

                $(function () {
                    load();
                });

                $(document).on('click', '#refersh', function () {
                    load();
                });

                $(document).on('click', '#add_gift_form', function () {

                    if ($("#add_min_odr_amunt").val() == "") {
                        alert("Please provide minimum amount for order!");
                        $("#add_min_odr_amunt").focus();
                        return false;
                    }
                    if ($("#add_max_odr_amunt").val() == "") {
                        alert("Please provide maximum amount for order!");
                        $("#add_max_odr_amunt").focus();
                        return false;
                    }                    
                    if($("#add_max_odr_amunt").val() < $("#add_min_odr_amunt").val()){
                        alert("Maximum order amount must be greater then minimum order amount.");
                        $("#add_max_odr_amunt").focus();
                        return false;
                    }
                    
                    

                    url = b_url + 'gift_actions.php';  //console.log(url);  console.log();
                    var gift_action = 'add';
                    var add_min_odr_amunt = $("#add_min_odr_amunt").val();
                    var add_max_odr_amunt = $("#add_max_odr_amunt").val();
                    var add_msg = $("#add_msg").val();
                    var add_gift1 = $("#add_gift1").val();
                    var add_gift2 = $("#add_gift2").val();
                    var add_gift3 = $("#add_gift3").val();
                    var add_gift4 = $("#add_gift4").val();
                    var add_gift5 = $("#add_gift5").val();
                    var add_gift6 = $("#add_gift6").val();
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            gift_action: gift_action,
                            add_min_odr_amunt: add_min_odr_amunt,
                            add_max_odr_amunt:add_max_odr_amunt,
                            add_msg:add_msg,
                            add_gift1:add_gift1,
                            add_gift2:add_gift2,
                            add_gift3:add_gift3,
                            add_gift4:add_gift4,
                            add_gift5:add_gift5,
                            add_gift6:add_gift6,
                        },
                        dataType: "html",
                        success: function (data)
                        {//   console.log(data);
                            load();

                            $('#notimsg').html('');
                            $('#notimsg').html(data);
                            clear();
                            $("#notimsg").fadeIn(1000);
                            setTimeout(function () {
                                $('#notimsg').delay(3000).fadeOut('1000')
                            }, 1000);

                        }
                    });
                });

                $(document).on('click', '#view_record', function () {
                    var gift_id = $(this).attr("dataid");
                    var gift_action = 'view';
                    url = b_url + 'gift_actions.php';
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            gift_action: gift_action,
                            gift_id: gift_id,
                        },
                        dataType: "html",
                        success: function (data)
                        {
                            $('#view_gift_data').html('');
                            $('#view_gift_data').html(data);
                        }
                    });
                });

                $(document).on('click', '#edit_record', function () {
                    var gift_id = $(this).attr("dataid");
                    var gift_action =  'edit_load_record';
                    url = b_url + 'gift_actions.php';
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            gift_id:gift_id,
                            gift_action:gift_action,
                        },
                        dataType: "html",
                        success: function (data)
                        {
                            $('#edit_gift_control').html('');
                            $('#edit_gift_control').html(data);
                        }
                    });
                });
                $(document).on('click', '#edit_gift_form', function () {

                    if ($("#edit_min_odr_amunt").val() == "") {
                        alert("Please provide minimum amount for order!");
                        $("#edit_min_odr_amunt").focus();
                        return false;
                    }
                    if ($("#edit_max_odr_amunt").val() == "") {
                        alert("Please provide maximum amount for order!");
                        $("#edit_max_odr_amunt").focus();
                        return false;
                    }                    
                    if($("#edit_max_odr_amunt").val() < $("#edit_min_odr_amunt").val()){
                        alert("Maximum order amount must be greater then minimum order amount.");
                        $("#edit_max_odr_amunt").focus();
                        return false;
                    }

                    url = b_url + 'gift_actions.php';
                    var gift_action = 'edit';
                    var gift_id = $('#gift_id').val();
                    var edit_min_odr_amunt = $("#edit_min_odr_amunt").val();
                    var edit_max_odr_amunt = $("#edit_max_odr_amunt").val();
                    var edit_msg = $("#edit_msg").val();
                    var edit_gift1 = $("#edit_gift1").val();
                    var edit_gift2 = $("#edit_gift2").val();
                    var edit_gift3 = $("#edit_gift3").val();
                    var edit_gift4 = $("#edit_gift4").val();
                    var edit_gift5 = $("#edit_gift5").val();
                    var edit_gift6 = $("#edit_gift6").val();

                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            gift_action:gift_action,
                            gift_id:gift_id,
                            edit_min_odr_amunt:edit_min_odr_amunt,
                            edit_max_odr_amunt:edit_max_odr_amunt,
                            edit_msg:edit_msg,
                            edit_gift1:edit_gift1,
                            edit_gift2:edit_gift2,
                            edit_gift3:edit_gift3,
                            edit_gift4:edit_gift4,
                            edit_gift5:edit_gift5,
                            edit_gift6:edit_gift6
                        },
                        dataType: "html",
                        success: function (data)
                        {
                            load();
                            $('#edit_notimsg').html('');
                            $('#edit_notimsg').html(data);
                            clear();
                            $("#edit_notimsg").fadeIn(1000);
                            setTimeout(function () {
                                $('#edit_notimsg').delay(3000).fadeOut('1000')
                            }, 1000);
                        }
                    });
                });

 

                $(document).on('click', '#delete_record', function () {
                    var attrib_id = $(this).attr("dataid");   //console.log(id);
                    $("#dele_hidden").val(attrib_id);
                });
                $(document).on('click', '#del_rec', function () {
                    var gift_id = $("#dele_hidden").val(); //console.log(id);
                    var gift_action = 'delete';
                    url = b_url + 'gift_actions.php';
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            gift_action:gift_action,
                            gift_id:gift_id
                        },
                        dataType: "html",
                        success: function (data)
                        {

                            $("#del_close").click();
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

            </script>


    </body>
</html>

