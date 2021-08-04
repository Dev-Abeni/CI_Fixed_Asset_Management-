<body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="<?php echo base_url("auth"); ?>" class="site_title">
                <img src="<?php echo base_url('assets/images/DashboardLogo.png');?>" width="45px" height="45px">
                <span>MCM Hospital</span>
              </a>
            </div>

            <div class="clearfix"></div>

            
            
            <!-- /menu profile quick info -->

            <br />
            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                <div class="menu_section">
                <ul class="nav side-menu">
                    <li><a href="<?php echo base_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard </a></li>
                    <li><a><i class="fa fa-exchange"></i> Vendors <span class="fa fa-plus"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?php echo base_url('vendors'); ?>">List</a></li>
                            <li><a href="<?php echo base_url('vendors/create'); ?>">Add new</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-truck"></i> Assets <span class="fa fa-plus"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?php echo base_url('asset'); ?>">List</a></li>
                            <li><a href="<?php echo base_url('asset/create'); ?>">Add New</a></li>
                            <?php if($user->role_id == 1): ?>
                            <li><a href="<?php echo base_url('asset_categories'); ?>">Category</a></li>
                            <?php endif; ?>
                            <li><a href="<?php echo base_url('asset_possesions'); ?>">Possesion</a></li>
                            <li><a href="<?php echo base_url('asset_depreciation_schedule'); ?>">Depreciation schedule </a></li>
                        </ul>
                    </li>
                    <?php if($user->role_id == 1): ?>
                    <li><a><i class="fa fa-database"></i>Master Data <span class="fa fa-plus"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?php echo base_url('departments'); ?>">Department</a></li>
                            <li><a href="<?php echo base_url('designations'); ?>">Designation</a></li>
                            <li><a href="<?php echo base_url('employees'); ?>">Employee</a></li>
                        </ul>
                    </li>
                    <li><a href="<?php echo base_url('auth/users'); ?>"><i class="fa fa-user"></i> Users </a></li>
                    <?php endif; ?>
                </ul>
                </div>

            </div>
            <!-- /sidebar menu -->
            </div>
        </div>