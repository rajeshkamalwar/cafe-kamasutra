<?php
function output($para1,$para2,$para3){

$str='<!DOCTYPE html><html>
    <head>
    <style>#footer{bottom: 0px;position: fixed;}</style>
    <script src="jquery.min.js"></script>
    <link rel="stylesheet" href="custom.css"><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head><body>'.file_get_contents('public_header.php').''.file_get_contents('css_file.php').'<div class="container checkoutpage"><div class="row">
                <div class="col-md-12">
                    <br/>
                </div>
                <span id=gtc""></span>
                <h1 class="payment_failed">'.$para1.'</h1>
                    <p>'.$para2.'</p>
                <a href="online-order.php">
                    <button type="button" class="btn btn-primary">'.$para3.'</button>
                </a>
                <script language="JavaScript" type="text/javascript">
                    $("#gtc").load("fresh.php");
                    var seconds = 10;
                    var url = "online-order.php";
                    function redirect() {
                        if (seconds <= 0) {
                            location.href = url;
                            } else {
                            seconds--;
                            document.getElementById("pageInfo").innerHTML = seconds;
                            setTimeout("redirect()", 1000);
                            }
                    }
                    redirect();
                </script>
            </div>
        </div>'.file_get_contents('public_footer.php').'</body></html>';
echo $str;
}