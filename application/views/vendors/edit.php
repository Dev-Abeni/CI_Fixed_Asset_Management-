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
            <h2>Edit a vendor</h2>

            <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                <?php 
                    if($successful_save = $this->session->flashdata('successful_save')){
                        echo "<div class='alert alert-dismissible alert-success'>";
                        echo $successful_save;
                        echo "</div>";
                    }elseif($failed_upload = $this->session->flashdata('failed_upload')){
                        echo "<div class='alert alert-dismissible alert-danger'>";
                        echo $failed_upload;
                        echo "</div>";
                    }
                ?>
                <?php $attributes = array('class' => 'form-horizontal form-label-left'); ?>
                    <?php echo form_open_multipart("vendors/update/$vendor->vendor_id", $attributes) ?>
                    <div class="form-group">
                        <div class="col-md-4">
                            <label class="control-label">Vendor <span class="text-danger">*</span></label>
                            <?php 
                                echo form_input([
                                    'name' => 'name', 
                                    'class' => 'form-control', 
                                    'placeholder' => 'Name of the vendor',
                                    'value' => set_value('name', $vendor->name)
                                ]); 
                            ?>
                            <?php echo form_error("name", "<p class='text-danger'>", "</p>"); ?>
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">Country <span class="text-danger">*</span></label>
                            <select class="select2_single form-control" name="country_id" tabindex="-1">
                                <?php if($countries): ?> 
                                    <option value='<?php echo $vendor->country_id; ?>'><?php echo $vendor->nicename; ?></option>
                                    <?php foreach($countries as $row): ?>
                                        <option value='<?php echo $row->country_id; ?>'><?php echo $row->nicename; ?></option>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <option>No records found</option>
                                <?php endif; ?>
                            </select>
                            <u><p>Current selection: <?php echo $vendor->nicename; ?></p></u>
                            <?php echo form_error("country_id", "<p class='text-danger'>", "</p>"); ?>
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">City <span class="text-danger">*</span></label>
                            <?php 
                                echo form_input([
                                    'name' => 'city', 
                                    'class' => 'form-control', 
                                    'placeholder' => 'City of the vendor',
                                    'value' => set_value('city', $vendor->city)
                                ]); 
                            ?>
                            <?php echo form_error("city", "<p class='text-danger'>", "</p>"); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-4">
                            <label class="control-label">Email <span class="text-danger">*</span></label>
                            <?php 
                                echo form_input([
                                    'name' => 'email', 
                                    'class' => 'form-control', 
                                    'placeholder' => 'Email address of the vendor', 
                                    'value' => set_value('email', $vendor->email)
                                ]); 
                            ?>
                            <?php echo form_error("email", "<p class='text-danger'>", "</p>"); ?>
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">Phone <span class="text-danger">*</span></label>
                            <?php 
                                echo form_input([
                                    'name' => 'phone', 
                                    'class' => 'form-control', 
                                    'placeholder' => 'Phone number of the vendor', 
                                    'value' => set_value('phone', $vendor->phone)
                                ]); 
                            ?>
                            <?php echo form_error("phone", "<p class='text-danger'>", "</p>"); ?>
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">State</label>
                            <?php 
                                echo form_input([
                                    'name' => 'state', 
                                    'class' => 'form-control', 
                                    'placeholder' => 'State of the vendor', 
                                    'value' => set_value('state', $vendor->state)
                                ]); 
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            <label class="control-label">Address</label>
                            <?php 
                                echo form_textarea([
                                    'name' => 'address', 
                                    'class' => 'form-control', 
                                    'rows' => '4', 
                                    'placeholder' => 'Physical address of the vendor', 
                                    'value' => set_value('address', $vendor->address)
                                ]); 
                            ?>
                        </div>
                        <div class="col-md-6">
                            <label class="control-label">Description</label>
                            <?php 
                                echo form_textarea([
                                    'name' => 'description', 
                                    'class' => 'form-control', 
                                    'rows' => '4', 
                                    'placeholder' => 'Short description about the vendor',
                                    'value' => set_value('description', $vendor->description)
                                ]); 
                            ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-4">
                            <?php if($vendor->image_url): ?>
                                <div class="profile_img">
                                    <div id="crop-avatar">
                                        <!-- Current avatar -->
                                        <img class="img-responsive avatar-view" src="<?php echo $vendor->image_url; ?>" alt="Avatar" title="Change the avatar">
                                    </div>
                                </div>
                            <?php endif; ?>
                            <label class="control-label">Asset Image</label>
                            <input type="file" width="20" name="image_url"/>
                        </div>
                    </div>
                    
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-4">
                            <?php echo form_submit(['value' => 'Update', 'class' => 'btn btn-success']); ?>
                            <a href='<?php echo base_url("vendors"); ?>' class="btn btn-link"> Cancel</a>
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


