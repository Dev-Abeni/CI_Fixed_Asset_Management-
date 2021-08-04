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
                <h2>Employees</h2>
                &nbsp;
                <a href="<?php echo base_url('employees'); ?>" class="btn btn-sm btn-primary"><i class="fa fa-reply"></i> Return to list</a>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <?php 
                    if($successful_registration = $this->session->flashdata('successful_registration')){
                        echo "<div class='alert alert-dismissible alert-success'>";
                        echo $successful_registration;
                        echo "</div>";
                    }elseif($failed_registration = $this->session->flashdata('failed_registration')){
                        echo "<div class='alert alert-dismissible alert-danger'>";
                        echo $failed_registration;
                        echo "</div>";
                    }elseif($successful_update = $this->session->flashdata('successful_update')){
                        echo "<div class='alert alert-dismissible alert-success'>";
                        echo $successful_update;
                        echo "</div>";
                    }elseif($failed_update = $this->session->flashdata('failed_update')){
                        echo "<div class='alert alert-dismissible alert-danger'>";
                        echo $failed_update;
                        echo "</div>";
                    }elseif($successful_cancel = $this->session->flashdata('successful_cancel')){
                        echo "<div class='alert alert-dismissible alert-success'>";
                        echo $successful_cancel;
                        echo "</div>";
                    }elseif($failed_cancel = $this->session->flashdata('failed_cancel')){
                        echo "<div class='alert alert-dismissible alert-danger'>";
                        echo $failed_cancel;
                        echo "</div>";
                    }
                ?>
                <?php if($deleted_employees): ?>
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Designation</th>
                            <th>Department</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php foreach($deleted_employees as $row): ?>
                                <tr>
                                    <td>
                                        <?php if($row->image_url): ?>
                                            <div class="profile_pic">
                                                <img src="<?php echo $row->image_url; ?>" alt="..." width="100px" heigh="100px" class="profile_img">
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo $row->name; ?></td>
                                    <td><?php echo $row->email; ?></td>
                                    <td><?php echo $row->phone; ?></td>
                                    <td><?php echo $row->designation_name; ?></td>
                                    <td><?php echo $row->department_name ?></td>
                                    <td>
                                    <a href='<?php echo base_url("employees/restore/$row->employee_id"); ?>' class="btn btn-success btn-sm"><i class="fa fa-refresh">
                                        </i> Restore</a>
                                        <a href='<?php echo base_url("employees/delete/$row->employee_id"); ?>' class="btn btn-danger btn-sm">
                                        <i class="fa fa-close"></i> Delete Permanently</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <h3 class="text-danger">No data available</h3>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- /page content -->

<!-- page footer -->
<?php $this->load->view("Layouts/footer.php"); ?>
<!-- /page footer -->


