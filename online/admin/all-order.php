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
.hiddenRow {
    padding: 0 !important;
}
@media print {
                /*  body * {
                    visibility: hidden;
                  }
                */
                @page {
                    size: auto;   /* auto is the initial value */
                    margin: 0;  /* this affects the margin in the printer settings */
                }
                #printcontent, #printcontent * {
                    /*max-width:300px !important;*/
                    width:300px !important;
                    visibility: visible;
                }
                #section-to-print {
                    position: absolute;
                    left: 0;
                    top: 0;
                }
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
                        Order
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="">Menu</li><li class="active">order</li>
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
                                    <h3 class="box-title">About Order</h3>

                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                    <!-- /.box-tools -->
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <blockquote>
                                        <p>Here you can see all details about orders you received.</p>

                                    </blockquote>
                                </div>
                                <!-- /.box-body -->
                            </div>

                        </div>
						
                        <!-- /.About section -->
                        <p id="del_notimsg"></p>
                    </div>
<?php
						if(isset($_GET['n'])){
							if($_GET['n']=='1'){ ?>
						 <div class="alert alert-success alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Success!</strong> Mail has been sent.
  </div>
						<?php } } 
						?>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <div class="row"> 
                                        <div class="col-lg-8">
                                            <h3 class="box-title">Orders</h3>
                                        </div>
                                        <div class="col-lg-4 ">

                                            <div class="pull-right">
                                                <div class="checkbox" style="float:left;"><label><input type="checkbox" id="show_all_order" name="show_all_order"> Show All Order</label></div>&nbsp;&nbsp;
                                                <button type="button" id="refersh" class="btn btn-primary "><i  class="fa fa-refresh"></i> Refresh</button>
                                                
<!--                                                <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#modal-add"><i  class="fa fa-plus"></i> Add New</button>-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body table-responsive no-padding">
                                    <div class="col-sm-12">
                                        <table class="table table-hover table-condensed" id="list_data"  style="border-collapse:collapse;">

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


<!--                 Add Modal 
                <div class="modal fade" id="modal-add">
                    <div class="modal-dialog"> modal-dialog 
                        <div class="modal-content"> modal-content 
                            <form method="post" > 
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Add New Gift Item</h4>
                                </div>
                                <div class="modal-body">
                                    <p>One fine body&hellip;</p>
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
                                     /.box-body 
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default pull-left" id="add_cancel" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Add</button>
                                    <input type="button" name="submit" id="add_gift_form" class="btn btn-primary" value="Submit" />
                                </div>
                            </form>
                        </div> /.modal-content 
                    </div> /.modal-dialog 
                </div>
                 /.Add Modal -->

<!--                 View Modal 
                <div class="modal fade" id="modal-view">
                    <div class="modal-dialog"> modal-dialog 
                        <div class="modal-content"> modal-content 
                            <form method="post" > 
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">View Gift's Details</h4>
                                </div>
                                <div class="modal-body">
                                    <p>One fine body&hellip;</p>

                                    <div class="box-body" id="view_gift_data">

                                    </div>
                                     /.box-body 
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default pull-left"  data-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div> /.modal-content 
                    </div> /.modal-dialog 
                </div>
                 /.View Modal -->

                <!-- Edit Modal -->
                <div class="modal fade" id="modal-edit">
                    <div class="modal-dialog"><!-- modal-dialog -->
                        <div class="modal-content"><!-- modal-content -->
                            <form method="post" > 
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Update Status Of Order</h4>
                                </div>
                                <div class="modal-body">
                                    <!--<p>One fine body&hellip;</p>-->
                                    <p id="edit_notimsg"></p><br/><br/>
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

