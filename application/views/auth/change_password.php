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
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                <h2>Change Password</h2>
                <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    <?php $attributes = array('class' => 'form-horizontal form-label-left'); ?>
                    <?php echo form_open('auth/update_password', $attributes) ?>
                        <?php 
                            if($incorrect_password = $this->session->flashdata('incorrect_password')){
                                echo "<div class='alert alert-dismissible alert-danger'>";
                                echo $incorrect_password;
                                echo "</div>";
                            }else if($failed_password_change = $this->session->flashdata('failed_password_change')){
                                echo "<div class='alert alert-dismissible alert-danger'>";
                                echo $failed_password_change;
                                echo "</div>";
                            }else if($password_changed = $this->session->flashdata('password_changed')){
                                echo "<div class='alert alert-dismissible alert-success'>";
                                echo $password_changed;
                                echo "</div>";
                            }
                        ?>
                        <div class="form-group">
                            <div class="col-md-3">
                                <label class="control-label">Old Password <span class="text-danger">*</span></label>
                                <?php echo form_password(['name' => 'old_password', 'class' => 'form-control', 'placeholder' => 'Enter your old password to confirm']); ?>
                                <?php echo form_error("old_password", "<p class='text-danger'>", "</p>"); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-3">
                                <label class="control-label">New Password <span class="text-danger">*</span></label>
                                <?php echo form_password(['name' => 'password', 'class' => 'form-control', 'placeholder' => 'Enter new password you want to set']); ?>
                                <?php echo form_error("password", "<p class='text-danger'>", "</p>"); ?>
                            </div>
                        </div>
                        
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-4">
                                <?php echo form_submit(['value' => 'Update', 'class' => 'btn btn-primary']); ?>
                                <a href="<?php echo base_url('dashboard'); ?>" class="btn btn-link">Return to Dashboard</a>
                            </div>
                        </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->

<!-- page footer -->
<?php $this->load->view("Layouts/footer.php"); ?>
<!-- /page footer -->


