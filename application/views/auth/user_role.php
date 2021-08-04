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
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
            <h2>User role</h2>

            <div class="clearfix"></div>
            </div>
            <div class="x_content">
            <?php 
                if($successful_save = $this->session->flashdata('successful_save')){
                    echo "<div class='alert alert-dismissible alert-success'>";
                    echo $successful_save;
                    echo "</div>";
                }
            ?>
                <br />
                <?php $attributes = array('class' => 'form-horizontal form-label-left'); ?>
                    <?php echo form_open_multipart("auth/assign_role/$user_id", $attributes) ?>
                    <div class="form-group">
                        
                        <div class="col-md-4">
                            <label class="control-label">Roles <span class="text-danger">*</span></label>
                            <select class="select2_single form-control" name="role_id" tabindex="-1">
                                <?php if($roles): ?> 
                                    <option value="">Role list</option>
                                    <?php foreach($roles as $row): ?>
                                        <option value='<?php echo $row->role_id; ?>'><?php echo $row->name; ?></option>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <option>No records found</option>
                                <?php endif; ?>
                            </select>
                            <?php echo form_error("role_id", "<p class='text-danger'>", "</p>"); ?>
                        </div>
                    </div>
                    
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-4">
                            <?php echo form_submit(['value' => 'Update', 'class' => 'btn btn-success']); ?>
                            <a href='<?php echo base_url("auth/users"); ?>' class="btn btn-link"> Cancel</a>
                        </div>
                    </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->

<!-- page footer -->
<?php $this->load->view("Layouts/footer.php"); ?>
<!-- /page footer -->


