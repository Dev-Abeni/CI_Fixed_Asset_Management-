<!-- page header -->
<?php $this->load->view("Layouts/header.php"); ?>
<!-- /page header -->
<!-- page sidebar -->
<?php $this->load->view("Layouts/sidebar.php"); ?>
<!-- /page sidebar -->
<!-- page navigation -->
<?php $this->load->view("Layouts/navigation.php"); ?>
<!-- /page navigation -->

<!-- page content -->
<div class="right_col" role="main">
      <?php 
          if($successful_removal = $this->session->flashdata('successful_removal')){
              echo "<br><br><div class='alert alert-dismissible alert-success'>";
              echo $successful_removal;
              echo "</div>";
          }elseif($failed_removal = $this->session->flashdata('failed_removal')){
              echo "<div class='alert alert-dismissible alert-danger'>";
              echo $failed_removal;
              echo "</div>";
          }
      ?>
      <?php if($assets): ?>
      <?php foreach($assets as $row): ?>
          <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="x_panel tile ">
              <div class="x_title">
                <h2><?php echo $row->name; ?></h2>
                
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <div class="dashboard-widget-content">
                  <ul class="quick-list">
                    <li><i class="fa fa-code"></i><?php echo $row->unicode; ?></li>
                    <li><i class="fa fa-bars"></i><?php echo $row->category_name; ?></li>
                    <li><i class="fa fa-building"></i><?php echo $row->vendor_name; ?></a> </li>
                    <li><i class="fa fa-money"></i><?php echo $row->original_price; ?> br</li>
                    <li><i class="fa fa-calendar"></i><?php echo date_format(date_create($row->date_of_acquisition), "F d, Y"); ?></li>
                    
                  </ul>
                  <?php if($row->image_url): ?>
                  <div class="pull-right">
                      <div class="goal-wrapper">
                        <img src="<?php echo $row->image_url;?>" class="profile-pic" width="110px" height="auto">
                      </div>
                  </div>
                  <?php endif; ?>
                  <div>
                      <a href="<?php echo base_url("asset_possesions/employee/$row->asset_id"); ?>" class="btn btn-success btn-sm">
                        <i class="fa fa-user"></i> Assign
                      </a>

                      <a href="<?php echo base_url("asset_possesions/remove_assignments/$row->asset_id"); ?>" class="btn btn-danger btn-sm">
                        <i class="fa fa-close"></i> Remove assignments
                      </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
      <?php endforeach; ?>
      <?php else: ?>
        <h3 class="text-danger">No data available</h3>
      <?php endif; ?>
</div>

<!-- /page content -->

<!-- page footer -->
<?php $this->load->view("Layouts/footer.php"); ?>
<!-- /page footer -->


