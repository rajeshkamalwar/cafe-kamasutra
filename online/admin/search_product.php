<?php
/* Database connection settings */
$host = 'localhost';
$user = 'rajrabvij_new';
$pass = 'Ems8c8?4';
$db = 'rajrabvij_new_online';
$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);
if(!empty($_POST["keyword"])) {
$query ="SELECT * FROM tdish WHERE dish_desc_en like '" . $_POST["keyword"] . "%' ORDER BY dish_desc_en LIMIT 0,6";
$result = $mysqli->runQuery($query);
if(!empty($result)) {
?>
<ul id="country-list">
<?php
foreach($result as $country) {
?>
<li onClick="selectCountry('<?php echo $country["dish_desc_en"]; ?>');"><?php echo $country["dish_desc_en"]; ?></li>
<?php } ?>
</ul>
<?php } } ?>