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
                <h2>Designations</h2>
                &nbsp;
                <a href="<?php echo base_url('designations/create'); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Add new designation</a>
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
                <?php if($designations): ?>
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                            <tbody>
                                <?php foreach($designations as $row): ?>
                                    <tr>
                                        <td><?php echo $row->name; ?></a></td>
                                        <td>
                                            <a href='<?php echo base_url("designations/change/$row->designation_id"); ?>' class="btn btn-success btn-sm">
                                            <i class="fa fa-pencil"></i> Edit</a>
                                            <a href='<?php echo base_url("designations/delete/$row->designation_id"); ?>' class="btn btn-danger btn-sm">
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


