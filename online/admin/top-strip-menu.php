<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$session_name = $_SESSION['name'] ?? ($_COOKIE['name'] ?? '');
$safe_name = $mysqli->escape_string($session_name);
$result = $mysqli->query("SELECT `registered_at` FROM users WHERE name='".$safe_name."'");
$user = $result ? $result->fetch_assoc() : null;

$query = "Select * From `adm_set`";
        $result_query = $mysqli->query($query);
$logo='';$rest_titl='';
$last_login_result = $mysqli->query("Select `last_login` from `users` where `id`='1'");
$last_login_row = $last_login_result ? $last_login_result->fetch_object() : null;
$last_login = $last_login_row ? $last_login_row->last_login : '';
        while ($row = $result_query->fetch_assoc()) {
           if($row['adm_set_name']=='print_url'){$logo=$row['adm_set_vlu'];}
           if($row['adm_set_name']=='rest_title'){$rest_titl=$row['adm_set_vlu'];}
        }

?>
<header class="main-header">
    <!-- Logo -->
    <a href="dashboard.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>FOS</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>FOS</b> Admin</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              
              <span class="hidden-xs"><?= $rest_titl ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?= $logo?>" class="img-circle" alt="User Image">

                <p>
                  <?= $rest_titl ?>
                  <small>Last Login <?php echo $last_login;//date_format(date_create($user['registered_at']),"M. Y"); ?></small>
                </p>
              </li>
             <!-- Menu Footer-->
              <li class="user-footer">
<!--                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">something</a>
                </div>-->
                <div class="pull-right">
                  <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          
        </ul>
      </div>
    </nav>
  </header>
 
