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
                        Customer
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="">Menu</li><li class="active">Customer</li>
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
                                    <h3 class="box-title">About Customer</h3>
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
                                            <h3 class="box-title">Available Customer</h3>
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
                                <h4 class="modal-title">Edit Customer</h4>
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
                    url = b_url + 'customer_action.php';
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
							customer:customer
						
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
                    url = b_url + 'customer_action.php';
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
                    
                    var postcode_id = $("#postcode_id").val();   //console.log(id);
                    var postcode_action = 'edit_postcode';
                    var username_edit = $("#username_edit").val();
                    var postcode_edit = $("#postcode_edit").val();
                    var name_edit = $("#name_edit").val();
                    var password_edit = $("#password_edit").val();
					var usr_company = $("#usr_company").val();
					var usr_streetaddress1 = $("#usr_streetaddress1").val();
					var usr_order_phone = $("#usr_order_phone").val();
					var usr_zipcode2letter = $("#usr_zipcode2letter").val();
					var usr_order_city = $("#usr_order_city").val();
					
					//alert(preorder);
                    url = b_url + 'customer_action.php';  //console.log(url);  console.log();
                    // console.log(url);
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            postcode_action: postcode_action,
                            postcode_id: postcode_id,
                            username_edit: username_edit,
                            postcode_edit: postcode_edit,
                            name_edit: name_edit,
                            password_edit: password_edit,
							usr_company: usr_company,
							usr_streetaddress1: usr_streetaddress1,
							usr_order_phone: usr_order_phone,
							usr_zipcode2letter: usr_zipcode2letter,
							usr_order_city: usr_order_city
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

               
                $(document).on('click', '#delete_record', function () {
                    var postcode_id = $(this).attr("dataid");   //console.log(id);
                    $("#dele_hidden").val(postcode_id);
                });
                $(document).on('click', '#del_rec', function () {
                    var postcode_id = $("#dele_hidden").val(); //console.log(id);
                    url = b_url + 'customer_action.php';  //console.log(url);  console.log();
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
				
				
	 $(document).on('click', '.printorderbtn2', function () {
			   var thiss = $(this);
		 	 var showresultof = $(this).attr('data-dataid');			 
                var action = 'printorders';			 
                   $.ajax({
                        type: "POST",
                       url: "all_order_action_print.php",
                         data: {showresultof: showresultof, action: action },
                        dataType: "html",
                        success: function (data1)
                        {
							   // $('#userInfo').html(data1);
							 //  var printContent = document.getElementById('userInfo');
								 var WinPrint = window.open('', '', 'width=900,height=650');
								 WinPrint.document.write(data1);
								 WinPrint.document.close();
								 WinPrint.focus();
								 WinPrint.print();
								 WinPrint.close();	     
                        }
                    });	 
	  });				

            </script>
    </body>
</html>

