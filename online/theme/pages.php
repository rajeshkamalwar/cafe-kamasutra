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
		<script src="//cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
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
                        Page
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="">Menu</li><li class="active">Page</li>
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
                                    <h3 class="box-title">About Pages</h3>
                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                    <!-- /.box-tools -->
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <blockquote>
                                        <p>We always try to deliver order as quickly as possible. So we ask for postcode at the time of order.</p>
                                    </blockquote>
                                </div>
                                <!-- /.box-body -->
                            </div>
                        </div>
                        <!-- /.About section -->
                    </div>
                    <p id="del_notimsg"></p>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <div class="row"> 
                                        <div class="col-lg-6">
                                            <h3 class="box-title">Available Pages</h3>
                                        </div>
                                        <div class="col-lg-6 ">
                                            <div class="pull-right">
                                                <button type="button" id="refersh" class="btn btn-primary "><i  class="fa fa-refresh"></i> Refresh</button> 
                                                <a href="bluk.php" class="btn btn-primary"><i  class="fa fa-plus"></i> Bulk Upload</a>                                               
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-add"><i  class="fa fa-plus"></i> Add New</button>
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
                            <form method="post"> 
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Add New Pages</h4>

                                </div>
                                <div class="modal-body">
                                    <!--<p>One fine body&hellip;</p>-->
                                    <p id="add_notimsg"></p>
                                    <div class="box-body">
                                        <div class="form-group">
										<div class="col-md-6 col-sm-12">
                                            <label for="postcode name">Page Name in english </label>
                                            <input type="text" class="form-control" id="pagename" name="pagename" required >
                                        </div>
										<div class="col-md-6 col-sm-12">
                                            <label for="postcode name">Page Name in Dutch </label>
                                            <input type="text" class="form-control" id="pagename_ml" name="pagename_ml" required >
                                        </div>
										</div>
                                       <div class="form-group">
										<div class="col-md-6 col-sm-12">
                                            <label for="postcode name">Heading in english </label>
                                            <input type="text" class="form-control" id="heading" name="heading" required >
                                        </div>
										<div class="col-md-6 col-sm-12">
                                            <label for="postcode name">Heading in Dutch </label>
                                            <input type="text" class="form-control" id="headling_nl" name="headling_nl" required >
                                        </div>
										</div>
                                        <div class="form-group">
										<div class="col-md-6 col-sm-12">
                                            <label for="postcode name">Short Description in english </label>
                                            <input type="text" class="form-control" id="short_description" name="short_description" required >
                                        </div>
										<div class="col-md-6 col-sm-12">
                                            <label for="postcode name">Short Description in Dutch </label>
                                            <input type="text" class="form-control" id="short_nl" name="short_nl" required >
                                        </div>
										</div>
                                        <div class="form-group">
										<div class="col-md-12 col-sm-12">
                                            <label for="postcode name">Long Description in english </label>
                                            <textarea class="form-control" id="long_description" name="long_description" required ></textarea>
                                        </div>
										<div class="col-md-12 col-sm-12">
                                            <label for="postcode name">Long Description in Dutch </label>
                                                               <textarea class="form-control summernote" id="long_nl" name="long_nl"></textarea> 												    
                                        </div>
										</div>
                                        
                                    </div>
                                    <!-- /.box-body -->
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                    <!--<button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Add</button>-->
                                    <input type="button" name="submit" id="add_pages" class="btn btn-primary" value="Submit" />
                                </div>
                            </form>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div>
                <!-- /.Add Modal -->             

                <!-- Edit Modal -->
                <div class="modal fade" id="modal-edit">
                    <div class="modal-dialog"><!-- modal-dialog -->
                        <div class="modal-content"><!-- modal-content -->
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Edit Postcode</h4>
                                <form role="form">
                            </div>
                            <div class="modal-body">
                                <p id="edit_notimsg"></p>
                                <div class="box-body" id="edit_postcode_data">

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                <button type="button" id="update_rec" class="btn btn-primary"><i class="fa fa-pencil"></i> Edit</button>
                                </form>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div>
                <!-- /.Edit Modal -->

                <!-- Status Change Modal -->
                <div class="modal fade" id="modal-stateChange">
                    <div class="modal-dialog"><!-- modal-dialog -->
                        <div class="modal-content"><!-- modal-content -->
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Change Postcode's Status</h4>
                                <form method="post" >
                            </div>
                            <div class="modal-body">
                                <p id="status_notimsg"></p>
                                <div class="box-body" id="return_string1">

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="button" name="changestatusbtn" id="changestatusbtn" class="btn btn-info btn-danger pull-right">Submit</button>
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
                                <h4 class="modal-title">Delete Postcode</h4>
                                <form role="form">
                            </div>
                            <div class="modal-body">
                                <p>Are you sure?<br/>You are going to delete this postcode. This operation can not be undo.</p>
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
	<!--<script>
       CKEDITOR.replace( 'long_description' );
       CKEDITOR.replace( 'long_nl' );
    </script>-->
            <script type="text/javascript">

                function load() {
                    url = b_url + 'pages_action.php';
                    var pages_action = 'load';
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {pages_action: pages_action},
                        dataType: "html",
                        success: function (data)
                        {   //console.log(data);
                            $('#list_data').html('');
                            $('#list_data').html(data);
                        }
                    });
                }

                function clear() {

                    $('#pagename').val('');
                    $('#pagename_ml').val('');
                    $('#heading').val('');
                    $('#headling_nl').val('');
                    $('#short_description').val('');
                    $('#short_nl').val('');
                    $('#long_description').val('');
                    $('#long_nl').val('');


                }

                $(function () {
                    load();
                });

                $(document).on('click', '#refersh', function () {
                    load();
                });

                $(document).on('click', '#add_pages', function () {
                    
                    var pages_action = 'add_pages';
                    var pagename = $("#pagename").val();
                    var pagename_ml = $("#pagename_ml").val();
                    var heading = $("#heading").val();
                    var headling_nl = $("#headling_nl").val();
                    var short_description = $("#short_description").val();
                    var short_nl = $("#short_nl").val();
                    var long_description = $("#long_description").val();
                    var long_nl = $("#long_nl").val();
                    url = b_url + 'pages_action.php';  //console.log(url);  console.log();
                    // console.log(url);
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            pages_action: pages_action,
                            pagename: pagename,
                            pagename_ml: pagename_ml,
                            heading: heading,
                            headling_nl: headling_nl,
                            short_description: short_description,
                            short_nl: short_nl,
                            long_description: long_description,
                            long_nl: long_nl
							},
                        dataType: "html",
                        success: function (data)
                        {
                            load();

                            //console.log(data);

                            $('#add_notimsg').html('');
                            $('#add_notimsg').html(data);
                            clear();
                            $("#add_notimsg").fadeIn(1000);
                            setTimeout(function () {
                                $('#add_notimsg').delay(3000).fadeOut('1000')
                            }, 1000);
                        }
                    });

                });

                $(document).on('click', '#edit_record', function () {
                    var postcode_id = $(this).attr("dataid");
                    url = b_url + 'pages_action.php';
                    var pages_action = 'get_data4edit';
                    
                    
                    // console.log(url);
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            postcode_id: postcode_id,
                            pages_action: pages_action
                        },
                        dataType: "html",
                        success: function (data)
                        {
                            //console.log(data);
                            $('#edit_postcode_data').html('');
                            $('#edit_postcode_data').html(data);
                        }
                    });

                });
                $(document).on('click', '#update_rec', function () {
                    
                    var id = $("#id").val();   //console.log(id);
                    var pages_action = 'edit_postcode';
                    var pagename = $("#pagenamenew").val();
                    var pagename_ml = $("#pagename_mlnew").val();
                    var heading = $("#headingnew").val();
                    var headling_nl = $("#headling_nlnew").val();
                    var short_description = $("#short_descriptionnew").val();
                    var short_nl = $("#short_nlnew").val();
                    var long_description = $("#long_descriptionnew").val();
                    var long_nl = $("#long_nlnew").val();
					url = b_url + 'pages_action.php';  //console.log(url);  console.log();
                    // console.log(url);
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            pages_action: pages_action,
                            id: id,
                            pagename: pagename,
                            pagename_ml: pagename_ml,
                            heading: heading,
                            headling_nl: headling_nl,
                            short_description: short_description,
                            short_nl: short_nl,
                            long_description: long_description,
                            long_nl: long_nl
							},
                        dataType: "html",
                        success: function (data)
                        {
                            load();

                            //console.log(data);

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

                $(document).on('click', '#change_record', function () {
                    var postcode_id = $(this).attr("dataid");   //console.log(id);
                    var pages_action = 'change_postcode_status_get';
                    url = b_url + 'pages_action.php';  //console.log(url);  console.log();
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {postcode_id: postcode_id, pages_action: pages_action},
                        dataType: "html",
                        success: function (data)
                        {//   console.log(data);
                            $('#return_string1').html('');
                            $('#return_string1').html(data);
                        }
                    });
                });
                $(document).on('click', '#changestatusbtn', function () {
                    var postcode_id = $("#postcode_id").val();
                    var selected_value = $("#currentstatus option:selected").text();
                    var pages_action = 'postcode_status_set';
                    url = b_url + 'pages_action.php';
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {pages_action: pages_action, selected_value: selected_value, postcode_id: postcode_id},
                        dataType: "html",
                        success: function (data)
                        {
                            load();

                            //console.log(data);

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
                    var postcode_id = $(this).attr("dataid");   //console.log(id);
                    $("#dele_hidden").val(postcode_id);
                });
                $(document).on('click', '#del_rec', function () {
                    var postcode_id = $("#dele_hidden").val(); //console.log(id);
                    url = b_url + 'pages_action.php';  //console.log(url);  console.log();
                    var pages_action = 'delete';
                    // console.log(url);
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {pages_action: pages_action, postcode_id: postcode_id},
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

