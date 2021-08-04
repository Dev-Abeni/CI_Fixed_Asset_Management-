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
                <h2>Assets</h2>
                &nbsp;
                <a href="<?php echo base_url('asset/create'); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Add new asset</a>
                <a href="<?php echo base_url('asset/recycle_bin'); ?>" class="btn btn-warning btn-sm"><i class="fa fa-trash"></i> Recycle bin</a>
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
                    }elseif($successful_restore = $this->session->flashdata('successful_restore')){
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
                <?php if($assets): ?>
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Image</th>
                            <th>Unicode</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php foreach($assets as $row): ?>
                                <tr>
                                    <td>
                                        <?php if($row->image_url): ?>
                                            <div class="profile_pic">
                                                <img src="<?php echo $row->image_url; ?>" alt="..." width="50px" heigh="50px">
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo $row->unicode; ?></a></td>
                                    <td><a href='<?php echo base_url("asset/details/$row->asset_id"); ?>'><u><?php echo $row->name; ?></u></a></td>
                                    <td><?php echo $row->category_name; ?></td>
                                    <td><?php echo number_format(($row->original_price), 2, '.', ''); ?> br</td>
                                    <td>
                                        <a href='<?php echo base_url("asset/change/$row->asset_id"); ?>' class="btn btn-success btn-sm">
                                        <i class="fa fa-pencil"></i> Edit</a>
                                        <a href='<?php echo base_url("asset/move_to_trash/$row->asset_id"); ?>' class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash"></i> Move to Trash</a>
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


