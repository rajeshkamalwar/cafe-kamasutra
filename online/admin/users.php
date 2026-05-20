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
                        Users
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="">Menu</li><li class="active">Users</li>
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
                                    <h3 class="box-title">About Users</h3>
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
                                            <h3 class="box-title">Available Users</h3>
                                        </div>
                                        <div class="col-lg-6 ">
                                            <div class="pull-right">
                                                <button type="button" id="refersh" class="btn btn-primary "><i  class="fa fa-refresh"></i> Refresh</button> 
                                                        
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
                                    <h4 class="modal-title">Add New User</h4>

                                </div>
                                <div class="modal-body">
                                    <!--<p>One fine body&hellip;</p>-->
                                    <p id="add_notimsg"></p>
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="username">Username </label>
                                            <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username" required >
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter Passsword" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="attributes price">Email Id</label>
                                            <input type="email" class="form-control" id="emailid" name="emailid" placeholder="Enter Email Id" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="attributes price">Mobile Number</label>
                                            <input type="text" class="form-control" id="number" name="number" placeholder="Enter Mobile Number" required>
                                        </div>
										<h4>Users module</h4>
                                           <div class="form-group">
											    <label for="attributes price">Sales Report</label>
                                            <input type="checkbox"  id="sales_report" name="sales_report" value="1" >
											<label for="attributes price">Customer</label>
                                            <input type="checkbox"  id="customer" name="customer" value="1" >
											   <label for="postcode">Welcome Text</label>
                                            <input type="checkbox"  id="welcome" name="welcome" value="1">
											   <label for="postcode">Cashier</label>
                                            <input type="checkbox"  id="cashier" name="cashier" value="1">
											   <label for="postcode">Users</label>
                                            <input type="checkbox"  id="users" name="users" value="1">
                                            <label for="postcode">Postcode</label>
                                            <input type="checkbox"  id="postcode" name="postcode" value="1">
											    <label for="minorder">Min order</label>
                                            <input type="checkbox"  id="minorder" name="minorder" value="1">
											    <label for="products">Menu/Products</label>
                                            <input type="checkbox"  id="products" name="products" value="1">
											    <label for="attributes price">Time Setting</label>
                                            <input type="checkbox"  id="time_setting" name="time_setting" value="1">
											    <label for="attributes price">Dish by category</label>
                                            <input type="checkbox"  id="dishbycategory" name="dishbycategory" value="1">
											    <label for="attributes price">Gift Item</label>
                                            <input type="checkbox"  id="gift_item" name="gift_item" value="1"> 
											   <label for="attributes price">Delivery Item</label>
                                            <input type="checkbox"  id="delivery_item" name="delivery_item" value="1">
											    <label for="attributes price">Discount</label>
                                            <input type="checkbox"  id="discount" name="discount"value="1">
											    <label for="attributes price">Holidays</label>
                                            <input type="checkbox"  id="holidays" name="holidays" value="1">
											   <label for="attributes price">Orders</label>
                                            <input type="checkbox"  id="order" name="order" value="1">
											   <label for="attributes price">Setting</label>
                                            <input type="checkbox"  id="setting" name="setting" value="1" >
											    <label for="attributes price">Pre Order</label>
                                            <input type="checkbox"  id="preorder" name="preorder" value="1" >
											   <label for="attributes price">Cutlery charges</label>
                                            <input type="checkbox"  id="cutlery_charges" name="cutlery_charges" value="1" >
											  
											   <label for="attributes price">GPS Mail Text</label>
                                            <input type="checkbox"  id="gps_mail" name="gps_mail" value="1" >
											    <label for="attributes price">2nd Coupon Mail </label>
                                            <input type="checkbox"  id="coupon_mail" name="coupon_mail" value="1" >
											    <label for="attributes price">Lost Customer</label>
                                            <input type="checkbox"  id="lost_customer" name="lost_customer" value="1" >
											    <label for="attributes price">Newsletter</label>
                                            <input type="checkbox"  id="newsletter" name="newsletter" value="1" >
											    <label for="attributes price">Plastic charge</label>
                                            <input type="checkbox"  id="plastic_charge" name="plastic_charge" value="1" >
											    <label for="attributes price">Review</label>
                                            <input type="checkbox" id="review" name="review" value="1" >
											   <label for="attributes price">Tip</label>
                                            <input type="checkbox" id="tip" name="tip" value="1" >
											   <label for="attributes price">Table</label>
                                            <input type="checkbox" id="table" name="table" value="1" >
											   <label for="attributes price">Promotion</label>
                                            <input type="checkbox" id="promotion" name="promotion" value="1" >
											   <label for="attributes price">Email Import</label>
                                            <input type="checkbox" id="email_import" name="email_import" value="1" >
											     <label for="attributes price">Reservation</label>
                                            <input type="checkbox" id="reserva_module" name="reserva_module" value="1" >
                                        </div> 
                                    </div>
                                    <!-- /.box-body -->
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                    <!--<button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Add</button>-->
                                    <input type="button" name="submit" id="add_postcode" class="btn btn-primary" value="Submit" />
                                </div>
                            </form>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div>
                <div class="modal fade" id="modal-edit">
                    <div class="modal-dialog"><!-- modal-dialog -->
                        <div class="modal-content"><!-- modal-content -->
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Edit User</h4>
                            </div>
							<form role="form">
                            <div class="modal-body">
                                <p id="edit_notimsg"></p>
                                <div class="box-body" id="edit_postcode_data">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                <button type="button" id="update_rec" class="btn btn-primary"><i class="fa fa-pencil"></i> Edit</button>
                            </div>
								</form>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div>
               <div class="modal fade" id="modal-stateChange">
                    <div class="modal-dialog"><!-- modal-dialog -->
                        <div class="modal-content"><!-- modal-content -->
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Change User's Status</h4>
                                
                            </div>
							<form method="post" >
                            <div class="modal-body">
                                <p id="status_notimsg"></p>
                                <div class="box-body" id="return_string1">

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="button" name="changestatusbtn" id="changestatusbtn" class="btn btn-info btn-danger pull-right">Submit</button>
                               
                            </div>
								 </form>
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
                               
                            </div>
							 <form role="form">
                            <div class="modal-body">
                                <p>Are you sure?<br/>You are going to delete this User. This operation can not be undo.</p>
                                <input type="hidden" value="" id="dele_hidden">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default " id="del_close" data-dismiss="modal">Close</button>
                                <button type="button" id="del_rec" class="btn btn-outline pull-left"><i class="fa fa-trash"></i> Delete</button>
                                
                            </div>
								 </form>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div>
                <!-- /.Delete Modal -->

            </div>

            <!--// main content -->

            <?php include 'footer.php'; ?>
            <script type="text/javascript">

                function load() {
                    url = b_url + 'users_action.php';
                    var postcode_action = 'load';
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {postcode_action: postcode_action},
                        dataType: "html",
                        success: function (data)
                        {   //console.log(data);
                            $('#list_data').html('');
                            $('#list_data').html(data);
                        }
                    });
                }

                function clear() {

                    $('#username').val('');
                    $('#password').val('');
                    $('#emailid').val('');
                    $('#number').val('');
                }

                $(function () {
                    load();
                });

                $(document).on('click', '#refersh', function () {
                    load();
                });

                $(document).on('click', '#add_postcode', function () {
                    if ($("#username").val() == "") {
                        alert("Please provide username!");
                        $("#username").focus();
                        return false;
                    }
                    if ($("#passowrd").val() == "") {
                        alert("Please provide Password!");
                        $("#passowrd").focus();
                        return false;
                    }
                    
                    var postcode_action = 'add_postcode';
                    var username = $("#username").val();
                    var password = $("#password").val();
                    var emailid = $("#emailid").val();
                    var number = $("#number").val();
					var welcome = $("#welcome:checked").val();
					var cashier = $("#cashier:checked").val();
					var users = $("#users:checked").val();
					var postcode = $("#postcode:checked").val();
					var minorder = $("#minorder:checked").val();
					var products = $("#products:checked").val();
					var time_setting = $("#time_setting:checked").val();
					var dishbycategory = $("#dishbycategory:checked").val();
					var gift_item = $("#gift_item:checked").val();
					var delivery_item = $("#delivery_item:checked").val();
					var discount = $("#discount:checked").val();
					var holidays = $("#holidays:checked").val();
					var order = $("#order:checked").val();
					var setting = $("#setting:checked").val();
			var preorder = $("#preorder:checked").val();
					var sales_report = $("#sales_report:checked").val();
					var gps_mail = $("#gps_mail:checked").val();
					var cutlery_charges = $("#cutlery_charges:checked").val();
					var customer = $("#customer:checked").val();
					var coupon_mail = $("#coupon_mail:checked").val();
					var lost_customer = $("#lost_customer:checked").val();
					var newsletter = $("#newsletter:checked").val();
					var plastic_charge = $("#plastic_charge:checked").val();
					var review = $("#review:checked").val();
					var tip = $("#tip:checked").val();
					var table = $("#table:checked").val();
					var promotion = $("#promotion:checked").val();
					var email_import = $("#email_import:checked").val();
                    var reserva_module =$('#reserva_module').val();
                    url = b_url + 'users_action.php';  //console.log(url);  console.log();
                    // console.log(url);
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            postcode_action: postcode_action,
                            username: username,
                            password: password,
                            emailid: emailid,
                            number: number,
							coupon_mail:coupon_mail,
							lost_customer:lost_customer,
							newsletter:newsletter,
							plastic_charge:plastic_charge,
							review:review,
							tip:tip,
							table:table,
							promotion:promotion,
							email_import:email_import,
							welcome: welcome,
							cashier: cashier,
							users: users,
							postcode: postcode,
							minorder: minorder,
							products: products,
							time_setting: time_setting,
							dishbycategory: dishbycategory,
							gift_item: gift_item,
							delivery_item: delivery_item,
							discount: discount,
							holidays: holidays,
							order: order,
							setting: setting,
							preorder:preorder,
							sales_report:sales_report,
							cutlery_charges:cutlery_charges,
							gps_mail:gps_mail,
							customer:customer,
							reserva_module:reserva_module
						
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
                    url = b_url + 'users_action.php';
                    var postcode_action = 'get_data4edit';
                    
                    
                    // console.log(url);
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            postcode_id: postcode_id,
                            postcode_action: postcode_action
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
                    
                    if ($("#username_edit").val() == "") {
                        alert("Please provide username!");
                        $("#postcode_name_edit").focus();
                        return false;
                    }
                    if ($("#password_edit").val() == "") {
                        alert("Please provide Password!");
                        $("#password_edit").focus();
                        return false;
                    }
                   
                    
                    var postcode_id = $("#postcode_id").val();   //console.log(id);
                    var postcode_action = 'edit_postcode';
                    var username_edit = $("#username_edit").val();
                    var password_edit = $("#password_edit").val();
                    var emailid_edit = $("#emailid_edit").val();
                    var number_edit = $("#number_edit").val();
					var welcome = $("#welcome:checked").val();
					var cashier = $("#cashier:checked").val();
					var users = $("#users:checked").val();
					var postcode = $("#postcode:checked").val();
					var minorder = $("#minorder:checked").val();
					var products = $("#products:checked").val();
					var time_setting = $("#time_setting:checked").val();
					var dishbycategory = $("#dishbycategory:checked").val();
					var gift_item = $("#gift_item:checked").val();
					var delivery_item = $("#delivery_item:checked").val();
					var discount = $("#discount:checked").val();
					var holidays = $("#holidays:checked").val();
					var order = $("#order:checked").val();
					var setting = $("#setting:checked").val();
					var preorder = $("#preorder:checked").val();
					var sales_report = $("#sales_report:checked").val();
					var gps_mail = $("#gps_mail:checked").val();
					var cutlery_charges = $("#cutlery_charges:checked").val();
					var customer_edit = $("#customer_edit:checked").val();
					var coupon_mail_edit = $("#coupon_mail_edit:checked").val();
					var lost_customer_edit = $("#lost_customer_edit:checked").val();
					var newsletter_edit = $("#newsletter_edit:checked").val();
					var plastic_charge_edit = $("#plastic_charge_edit:checked").val();
					var review_edit = $("#review_edit:checked").val();
					var tip_edit = $("#tip_edit:checked").val();
					var table_edit = $("#table_edit:checked").val();
					var promotion_edit = $("#promotion_edit:checked").val();
					var email_import_edit = $("#email_import_edit:checked").val();
						var reserva_module = $("#reserv_module_edit:checked").val();
					
					//alert(preorder);
                    url = b_url + 'users_action.php';  //console.log(url);  console.log();
                    // console.log(url);
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            postcode_action: postcode_action,
                            postcode_id: postcode_id,
                            username_edit: username_edit,
                            password_edit: password_edit,
                            emailid_edit: emailid_edit,
                            number_edit: number_edit,
							welcome: welcome,
							cashier: cashier,
							users: users,
							postcode: postcode,
							minorder: minorder,
							products: products,
							time_setting: time_setting,
							dishbycategory: dishbycategory,
							gift_item: gift_item,
							delivery_item: delivery_item,
							discount: discount,
							holidays: holidays,
							order: order,
							setting: setting,
							preorder:preorder,
							sales_report:sales_report,
							cutlery_charges:cutlery_charges,
							gps_mail:gps_mail,
							coupon_mail_edit:coupon_mail_edit,
							lost_customer_edit:lost_customer_edit,
							newsletter_edit:newsletter_edit,
							plastic_charge_edit:plastic_charge_edit,
							review_edit:review_edit,
							tip_edit:tip_edit,
							table_edit:table_edit,
							promotion_edit:promotion_edit,
							email_import_edit:email_import_edit,
							customer_edit:customer_edit,
							reserva_module:reserva_module
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
                    var postcode_action = 'change_postcode_status_get';
                    url = b_url + 'postcode_action.php';  //console.log(url);  console.log();
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {postcode_id: postcode_id, postcode_action: postcode_action},
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
                    var postcode_action = 'postcode_status_set';
                    url = b_url + 'users_action.php';
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {postcode_action: postcode_action, selected_value: selected_value, postcode_id: postcode_id},
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
                    url = b_url + 'users_action.php';  //console.log(url);  console.log();
                    var postcode_action = 'delete';
                    // console.log(url);
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {postcode_action: postcode_action, postcode_id: postcode_id},
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

