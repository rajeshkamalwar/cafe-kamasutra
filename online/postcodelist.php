<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
    <head>
        <script src="jquery.min.js"></script>
        <link rel="stylesheet" href="custom.css">
    </head>
    <body>
		
        <?php include 'public_header.php';?>
        <div class="container">
			<script>b_url1 = '<?php echo 'https://restaurantkamasutra.nl/online/'; ?>';</script>
            <?php
            session_start();
            include 'admin/db.php';
            include 'admin/config.php';
            include 'css_file.php';
            ob_start();

            $current_lang = $_SESSION['current_lang'];
             $tbl_hed='';
            if($current_lang=="dutch"){
                         $tbl_hed='<tr><th>Postcode</th><th>Wijknaam</th><th>Minimum </th><th>Levering</th><th>Vrij van</th></tr>';
            }else{
            $tbl_hed='<tr><th>Postcode</th><th>Neighborhood Name</th><th>Minimum </th><th>Delivery</th><th>Free From</th></tr>';}
            
            
            
             $list_postcode_query = "Select * From `postcode` where `postcode_status`='Active'";
        $result_list_postcode_query = $mysqli->query($list_postcode_query);
        $list_postcode = '<tbody>'.$tbl_hed;
        if ($result_list_postcode_query->num_rows == 0) {
            $list_postcode.= '<tr><td colspan=7><center>No record found.</center></td></tr>';
        } else {
            include 'admin/function.php';
            while ($row = $result_list_postcode_query->fetch_assoc()) {
                $list_postcode .= '<tr>
                                    <td>' . $row['postcode'] . '</td>
                                    <td>' . short_desc($row['postcode_nbh'], 50) . '</td>
                                    <td>' . add_currency_sing($row['postcode_min_amt']) . '</td>
                                    <td>' . add_currency_sing($row['postcode_deli_chrg']) . '</td>
                                    <td>' . add_currency_sing($row['postcode_free_from']) . '</td>
                                    
                                  </tr>';
            }
        }
        $list_postcode .= "</tbody>";
        

?>
<div class="table-responsive">
                                    <div class="col-sm-12">
                                        <table class="table table-hover" id="list_data">
                                            <?php echo $list_postcode;?>
                                        </table>
                                    </div>
                                </div>
        </div>
        
            <?php include 'public_footer.php';?>