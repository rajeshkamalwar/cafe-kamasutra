<?php
if(isset($_POST['submit'])){
$emailid= $_POST['emailid'];
	$query = $mysqli->query("insert into newsletter set emailid = '$emailid'");
}
?>
 
<script>
function myFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}
</script>


<div id="footer">
	<!--<form method="POST">
	<input type="email" name="emailid" id="emailid" required placeholder="Enter Emailid" style="color: black;">
	<input type="submit" name="submit" class="btn btn-primary" value="submit">
</form>-->
	Copyrights 2024 . All Rights Reserved <?php echo $_SERVER['SERVER_NAME'];?>. <div class="footerpowerd">Powered by <span color="#E0551B"><a href="https://thewebdesign.nl/" target="_blank" >The Webdesign</a></span></div></div>

<script>
function myFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}
</script>
<script>
    function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    document.getElementById("myBtntopbtn").style.display = "block";
  } else {
    document.getElementById("myBtntopbtn").style.display = "none";
  }
}
 function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}


	$(document).ready(function () {

            window.onscroll = function() {scrollFunction()};
				var newWindowWidth = $(window).width();
			 if (newWindowWidth < 991) {

		$(document).on('click', '.dish_cat_icon', function () {
			///$('#sidebar1').removeClass("cart_icon_y");
			$('.sidebarleft').toggleClass("dish_cat_icon_y");
		});

		$(document).on('click', '.cart_icon', function () {
		$('.sidebarleft').removeClass("dish_cat_icon_y");
			$('.pm-sidebar-right').toggleClass("cart_icon_y");
		});
		$(document).on('click', '#sidebar1 a', function () {
			$('.dish_cat_icon').click().true;
		});}

	 
		
		

	});

$(document).on('click', '.sel_lan', function () {
                    url = b_url1 + 'setlang.php';  //console.log(url);return false;
	//alert(url);
                    var sel_lang = $(this).attr("data-id");
                    var action = 'update_lang';
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            sel_lang: sel_lang,
                            action: action,
                        },
                        dataType: "html",
                        success: function (data)
                        { window.location.reload(true);
                        }
                    });
                });

</script>

 

 