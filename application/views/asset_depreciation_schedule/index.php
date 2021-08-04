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
                <h2>Asset depreciation expense</h2>
                &nbsp; 
                <a href='<?php echo base_url("asset_depreciation_schedule/report"); ?>' class="btn btn-primary btn-sm">
                    <i class="fa fa-print"></i> Print everything
                </a>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <?php if($asset_depreciation_schedule): ?>
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Unicode</th>
                            <th>Name</th>
                            <th>Acquisition date</th>
                            <th>Acquisition cost</th>
                            <th>Rate</th>
                            <th>Book value</th>
                            <th>Depreciation expense</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php foreach($asset_depreciation_schedule as $row): ?>
                                <tr>
                                    <td><?php echo date_format(date_create($row->date), "F d, Y"); ?></td>
                                    <td><?php echo $row->unicode; ?></td>
                                    <td><u><b><a href='<?php echo base_url("asset_depreciation_schedule/single_report/$row->asset_id"); ?>'><?php echo $row->name; ?></a></b></u></td>
                                    <td><?php echo date_format(date_create($row->date_of_acquisition), "F d, Y"); ?></td>
                                    <td><?php echo number_format(($row->original_price), 2, '.', ''); ?> br</td>
                                    <td><?php echo $row->depreciation_percent/100; ?></td>
                                    <td><?php echo number_format(($row->book_value), 2, '.', ''); ?> br</td>
                                    <td><?php echo number_format(($row->depreciation_expense), 2, '.', ''); ?> br</td>
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


