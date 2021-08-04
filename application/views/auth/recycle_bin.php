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
                <h2>Users</h2>
                &nbsp;
                <a href="<?php echo base_url('auth/users'); ?>" class="btn btn-sm btn-primary"><i class="fa fa-reply"></i> Return to list</a>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <?php 
                    if($successful_delete = $this->session->flashdata('successful_delete')){
                        echo "<div class='alert alert-dismissible alert-success'>";
                        echo $successful_delete;
                        echo "</div>";
                    }elseif($failed_delete = $this->session->flashdata('failed_delete')){
                        echo "<div class='alert alert-dismissible alert-danger'>";
                        echo $failed_delete;
                        echo "</div>";
                    }
                ?>
                <?php if($trashed_users): ?>
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Username</th>
                            <th>User role</th>
                            <th>Account status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php foreach($trashed_users as $row): ?>
                                <tr>
                                    <td><?php echo $row->first_name; ?> <?php echo $row->last_name; ?></a></td>
                                    <td><?php echo $row->username; ?></td>
                                    <td>
                                        <?php 
                                            if($row->role_id == 1):
                                        ?>
                                                Administrator
                                        <?php      
                                            elseif($row->account_status == 2):
                                        ?>
                                                Officer
                                        <?php  
                                            endif; 
                                        ?>
                                    </td>
                                    <td><?php 
                                            if($row->account_status == 1):
                                        ?>
                                                <p class="btn btn-sm btn-primary">Active</p>
                                        <?php      
                                            elseif($row->account_status == 0):
                                        ?>
                                                <p class="btn btn-sm btn-warning">Inactive</p>
                                        <?php  
                                            endif; 
                                        ?>
                                    </td>
                                    <td>
                                        <a href='<?php echo base_url("auth/change_is_canceled/$row->user_id/$row->is_canceled"); ?>' class="btn btn-success">
                                        <i class="fa fa-refresh"></i> Restore
                                        <a href='<?php echo base_url("auth/delete/$row->user_id"); ?>' class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash"></i> Delete
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


