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
                <h2>Recycle bin</h2>
                &nbsp; 
                <a href="<?php echo base_url('vendors'); ?>" class="btn btn-sm btn-primary"><i class="fa fa-reply"></i> Return to list</a>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <?php 
                    if($successful_restore = $this->session->flashdata('successful_restore')){
                        echo "<div class='alert alert-dismissible alert-success'>";
                        echo $successful_restore;
                        echo "</div>";
                    }elseif($failed_restore = $this->session->flashdata('failed_restore')){
                        echo "<div class='alert alert-dismissible alert-danger'>";
                        echo $failed_restore;
                        echo "</div>";
                    }elseif($successful_delete = $this->session->flashdata('successful_delete')){
                        echo "<div class='alert alert-dismissible alert-success'>";
                        echo $successful_delete;
                        echo "</div>";
                    }elseif($failed_delete = $this->session->flashdata('failed_delete')){
                        echo "<div class='alert alert-dismissible alert-danger'>";
                        echo $failed_delete;
                        echo "</div>";
                    }
                ?>
                <?php if($deleted_vendors): ?>
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Vendor company</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Country</th>
                            <th>City</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php foreach($deleted_vendors as $row): ?>
                                <tr>
                                    <td><?php echo $row->name; ?></td>
                                    <td><?php echo $row->email; ?></td>
                                    <td>(<?php echo "+".$row->phonecode; ?>) <?php echo $row->phone; ?></td>
                                    <td><?php echo $row->nicename; ?></td>
                                    <td><?php echo $row->city; ?></td>
                                    <td>
                                        <a href='<?php echo base_url("vendors/restore/$row->vendor_id"); ?>' class="btn btn-success btn-sm">
                                            <i class="fa fa-refresh"></i> 
                                            Restore
                                        </a>
                                        <a href='<?php echo base_url("vendors/delete/$row->vendor_id"); ?>' class="btn btn-danger btn-sm">
                                            <i class="fa fa-close"></i> 
                                            Delete
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

<!-- /page content -->

<!-- page footer -->
<?php $this->load->view("Layouts/footer.php"); ?>
<!-- /page footer -->


