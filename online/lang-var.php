    <?php


            $PostcodePopupTitle = $PostcodePopupP1 = $btntext = $PostcodePageURLtxt=$option_l=$yourorder_l=$urpostcode_l=$minamt_L=$DeliveryCharge_L= '';

  $quan_l='';$clear_l='';$add_btn_l='';
 

            if ($current_lang == "en") {
				$attrreq_war = 'Make your choice';
				$resdelvery_msg_text = 'you can pickup from';			 
				$resdelvery_msg_text_till = 'We will delivery till';
			 
                $yourorder_l="Your order";
                $PostcodePopupTitle = 'Would you like to have it delivered ?';
                $PostcodepicmsgP1 = 'If you want to pick up, click below';
                $ofmsg = "OR";
                $PostcodePopupP1 = 'Enter the four digits of your postcode :';
                $btntext = "To Order!";
                $PostcodePageURLtxt = "View our delivery area here";
                $option_l="Option(s)";
             $PostcodePageURL = "https://restaurantkamasutra.nl/information/";
                $urpostcode_l="Your postal code :";
                $minamt_L="Minimum amount : ";
                $DeliveryCharge_L="Delivery Charge :";
                $Deliverypreferto ="Prefer to :";
                $pickup = "Pick up";

                $deiveryup =  "delivery";
                $DeliveryCharge_L="Delivery Charge :";
                $Deliveryprefer="Would you like to delivered or pick it up yourself ?";
                $pickInformationSection = "Pickup information :";
				$todadis = "Today's Discount";
				$cart_btn_lang2 = 'Clear cart';
				$cart_btn_lang = 'Check out';	
				  $selecttime = "ASAP";
				$L_pickdel_chk_txt = "I want to pick it up myself";
				$placeodr_l = "Place order";
			 
				$cutleryhading = "Do u need cutlery?";
				$Cutlery_charge = 'Cutlery charge ';
				$finaltotal = 'Total';
				$cutyes = 'Yes';
				$cutrno = 'No';
				$saveaspass = 'Create my account';
				$addnewadres = 'Add new address';
				$subbtm = "Submit";
				$L_SelectBillingAddress = "Select Delivery Address";
				$coupontext = "Have a coupon code?";
				$tip="would you like to tip?";
				$choosetip="choose your amount";
				$tipamount="would you like to tip? ";
				$tiptext="Tip";
				$currency = '€';
				$quan_l='Quantity';$clear_l='Clear Selection';$add_btn_l='Add';
				$onlyfor_pik = 'Only for takeaway';
				$total_cart = 'Sub total';

            } else {
				$attrreq_war = 'Maak uw keuze';
                $yourorder_l="Uw bestelling";
                $PostcodePopupTitle = 'Wilt you laten bezorgen?';
                $PostcodepicmsgP1 = 'Wilt you afhalen, click hieronder';
                $ofmsg = "OF";
                $PostcodePopupP1 = 'Vul de vier cijfers van uw postcode in :';
                $btntext = "Bestellen!";
                $PostcodePageURLtxt = "Bekijk hier ons bezorggebied";
                $option_l="Optie(s)";
              $PostcodePageURL = "https://restaurantkamasutra.nl/nl/informatie/";
                $urpostcode_l="Je post code :";
                $minamt_L= "Minimal order : ";
                $DeliveryCharge_L="Bezorgkosten :";
                $Deliverypreferto ="Liever :";
                $pickup = "afhalen";
                $deiveryup =  "bezorgen";

                 $Deliveryprefer="Wilt u laten bezorgen of zelf afhalen ?";
                $DeliveryCharge_L="Bezorgkosten :";
                $pickInformationSection = "Afhaalinformatie :";

                $total_cart = 'Totaal';
				$todadis = "Vandaag's Aanbieding";
			  	$cart_btn_lang2 = ' leeg winkelwagentje ';
				$cart_btn_lang = ' Afrekenen'	;
				    $currency = '€';
				
				 $resdelvery_msg_text = 'U Kunt ophalen vanaf';
				$resdelvery_msg2_text = '';
				$resdelvery_msg_text_till = 'We will delivery till';
				$resdelvery_msg_text2_till = '';
				$quan_l='Aantal stuks';$clear_l='Duidelijke selectie';$add_btn_l='Toevoegen';
				$onlyfor_pik = 'Alleen voor afhaalmaaltijden';
				$total_cart = 'Subtotaal';
            }


            //Code 4 Delivery Information Section
            $DeliveryInformationSection = $DeliveryToday = "";
            if ($current_lang == "en") {
                $DeliveryInformationSection = "Delivery Information";
                $DeliveryToday = "Delivery Today";
                $freefrom = "Free From";
                $from = "from";
                $pickuptoday = "Pickup Today";
            } else {
                $DeliveryInformationSection = "Bezorg Informatie";
                $DeliveryToday = "Bezorging Vandaag";
                $freefrom = "Gratis vanaf";
                $form = "V.a.";
                $pickuptoday = "afhalen Vandaag";
            }

            //echo "Current Time : ".date('h:i:s');

                $serve_till ="";
                $serve_from = $close4theday = $weekoff = $serve_start_from = "";

                if ($current_lang == "dutch"){
                    $DeliveryInformationSection = "Bezorg Informatie";
                    $DeliveryToday = "Bezorging Time";
                    $serve_till = "wij bezorgen tot met ";
                    $pick_till = "U kunt ophalen tot";
                    $serve_from = "We zullen opnieuw leveren ";
                    $close4theday = "Wij zijn op dit moment gesloten.";
                    $weekoff = "We zijn vandaag gesloten.";
                   /// $serve_start_from = "Wij zullen dienen van";
                    $serve_start_from = "Wij bezorgen vanaf";

                }else{
                    $DeliveryInformationSection = "Delivery Information";
                    $DeliveryToday = "Delivery Time";
                    $serve_till = "We will deliver till";
                    $pick_till = "You can pickup till ";
                    $serve_from = "We will deliver again ";
                    $close4theday = "We are closed at this moment.";
                    $weekoff = "We are close today.";
                    $serve_start_from = "We will deliver from";

                }




