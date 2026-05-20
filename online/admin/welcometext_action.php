<?php

include 'db.php';
include 'config.php';
if (isset($_POST['welcmtxt_action'])) {
    $welcmtxt_action= $_POST['welcmtxt_action'];


    if ($welcmtxt_action == "load") {
        $query = "Select * From `welcome`";
        $result_query = $mysqli->query($query);
        $row = $result_query->fetch_assoc();
        echo json_encode($row);
    }
   if ($welcmtxt_action == "edit") {
            $edit_welcmtxt_query_result = $mysqli->query("UPDATE `welcome` SET `welcm_en`='" . $mysqli->escape_string($_POST['welcm_txt_en']) . "',`welcm_nl`='" . $mysqli->escape_string($_POST['welcm_txt_nl']) . "',`footer_en`='" . $mysqli->escape_string($_POST['footer_en']) . "',`footer_nl`='" . $mysqli->escape_string($_POST['footer_nl']) . "',`lastupdate`='" . date("Y-m-d H:i:s") . "'");

            $notification_message = '';
            if ($edit_welcmtxt_query_result) {
                $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-success" style="margin-bottom: 0!important;">Welcome text updated successfully.</div></div></div>';
            } else {
                $notification_message = '<div class="col-xs-12"><div class=" no-print"><div class="callout callout-danger" style="margin-bottom: 0!important;">Oops! Welcome text not updated. Please try again little later.</div></div></div>';
            }       
        echo $notification_message;
    }
}
?>