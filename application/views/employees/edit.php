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
            <h2>Edit an employee</h2>

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
                <?php echo form_open_multipart("employees/update/$employee->employee_id", $attributes) ?>
                <div class="form-group">
                    <div class="col-md-4">
                        <label class="control-label">Name <span class="text-danger">*</span></label>
                        <?php 
                            echo form_input([
                                'name' => 'name', 
                                'class' => 'form-control', 
                                'placeholder' => 'Name of the employee',
                                'value' => set_value('name', $employee->name)
                            ]); 
                        ?>
                        <?php echo form_error("name", "<p class='text-danger'>", "</p>"); ?>
                    </div>
                    <div class="col-md-4">
                        <label class="control-label">Email <span class="text-danger">*</span></label>
                        <?php 
                            echo form_input([
                                'name' => 'email', 
                                'class' => 'form-control', 
                                'placeholder' => 'Email address of the employee', 
                                'value' => set_value('email', $employee->email)
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
                                'placeholder' => 'Phone number of the employee', 
                                'value' => set_value('phone', $employee->phone)
                            ]); 
                        ?>
                        <?php echo form_error("phone", "<p class='text-danger'>", "</p>"); ?>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-4">
                        <label class="control-label">Department <span class="text-danger">*</span></label>
                        <select class="select2_single form-control" name="department_id" tabindex="-1">
                            <?php if($departments): ?> 
                                <option value="<?php echo $employee->department_id; ?>"><?php echo $employee->department_name; ?></option>
                                <?php foreach($departments as $row): ?>
                                    <option value='<?php echo $row->department_id; ?>'><?php echo $row->name; ?></option>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <option>No records found</option>
                            <?php endif; ?>
                        </select>
                        <u><p>Current selection: <?php echo $employee->department_name; ?></p></u>
                        <?php echo form_error("department_id", "<p class='text-danger'>", "</p>"); ?>
                    </div>

                    <div class="col-md-4">
                        <label class="control-label">Designation <span class="text-danger">*</span></label>
                        <select class="select2_single form-control" name="designation_id" tabindex="-1">
                            <?php if($designations): ?> 
                                <option value="<?php echo $employee->designation_id; ?>"><?php echo $employee->designation_name; ?></option>
                                <?php foreach($designations as $row): ?>
                                    <option value='<?php echo $row->designation_id; ?>'><?php echo $row->name; ?></option>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <option>No records found</option>
                            <?php endif; ?>
                        </select>
                        <u><p>Current selection: <?php echo $employee->designation_name; ?></p></u>
                        <?php echo form_error("designation_id", "<p class='text-danger'>", "</p>"); ?>
                    </div>
                </div>

                <div class="form-group">
                <div class="col-md-4">
                            <?php if($employee->image_url): ?>
                                <div class="profile_img">
                                    <div id="crop-avatar">
                                        <!-- Current avatar -->
                                        <img class="img-responsive avatar-view" src="<?php echo $employee->image_url; ?>" alt="Avatar" title="Change the avatar">
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
                        <a href='<?php echo base_url("employees"); ?>' class="btn btn-link"> Cancel</a>
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


