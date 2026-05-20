<style>
	.skin-blue .sidebar-menu>li:hover>a, .skin-blue .sidebar-menu>li.active>a, .skin-blue .sidebar-menu>li.menu-open>a {
    color: #fff;
    background: #3c8dbc;
}
</style>

<?php 

$usrs="Select * from users where name='".$_COOKIE["name"]."'";
$user_query = $mysqli->query($usrs);
$row = $user_query->fetch_assoc();
if($row['user_type']=='2'){ ?>
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
		
        <li class="<?= ($current_active_page == 'dashboard') ? 'active':''; ?>">
          <a href="dashboard.php">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
		 
               <li class="treeview <?= ($current_active_page == 'online-orders'|| $current_active_page == 'all-order'  || $current_active_page == 'current-month-order' || $current_active_page == 'seoanalysis'|| $current_active_page == 'current_month_orders') ? 'active':''; ?>">
          <a href="#">
            <i class="fa fa-list-ul"></i> <span>Order(s)</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
		   <?php if($row['order']=='1'){?>
            <li class="<?= ($current_active_page=="order")? 'active':''; ?>"><a href="online-orders.php"><i class="fa fa-circle-o"></i> Today's order(s)</a></li>
            <li class="<?= ($current_active_page=="current_month_orders")? 'active':''; ?>"><a href="current_month_orders.php"><i class="fa fa-circle-o"></i> Current Month's Order(s)</a></li>
            <li class="<?= ($current_active_page=="all-order")? 'active':''; ?>"><a href="all-order.php"><i class="fa fa-circle-o"></i> All Order(s)</a></li>
			<?php } ?>
			<?php if($row['sales_report']=='1'){?>
		  <li class="<?= ($current_active_page=="seoanalysis")? 'active':''; ?>"><a href="seoanalysis.php"><i class="fa fa-paperclip"></i> <span>Sale Report</span></a></li>
		  <?php } ?>
		           
          </ul>
        </li>  
		  
		  
		  <?php if($row['setting']=='1'){?>
		 <li class="<?= ($current_active_page == 'setting') ? 'active':''; ?>"><a href="setting.php"><i class="fa fa-gears"></i> <span>Setting</span></a></li>
		 <?php } ?>
		  <?php if($row['cashier']=='1'){?>
          	  <li class="<?= ($current_active_page == 'cashier') ? 'active':''; ?>">
          <a href="cashier.php">
            <i class="fa fa-map-signs"></i> <span>Cashier</span>
          </a>
        </li>
           <?php } ?> <?php if($row['products']=='1'){?>
		   <li class="treeview <?= ($current_active_page == 'variables' || $current_active_page == 'attributes' || $current_active_page == 'attributes' || $current_active_page == 'dish' || $current_active_page == 'categories' || $current_active_page == 'order-category' || $current_active_page=="order-dish-indi" || $current_active_page == 'order-dish'|| $current_active_page == 'variable-order' || $current_active_page == 'supercategory') ? 'active':''; ?>">
          <a href="#">
            <i class="fa fa-list-ul"></i> <span>Food Menu</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
		    <li class="<?= ($current_active_page=="dish")? 'active':''; ?>"><a href="dish.php"><i class="fa fa-circle-o"></i> Dishes</a></li>
			 <li class="<?= ($current_active_page=="categories")? 'active':''; ?>"><a href="categories.php"><i class="fa fa-circle-o"></i> Categories</a></li>
	 <li class="<?= ($current_active_page=="supercategory")? 'active':''; ?>"><a href="supercategory.php"><i class="fa fa-circle-o"></i> Super Category</a></li>
            <li class="<?= ($current_active_page=="attributes")? 'active':''; ?>"><a href="attributes.php"><i class="fa fa-circle-o"></i> Attributes</a></li>
            <li class="<?= ($current_active_page=="variables")? 'active':''; ?>"><a href="variables.php"><i class="fa fa-circle-o"></i> Variables</a></li>
			
           
           <li class="treeview <?= ($current_active_page=="order-dish-indi" || $current_active_page=="order-category" || $current_active_page=="order-dish")? 'active':''; ?>">
              <a href="#"><i class="fa fa-circle-o"></i> Arranging Display Order
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
				<li class="<?= ($current_active_page=="order-category")? 'active':''; ?>"><a href="superorder-category.php"><i class="fa fa-circle-o"></i> SuperCategories Order</a></li>
                <li class="<?= ($current_active_page=="order-category")? 'active':''; ?>"><a href="order-category.php"><i class="fa fa-circle-o"></i> Categories Order</a></li>
                <li class="<?= ($current_active_page=="order-dish" || $current_active_page=="order-dish-indi")? 'active':''; ?>"><a href="order-dish.php"><i class="fa fa-circle-o"></i> Dish Order</a></li>
				       <li class="<?= ($current_active_page=="variable-order" || $current_active_page=="variable-order")? 'active':''; ?>"><a href="variable-order.php"><i class="fa fa-circle-o"></i> Variable Order</a></li>
              </ul>
            </li>
			 <?php if($row['dishbycategory']=='1'){?>
			 <li class="<?= ($current_active_page == 'dishbycat') ? 'active':''; ?>"><a href="dishbycat.php"><i class="fa fa-cutlery"></i> <span>Dish By Categories</span></a></li>
			 <?php } ?>
          </ul> 
        </li> 
		<?php } ?> 
		
		 
		   <li class="treeview <?= ($current_active_page == 'timesetting' || $current_active_page == 'preorder' || $current_active_page == 'postcode' || $current_active_page == 'restraholiday' || $current_active_page == 'plastic_charge' || $current_active_page == 'cutlery' || $current_active_page=="minorder" || $current_active_page == 'gspmail'|| $current_active_page == 'welcometext' || $current_active_page == 'delinfo' || $current_active_page == 'tipcontrol'|| $current_active_page == 'email_import') ? 'active':''; ?>">
          <a href="#"><i class="fa fa-list-ul"></i> <span>Restaurant Setting</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i>
            </span></a>
          <ul class="treeview-menu">
		      
      <?php if($row['time_setting']=='1'){?>
        <li class="<?= ($current_active_page == 'timesetting') ? 'active':''; ?>"><a href="timesetting.php"><i class="fa fa-clock-o"></i> <span>Time Setting</span></a></li><?php } ?>
		 <?php if($row['preorder']=='1'){?>
	     <li class="<?= ($current_active_page == 'preorder') ? 'active':''; ?>"><a href="preorder.php"><i class="fa fa-map-signs"></i> <span>PreOrder </span>  </a></li> <?php } ?>
		   <?php if($row['postcode']=='1'){?>
		 <li class="<?= ($current_active_page == 'postcode') ? 'active':''; ?>"><a href="postcode.php"><i class="fa fa-map-signs"></i> <span>Postcode</span>
          </a></li>
		  <?php } ?>
		    <?php if($row['delivery_item']=='1'){?>
         <li class="<?= ($current_active_page == 'delinfo') ? 'active':''; ?>"><a href="delinfo.php"><i class="fa fa-gift"></i> <span>Delivery Info</span>
          </a></li>
		   <?php } ?>
		     <?php if($row['holidays']=='1'){?>
        <li class="<?= ($current_active_page == 'restraholiday') ? 'active':''; ?>"><a href="restraholiday.php"><i class="fa  fa-plane"></i> <span>Restra Holidays</span></a></li><?php } ?>		
		 <?php if($row['plastic_charge']=='1'){?>
		<li class="<?= ($current_active_page == 'plastic_charge') ? 'active':''; ?>"><a href="plastic_charge.php"><i class="fa fa-gears"></i> <span>Plastic Charge</span></a></li>  <?php } ?>
		  <?php if($row['cutlery_charges']=='1'){?>
         <li class="<?= ($current_active_page == 'cutlery') ? 'active':''; ?>"><a href="cutlery.php"><i class="fa fa-gift"></i> <span>Cutlery Charge</span>
          </a></li>  
		<?php } ?>		  
		   <?php if($row['minorder']=='1'){?>
          <li class="<?= ($current_active_page == 'minorder') ? 'active':''; ?>"><a href="minorder.php"><i class="fa fa-map-signs"></i> <span>Minimum Order for pickup</span></a></li>   <?php } ?>
		    <?php if($row['gps_mail']=='1'){?>
		<li class="<?= ($current_active_page == 'gspmail') ? 'active':''; ?>"><a href="gspmail.php"><i class="fa fa-gears"></i> <span>GSP Mail Text</span>
          </a></li>   <?php } ?>
		    <?php if($row['welcome']=='1'){?>
		   <li class="<?= ($current_active_page == 'welcometext') ? 'active':''; ?>"><a href="welcometext.php"><i class="fa fa-paperclip"></i> <span>Welcome Text</span></a></li> <?php } ?>
		    <?php if($row['tip']=='1'){?>
		  <li class="<?= ($current_active_page == 'tipcontrol') ? 'active':''; ?>"><a href="tipcontrol.php"><i class="fa  fa-plane"></i> <span>Tip </span>
          </a></li>    <?php } ?>
		  <?php if($row['email_import']=='1'){?>
		 <li class="<?= ($current_active_page == 'email_import') ? 'active':''; ?>"><a href="email_import.php"><i class="fa fa-gears"></i> <span>Email Import</span></a></li><?php } ?>
		    </ul>
        </li> 
		<?php if($row['customer']=='1'){?>
			 <li class="<?= ($current_active_page=="customer")? 'active':''; ?>">
          <a href="customer.php">
            <i class="fa fa-paperclip"></i> <span>Customer</span>
          </a>
        </li>
		<?php } ?>
		  <?php if($row['review']=='1'){?>
			<li class="<?= ($current_active_page == 'review') ? 'active':''; ?>">
          <a href="review.php">
            <i class="fa fa-gears"></i> <span>Review</span>
          </a>
        </li><?php } ?>
		
		  <li class="treeview <?= ($current_active_page == 'newsletter'|| $current_active_page == '2ndordermailformat'|| $current_active_page == 'lostcustomer'|| $current_active_page == 'gift') ? 'active':''; ?>">
          <a href="#">
            <i class="fa fa-list-ul"></i> <span>Online Promotion Module</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>		  
          <ul class="treeview-menu">
		  <?php if($row['newsletter']=='1'){?>
		  <li class="<?= ($current_active_page=="newsletter")? 'active':''; ?>"><a href="newsletter.php"><i class="fa fa-paperclip"></i> <span>Newsletter</span>
          </a></li>
		    <?php } ?>
		  <li class="treeview <?= ($current_active_page=="newsletter" || $current_active_page=="2ndordermailformat" || $current_active_page=="lostcustomer")? 'active':''; ?>"><a href="#"><i class="fa fa-circle-o"></i> Voucher <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
         <?php if($row['coupon_mail']=='1'){?>	  
		 <li class="<?= ($current_active_page=="2ndordermailformat")? 'active':''; ?>"><a href="2ndordermailformat.php"><i class="fa fa-paperclip"></i> <span>2nd Coupon mail</span></a></li>
		 <?php } ?>
		  <?php if($row['lost_customer']=='1'){?>
		  <li class="<?= ($current_active_page=="lostcustomer")? 'active':''; ?>"><a href="lostcustomer.php"><i class="fa fa-paperclip"></i> <span>Lost Customer</span></a></li>
		  <?php } ?>
		    <?php if($row['gift_item']=='1'){?>
		    <li class="<?= ($current_active_page == 'gift') ? 'active':''; ?>"><a href="gift.php"><i class="fa fa-gift"></i> <span>Gift Item</span>          </a> </li>
			<?php } ?>
		 
	
</ul></li> </ul>
        </li>
		 <?php if($row['discount']=='1'){?>
		  <li class="treeview <?= ($current_active_page == 'discount' || $current_active_page == 'discount_description') ? 'active':''; ?>">
          <a href="#">
            <i class="fa fa-list-ul"></i> <span>Discount</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>		  
          <ul class="treeview-menu">
		  
		    <li class="<?= ($current_active_page=="discount")? 'active':''; ?>"><a href="discount.php"><i class="fa fa-circle-o"></i> Discount</a></li>
		   <li class="<?= ($current_active_page=="discount_description")? 'active':''; ?>"><a href="discount_description.php"><i class="fa fa-circle-o"></i>Discount description</a></li>
		  </ul>
        </li>
		<?php } ?>
		 <?php if($row['table']=='1'){?>
		  <li  class="<?= ($current_active_page=="table")? 'active':''; ?>"><a href="table.php"><i class="fa fa-paperclip" ></i> <span>Book Table</span>
          </a></li>
		<?php } ?>
		
		
		
		
		  
		   <?php if($row['table']=='1'){?>
		  <li class="treeview <?= ($current_active_page == 'tvariables' || $current_active_page == 'tattributes' || $current_active_page == 'tattributes' || $current_active_page == 'tdish' || $current_active_page == 'tcategories' || $current_active_page == 'torder-category' || $current_active_page=="torder-dish-indi" || $current_active_page == 'torder-dish' || $current_active_page == 'tsupercategory') ? 'active':''; ?>">
          <a href="#">
            <i class="fa fa-list-ul"></i> <span> Table Module Settings</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
		    
			
			<li class="treeview <?= ($current_active_page=="tattributes" || $current_active_page=="tvariables" || $current_active_page=="tvariables" || $current_active_page=="tdish")? 'active':''; ?>">
              <a href="#"><i class="fa fa-circle-o"></i> Table Dishes<span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu ">
				  <li class="<?= ($current_active_page=="tattributes")? 'active':''; ?>"><a href="tattributes.php"><i class="fa fa-circle-o"></i> Attributes</a></li>
            <li class="<?= ($current_active_page=="tvariables")? 'active':''; ?>"><a href="tvariables.php"><i class="fa fa-circle-o"></i> Variables</a></li>
			<li class="<?= ($current_active_page=="tsupercategory")? 'active':''; ?>"><a href="tsupercategory.php"><i class="fa fa-circle-o"></i> Super Category</a></li>	  
			<li class="<?= ($current_active_page=="tcategories")? 'active':''; ?>"><a href="tcategories.php"><i class="fa fa-circle-o"></i> Categories</a></li>
            <li class="<?= ($current_active_page=="tdish")? 'active':''; ?>"><a href="tdish.php"><i class="fa fa-circle-o"></i> Dishes</a></li>
             
			 <li class="treeview <?= ($current_active_page=="torder-dish-indi" || $current_active_page=="torder-category" || $current_active_page=="order-dish")? 'active':''; ?>">
              <a href="#"><i class="fa fa-circle-o"></i> Arranging Display Order<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
				<li class="<?= ($current_active_page=="torder-category")? 'active':''; ?>"><a href="tsuperorder-category.php"><i class="fa fa-circle-o"></i> SuperCategories Order</a></li>
                <li class="<?= ($current_active_page=="torder-category")? 'active':''; ?>"><a href="torder-category.php"><i class="fa fa-circle-o"></i> Categories Order</a></li>
                <li class="<?= ($current_active_page=="torder-dish" || $current_active_page=="torder-dish-indi")? 'active':''; ?>"><a href="torder-dish.php"><i class="fa fa-circle-o"></i> Dish Order</a></li>
              </ul>
            </li>
              </ul>
			 
            <li class="treeview <?= ($current_active_page == 'admin_orders' || $current_active_page == 'today_table_orders') ? 'active':''; ?>">
          <a href="#">
            <i class="fa fa-list-ul"></i> <span>Table Orders</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?= ($current_active_page=="order")? 'active':''; ?>"><a href="today_table_orders.php"><i class="fa fa-circle-o"></i> Today's Table order(s)</a></li>
           
            <li class="<?= ($current_active_page=="admin_orders")? 'active':''; ?>"><a href="admin_orders.php"><i class="fa fa-circle-o"></i> All Table Order(s)</a></li>         
          </ul>
        </li>
		
			  <li class="<?= ($current_active_page=="table_sale_report")? 'active':''; ?>"><a href="table_sale_report.php"><i class="fa fa-circle-o"></i> Table Sale Report</a></li>
          </ul>
        </li>
		<?php } ?>
	  <?php if($row['reserva_module']=='1'){?>	
	 <li class="treeview <?= ($current_active_page == 'reservation' || $current_active_page == 'date_control' || $current_active_page == 'email_templete'|| $current_active_page == 'custom_field'|| $current_active_page == 'reservation-data') ? 'active':''; ?>">
          <a href="#">
            <i class="fa fa-list-ul"></i> <span>Reservation Module</span><span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?= ($current_active_page=="reservation")? 'active':''; ?>"><a href="reservation.php"><i class="fa fa-circle-o"></i> Reservation</a></li>
            <li class="<?= ($current_active_page=="date_control")? 'active':''; ?>"><a href="date_control.php"><i class="fa fa-circle-o"></i> Manage Time & Date</a></li>
			  <li class="<?= ($current_active_page=="email_templete")? 'active':''; ?>"><a href="email_templete.php"><i class="fa fa-circle-o"></i> Email Template</a></li>
			  <li class="<?= ($current_active_page=="custom_field")? 'active':''; ?>"><a href="custom_field.php"><i class="fa fa-circle-o"></i> Custom Field</a></li>
			  <li class="<?= ($current_active_page=="reservation-data")? 'active':''; ?>"><a href="reservation-data.php"><i class="fa fa-circle-o"></i> Export</a></li>		
          </ul>
        </li>	
			<?php } ?>
			  <?php if($row['promotion']=='1'){?>
		  <li class="treeview <?= ($current_active_page == 'promotion' || $current_active_page == 'redeem'|| $current_active_page == 'coupon_expire'|| $current_active_page == 'customer_list') ? 'active':''; ?>">
          <a href="#">
            <i class="fa fa-list-ul"></i> <span>Table Promotion Module</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
		  
            <li class="<?= ($current_active_page=="promotion")? 'active':''; ?>"><a href="promotion.php"><i class="fa fa-circle-o"></i> Add Customer Detail</a></li>
            <li class="<?= ($current_active_page=="redeem")? 'active':''; ?>"><a href="redeem.php"><i class="fa fa-circle-o"></i> Redeem Coupon</a></li>
			  <li class="<?= ($current_active_page=="customer_list")? 'active':''; ?>"><a href="customer_list.php"><i class="fa fa-circle-o"></i> Customer List</a></li>
<li class="<?= ($current_active_page == 'coupon_expire') ? 'active':''; ?>"><a href="coupon_expire.php"><i class="fa fa-table"></i> <span>Coupon Expire Days</span></a></li>			
          </ul>
        </li>
		<?php } ?>
		  <?php if($row['users']=='1'){?>
		   <li class="<?= ($current_active_page == 'users') ? 'active':''; ?>">
          <a href="users.php">
            <i class="fa fa-map-signs"></i> <span>Users</span>
          </a>
        </li><?php } ?>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
 <?php } else {?>



<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="<?= ($current_active_page == 'dashboard') ? 'active':''; ?>">
          <a href="dashboard.php">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
               <li class="treeview <?= ($current_active_page == 'online-orders'|| $current_active_page == 'all-order'  || $current_active_page == 'current-month-order' || $current_active_page == 'seoanalysis'|| $current_active_page == 'current_month_orders') ? 'active':''; ?>">
          <a href="#">
            <i class="fa fa-list-ul"></i> <span>Order(s)</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?= ($current_active_page=="order")? 'active':''; ?>"><a href="online-orders.php"><i class="fa fa-circle-o"></i> Today's order(s)</a></li>
            <li class="<?= ($current_active_page=="current_month_orders")? 'active':''; ?>"><a href="current_month_orders.php"><i class="fa fa-circle-o"></i> Current Month's Order(s)</a></li>
            <li class="<?= ($current_active_page=="all-order")? 'active':''; ?>"><a href="all-order.php"><i class="fa fa-circle-o"></i> All Order(s)</a></li>
		  <li class="<?= ($current_active_page=="seoanalysis")? 'active':''; ?>"><a href="seoanalysis.php"><i class="fa fa-paperclip"></i> <span>Sale Report</span></a></li>
		           
          </ul>
        </li>  
	
		
		
          	  <li class="<?= ($current_active_page == 'cashier') ? 'active':''; ?>">
          <a href="cashier.php">
            <i class="fa fa-map-signs"></i> <span>Cashier</span>
          </a>
        </li>
          
		   <li class="treeview <?= ($current_active_page == 'variables' || $current_active_page == 'attributes' || $current_active_page == 'attributes' || $current_active_page == 'dish' || $current_active_page == 'categories' || $current_active_page == 'order-category' || $current_active_page=="order-dish-indi" || $current_active_page == 'order-dish'|| $current_active_page == 'variable-order' || $current_active_page == 'supercategory' || $current_active_page == 'dishbycat') ? 'active':''; ?>">
          <a href="#">
            <i class="fa fa-list-ul"></i> <span>Food Menu</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
		    <li class="<?= ($current_active_page=="dish")? 'active':''; ?>"><a href="dish.php"><i class="fa fa-circle-o"></i> Dishes</a></li>
			 <li class="<?= ($current_active_page=="categories")? 'active':''; ?>"><a href="categories.php"><i class="fa fa-circle-o"></i> Categories</a></li>
	 <li class="<?= ($current_active_page=="supercategory")? 'active':''; ?>"><a href="supercategory.php"><i class="fa fa-circle-o"></i> Super Category</a></li>
            <li class="<?= ($current_active_page=="attributes")? 'active':''; ?>"><a href="attributes.php"><i class="fa fa-circle-o"></i> Attributes</a></li>
            <li class="<?= ($current_active_page=="variables")? 'active':''; ?>"><a href="variables.php"><i class="fa fa-circle-o"></i> Variables</a></li>
			
           
           <li class="treeview <?= ($current_active_page=="order-dish-indi" || $current_active_page=="order-category" || $current_active_page=="order-dish")? 'active':''; ?>">
              <a href="#"><i class="fa fa-circle-o"></i> Arranging Display Order
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
				<li class="<?= ($current_active_page=="order-category")? 'active':''; ?>"><a href="superorder-category.php"><i class="fa fa-circle-o"></i> SuperCategories Order</a></li>
                <li class="<?= ($current_active_page=="order-category")? 'active':''; ?>"><a href="order-category.php"><i class="fa fa-circle-o"></i> Categories Order</a></li>
                <li class="<?= ($current_active_page=="order-dish" || $current_active_page=="order-dish-indi")? 'active':''; ?>"><a href="order-dish.php"><i class="fa fa-circle-o"></i> Dish Order</a></li>
				       <li class="<?= ($current_active_page=="variable-order" || $current_active_page=="variable-order")? 'active':''; ?>"><a href="variable-order.php"><i class="fa fa-circle-o"></i> Variable Order</a></li>
              </ul>
            </li>
			 <li class="<?= ($current_active_page == 'dishbycat') ? 'active':''; ?>"><a href="dishbycat.php"><i class="fa fa-cutlery"></i> <span>Dish By Categories</span></a></li>
          </ul>
		 
      
        </li> 
		
		
		 
		   <li class="treeview <?= ($current_active_page == 'timesetting' || $current_active_page == 'preorder' || $current_active_page == 'postcode' || $current_active_page == 'restraholiday' || $current_active_page == 'plastic_charge' || $current_active_page == 'cutlery' || $current_active_page=="minorder" || $current_active_page == 'gspmail'|| $current_active_page == 'welcometext' || $current_active_page == 'delinfo' || $current_active_page == 'tipcontrol'|| $current_active_page == 'email_import') ? 'active':''; ?>">
          <a href="#"><i class="fa fa-list-ul"></i> <span>Restaurant Setting</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i>
            </span></a>
          <ul class="treeview-menu">
		      
      
        <li class="<?= ($current_active_page == 'timesetting') ? 'active':''; ?>"><a href="timesetting.php"><i class="fa fa-clock-o"></i> <span>Time Setting</span></a></li>
	     <li class="<?= ($current_active_page == 'preorder') ? 'active':''; ?>"><a href="preorder.php"><i class="fa fa-map-signs"></i> <span>PreOrder </span>
		 <li class="<?= ($current_active_page == 'postcode') ? 'active':''; ?>"><a href="postcode.php"><i class="fa fa-map-signs"></i> <span>Postcode</span>
          </a></li>
         <li class="<?= ($current_active_page == 'delinfo') ? 'active':''; ?>"><a href="delinfo.php"><i class="fa fa-gift"></i> <span>Delivery Info</span>
          </a></li>
        <li class="<?= ($current_active_page == 'restraholiday') ? 'active':''; ?>"><a href="restraholiday.php"><i class="fa  fa-plane"></i> <span>Restra Holidays</span></a></li>
		<li class="<?= ($current_active_page == 'plastic_charge') ? 'active':''; ?>"><a href="plastic_charge.php"><i class="fa fa-gears"></i> <span>Plastic Charge</span></a></li>
         <li class="<?= ($current_active_page == 'cutlery') ? 'active':''; ?>"><a href="cutlery.php"><i class="fa fa-gift"></i> <span>Cutlery Charge</span>
          </a></li>   
          <li class="<?= ($current_active_page == 'minorder') ? 'active':''; ?>"><a href="minorder.php"><i class="fa fa-map-signs"></i> <span>Minimum Order for pickup</span></a></li>  
		<li class="<?= ($current_active_page == 'gspmail') ? 'active':''; ?>"><a href="gspmail.php"><i class="fa fa-gears"></i> <span>GSP Mail Text</span>
          </a></li>  
		   <li class="<?= ($current_active_page == 'welcometext') ? 'active':''; ?>"><a href="welcometext.php"><i class="fa fa-paperclip"></i> <span>Welcome Text</span></a></li>
		  <li class="<?= ($current_active_page == 'tipcontrol') ? 'active':''; ?>"><a href="tipcontrol.php"><i class="fa  fa-plane"></i> <span>Tip </span>
          </a>
        </li>
		 <li class="<?= ($current_active_page == 'email_import') ? 'active':''; ?>"><a href="email_import.php"><i class="fa fa-gears"></i> <span>Email Import</span></a></li>
		    </ul>
        </li> 
		
			 <li class="<?= ($current_active_page=="customer")? 'active':''; ?>">
          <a href="customer.php">
            <i class="fa fa-paperclip"></i> <span>Customer</span>
          </a>
        </li>
			<li class="<?= ($current_active_page == 'review') ? 'active':''; ?>">
          <a href="review.php">
            <i class="fa fa-gears"></i> <span>Review</span>
          </a>
        </li>
		
		  <li class="treeview <?= ($current_active_page == 'newsletter'|| $current_active_page == '2ndordermailformat'|| $current_active_page == 'lostcustomer'|| $current_active_page == 'gift') ? 'active':''; ?>">
          <a href="#">
            <i class="fa fa-list-ul"></i> <span>Online Promotion Module</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>		  
          <ul class="treeview-menu">
		  <li class="<?= ($current_active_page=="newsletter")? 'active':''; ?>"><a href="newsletter.php"><i class="fa fa-paperclip"></i> <span>Newsletter</span>
          </a></li>
		  
		  <li class="treeview <?= ($current_active_page=="newsletter" || $current_active_page=="2ndordermailformat" || $current_active_page=="lostcustomer")? 'active':''; ?>"><a href="#"><i class="fa fa-circle-o"></i> Voucher <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
        	  
		 <li class="<?= ($current_active_page=="2ndordermailformat")? 'active':''; ?>"><a href="2ndordermailformat.php"><i class="fa fa-paperclip"></i> <span>2nd Coupon mail</span></a></li>
		  <li class="<?= ($current_active_page=="lostcustomer")? 'active':''; ?>"><a href="lostcustomer.php"><i class="fa fa-paperclip"></i> <span>Lost Customer</span></a></li>
		    <li class="<?= ($current_active_page == 'gift') ? 'active':''; ?>"><a href="gift.php"><i class="fa fa-gift"></i> <span>Gift Item</span>          </a> </li>
		 
	
</ul></li> </ul>
        </li>
		
		  <li class="treeview <?= ($current_active_page == 'discount' || $current_active_page == 'discount_description') ? 'active':''; ?>">
          <a href="#">
            <i class="fa fa-list-ul"></i> <span>Discount</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>		  
          <ul class="treeview-menu">
		    <li class="<?= ($current_active_page=="discount")? 'active':''; ?>"><a href="discount.php"><i class="fa fa-circle-o"></i> Discount</a></li>
		   <li class="<?= ($current_active_page=="discount_description")? 'active':''; ?>"><a href="discount_description.php"><i class="fa fa-circle-o"></i>Discount description</a></li>
		  </ul>
        </li>
		
		  <li  class="<?= ($current_active_page=="table")? 'active':''; ?>"><a href="table.php"><i class="fa fa-paperclip" ></i> <span>Book Table</span>
          </a></li>
		
		
		
		
		
		  
		  
		  <li class="treeview <?= ($current_active_page == 'tvariables' || $current_active_page == 'tattributes' || $current_active_page == 'tattributes' || $current_active_page == 'tdish' || $current_active_page == 'tcategories' || $current_active_page == 'torder-category' || $current_active_page=="torder-dish-indi" || $current_active_page == 'torder-dish'|| $current_active_page == 'tsupercategory' || $current_active_page == 'today_table_orders'|| $current_active_page == 'admin_orders'|| $current_active_page == 'table_sale_report') ? 'active':''; ?>">
          <a href="#">
            <i class="fa fa-list-ul"></i> <span> Table Module Settings</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
		    
			
			<li class="treeview <?= ($current_active_page=="tattributes" || $current_active_page=="tvariables" || $current_active_page=="tvariables" || $current_active_page=="tdish")? 'active':''; ?>">
              <a href="#"><i class="fa fa-circle-o"></i> Table Dishes<span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu ">
				  <li class="<?= ($current_active_page=="tattributes")? 'active':''; ?>"><a href="tattributes.php"><i class="fa fa-circle-o"></i> Attributes</a></li>
            <li class="<?= ($current_active_page=="tvariables")? 'active':''; ?>"><a href="tvariables.php"><i class="fa fa-circle-o"></i> Variables</a></li>
			<li class="<?= ($current_active_page=="tsupercategory")? 'active':''; ?>"><a href="tsupercategory.php"><i class="fa fa-circle-o"></i> Super Category</a></li>	  
			<li class="<?= ($current_active_page=="tcategories")? 'active':''; ?>"><a href="tcategories.php"><i class="fa fa-circle-o"></i> Categories</a></li>
            <li class="<?= ($current_active_page=="tdish")? 'active':''; ?>"><a href="tdish.php"><i class="fa fa-circle-o"></i> Dishes</a></li>
             
			 <li class="treeview <?= ($current_active_page=="torder-dish-indi" || $current_active_page=="torder-category" || $current_active_page=="order-dish")? 'active':''; ?>">
              <a href="#"><i class="fa fa-circle-o"></i> Arranging Display Order<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
				<li class="<?= ($current_active_page=="torder-category")? 'active':''; ?>"><a href="tsuperorder-category.php"><i class="fa fa-circle-o"></i> SuperCategories Order</a></li>
                <li class="<?= ($current_active_page=="torder-category")? 'active':''; ?>"><a href="torder-category.php"><i class="fa fa-circle-o"></i> Categories Order</a></li>
                <li class="<?= ($current_active_page=="torder-dish" || $current_active_page=="torder-dish-indi")? 'active':''; ?>"><a href="torder-dish.php"><i class="fa fa-circle-o"></i> Dish Order</a></li>
              </ul>
            </li>
              </ul>
			 
            <li class="treeview <?= ($current_active_page == 'admin_orders' || $current_active_page == 'today_table_orders') ? 'active':''; ?>">
          <a href="#">
            <i class="fa fa-list-ul"></i> <span>Table Orders</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?= ($current_active_page=="today_table_orders")? 'active':''; ?>"><a href="today_table_orders.php"><i class="fa fa-circle-o"></i> Today's Table order(s)</a></li>
           
            <li class="<?= ($current_active_page=="admin_orders")? 'active':''; ?>"><a href="admin_orders.php"><i class="fa fa-circle-o"></i> All Table Order(s)</a></li>         
          </ul>
        </li>
			  <li class="<?= ($current_active_page=="table_sale_report")? 'active':''; ?>"><a href="table_sale_report.php"><i class="fa fa-circle-o"></i> Table Sale Report</a></li>
          </ul>
        </li>
		
	 <li class="treeview <?= ($current_active_page == 'reservation' || $current_active_page == 'date_control' || $current_active_page == 'email_templete'|| $current_active_page == 'custom_field'|| $current_active_page == 'reservation-data') ? 'active':''; ?>">
          <a href="#">
            <i class="fa fa-list-ul"></i> <span>Reservation Module</span><span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?= ($current_active_page=="reservation")? 'active':''; ?>"><a href="reservation.php"><i class="fa fa-circle-o"></i> Reservation</a></li>
            <li class="<?= ($current_active_page=="date_control")? 'active':''; ?>"><a href="date_control.php"><i class="fa fa-circle-o"></i> Manage Time & Date</a></li>
			  <li class="<?= ($current_active_page=="email_templete")? 'active':''; ?>"><a href="email_templete.php"><i class="fa fa-circle-o"></i> Email Template</a></li>
			  <li class="<?= ($current_active_page=="custom_field")? 'active':''; ?>"><a href="custom_field.php"><i class="fa fa-circle-o"></i> Custom Field</a></li>
			  <li class="<?= ($current_active_page=="reservation-data")? 'active':''; ?>"><a href="reservation-data.php"><i class="fa fa-circle-o"></i> Export</a></li>		
          </ul>
        </li>	
		
		  <li class="treeview <?= ($current_active_page == 'promotion' || $current_active_page == 'redeem' ||  $current_active_page == 'customer_list' || $current_active_page == 'coupon_expire') ? 'active':''; ?>">
          <a href="#">
            <i class="fa fa-list-ul"></i> <span>Table Promotion Module</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?= ($current_active_page=="promotion")? 'active':''; ?>"><a href="promotion.php"><i class="fa fa-circle-o"></i> Add Customer Detail</a></li>
            <li class="<?= ($current_active_page=="redeem")? 'active':''; ?>"><a href="redeem.php"><i class="fa fa-circle-o"></i> Redeem Coupon</a></li>
			  <li class="<?= ($current_active_page=="customer_list")? 'active':''; ?>"><a href="customer_list.php"><i class="fa fa-circle-o"></i> Customer List</a></li>
<li class="<?= ($current_active_page == 'coupon_expire') ? 'active':''; ?>"><a href="coupon_expire.php"><i class="fa fa-table"></i> <span>Coupon Expire Days</span></a></li>			
          </ul>
        </li>
		
		   <li class="<?= ($current_active_page == 'users') ? 'active':''; ?>">
          <a href="users.php">
            <i class="fa fa-map-signs"></i> <span>Users</span>
          </a>
        </li>
			  	
		 <li class="<?= ($current_active_page == 'setting') ? 'active':''; ?>"><a href="setting.php"><i class="fa fa-gears"></i> <span>Setting</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
<?php } ?>