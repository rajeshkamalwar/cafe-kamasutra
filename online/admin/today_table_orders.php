<?php
include 'db.php';
include 'config.php';
ob_start();
 
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
<?php
	  $list_gift_query = "Select * From `admin_orders` where `order_date` like '" . date('Y-m-d') . "%' ORDER BY `id` DESC"; 
        $result_list_gift_query = $mysqli->query($list_gift_query);
											
	 $list_gift_query2 = "Select * From `admin_orders_new` where `order_date` like '" . date('Y-m-d') . "%' ORDER BY `id` DESC"; 
        $result_list_gift_query2 = $mysqli->query($list_gift_query2);
											
        $list_gift = '<tbody><tr>
                                                <th>#</th>
                                                <th>Table No.</th>
											    <th>Order Date</th>
												<th>Order Time</th>
												<th>Paid With</th>
												<th>Subtotal</th>
												<th>Discount</th>
												<th>Total</th>
                                                <th>Items</th>
												<th>Action</th>
 												
                                            </tr>';
       
		 
		      $cno = 1;
            while ($row = $result_list_gift_query->fetch_assoc()) {
			$list_gift .= '<tr class="listrecord'.$row['id'].'">          <td>' . $cno . '</td>               
			   <td>' . $row['table_no'] . '</td>
			   
			    <td>'. date_format(new DateTime($row["order_date"]), "M d, Y").'</td>
			   <td>'  . date_format(new DateTime($row["order_time"]), "H:i") . '</td>
			   <td><span>' . $row['paid_with'] . '</span><div class="updatebox"  style="display:none;"><select class="orderopt"><option>-</option><option vlaue="Cash">Cash</option><option value="Pin">Pin</option><option value="Card">Card</option></select><button type="button" class="saveorderpayment"  data-orderrow="'.$row['id'].'">Submit</button><input type="hidden" class="payopt"></div></td>
			   <td>' . $row['subtotal'] . '</td>
			   <td>' . $row['discount_if'] . '</td>
			   <td>' . $row['TotalAmount'] . '</td> 
             <td><a title="View Details" class="btn btn-social-icon btn-primary vieworder"   data-result="#result'.$cno.'" class="accordion-toggle hendmouse" id="edit_record" dataid="'.$row['id'].'"><i class="fa fa-eye"></i></a> <a title="Update Status" class="btn btn-social-icon btn-success edit_record" data-toggle="modal" data-target="#modal-edit" id="edit_record" dataid="'.$row['id'].'"><i class="fa fa-pencil"></i></a> <a href="adminorderprint.php?dataid='.$row['id'].'" class="btn btn-social-icon btn-warning"><i class="fa fa-print"></i></a><a class="btn btn-social-icon btn-danger deleterecordbtn" data-toggle="modal" data-target="#modal-delete" id="delete_record" data-id="'.$row['id'].'"><i class="fa fa-trash"></i> </a></td>
                </tr><tr id="result'.$cno.'"  class="listrecord'.$row['id'].'" style="display:none;height:0"><td colspan="5"><div>' . $row['products'] . '</div></td></tr>';
				$cno++;
		 }
											
		
		    
            while ($row = $result_list_gift_query2->fetch_assoc()) {
						$discounton = $row['discounton'];	
			$distype = $row['discountype'];
			if($discounton == 1 && $distype==1){
				$discountis = '%';
			}
	    else if($discounton == 1 && $distype==2){$discountis = 'Fixed';
		}
				else {  $discountis = ' ';}
			$list_gift .= '<tr class="listrecord'.$row['id'].'">          <td>' . $cno . '</td>               
			   <td>' . $row['table_no'] . '</td>
			   
			    <td>'. date_format(new DateTime($row["order_date"]), "M d, Y").'</td>
			   <td>'  . date_format(new DateTime($row["order_time"]), "H:i") . '</td>
			   <td><span>' . $row['paid_with'] . '</span><div class="updatebox"  style="display:none;"><select class="orderopt"><option>-</option><option vlaue="Cash">Cash</option><option value="Pin">Pin</option><option value="Card">Card</option></select><button type="button" class="saveorderpayment"  data-orderrow="'.$row['id'].'">Submit</button><input type="hidden" class="payopt"></div></td>
			   <td>' . $row['total_price'] . '</td>
			   <td>' . $row['disamount1'] . '<span>'.$discountis.'</span></td>
			   <td>' . $row['price_after_dis'] . '</td> 
             <td><a title="View Details" class="btn btn-social-icon btn-primary vieworder"   data-result="#result'.$cno.'" class="accordion-toggle hendmouse" id="edit_record" dataid="'.$row['id'].'"><i class="fa fa-eye"></i></a> <a title="Update Status" class="btn btn-social-icon btn-success edit_record" data-toggle="modal" data-target="#modal-edit" id="edit_record" dataid="'.$row['id'].'"><i class="fa fa-pencil"></i></a> <a href="adminorderprint.php?dataid='.$row['id'].'&new=1" class="btn btn-social-icon btn-warning"><i class="fa fa-print"></i></a><a class="btn btn-social-icon btn-danger deleterecordbtn" data-toggle="modal" data-target="#modal-delete" id="delete_record" data-id="'.$row['id'].'"><i class="fa fa-trash"></i> </a></td>
                </tr><tr id="result'.$cno.'"  class="listrecord'.$row['id'].'" style="display:none;height:0"><td colspan="5"><div>' . $row['producttable2'] . '</table></div></td></tr>';
				$cno++;
		 }									
											
											
        echo $list_gift;
   	
											?>
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

  
<div class="modal modal-danger fade" id="modal-delete" style="display: none;">
                                    <div class="modal-dialog">
                                        <div class="modal-content"> 
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span></button>
                                                <h4 class="modal-title">Delete Order</h4>
                                                
                                            </div>
											<form role="form" id="cform">
                                            <div class="modal-body">
                                                <p>Are you sure?<br>You are going to delete item. This operation can not be undo.</p>
                                                <input type="hidden" value="030821122" id="dele_hidden">
																								<p>Put the code here for delete</p>
												<input type="password" name="delcode" id="delcode" class="form-control">
												 </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default " id="del_close" data-dismiss="modal">Close</button>
																								<button type="button" id="del_rec_bycode" class="btn btn-outline pull-left"><i class="fa fa-trash"></i> Delete</button>
																								</div>
                                                </form>
                                            
                                        </div>  
                                    </div> 
                                </div><!-- model -->
               

            </div>

            <!--// main content -->

            <?php include 'footer.php'; ?>
         <script type="text/javascript">
 
	jQuery(document).ready(function($){
	   jQuery(".vieworder").click(function(){		
		 	 var showresultof = $(this).attr('data-result');			
		 	 $(showresultof).slideToggle(150);
		     $(showresultof).css('height','auto');	   
	  });
	   jQuery(".edit_record").click(function(){		
		 	$(this).parent().parent().find('.updatebox').slideToggle(150);		    
	  });		
 
	  jQuery(".orderopt").click(function(){		 		
		  var valueSelected = this.value;		 
		  if(valueSelected=='-'){			 
		  }
		  else{
			   $(this).parent().parent().find('input.payopt').val(valueSelected);
		  }		 
	});

	   jQuery(".deleterecordbtn").click(function(){		
		 	 var showresultof = $(this).attr('data-id');			
		 	 $('#dele_hidden').val(showresultof);  
	  });		
		   jQuery(".saveorderpayment").click(function(){	
			   var thiss = $(this);
		 	 var showresultof = $(this).attr('data-orderrow');			 
			  var choosedval =   $(this).parent().parent().find('input.payopt').val();	 
                var action = 'updatepaymentopt';
			   if(choosedval==''){
				   return true
			   }
                    $.ajax({
                        type: "POST",
                       url: "table_action.php",
                         data: {showresultof: showresultof, action: action,choosedval:choosedval},
                        dataType: "html",
                        success: function (data1)
                        {
								$(thiss).parent().parent().find('span').html(choosedval);
                           	$(thiss).parent().parent().find('.updatebox').slideToggle(150);		    
                        }
                    });	  
	  });	
		
		
$(document).on('click', '#del_rec_bycode', function () {
                    var rowid = $("#dele_hidden").val(); //console.log(id);
					var delcode = $("#delcode").val();
					 if ($("#delcode").val() == "") {
                        alert("Please provide Code!");
                        $("#delcode").focus();
                        return false;
                    }
                    var action = 'deletebycode';
                  
                    $.ajax({
                        type: "POST",
                       url: "table_action.php",
                        data: {
                            rowid: rowid,
							delcode:delcode,
                            action:action
                        },
                        dataType: "html",
                        success: function (data)
                        {
							if(data==1){
								alert('Delete code is wrong');
							}
							else{
								 $("#del_close").click();
								$('body').find('tr.listrecord'+rowid).fadeOut(2000);
							}

							console.log(data);
                            
                        }
                    });

                });		
		
		
		});
</script>


    </body>
</html>