$L_BillingAddress = $L_Additionalinformation = $L_Emailaddress = $L_Phone = $L_TownCity = $L_Firstname = $L_Lastname = $L_Companyname = $L_Streetaddress = $L_Postcode = $L_TwolettersofyourPostcode = $L_Ordernotes_placeholder = $L_Ordernotes = $L_Streetaddress_placeholder = $L_Apartmentsuite_placeholder = $L_yourorder = $L_gift_choice = $emptycart_msg = $redirect_msg = $msg_giftitem = $gobackbtn_txt= '';


if ($current_lang == "en"){
    $L_BillingAddress = 'Billing Address';
    $L_Firstname = "Your name";
    $L_Lastname = "Last name";
    $L_Companyname = "Company name (optional)";
    $L_Streetaddress = "Street address";
    $L_Postcode = "Postcode / ZIP";
    $L_TwolettersofyourPostcode = "Two letters of your Postcode";
    $L_TownCity = "Town / City";
    $L_Phone = "Phone";
    $L_Emailaddress = "Email address";
    $L_Additionalinformation = "Additional information";
    $L_Ordernotes = "Order notes (optional)";
    $L_Ordernotes_placeholder = "Notes about your order, e.g. special notes for delivery.";
    $L_Streetaddress_placeholder = "House number and street name";
    $L_Apartmentsuite_placeholder = "Apartment, suite, unit etc. (optional)";
    $L_yourorder = "Your order";
    $L_gift_choice = "You will receive one " . $msg_giftitem . ". Make your choice:";
    $emptycart_msg = "Your cart is currently empty.";
    $redirect_msg = 'You will be redirected to product\'s list to add item(s) in  <span id="pageInfo">10</span> second(s).';
    $gobackbtn_txt = 'Go back to order';
    $L_pickdel = "Pick up / Delivery";
    $pickuptime = "Pick up Time";
    $deliverytime = "Delivery Time";
    $selecttime = "ASAP";
    $L_pickdel_chk_txt = "I want to pick it up myself";
    $placeodr_l = "Place order";
    $cutleryhading = "Do u need cutlery?";
    $Cutlery_charge = 'Cutlery charge ';
    $finaltotal = 'Total';
    $cutyes = 'Yes';
    $cutrno = 'No';
    $saveaspass = 'Create my account';
    $addnewadres = 'Add new address';
    $subbtm = "Submit";
    $L_SelectBillingAddress = "Select Delivery Address";
    $coupontext = "Have a coupon code?";
    $tip="would you like to tip?";
    $choosetip="choose your amount";
    $tipamount="would you like to tip? ";
    $tiptext="Tip";
}
else{
    $coupontext = "Heeft u een couponcode?";
    $cutleryhading = "Heb jij Bestek nodig?";
    $L_BillingAddress = 'Uw gegevens';
    $L_Firstname = "Uw Naam ";
    $L_Lastname = "Achternaam";
    $L_Companyname = "Bedrijfsnaam (optioneel)";
    $L_Streetaddress = "Straatnaam";
    $L_Postcode = "Postcode";
    $L_TwolettersofyourPostcode = "Twee letters van uw Postcode";
    $L_TownCity = "Plaats";
    $L_Phone = "Telefoon";
    $L_Emailaddress = "E-mailadres";
    $L_Additionalinformation = "Extra informatie";
    $L_Ordernotes = "Bestelnotities (optioneel)";
    $L_Ordernotes_placeholder = "Notities over je bestelling, bijvoorbeeld speciale notities voor aflevering.";
    $L_Streetaddress_placeholder = "Straatnaam en huisnummer";
    $L_Apartmentsuite_placeholder = "Straatnaam en huisnummer";
    $L_yourorder = "Jouw bestelling";
    $L_gift_choice = "U krijgt een " . $msg_giftitem . ". Maak uw keuze uit:";
    $emptycart_msg = "Je winkelmand is momenteel leeg.";
    $redirect_msg = 'U wordt doorgestuurd naar de productlijst om items toe te voegen <span id="pageInfo">10</span> second(s).';
    $gobackbtn_txt = 'Ga terug naar de bestelling';
    $L_pickdel = "Afhalen / Bezorgen";
    $pickuptime = "afhaaltijd";
    $deliverytime = "Bezorgtijd";
    $selecttime = "ZSM";
    $L_pickdel_chk_txt = "Ik wil zelf afhalen";
    $placeodr_l = "Plaats bestelling";

    $Cutlery_charge = 'Bestek ';
    $finaltotal = 'Totaal';
    $cutyes = 'Ja';
    $cutrno = 'Nee';
    $saveaspass = 'Maak mijn account';
    $addnewadres = 'Nieuw adres toevoegen';
    $subbtm = "Indienen";
    $L_SelectBillingAddress="Selecteer uw adres";
    $tip="wilt u fooi geven?";
    $choosetip="kies jouw bedrag";
    $tipamount="wilt u fooi geven?";
    $tiptext="Fooie";
}
if (isset($_SESSION['gt_msg_giftitem']) && !empty($_SESSION['gt_msg_giftitem'])){
    $msg_giftitem = $_SESSION['gt_msg_giftitem'];
}

 $palstbag1=($current_lang=="en")?"Plastic Bin Surcharge":"Plastic Bak Toeslag";	
  ?>