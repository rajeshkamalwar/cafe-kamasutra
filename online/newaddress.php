         <div class="modal fade" id="myModaladdress" role="dialog">
    <div class="modal-dialog gdgddsww">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><?php echo $addnewadres; ?></h4>
        </div>
          <form method="POST">
        <div class="modal-body">
          <div class="form-group">
              <div class="col-sm-12" id="error_addpanel"></div>
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <label ><?php echo $L_Firstname; ?><span class="required">*</span></label>
                                            <input type="text" class="form-control" id="fname" name="fname" >
                                        </div>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <label><?php echo $L_Companyname; ?></label>
                                            <input type="text" class="form-control" id="companyname" name="companyname" >
                                        </div>
                                    </div>
                                </div>
                                  <?php if (($_SESSION['current_pick'] ?? '') != "pickup")  { ?>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <label><?php echo $L_Streetaddress; ?><span class="required">*</span></label>
                                            <input type="text" class="form-control" id="housenumber" name="housenumber" placeholder="<?=$L_Streetaddress_placeholder ?>" ></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                            <label><?php echo $L_Postcode; ?><span class="required">*</span></label>
                                            <input type="text" class="form-control" id="addpostcode" name="addpostcode"  pattern="\d{4}" maxlength="4">
                                            <span id="posterrmsg"></span>
                                             <span id="postcode_newresponse"></span>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <label><?php echo $L_TwolettersofyourPostcode; ?><span class="required">*</span></label>
                                            <input type="text" class="form-control" id="twolettersofyourPostcode" name="twolettersofyourPostcode" maxlength="2" oninput="this.value = this.value.toUpperCase()" >&nbsp;<span id="newpostcode_errmsg"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <label><?php echo $L_TownCity; ?><span class="required">*</span></label>
                                            <input type="text" class="form-control" id="townCity" name="townCity" >
                                        </div>
                                    </div>
                                </div>
                                <?php  } ?>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                            <label><?php echo $L_Phone; ?><span class="required">*</span></label>
                                            <input type="text" class="form-control" id="phonenumber" name="phonenumber" pattern="\d{10}" maxlength="10">&nbsp;<span id="newphone_errmsg" ></span>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <label><?php echo $L_Emailaddress; ?><span class="required">*</span></label>
                                            <input type="email" class="form-control" id="emailaddress" name="emailaddress" ><span id="CoC_Emailaddress_errmsg" ></span>
                                        </div>
                                    </div>
                                </div>
        </div>
        <div class="modal-footer">

            <button type="submit" name="submit" id="addnewbtn" class="btn btn-primary" ><?php echo $subbtm; ?></button>
        </div>
          </form>
      </div>

    </div>
 </div>

    <script type="text/javascript">      
$(document).on('click', '#addnewbtn', function (e) {
		e.preventDefault();
		var error_msg = "";
                            $("#error_addpanel").hide();
                            if ($("#fname").val() == "") {
                                if (current_lang == 'en') {
                                    error_msg = error_msg + "<b>Billing address First name</b> is a required field.";
                                } else {
                                    error_msg = error_msg + "<b>Factuuradres Voornaam</b> is een verplicht veld.";
                                }
                                $("#fname").addClass('error_control');
                            } else {
                                $("#fname").removeClass('error_control');
                            }
                            if ($("#housenumber").val() == "") {
                                if (current_lang == 'en') {
                                    error_msg = error_msg + "<br/><b>Billing address Street address</b> is a required field.";
                                } else {
                                    error_msg = error_msg + "<br/><b>Factuuradres Straat en huisnummer</b> is een verplicht veld.";
                                }
                                $("#housenumber").addClass('error_control');
                            } else {
                                $("#housenumber").removeClass('error_control');
                            }

                    if ($("#addpostcode").val() == "") {
                                if (current_lang == 'en') {
                                    error_msg = error_msg + "<br/><b>Billing address Postcode / ZIP</b> is a required field.";
                                } else {
                                    error_msg = error_msg + "<br/><b>Factuuradres Postcode</b> is een verplicht veld.";
                                }
                                $("#addpostcode").addClass('error_control');
                            } else {
                                $("#addpostcode").removeClass('error_control');
                            }

                            if ($("#twolettersofyourPostcode").val() == "") {
                                if (current_lang == 'en') {
                                    error_msg = error_msg + "<br/><b>Billing address Two letters of your Postcode</b> is a required field.";
                                } else {
                                    error_msg = error_msg + "<br/><b>Factuuradres Twee letters van uw Postcode</b> is een verplicht veld.";
                                }
                                $("#twolettersofyourPostcode").addClass('error_control');
                            } else {
                                $("#twolettersofyourPostcode").removeClass('error_control');
                            }

                            if ($("#townCity").val() == "") {
                                if (current_lang == 'en') {
                                    error_msg = error_msg + "<br/><b>Billing address Town / City</b> is a required field.";
                                } else {
                                    error_msg = error_msg + "<br/><b>Factuuradres Plaats</b> is een verplicht veld.";
                                }
                                $("#townCity").addClass('error_control');
                            } else {
                                $("#townCity").removeClass('error_control');
                            }

                            if ($("#phonenumber").val() == "") {
                                if (current_lang == 'en') {
                                    error_msg = error_msg + "<br/><b>Billing address Phone</b> is a required field.";
                                } else {
                                    error_msg = error_msg + "<br/><b>Factuuradres Telefoon</b> is een verplicht veld.";
                                }
                                $("#phonenumber").addClass('error_control');
                            } else {
                                $("#phonenumber").removeClass('error_control');
                            }

						var x = $('#emailaddress').val();
	var atposition=x.indexOf("@");
var dotposition=x.lastIndexOf(".");
							if (atposition<1 || dotposition<atposition+2 || dotposition+2>=x.length){
                                if (current_lang == 'en') {
                                    error_msg = error_msg + "<br/><b>Billing address Email address</b> is a required field.";
                                } else {
                                    error_msg = error_msg + "<br/><b>Factuuradres E-mailadres</b> is een verplicht veld.";
                                }
                                $("#emailaddress").addClass('error_control');
                            } else {
                                $("#emailaddress").removeClass('error_control');
                            }




                            //console.log(error_msg);
                            if (error_msg != '') {
                                $("#error_addpanel").html('');
                                $("#error_addpanel").show();
                                $("#error_addpanel").html(error_msg);
                                //$('html, body').animate({scrollTop: $("#error_regpanel").offset().top}, 500);
                                return false;
                            }

		              var name = $("#fname").val();
                      var email = $("#emailaddress").val();  //console.log(id);

		var cname = $("#cname").val();
		var postcode = $("#addpostcode").val();
		var twoletter = $("#twolettersofyourPostcode").val();
		var streetaddress = $("#housenumber").val();
		var city = $("#townCity").val();
		var phone = $("#phonenumber").val();

		var poid = $("input[name=poid]").val();
if (poid == "notavailable") {
	if (current_lang == 'en') {
      alert("We do not deliver to this zip code area");
	} else {
		alert("Wij bezorgen niet in deze postcodegebied");
	}
      $("input[name=poid]").focus();
      return false;
    }
		            url = b_url1 + 'addnewaddress.php';
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {name:name,email: email,cname:cname,postcode:postcode,twoletter:twoletter,streetaddress:streetaddress,city:city,phone:phone},
                        dataType: "html",
                        success: function (data)
                        {
							var successmg = 1;
							if(data!=successmg){
								location.reload();
							} else {
								location.reload();
							}
                        }
                    });
                });
                </script>