<!--                 Delete Modal -->
                 <?php $del_query22="Select * from adm_set where adm_set_name='delcheck' ";
                $result_del_query22 = $mysqli->query($del_query22);
				$row_delusr22 = $result_del_query22->fetch_assoc();
				$delcheck = $row_delusr22['adm_set_vlu']; ?>
				
                                <div class="modal modal-danger fade" id="modal-delete">
                                    <div class="modal-dialog">
                                        <div class="modal-content"> 
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title">Delete Order</h4>
                                                
                                            </div>
											<form role="form" id="cform">
                                            <div class="modal-body">
                                                <p>Are you sure?<br/>You are going to delete item. This operation can not be undo.</p>
                                                <input type="hidden" value="" id="dele_hidden">
												<?php if($delcheck=='yes'){?>
												<p>Put the code here for delete</p>
												<input type="password" name="delcode" id="delcode" class="form-control">
												<?php } ?>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default " id="del_close" data-dismiss="modal">Close</button>
												<?php if($delcheck=='yes'){?>
												<button type="button" id="del_rec_bycode" class="btn btn-outline pull-left"><i class="fa fa-trash"></i> Delete</button>
												<?php } else { ?>
                                                <button type="button" id="del_rec" class="btn btn-outline pull-left"><i class="fa fa-trash"></i> Delete</button>
												<?php } ?>
												</div>
                                                </form>
                                            
                                        </div>  
                                    </div> 
                                </div>
              <!--   /.Delete Modal -->

            </div>

            <!--// main content -->

            <?php include 'footer.php'; ?>
            <script type="text/javascript">
                
                function load() {
                    url = b_url + 'all_order_action.php';
                    var showallodr='';
                    if ($("#show_all_order").prop('checked') == true) {showallodr="yes";}else{showallodr="No";}
                    var gift_action = 'load';
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {gift_action: gift_action,showallodr:showallodr},
                        dataType: "html",
                        success: function (data)
                        {   //console.log(data);
                            $('#list_data').html('');
                            $('#list_data').html(data);
                            //removeextradata();
                        }
                    });
                    
                }

//function removeextradata(){
//    
////    var rowCount = $('#list_data #order_table').length
////    var rowCount=rowCount-4;
//    
//    //$('#list_data #order_table tr:nth-child(n+4)').remove();
//}
                

                $(function () {
                    load();
                });

                $(document).on('click', '#refersh', function () {
                    load();
                });

              

                $(document).on('click','#show_all_order',function(){
                     load();
                });

                $(document).on('click', '#edit_record', function () {
                    var ot_id = $(this).attr("dataid");
                    var gift_action =  'edit_load_record';
                    url = b_url + 'all_order_action.php';
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            ot_id:ot_id,
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
                    url = b_url + 'all_order_action.php';
                    var gift_action = 'edit';
                    var ot_id = $('#ot_id').val();
					var ot_trxid = $('#ot_trxid').val();
                    var selected_val=$("#currentstatus option:selected").val();
                    var ot_paymentoption=$("#ot_paymentoption option:selected").val();
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            gift_action:gift_action,
                            ot_id:ot_id,
                            selected_val:selected_val,
							ot_paymentoption:ot_paymentoption,
							ot_trxid:ot_trxid							
                        },
                        dataType: "html",
                        success: function (data)
                        {
                            load();
                            $('#edit_notimsg').html('');
                            $('#edit_notimsg').html(data);
                            
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
                    var attrib_id = $("#dele_hidden").val(); //console.log(id);
					//alert(attrib_id);
                    var gift_action = 'delete';
                    url = b_url + 'all_order_action.php';
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            attrib_id: attrib_id,
                            gift_action:gift_action
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
	$(document).on('click', '#del_rec_bycode', function () {
                    var attrib_id = $("#dele_hidden").val(); //console.log(id);
					var delcode = $("#delcode").val();
					 if ($("#delcode").val() == "") {
                        alert("Please provide Code!");
                        $("#delcode").focus();
                        return false;
                    }
                    var gift_action = 'deletebycode';
                    url = b_url + 'all_order_action.php';
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            attrib_id: attrib_id,
							delcode:delcode,
                            gift_action:gift_action
                        },
                        dataType: "html",
                        success: function (data)
                        {

                            $("#del_close").click();
                            load();
                            $('#del_notimsg').html('');
                            $('#del_notimsg').html(data);
							$("#cform")[0].reset();
                            $("#del_notimsg").fadeIn(1000);
                            setTimeout(function () {
                                $('#del_notimsg').delay(3000).fadeOut('1000')
                            }, 1000);
                        }
                    });

                });
            
				
				
		
		   ///$(".printorder").click(function(){	
			   	$(document).on('click', '.printorder', function () {
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
