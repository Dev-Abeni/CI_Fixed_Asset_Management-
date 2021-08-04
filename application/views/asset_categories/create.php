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
            <h2>Add an asset category</h2>

            <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                <?php $attributes = array('class' => 'form-horizontal form-label-left'); ?>
                <?php echo form_open("asset_categories/add", $attributes) ?>
                    <div class="form-group">
                        <div class="col-md-4">
                            <label class="control-label">Name <span class="text-danger">*</span></label>
                            <?php 
                                echo form_input([
                                    'name' => 'name', 
                                    'class' => 'form-control', 
                                    'placeholder' => 'Name of the category', 
                                    'value' => set_value('name')
                                ]); 
                            ?>
                            <?php echo form_error("name", "<p class='text-danger'>", "</p>"); ?>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-md-4">
                            <label class="control-label">Depreciation Percentage <span class="text-danger">*</span></label>
                            <?php 
                                echo form_input([
                                    'name' => 'depreciation_percent', 
                                    'class' => 'form-control', 
                                    'placeholder' => 'The value of the depreciation rate', 
                                    'value' => set_value('depreciation_percent')
                                ]); 
                            ?>
                            <?php echo form_error("depreciation_percent", "<p class='text-danger'>", "</p>"); ?>
                        </div>
                    </div>

                    <div class="form-group"> 
                        <div class="col-md-4">
                            <label class="control-label">Description</label>
                            <?php 
                                echo form_textarea([
                                    'name' => 'description', 
                                    'class' => 'form-control', 
                                    'rows' => '4', 
                                    'placeholder' => 'Description about the category', 
                                    'value' => set_value('description')
                                ]); 
                            ?>
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-4">
                            <?php echo form_submit(['value' => 'Save', 'class' => 'btn btn-success']); ?>
                            <a href='<?php echo base_url("asset_categories"); ?>' class="btn btn-link"> Cancel</a>
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


