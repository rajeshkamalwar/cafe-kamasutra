<style>
    .my-custom-scrollbar {
position: relative;
height: 300px;
overflow: auto;
}
.table-wrapper-scroll-y {
display: block;
}</style>

<?php
//require 'db.php';
ob_start();
include 'simplexlsx.class.php';
ini_set('max_execution_time', 300);
ini_set('post_max_size', '64M');
ini_set('upload_max_filesize', '64M');

if (isset($_POST["Import"])) {
//echo $filename=$_FILES["file"]["tmp_name"];
    $filename = $_FILES["file"]["tmp_name"];
    if ($_FILES["file"] ["size"] > 0) {
        $file = fopen($filename, "r");
        if ($xlsx = SimpleXLSX::parse($filename)) {
//echo "<pre>";print_r( $xlsx->rows() );echo "</pre>";die();
            $i = 0;
            
            echo '<div class="table-wrapper-scroll-y my-custom-scrollbar">

  <table   id="example2"  class="table table-bordered table-hover table-striped mb-0">
  ';
            foreach ($xlsx->rows() as $row) {
                //echo "Itterationno-".$i;
                if ($i == 0) {
                    //echo "<br/>Blank Record... So skiped...<br/>";
                } else {
                    $postcode = isset($row[0]) ? $row[0] : '';
                    $postcode_nbh = isset($row[1]) ? $row[1] : '';
                    $postcode_min_amt = str_replace(",",".",isset($row[2]) ? $row[2] : '');
                    $postcode_deli_chrg = str_replace(",",".",isset($row[3]) ? $row[3] : '');
                    $postcode_free_from = str_replace(",",".",isset($row[4]) ? $row[4] : '');
                    $postcode_status = isset($row[5]) ? $row[5] : '';
               

                        $query = 'insert into `postcode`(`postcode`,`postcode_nbh`,`postcode_min_amt`,`postcode_deli_chrg`,`postcode_free_from`,`postcode_status`) values("'.$postcode.'","'.$postcode_nbh.'","'.$postcode_min_amt.'","'.$postcode_deli_chrg.'","'.$postcode_free_from.'","'.$postcode_status.'")';

                        $dupesql = "SELECT * FROM `postcode` where postcode = '$postcode'";
                        $duperaw = $mysqli->query($dupesql);
                        if ($duperaw->num_rows > 0) {
                        echo '<tr><td><p style="color:#f39c12;"><i class="icon fa fa-warning"></i> Postcode : '.$postcode.' with Neighborhood Name : '.$postcode_nbh.' already exists.</i></p></td></tr>';
                        }else{
                            $result = $mysqli->query($query);

                        
                            if ($result) {
                                echo '<tr><td><p style="color:green;"><i class="icon fa fa-check"></i> Postcode : '.$postcode.' with Neighborhood Name : '.$postcode_nbh.' added Successfully!</p></td></tr>';
                            }
                        else{echo '<tr><td><p style="color:red;"><i class="icon fa fa-ban"></i> Postcode : '.$postcode.' with Neighborhood Name : '.$postcode_nbh.' Not added.</p></td></tr>';}
                        
                        }
                    
                }
                
                $i++;
            }echo "</table></div>";
        } else {
            echo SimpleXLSX::parse_error();
        }
    }

    fclose($file); ?>

<?php } 

ini_set('max_execution_time', 30);

?>