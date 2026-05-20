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
                        Attributes
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="">Menu</li><li class="active">Attributes</li>
                    </ol>
                </section>



                <!-- Inner content -->
                <section class="content">

                    <div class="row">
                        <!-- Attributes action --><?php include 'attributes_actions.php';                              ?><!-- Attributes action -->
                        <!-- About section -->
                        <div class="col-xs-12">
                            <div class="box box-default collapsed-box">
                                <div class="box-header with-border">
                                    <i class="fa fa-bullhorn"></i>
                                    <h3 class="box-title">About Attributes</h3>

                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                    <!-- /.box-tools -->
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <blockquote>
                                        <p>Attributes add extra product date to your products. For example size, color. You cannot rename an attribute later on.</p>

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
                                            <h3 class="box-title">Available Attributes</h3>
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
                                    <h4 class="modal-title">Add New Attributes</h4>
                                </div>
                                <div class="modal-body">
                                    <!--<p>One fine body&hellip;</p>-->
                                    <p id="notimsg"></p>
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="attributes name">Attributes Name</label>
                                            <div class="row">
                                                <div class="col-md-6 col-sm-12">
                                                    <input type="text" class="form-control" id="attributes_name_new_en" name="attributes_name_new_en" placeholder="Attributes name in <?= lang1;?>" >
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <input type="text" class="form-control" id="attributes_name_new_nl" name="attributes_name_new_nl" placeholder="Attributes name in <?= lang2;?>" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="attributes price">Price</label>
                                            <input type="text" class="form-control" id="attributes_price_new" name="attributes_price_new" placeholder="Price" >
                                        </div>
                                        <div class="form-group">
                                            <label for="attributes description">Attributes Description</label>
                                            <div class="row">
                                                <div class="col-md-6 col-sm-12">
                                                    <textarea class="form-control" rows="3" id="attributes_description_add_en" name="attributes_description_add_en"  placeholder="Attributes description in <?= lang1;?>"></textarea>
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <textarea class="form-control" rows="3" id="attributes_description_add_nl" name="attributes_description_add_nl"  placeholder="Attributes description in <?= lang2;?>"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.box-body -->
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default pull-left" id="add_cancel" data-dismiss="modal">Close</button>
                                    <!--<button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Add</button>-->
                                    <input type="button" name="submit" id="add_attrib_form" class="btn btn-primary" value="Submit" />
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
                                    <h4 class="modal-title">View Attribute's Details</h4>
                                </div>
                                <div class="modal-body">
                                    <!--<p>One fine body&hellip;</p>-->

                                    <div class="box-body" id="view_attri_data">

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
                                    <h4 class="modal-title">Edit Attribute's Details</h4>
                                </div>
                                <div class="modal-body">
                                    <!--<p>One fine body&hellip;</p>-->
                                    <p id="edit_notimsg"></p>
                                    <div class="box-body" id="edit_attrib_control">



                                    </div>
                                    <!-- /.box-body -->
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default pull-left" id="edit_cancel" data-dismiss="modal">Close</button>
                                    <!--<button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Add</button>-->
                                    <input type="button" name="submit" id="edit_attrib_form" class="btn btn-primary" value="Submit" />
                                </div>
                            </form>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div>
                <!-- /.Edit Modal -->

                <!-- Status Change Modal -->
                <div class="modal fade" id="modal-change_status">
                    <div class="modal-dialog"><!-- modal-dialog -->
                        <div class="modal-content"><!-- modal-content -->
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Change Attribute's Status</h4>
                                <form method="post" action="">
                            </div>
                            <div class="modal-body">
                                <p id="status_notimsg"></p>
                                <div class="box-body" id="return_string1">

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="button" name="change_status_btn" id="change_status_btn" class="btn btn-info btn-danger pull-right">Submit</button>
                                </form>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div>
                <!-- /.Status Change Modal -->

                <!-- Delete Modal -->
                <div class="modal modal-danger fade" id="modal-delete">
                    <div class="modal-dialog"><!-- modal-dialog -->
                        <div class="modal-content"><!-- modal-content -->
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Delete Attributes</h4>
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
                    url = b_url + 'attributes_actions.php';
                    var attrib_action = 'load';
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {attrib_action: attrib_action},
                        dataType: "html",
                        success: function (data)
                        {   //console.log(data);
                            $('#list_data').html('');
                            $('#list_data').html(data);
                        }
                    });
                }

                function clear() {

                    $('#attributes_name_new_en').val('');
                    $('#attributes_name_new_nl').val('');
                    $('#attributes_price_new').val('');
                    $('#attributes_description_add_en').val('');
                    $('#attributes_description_add_nl').val('');


                }

                $(function () {
                    load();
                });

                $(document).on('click', '#refersh', function () {
                    load();
                });

                $(document).on('click', '#add_attrib_form', function () {

                    if ($("#attributes_name_new_en").val() == "") {
                        alert("Please provide attribute name!");
                        $("#attributes_name_new_en").focus();
                        return false;
                    }
                    if ($("#attributes_name_new_nl").val() == "") {
                        alert("Please provide attribute name!");
                        $("#attributes_name_new_nl").focus();
                        return false;
                    }
                    if ($("#attributes_price_new").val() == "") {
                        alert("Please provide attributes price!");
                        $("#attributes_price_new").focus();
                        return false;
                    }

                    url = b_url + 'attributes_actions.php';  //console.log(url);  console.log();
                    var attrib_action = 'add';
                    var attributes_name_new_en = $('#attributes_name_new_en').val();
                    var attributes_name_new_nl = $('#attributes_name_new_nl').val();
                    var attributes_price_new = $('#attributes_price_new').val();
                    var attributes_description_add_en = $('#attributes_description_add_en').val();
                    var attributes_description_add_nl = $('#attributes_description_add_nl').val();

                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            attrib_action: attrib_action,
                            attributes_name_new_en: attributes_name_new_en,
                            attributes_name_new_nl: attributes_name_new_nl,
                            attributes_price_new: attributes_price_new,
                            attributes_description_add_en: attributes_description_add_en,
                            attributes_description_add_nl: attributes_description_add_nl
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

                    var attrib_id = $(this).attr("dataid");
                    
                    var attrib_action = 'view';
                    url = b_url + 'attributes_actions.php';


                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            attrib_action: attrib_action,
                            attrib_id: attrib_id,
                        },
                        dataType: "html",
                        success: function (data)
                        {//   console.log(data);
                            $('#view_attri_data').html('');
                            $('#view_attri_data').html(data);
                        }
                    });
                });

                $(document).on('click', '#edit_record', function () {

                    var attrib_id = $(this).attr("dataid");
                    var attrib_action = 'edit_load_record';
                    url = b_url + 'attributes_actions.php';


                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            attrib_action: attrib_action,
                            attrib_id: attrib_id,
                        },
                        dataType: "html",
                        success: function (data)
                        {//   console.log(data);
                            $('#edit_attrib_control').html('');
                            $('#edit_attrib_control').html(data);
                        }
                    });
                });
                $(document).on('click', '#edit_attrib_form', function () {

                    if ($("#attributes_name_edit_en").val() == "") {
                        alert("Please provide attribute name!");
                        $("#attributes_name_edit_en").focus();
                        return false;
                    }
                    if ($("#attributes_name_edit_nl").val() == "") {
                        alert("Please provide attribute name!");
                        $("#attributes_name_edit_nl").focus();
                        return false;
                    }
                    if ($("#attributes_price_edit").val() == "") {
                        alert("Please provide attributes price!");
                        $("#attributes_price_edit").focus();
                        return false;
                    }

                    url = b_url + 'attributes_actions.php';
                    var attrib_action = 'edit';
                    var attrib_id = $('#attrib_id').val();
                    var attributes_name_edit_en = $('#attributes_name_edit_en').val();
                    var attributes_name_edit_nl = $('#attributes_name_edit_nl').val();
                    var attributes_price_edit = $('#attributes_price_edit').val();
                    var attributes_description_edit_en = $('#attributes_description_edit_en').val();
                    var attributes_description_edit_nl = $('#attributes_description_edit_nl').val();

                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            attrib_action: attrib_action,
                            attrib_id: attrib_id,
                            attributes_name_edit_en: attributes_name_edit_en,
                            attributes_name_edit_nl: attributes_name_edit_nl,
                            attributes_price_edit: attributes_price_edit,
                            attributes_description_edit_en: attributes_description_edit_en,
                            attributes_description_edit_nl: attributes_description_edit_nl
                        },
                        dataType: "html",
                        success: function (data)
                        {//   console.log(data);
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

                $(document).on('click', '#change_status', function () {
                    var attrib_id = $(this).attr("dataid");   //console.log(id);
                    var attrib_action = 'get_status';
                    url = b_url + 'attributes_actions.php';  //console.log(url);  console.log();
                    myVar = '';
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            attrib_action: attrib_action,
                            attrib_id: attrib_id
                        },
                        dataType: "html",
                        success: function (data)
                        {//   console.log(data);
                            $('#return_string1').html('');
                            $('#return_string1').html(data);
                        }
                    });
                });
                $(document).on('click', '#change_status_btn', function () {
                    var attrib_id = $("#mso").val();
                    var attrib_action = 'change_status';
                    var selected_value = $("#currentstatus option:selected").text();
                    url = b_url + 'attributes_actions.php';  //console.log(url);  console.log();
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            attrib_action: attrib_action,
                            attrib_id: attrib_id,
                            selected_value: selected_value
                        },
                        dataType: "html",
                        success: function (data)
                        {
                            load();
                            $('#status_notimsg').html('');
                            $('#status_notimsg').html(data);
                            $("#status_notimsg").fadeIn(1000);
                            setTimeout(function () {
                                $('#status_notimsg').delay(3000).fadeOut('1000')
                            }, 1000);
                        }
                    });
                });

                $(document).on('click', '#delete_record', function () {
                    var attrib_id = $(this).attr("dataid");   //console.log(id);
                    $("#dele_hidden").val(attrib_id);
                });
                $(document).on('click', '#del_rec', function () {
                    var attrib_id = $("#dele_hidden").val(); //console.log(id);
                    var attrib_action = 'delete';
                    url = b_url + 'attributes_actions.php';
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            attrib_id: attrib_id,
                            attrib_action: attrib_action
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

