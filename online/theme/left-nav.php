<aside class="main-sidebar">
    <section class="sidebar">
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="<?= ($current_active_page == 'dashboard') ? 'active':''; ?>">
          <a href="dashboard.php">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li class="<?= ($current_active_page == 'postcode') ? 'active':''; ?>">
          <a href="postcode.php">
            <i class="fa fa-map-signs"></i> <span>Postcode</span>
          </a>
        </li>
		<li class="<?= ($current_active_page == 'themecolor') ? 'active':''; ?>">
          <a href="themecolor.php">
            <i class="fa fa-map-signs"></i> <span>Theme Color</span>
          </a>
        </li>
		<li class="<?= ($current_active_page == 'pages') ? 'active':''; ?>">
          <a href="pages.php">
            <i class="fa fa-map-signs"></i> <span>Pages </span>
          </a>
        </li>
        </ul>
    </section>
  </aside>

 