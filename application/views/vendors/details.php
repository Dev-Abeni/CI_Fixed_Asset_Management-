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
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Vendor details</h2>
                    <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                            <?php if($vendor_details->image_url): ?>
                                <div class="profile_img">
                                    <div id="crop-avatar">
                                        <!-- Current avatar -->
                                        <img class="img-responsive avatar-view" src="<?php echo $vendor_details->image_url; ?>" alt="Avatar" title="Change the avatar">
                                    </div>
                                </div>
                            <?php endif; ?>
                            <h3><?php echo $vendor_details->name; ?></h3>
                            <ul class="list-unstyled user_data">
                            <li>
                                <i class="fa fa-map-marker user-profile-icon"></i> 
                                <?php echo $vendor_details->city; ?> 
                                <?php 
                                    if($vendor_details->state){
                                        echo " | ".$vendor_details->state;
                                    }
                                ?>
                                <?php echo " | ".$vendor_details->nicename; ?>
                                <?php 
                                    if($vendor_details->address){
                                        echo " | ".$vendor_details->address;
                                    }
                                ?>
                            </li>
                            <br>
                            <li>
                                <i class="fa fa-envelope user-profile-icon"></i> 
                                <?php echo $vendor_details->email; ?>
                            </li>
                            <br>
                            <li class="m-top-xs">
                                <i class="fa fa-phone user-profile-icon"></i>
                                <?php echo "(+".$vendor_details->phonecode.") ".$vendor_details->phone; ?>
                            </li>
                            </ul>
                        </div>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <div class="profile_title">
                                <div class="col-md-6">
                                    <h2>Description</h2>
                                </div>
                            </div>
                            <div class="profile_content">
                                <p><?php echo $vendor_details->description; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->

<!-- page footer -->
<?php $this->load->view("Layouts/footer.php"); ?>
<!-- /page footer -->


