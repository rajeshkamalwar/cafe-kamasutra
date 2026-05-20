<style>
:root {
<?php 

$color_sch = $mysqli->query("select `adm_set_vlu` from adm_set where adm_set_name='colschm'")->fetch_object()->adm_set_vlu;
if($color_sch=="blue"){
    ?>--blue: #3c8dbc;  
  --blueboder:#2e6da4;
  --bluehover:#204d74;
  --bluehoverboder:#122b40;
    <?php
}if($color_sch=="yellow"){
    ?>--blue: #f39c12;  
  --blueboder:#dc8d0f;
  --bluehover:#dc8d0f;
  --bluehoverboder:#f39c12;
    <?php
}if($color_sch=="red"){
    ?>--blue: #EA6D0F;  
  --blueboder:#EA6D0F;
  --bluehover:#EA6D0F;
  --bluehoverboder:#EA6D0F;
    <?php
}if($color_sch=="green"){
    ?>--blue: #00a65a;  
  --blueboder:#047340;
  --bluehover:#047340;
  --bluehoverboder:#00a65a;
    <?php
}
?> 
  --errorpanel:#f5f3f3;
  } 
</style>
