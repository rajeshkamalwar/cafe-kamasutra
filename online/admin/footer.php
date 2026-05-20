
<style>
  #alert_popover
  {
   display:block;
   position:fixed;
   top:60px;
   left:550px;
  }
  #myBtn {
  display: none;
  position: fixed;
  bottom: 50px;
    right: 0px;
    z-index: 99;
    font-size: 18px;
    border: none;
    outline: none;
    background-color: red;
    color: white;
    cursor: pointer;
    padding: 2px 12px 7px 12px;
    border-radius: 4px;
}

#myBtn:hover {
  background-color: #555;
}
  .alert_default
  {
   color: #333333;
   background-color: #f2f2f2;
   border-color: #cccccc;
  }
  </style> 
 <div id="alert_popover">
   
     <div class="content12">
      
     </div>
    
   </div>
<footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 3.0.0
    </div>
    <strong>Copyright &copy; <?php echo date("Y")." - ".date('Y', strtotime('+1 year')); ?> <a href="#">The Webdesign company</a>.</strong> All rights
    reserved.
  </footer>

 <audio controls style="display:none;"  id="myAudio"><source src="good-msg-tone-50191.mp3" ></audio>  
 
   
  
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="theme_assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="theme_assets/bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
  
//  $('.sidebar-menu li').click(function(){
//    $('.sidebar-menu li').removeClass("active");
//    $(this).addClass("active");
//});

</script>
<script>
$(document).ready(function(){

 setInterval(function(){
  load_last_notification();
 }, 5000);
var myarray = []; 
 function load_last_notification(){
	 
	  $.ajax({
   url:"fetch.php",
   method:"POST",
   success:function(data)
   {
    $('.content12').html(data);
	 
   }
  })
/*	 
  $.ajax({
   url:"fetch.php",
   method:"POST",
	  
	  dataType: "json",
   success:function(data){
	   
	   console.log(data.ordersext);
	   myarray = data.ordersext;  
	   for (let i = 0; i < myarray.length; i++) { 
									 
									if($('.printorderbtn2.ordno'+myarray[i]).length ==0){ 
									   document.getElementById("myAudio").play(); 
										 $('.content12').append('<div class="btn btn-social-icon btn-warning printorderbtn2 ordno'+ myarray[i] +' "   data-dataid="'+myarray[i]+'"></div></div>');
									//	$('.printorderbtn2').trigger('click')
											$('.printorderbtn2.ordno'+myarray[i]).trigger('click');
										///$('.printorderbtn2.ordno'+myarray[i]).remove();
                                  }
                                }
	  
 
	   ///; 
   }
  }); */
 }

});
</script>

 


<button onclick="topFunction()" id="myBtn" title="Go to top">↑</button>
<script>
//Get the button
var mybutton = document.getElementById("myBtn");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
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

<script type="text/javascript">
	 
      $(document).on('click', '#print_record', function () {
                    url = b_url + 'online_orders_actions.php';
                    var gift_action = 'print';
                    var ot_id = $(this).attr("dataid");
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            gift_action: gift_action,
                            ot_id: ot_id,
                        },
                        dataType: "html",
                        success: function (data)
                        {
                            document.body.innerHTML = data;
                            setTimeout(function () {
                                window.print();
                                location.reload();
                            }, 500);
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
