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
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <?php 
                    if($successful_save = $this->session->flashdata('successful_save')){
                        echo "<div class='alert alert-dismissible alert-success'>";
                        echo $successful_save;
                        echo "</div>";
                    }elseif($failed_save = $this->session->flashdata('failed_save')){
                        echo "<div class='alert alert-dismissible alert-danger'>";
                        echo $failed_save;
                        echo "</div>";
                    }
                ?>
                <div class="table-responsive">
                    <?php if($employees): ?>
                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                                <tr class="headings">
                                <th>Image</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Designation</th>
                                <th>Department</th>
                                <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                            <?php foreach($employees as $row): ?>
                                <tr class="even pointer">
                                <td>
                                    <?php if($row->image_url): ?>
                                        <div class="profile_pic">
                                            <img src="<?php echo $row->image_url; ?>" alt="..." width="50px" heigh="50px" class="profile_img">
                                        </div>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo $row->name; ?></td>
                                <td><?php echo $row->email; ?></td>
                                <td><?php echo $row->phone; ?></td>
                                <td><?php echo $row->designation_name; ?></td>
                                <td><?php echo $row->department_name ?></td>
                                <td>
                                    <a href="<?php echo base_url("asset_possesions/assign_to_employees/$asset_id/$row->employee_id"); ?>" class="btn btn-success btn-sm">
                                         Assign asset
                                    </a>
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
</div>

<!-- /page content -->

<!-- page footer -->
<?php $this->load->view("Layouts/footer.php"); ?>
<!-- /page footer -->


