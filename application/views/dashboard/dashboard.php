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
    <h3>Dashboard</h3>
    <!-- top tiles -->
    <div class="tile_count">
    <div class="">
        <div class="row top_tiles">
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a href="<?php echo base_url("asset"); ?>">
                    <div class="tile-stats">
                        <div class="icon"><i class="fa fa-truck"></i></div>
                        <div class="count"><?php echo $assets; ?></div>
                        <br>
                        <h3>Assets</h3>
                    </div>
                </a>
            </div>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a href="<?php echo base_url("vendors"); ?>">
                    <div class="tile-stats">
                        <div class="icon"><i class="fa fa-exchange"></i></div>
                        <div class="count"><?php echo $vendors; ?></div>
                        <br>
                        <h3>Vendors</h3>
                    </div>
                </a>
            </div>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a href="<?php echo base_url("departments"); ?>">
                    <div class="tile-stats">
                        <div class="icon"><i class="fa fa-building"></i></div>
                        <div class="count"><?php echo $departments; ?></div>
                        <br>
                        <h3>Departments</h3>
                    </div>
                </a>
            </div>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a href="<?php echo base_url("employees"); ?>">
                    <div class="tile-stats">
                        <div class="icon"><i class="fa fa-user"></i></div>
                        <div class="count"><?php echo $employees; ?></div>
                        <br>
                        <h3>Employees</h3>
                    </div>
                </a>
            </div>
        </div>
        <br>
        <br>
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
    <!-- /top tiles -->
    
    </div>
</div>
<!-- /page content -->

<!-- page footer -->
<?php $this->load->view("Layouts/footer.php"); ?>
<!-- /page footer -->


