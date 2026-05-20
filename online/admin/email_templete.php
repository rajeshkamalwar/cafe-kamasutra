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
     <link rel="stylesheet" href="theme_assets/jquery.cleditor.css" />
    <script src="theme_assets/jquery.min.js"></script>
    <script src="theme_assets/jquery.cleditor.min.js"></script>
  <style>
      input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    margin: 0; 
}

.auto-approve-checkbox {
    margin-left: 22px;
    color: red;
    font-size: 15px;
}

.auto-approve-checkbox #auto-approve {
position:absolute;
left:5px;
   
}

.container {
    width: 978px;
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

                  <!-- About section -->
                        <div class="col-xs-12">
                            <div class="box box-default collapsed-box">
                                <div class="box-header with-border">
                                    <i class="fa fa-bullhorn"></i>
                                    <h3 class="box-title">Send Email Module</h3>

                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                    <!-- /.box-tools -->
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <blockquote>
                                        <p>Few words about Email Module</p>

                                    </blockquote>
                                </div>
                                <!-- /.box-body -->
                            </div>

                        </div>
                        <!-- /.About section -->
                        

                    <div class="row">
                       
                        <div class="col-md-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <p id="del_notimsg"></p>
                                </div>
       
    <div class="box-body table-responsive no-padding">

               <div class="container">
              <div class="msg"></div>
  <h2 class="text-center">Email Form</h2>
<?php   

$type=[
      '1'=>'Book Email',
      '2'=>'Admin Email',
      '3'=>'Approve Email',
      '4'=>'Reject Email',
      '5'=>'Auto Approve Email',

      ];

$d_type=[
      '6'=>'Boek E-mail',
      '7'=>'E-mailadres Admin',
      '8'=>'E-mail goedkeuren',
      '9'=>'E-mail weigeren',
    //  '10'=>'E-mail automatisch goedkeuren',

      ];
  $From_Email_Address= $mysqli->query("Select `adm_set_vlu` from `adm_set` where `adm_set_name`='email_from_smtp'")->fetch_object()->adm_set_vlu;  
	$Additional_Email = $mysqli->query("Select `adm_set_vlu` from `adm_set` where `adm_set_name`='email_from_smtp_pwd'")
    ->fetch_object()->adm_set_vlu;			   
?>
  <form method="POST" class="form-horizontal" id="email_form" action="">
   
     <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Email Template:</label>
      <div class="col-sm-10">          
       <select class="form-control" onchange="select_type(this)" id="type" name="type" required>

            <option value="">Select template</option>';
            
            <?php foreach ($type as $key => $value) { ?>
      
                <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
              <?php }?>
       </select>
      </div>
    </div>

     <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">E-mail sjabloon:</label>
      <div class="col-sm-10">          
       <select class="form-control" onchange="select_type_two(this)" id="type_two" name="type_two" required>

            <option value="">Selecteer sjabloon</option>';
            
            <?php foreach ($d_type as $d_key => $d_value) { ?>
      
                <option value="<?php echo $d_key; ?>"><?php echo $d_value; ?></option>
              <?php }?>
       </select>
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">To(<i>Only admin email</i>):</label>
      <div class="col-sm-10">  

     <input type="text" class="form-control" id="admin_to" placeholder="" name="admin_to"  value="<?php echo $Additional_Email; ?>">
      </div>
    </div>

     <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Aan(<i>Alleen admin e-mail</i>):</label>
      <div class="col-sm-10">  

     <input type="text" class="form-control" id="admin_to_two" placeholder="" name="admin_to_two"  value="<?php echo $Additional_Email; ?>"  readonly="readonly">
      </div>
    </div>

     <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">From:</label>
      <div class="col-sm-10">  
     <input type="text" class="form-control" id="form" placeholder="" name="form"   value="<?php echo $From_Email_Address; ?>">
      </div>
    </div>

      <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Van:</label>
      <div class="col-sm-10">  
     <input type="text" class="form-control" id="form_two" placeholder="" name="form_two"  value="<?php echo $From_Email_Address; ?>">
      </div>
    </div>

     <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Subject:</label>
      <div class="col-sm-10">          
        <input type="text" class="form-control" id="subject" placeholder="" name="subject">
      </div>
    </div>

     <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Onderwerp:</label>
      <div class="col-sm-10">          
        <input type="text" class="form-control" id="subject_two" placeholder="" name="subject_two">
      </div>
    </div>



       <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Body:</label>
      <div class="col-sm-10">          
     <textarea id="content" name="content" cols="10" rows="10"></textarea>
      </div>
    </div>

       <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Lichaam:</label>
      <div class="col-sm-10">          
     <textarea id="content_two" name="content_two" cols="10" rows="10"></textarea>
      </div>
    </div>


       <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Footer:</label>
      <div class="col-sm-10">          
     <textarea id="footer" name="footer" cols="10" rows="10"></textarea>
      </div>
    </div>

      <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Voettekst:</label>
      <div class="col-sm-10">          
     <textarea id="footer_two" name="footer_two" cols="10" rows="10"></textarea>
      </div>
    </div>
   
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="button" name="email_now" onclick="email(this)" class="btn btn-primary">Submit</button>
      </div>
    </div>
  </form>
</div>               

            </div>

             </div><!-- /.row -->

                </section>
                <!-- /.Inner content -->
            </div>
            <!--// main content -->
 

<footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.0
    </div>
    <strong>Copyright &copy; <?php echo date("Y")." - ".date('Y', strtotime('+1 year')); ?> <a href="#">xyz company</a>.</strong> All rights
    reserved.
  </footer>


<script>


$(document).ready(function(){

 setInterval(function(){
  $('.msg').hide();


 }, 8000);

});
  


  function email(that) {
  tinyMCE.triggerSave();
  var form=$("#email_form");
      $.ajax({  
        type: "POST",  
        url: "ajax_email_templete.php",  
        data:form.serialize(),
        success: function(response) { 
   
            $(".msg").hide();
            if(response==2){
           
                $(".msg").show().html('<div class="alert alert-success" role="alert">Email templete updated successfully!</div>');

         }else{
                  
   
                $(".msg").show().html('<div class="alert alert-success" role="alert">Email templete added successfully!</div>');
         }
              //$("#refresh").load(location.href + " #refresh"); 
         
        }
    });


        
   }

function select_type(th) {

  var type=$(th).val();

  if(type){

    if(type=='2' || type=='5'){
      /// $('#admin_to').attr('readonly', false);
    }else{
     /// $('#admin_to').attr('readonly', true);
    }



      $.ajax({  
        type: "POST",  
        url: "ajax_fetch_email_data.php",  
        data:{'type':type},
        success: function(response) { 
         var sample_obj =$.parseJSON(response);
         if(sample_obj!=''){
         // console.log(sample_obj.name);
        ///  $('#form').val(sample_obj.form);
          $('#subject').val(sample_obj.subject);
       ///   $('#admin_to').val(sample_obj.admin_to);
           tinymce.get("content").setContent(sample_obj.content);
          tinymce.get("footer").setContent(sample_obj.footer);

          }else{
          ///  $('#form').val('');
            $('#subject').val('');
          ///  $('#admin_to').val('');
          tinymce.get("content").setContent('');
          tinymce.get("footer").setContent('');
          }
        }
    });

   }else{
          /// $('#form').val('');
            $('#subject').val('');
           /// $('#admin_to').val('');
          tinymce.get("content").setContent('');
          tinymce.get("footer").setContent('');

   }
        
 }


//code BR3-222//


function select_type_two(th) {

  var type=$(th).val();

  if(type){

    if(type=='7'){
     ///  $('#admin_to_two').attr('readonly', false);
    }else{
   ///   $('#admin_to_two').attr('readonly', true);
    }



      $.ajax({  

        type: "POST",  
        url: "ajax_fetch_email_data.php",  
        data:{'type_two':type},
        success: function(response) { 
         var sample_obj =$.parseJSON(response);
         if(sample_obj!=''){
         // console.log(sample_obj.name);
        ///  $('#form_two').val(sample_obj.form);
          $('#subject_two').val(sample_obj.subject);
        ///  $('#admin_to_two').val(sample_obj.admin_to);
           tinymce.get("content_two").setContent(sample_obj.content);
          tinymce.get("footer_two").setContent(sample_obj.footer);

          }else{
         ///   $('#form_two').val('');
            $('#subject_two').val('');
          ///  $('#admin_to_two').val('');
          tinymce.get("content_two").setContent('');
          tinymce.get("footer_two").setContent('');
          }
        }
    });

   }else{
         ///  $('#form_two').val('');
            $('#subject_two').val('');
           /// $('#admin_to_two').val('');
          tinymce.get("content_two").setContent('');
          tinymce.get("footer_two").setContent('');

   }
        
 }


  
</script>

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
 <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'textarea'});tinymce.init({ selector:'#footer'});</script>
    </body>
</html>