<?php
if ( ! defined( 'base_url' ) && file_exists( __DIR__ . '/config.php' ) ) {
	include_once __DIR__ . '/config.php';
}
?>
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

<script> b_url = '<?= defined( 'base_url' ) ? base_url : './'; ?>';</script>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="icon" href="fav.png" type="image/x-icon"/>
    <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->  <link rel="stylesheet" href="theme_assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->     <link rel="stylesheet" href="theme_assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->         <link rel="stylesheet" href="theme_assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->      <link rel="stylesheet" href="theme_assets/dist/css/AdminLTE.min.css">
  <!-- iCheck -->           <link rel="stylesheet" href="theme_assets/plugins/iCheck/square/blue.css">
  <!-- Google Font -->      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <!-- AdminLTE Skins. -->  <link rel="stylesheet" href="theme_assets/dist/css/skins/_all-skins.min.css">
    <!-- Morris chart -->     <link rel="stylesheet" href="theme_assets/bower_components/morris.js/morris.css">
  <!-- jvectormap -->       <link rel="stylesheet" href="theme_assets/bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->      <link rel="stylesheet" href="theme_assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker --> <link rel="stylesheet" href="theme_assets/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor --><link rel="stylesheet" href="theme_assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">


