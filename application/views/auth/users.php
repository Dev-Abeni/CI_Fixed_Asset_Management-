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
                <a href='<?php echo base_url("auth/recycle_bin") ?>' class="btn btn-warning btn-sm"><i class="fa fa-trash"></i> Recycle bin</a>
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
                    }elseif($successful_assignment = $this->session->flashdata('successful_assignment')){
                        echo "<div class='alert alert-dismissible alert-success'>";
                        echo $successful_assignment;
                        echo "</div>";
                    }elseif($failed_assignment = $this->session->flashdata('failed_assignment')){
                        echo "<div class='alert alert-dismissible alert-danger'>";
                        echo $failed_assignment;
                        echo "</div>";
                    }
                ?>
                <?php if($users): ?>
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Username</th>
                            <th>User role</th>
                            <th>Account status</th>
                            <th>Change status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php foreach($users as $row): ?>
                                <tr>
                                    <td><?php echo $row->first_name; ?> <?php echo $row->last_name; ?></a></td>
                                    <td><?php echo $row->username; ?></td>
                                    <td>
                                        <?php 
                                            if($row->role_id == 1):
                                        ?>
                                                Administrator
                                        <?php      
                                            else:
                                        ?>
                                                Officer
                                        <?php  
                                            endif; 
                                        ?>
                                    </td>
                                    <td>
                                        <?php 
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
                                        <?php 
                                            if($row->account_status == 1):
                                        ?>
                                                <a href='<?php echo base_url("auth/change_account_status/$row->user_id/$row->account_status"); ?>' class="btn btn-warning btn-sm">
                                                <i class="fa fa-lock"></i> Turn Off </a>
                                        <?php      
                                            elseif($row->account_status == 0):
                                        ?>
                                                <a href='<?php echo base_url("auth/change_account_status/$row->user_id/$row->account_status"); ?>' class="btn btn-primary btn-sm">
                                                <i class="fa fa-unlock"></i> Turn On </a>
                                        <?php  
                                            endif; 
                                        ?>
                                    </td>
                                    <td>
                                        <a href='<?php echo base_url("auth/user_role/$row->user_id") ?>' class="btn btn-link btn-sm">
                                        <i class="fa fa-user"></i> User Role
                                        <a href='<?php echo base_url("auth/change_is_canceled/$row->user_id/$row->is_canceled"); ?>' class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash"></i> Move to Trash
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


