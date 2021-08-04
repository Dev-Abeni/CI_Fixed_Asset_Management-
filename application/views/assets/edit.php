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
            <h2>Edit an asset</h2>

            <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                <?php 
                    if($failed_upload = $this->session->flashdata('failed_upload')){
                        echo "<div class='alert alert-dismissible alert-danger'>";
                        echo $failed_upload;
                        echo "</div>";
                    }
                ?>
                <?php $attributes = array('class' => 'form-horizontal form-label-left'); ?>
                    <?php echo form_open_multipart("asset/update/$asset->asset_id", $attributes) ?>
                    <div class="form-group">
                        <div class="col-md-4">
                            <label class="control-label">Unicode <span class="text-danger">*</span></label>
                            <?php 
                                echo form_input([
                                    'name' => 'unicode', 
                                    'class' => 'form-control', 
                                    'placeholder' => 'Plate, serial or other identification code', 
                                    'readonly' => true,
                                    'value' => set_value('unicode', $asset->unicode)
                                ]); 
                            ?>
                            <?php echo form_error("unicode", "<p class='text-danger'>", "</p>"); ?>
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">Name <span class="text-danger">*</span></label>
                            <?php 
                                echo form_input([
                                    'name' => 'name', 
                                    'class' => 'form-control', 
                                    'placeholder' => 'Name of the asset', 
                                    'value' => set_value('name', $asset->name)
                                ]); 
                            ?>
                            <?php echo form_error("name", "<p class='text-danger'>", "</p>"); ?>
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">Category <span class="text-danger">*</span></label>
                            <select class="select2_single form-control" name="category_id" tabindex="-1">
                                <?php if($categories): ?> 
                                    <option value='<?php echo $asset->category_id; ?>'><?php echo $asset->category_name; ?></option>
                                    <?php foreach($categories as $row): ?>
                                        <option value='<?php echo $row->category_id; ?>'><?php echo $row->name; ?></option>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <option>No records found</option>
                                <?php endif; ?>
                            </select>
                            <u><p>Current selection: <?php echo $asset->category_name; ?></p></u>
                            <?php echo form_error("category_id", "<p class='text-danger'>", "</p>"); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-4">
                            <label class="control-label">Date of acquisition <span class="text-danger">*</span></label>
                            <?php 
                                echo form_input([
                                    'name' => 'date_of_acquisition', 
                                    'class' => 'form-control', 
                                    'placeholder' => 'Date when the asset was purchased', 
                                    'value' => set_value('$asset->unicode', $asset->date_of_acquisition), 
                                    'id' => 'datepicker'
                                ]); 
                            ?>
                            <?php echo form_error("date_of_acquisition", "<p class='text-danger'>", "</p>"); ?>
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">Price <span class="text-danger">*</span></label>
                            <?php 
                                echo form_input([
                                    'name' => 'original_price', 
                                    'class' => 'form-control', 
                                    'placeholder' => 'Original price of the asset', 
                                    'value' => set_value('original_price', $asset->original_price)
                                ]); 
                            ?>
                            <?php echo form_error("original_price", "<p class='text-danger'>", "</p>"); ?>
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">Vendors</label>
                            <select class="select2_single form-control" name="vendor_id" tabindex="-1">
                                <?php if($vendors): ?> 
                                    <option value='<?php echo $asset->vendor_id; ?>'><?php echo $asset->vendor_name; ?></option>
                                    <?php foreach($vendors as $row): ?>
                                        <option value='<?php echo $row->vendor_id; ?>'><?php echo $row->name; ?></option>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <option>No records found</option>
                                <?php endif; ?>
                            </select>
                            <?php echo form_error("vendor_id", "<p class='text-danger'>", "</p>"); ?>
                            <u><p>Current selection: <?php echo $asset->vendor_name; ?></p></u>
                            <?php echo form_error("vendor_id", "<p class='text-danger'>", "</p>"); ?>
                        </div>
                        <div class="form-group">
                        <div class="col-md-4">
                            <?php if($asset->image_url): ?>
                                <div class="profile_img">
                                    <div id="crop-avatar">
                                        <!-- Current avatar -->
                                        <img class="img-responsive avatar-view" src="<?php echo $asset->image_url; ?>" alt="Avatar" title="Change the avatar">
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
                            <a href='<?php echo base_url("asset"); ?>' class="btn btn-link"> Cancel</a>
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


