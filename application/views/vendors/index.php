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
                <h2>Vendors</h2>
                &nbsp;
                <a href="<?php echo base_url('vendors/create'); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Add new vendor</a>
                <a href='<?php echo base_url("vendors/recycle_bin") ?>' class="btn btn-warning btn-sm"><i class="fa fa-trash"></i> Recycle bin</a>
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
                <?php if($vendors): ?>
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Image</th>
                            <th>Vendor company</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Country</th>
                            <th>City</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php foreach($vendors as $row): ?>
                                <tr>
                                    <td>
                                        <?php if($row->image_url): ?>
                                            <div class="profile_pic">
                                                <img src="<?php echo $row->image_url; ?>" alt="..." width="50px" heigh="50px">
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td><a href='<?php echo base_url("vendors/details/$row->vendor_id"); ?>'><u><?php echo $row->name; ?></u></a></td>
                                    <td><?php echo $row->email; ?></td>
                                    <td>(<?php echo "+".$row->phonecode; ?>) <?php echo $row->phone; ?></td>
                                    <td><?php echo $row->nicename; ?></td>
                                    <td><?php echo $row->city; ?></td>
                                    <td>
                                        <a href='<?php echo base_url("vendors/change/$row->vendor_id"); ?>' class="btn btn-success btn-sm">
                                        <i class="fa fa-pencil"></i> Edit</a>
                                        <a href='<?php echo base_url("vendors/move_to_trash/$row->vendor_id"); ?>' class="btn btn-sm btn-danger">
                                        <i class="fa fa-trash m-right-xs"></i> Move to Trash </a>
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


