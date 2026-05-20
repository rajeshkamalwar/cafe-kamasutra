<?php
include 'db.php';
include 'config.php';
ob_start();
include 'conform_user.php';
include 'import_functions.php';

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Welcome <?= $name ?> </title>
        <?php include 'header.php'; ?>  
   <link rel="stylesheet" href="theme_assets/jquery.cleditor.css" />
    <script src="theme_assets/jquery.min.js"></script>
		<script src="theme_assets/jquery-3.0.0.js"></script>
    <script src="theme_assets/jquery.cleditor.min.js"></script>
  <style>
	  .delete{
    color: red;
}

.delete:hover{
	cursor: pointer;
}
	  .eamil-list table {
    width: 100%;
}
	  table.import-user {
    width: 100%;
}
	  legend {
    text-align: center;
    padding-bottom: 20px;
}
	  .imp-set {
    border: 1px solid #d7d7d7;
    padding: 20px;
}
	  td.bd {
    background: #3498db;
    color: #fff;
    text-align: center;
}
	  th { 
	background: #3498db; 
	color: white; 
	font-weight: bold; 
	}

td, th { 
	padding: 10px; 
	border: 1px solid #ccc; 
	text-align: center; 
	font-size: 18px;
	}

/* 
Max width before this PARTICULAR table gets nasty
This query will take effect for any screen smaller than 760px
and also iPads specifically.
*/
@media 
only screen and (max-width: 760px),
(min-device-width: 768px) and (max-device-width: 1024px)  {

	table { 
	  	width: 100%; 
	}

	/* Force table to not be like tables anymore */
	table, thead, tbody, th, td, tr { 
		display: block; 
	}
	
	/* Hide table headers (but not display: none;, for accessibility) */
	thead tr { 
		position: absolute;
		top: -9999px;
		left: -9999px;
	}
	
	tr { border: 1px solid #ccc; }
	
	td { 
		/* Behave  like a "row" */
		border: none;
		border-bottom: 1px solid #eee; 
		position: relative;
		padding-left: 50%; 
	}

	td:before { 
		/* Now like a table header */
		position: absolute;
		/* Top/left values mimic padding */
		top: 6px;
		left: 6px;
		width: 45%; 
		padding-right: 10px; 
		white-space: nowrap;
		/* Label the data */
		content: attr(data-column);

		color: #000;
		font-weight: bold;
	}

}
 #promotn_modul54 .form-control {    margin-bottom: 10px;}
  .eamil-list {
    padding: 30px;
}
  </style>
  
  
    </head>
    <body class="hold-transition <?= theme_skin ?> sidebar-mini">
        


        <div id="promotn_modul54" class="wrapper">
            <div class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
                <!-- left-fixed -navigation--><?php include 'left-nav.php'; ?><!-- /.left-fixed -navigation-->
            </div>
            <!-- header-starts --><?php include 'top-strip-menu.php'; ?><!-- /.header-starts -->


            <!-- main content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                      Email Module
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="">Menu</li><li class="active"> Email Module</li>
                    </ol>
                </section>



                <!-- Inner content -->
                <section class="content">

                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <p id="del_notimsg"></p>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body table-responsive no-padding">
                                    <div class="col-sm-12 imp-em-tb">
										  <form class="form-horizontal" action="import_functions.php" method="post" name="upload_excel" enctype="multipart/form-data">
                                           <fieldset>

                                              <!-- Form Name -->
                                              <legend>Import CSV file data</legend>

                                              <!-- File Button -->
											   <div class="imp-set">
                                              <div class="form-group">
                                                <label class="col-md-4 control-label" for="filebutton">Select File</label>
                                                <div class="col-md-4">
                                                <input type="file" name="file" id="file" class="input-large" required>
                                                </div>
                                              </div>
						
                                              <!-- Button -->
                                             <div class="form-group">
                                                <label class="col-md-4 control-label" for="singlebutton">Import data</label>
                                                <div class="col-md-4">
                                                <button type="submit" id="submit" name="Import" class="btn btn-primary button-loading" data-loading-text="Loading...">Upload</button>
                                                </div>
												   </div>
                                             </div>
						
                                           </fieldset>
                                          </form>
				
                                    </div>
									
									 


                                </div>
<div class="eamil-list">
<table border='1' >
                <tr style='background: whitesmoke;'>
                    <th>S.no</th>
                    <th>Name</th>
                    <th>Email</th>
					<th>Action</th>
                </tr>

                <?php 
                $query = "SELECT * FROM email_import";
                $result = mysqli_query($mysqli,$query);

                $count = 1;
                while($row = mysqli_fetch_array($result) ){
                    $id = $row['id'];
                    $title = $row['name'];
                    $name = $row['email'];

                ?>
                    <tr>
                        <td align='center'><?= $count; ?></td>
                        <td  align='center'><?= $title; ?></td>
						<td  align='center'><?= $name; ?></td>
                        <td align='center'><span class='delete' data-id='<?= $id; ?>'>Delete</span></td>
                    </tr>
                <?php
                    $count++;
                }
                ?>
            </table>
</div>	
 </div>
</div><!-- /.row -->
</div>
 </section>
              
</div>
</div>
<style>
  #alert_popover
  {
   display:block;
   position:fixed;
   top:60px;
   left:550px;
  }
  
  .alert_default
  {
   color: #333333;
   background-color: #f2f2f2;
   border-color: #cccccc;
  }
  </style> 
 
<footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.0
    </div>
    <strong>Copyright &copy; <?php echo date("Y")." - ".date('Y', strtotime('+1 year')); ?> <a href="#">xyz company</a>.</strong> All rights
    reserved.
  </footer>

   
   
  <script src="theme_assets/bower_components/jquery-ui/jquery-ui.min.js"></script>
<script>
$(document).ready(function(){

    // Delete 
    $('.delete').click(function(){
        var el = this;

        // Delete id
        var id = $(this).data('id');
        
        var confirmalert = confirm("Are you sure?");
        if (confirmalert == true) {
            // AJAX Request
            $.ajax({
                url: 'remove_import_email.php',
                type: 'POST',
                data: { id:id },
                success: function(response){
    
                    if(response == 1){
                        // Remove row from HTML Table
                        $(el).closest('tr').css('background','tomato');
                        $(el).closest('tr').fadeOut(800,function(){
                            $(this).remove();
                        });
                    }else{
                        alert('Invalid ID.');
                    }
                }
            });
        }
    });
});
</script>	


<!-- Bootstrap 3.3.7 -->
<!-- Bootstrap 3.3.7 -->
<script src="theme_assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="theme_assets/bower_components/raphael/raphael.min.js"></script>
<script src="theme_assets/bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="theme_assets/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="theme_assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="theme_assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="theme_assets/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="theme_assets/bower_components/moment/min/moment.min.js"></script>
<script src="theme_assets/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="theme_assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="theme_assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="theme_assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="theme_assets/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="theme_assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="theme_assets/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="theme_assets/dist/js/demo.js"></script>
<script src="theme_assets/plugins/iCheck/icheck.min.js"></script>


    </body>
</html>