<!-- page header -->
<?php $this->load->view("Layouts/header.php"); ?>
<!-- /page header -->
<!-- page sidebar -->
<?php $this->load->view("Layouts/sidebar.php"); ?>
<!-- /page sidebar -->
<!-- page navigation -->
<?php $this->load->view("Layouts/navigation.php"); ?>
<!-- /page navigation -->

<style>
    .date{
        background: #f1a636;
        color: white; 
        text-align: center;
        width: 80px;
        -ms-border-radius: 4px;
        border-radius: 4px;
        margin-top: 7px;
    }

    .month{
        text-transform: uppercase; 
        font-size: 12px; 
        font-weight: bold;
        padding: 2px 6px;
        font-weight: 400;
    }

    .day{
        background: #e6e6e6;
        color: #333; 
        font-size: 30px;
        font-weight: 400; 
        padding: 6px 12px;
    }
</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Asset details</h2>
                    <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                            <?php if($asset->image_url): ?>
                                <div class="profile_img">
                                    <div id="crop-avatar">
                                        <!-- Current avatar -->
                                        <img class="img-responsive avatar-view" src="<?php echo $asset->image_url; ?>" alt="Avatar">
                                    </div>
                                </div>
                            <?php endif; ?>
                            <h4 style="color: black;"><b><?php echo $asset->name; ?></b></h4>
                            <small class="btn btn-xs btn-default"><?php echo $asset->unicode; ?></small>
                            <?php if($asset->is_disposed == 0): ?>
                            <br>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target=".bs-example-modal1">Dispose asset</button>
                            <?php endif; ?>
                            <ul class="list-unstyled user_data">
                                <br>
                                <li>
                                    <h4>Asset type</h4>
                                    <p style="color:black;"><?php echo $asset->category_name; ?></p> 
                                </li>    
                                <li>
                                    <h4>Vendor</h4>
                                    <p style="color:black;"><?php echo $asset->vendor_name; ?> </p>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <div class="profile_content">
                                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                    <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                        <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Accounting </a>
                                        </li>
                                        <?php if($asset->is_disposed == 0): ?>
                                        <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Possession</a>
                                        </li>
                                        <?php endif; ?>
                                        <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Repairs & maintenance</a>
                                        </li>
                                    </ul>
                                    <div id="myTabContent" class="tab-content">
                                    <?php if($asset->is_disposed == 0): ?>
                                        <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                                            <div class="col-md-3 col-sm-3 col-xs-12">
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-sm-12 col-xs-12" style="background-color: #f9f9f9;">
                                                <div class="col-md-3 col-sm-3 col-xs-12">
                                                    <ul class="list-unstyled user_data">
                                                        <br />
                                                        <li>
                                                            <p>Date of acquisition</p>
                                                            <div class="date">
                                                                <div class="month">
                                                                    <?php echo date_format(date_create($asset->date_of_acquisition), "F Y"); ?>   
                                                                </div>
                                                                <div class="day">
                                                                    <?php echo date_format(date_create($asset->date_of_acquisition), "d"); ?>   
                                                                </div>
                                                            </div> 
                                                        </li>
                                                        
                                                    </ul>
                                                </div>
                                                <div class="col-md-4 col-sm-5 col-xs-12">
                                                <ul class="list-unstyled user_data">
                                                    <br>
                                                    <li>
                                                        <p>Acquisition cost</p>
                                                        <h2 style="color:#6dd000;"><b><?php echo number_format(($original_price), 2, '.', ''); ?></b> <small> br</small></h2>
                                                    </li>
                                                    <br>
                                                    <li>
                                                        <p>Depreciation rate</p>
                                                        <h2 style="color:black;"><?php echo $depreciation_percent/100; ?></h2>
                                                    </li>
                                                    <br>
                                                    <li>
                                                        <p>Daily depreciation charge</p>
                                                        <h2 class="btn btn-danger btn-xs"><?php echo number_format($daily_depreciation_charge,2, '.', ''); ?> br</h2>
                                                    </li>
                                                </div>
                                                <div class="col-md-5 col-sm-7 col-xs-12">
                                                    <ul class="list-unstyled user_data">
                                                        <br>
                                                        <li>
                                                            <p>Book value</p>
                                                            <b><h1 style="color:black;">
                                                                <i class="fa fa-caret-down text-danger"></i> 
                                                                <?php 
                                                                    if($book_value <= 0.0){
                                                                        ?><span class="text-danger"><?php echo number_format($book_value, 2, '.', '');?></span>
                                                                    <?php 
                                                                    }else{
                                                                        echo number_format($book_value, 2, '.', '');
                                                                    }
                                                                ?> 
                                                                <small> br</small> 
                                                            </b></h1>
                                                        </li>
                                                        <br>
                                                        <li>
                                                            <p>Depreciation expense</p>
                                                            <?php $depreciation_expense = $original_price - $book_value; ?>
                                                            <h3 style="color:black;"><i class="fa fa-minus"></i> <?php echo number_format($depreciation_expense, 2, '.', ''); ?><small> br</small> </h3>
                                                        </li>
                                                        <li>
                                                            <p class="btn btn-xs btn-default"><?php echo $days_difference; ?> days worked</p>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <br>
                                                <br>
                                                <?php 
                                                    if($failed_download = $this->session->flashdata('failed_download')){
                                                        echo "<div class='alert alert-dismissible alert-danger'>";
                                                        echo $failed_download;
                                                        echo "</div>";
                                                    }
                                                ?>
                                                <?php echo form_open("asset_depreciation_schedule/download"); ?>
                                                    <?php echo form_hidden("asset_id", $asset->asset_id); ?>
                                                    <?php echo form_hidden("book_value", $book_value); ?>
                                                    <?php echo form_hidden("depreciation_expense", $depreciation_expense); ?>
                                                    <?php echo form_hidden("date", date("Y-m-d")); ?>
                                                    <?php echo form_error("date", "<p class='text-danger'>", "</p>"); ?>
                                                    <?php echo form_submit(['value' => 'Syncronize today\'s data', 'class' => 'btn btn-default']); ?> 
                                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target=".bs-example-modal">Add maintenance cost</button>
                                                    <a href='<?php echo base_url("asset_depreciation_schedule/single_report/$asset->asset_id"); ?>' class="btn btn-link pull-right"><u>Take me to report</u></a>
                                                <?php echo form_close(); ?>
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
                                                <div class="modal fade bs-example-modal" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog modal-md">
                                                        <div class="modal-content">

                                                            <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                                                            </button>
                                                            <h4 class="modal-title" id="myModalLabel2">Maintenance record</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <?php echo form_open("asset_maintenance/save/$asset->asset_id"); ?>
                                                                <div class="form-group">
                                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                                        <label class="control-label">Name <span class="text-danger">*</span></label>
                                                                        <?php 
                                                                            echo form_input([
                                                                                'name' => 'name', 
                                                                                'class' => 'form-control input-md', 
                                                                                'placeholder' => 'Name of maintenance', 
                                                                                'value' => set_value('name'), 
                                                                                "required" => "required"
                                                                            ]); 
                                                                        ?>
                                                                        <?php echo form_error("name", "<p class='text-danger'>", "</p>"); ?>
                                                                    </div>
                                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                                        <label class="control-label">Date <span class="text-danger">*</span></label>
                                                                        <?php 
                                                                            echo form_input([
                                                                                'name' => 'date', 
                                                                                'class' => 'form-control input-md', 
                                                                                'placeholder' => 'Date of maintenance', 
                                                                                'value' => set_value('date'), 
                                                                                "required" => "required", 
                                                                                "id" => "datepicker"
                                                                            ]); 
                                                                        ?>
                                                                        <?php echo form_error("date", "<p class='text-danger'>", "</p>"); ?>
                                                                    </div>
                                                                </div>
                                                                <br><br><br><br>
                                                                <div class="form-group">
                                                                    
                                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                                        <label class="control-label">Cost <span class="text-danger">*</span></label>
                                                                        <?php 
                                                                            echo form_input([
                                                                                'name' => 'cost', 
                                                                                'class' => 'form-control input-md', 
                                                                                'placeholder' => 'Cost of maintenance', 
                                                                                'value' => set_value('cost'), 
                                                                                "required" => "required"
                                                                            ]); 
                                                                        ?>
                                                                        <?php echo form_error("cost", "<p class='text-danger'>", "</p>"); ?>
                                                                    </div>
                                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                                        <label class="control-label">Description</label>
                                                                        <?php 
                                                                            echo form_textarea([
                                                                                'name' => 'description', 
                                                                                'class' => 'form-control input-md', 
                                                                                'placeholder' => 'Description of maintenance', 
                                                                                'value' => set_value('description'), 
                                                                                'rows' => '4',
                                                                            ]); 
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <?php echo form_submit(['value' => 'Save', 'class' => 'btn btn-md btn-success']); ?>
                                                                <button type="button" class="btn btn-default btn-md" data-dismiss="modal">Close</button>
                                                            </div>
                                                        <?php echo form_close(); ?>
                                                    </div>
                                                </div>
                                            </div>  
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <br />
                                            <?php if($asset_depreciation_schedule): ?>
                                                <table id="datatable" class="table table-striped table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th>Date</th>
                                                        <th>Book value</th>
                                                        <th>Depreciation expense</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach($asset_depreciation_schedule as $row): ?>
                                                            <tr>
                                                                <td><?php echo date_format(date_create($row->date), "F d, Y"); ?></td>
                                                                <td><?php echo number_format($row->book_value, 2, '.', ''); ?> br</td>
                                                                <td><?php echo number_format($row->depreciation_expense, 2, '.', ''); ?> br</td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            <?php else: ?>
                                                <h4 class="text-danger">No data available</h4>
                                            <?php endif; ?>
                                        </div>
                                        </div>
                                        <?php else: ?>
                                        <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                                            <div class="col-md-3 col-sm-3 col-xs-12">
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-sm-12 col-xs-12" style="background-color: #f9f9f9;">
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <p class="alert alert-info"><i class="fa fa-info-circle"></i> Asset <b><u>disposed</u></b>, no further actions available. </p>
                                                </div> 
                                                <div class="col-md-4 col-sm-4 col-xs-12">
                                                <ul class="list-unstyled user_data">
                                                    <br>
                                                    <li>
                                                        <p>Acquisition cost</p>
                                                        <h2 style="color:#111;"><?php echo number_format(($original_price), 2, '.', ''); ?> <small> br</small></h2>
                                                    </li>
                                                    <br>
                                                    <li>
                                                        <p>Last book value</p>
                                                        <h2 style="color:#111;"><?php echo number_format(($book_value), 2, '.', ''); ?> <small> br</small></h2>
                                                    </li>
                                                </div>
                                                <div class="col-md-8 col-sm-8 col-xs-12">
                                                    <ul class="list-unstyled user_data">
                                                        <br>
                                                        <li>
                                                            <p>Asset disposed for</p>
                                                            <b><h1 style="color:black;">
                                                                <?php 
                                                                    echo number_format($disposed_price, 2, '.', '');
                                                                ?> 
                                                                <small> br</small> 
                                                            </b></h1>
                                                        </li>
                                                        <br>
                                                        <li>
                                                            <?php $loss_gain = $disposed_price - $book_value; ?>
                                                            <?php if($loss_gain > 0): ?>
                                                            <p>Total gain</p>
                                                            <h3 style="color:#6dd000;"> <?php echo number_format($loss_gain, 2, '.', ''); ?><small> br</small> </h3>
                                                            <?php else: ?>
                                                            <p>Total loss</p>
                                                            <h3 style="color:red;"> <?php echo number_format($loss_gain, 2, '.', ''); ?><small> br</small> </h3>
                                                            <?php endif; ?>
                                                        </li>
                                                        <li>
                                                            <p class="btn btn-xs btn-default"><?php echo $days_difference; ?> days worked</p>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                             
                                        </div>
                                        <?php endif; ?>

                                        <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                                                <?php if($asset_possessions): ?>
                                                    <?php foreach ($asset_possessions as $row): ?>
                                                        <div class="col-md-6 col-sm-6 col-xs-12 profile_details">
                                                            <div class="well profile_view">
                                                            <div class="col-sm-12">
                                                                <h2><?php echo $row->employee_name; ?></h2>
                                                                <div class="left col-xs-7">
                                                                <h4 class="brief"><?php echo $row->designation_name; ?> at <?php echo $row->department_name; ?> department</h4>
                                                                <br>
                                                                <ul class="list-unstyled">
                                                                    <li><i class="fa fa-phone"></i> <?php echo $row->phone; ?> </li>
                                                                    <li><i class="fa fa-envelope"></i> <?php echo $row->email; ?> </li>
                                                                </ul>
                                                                </div>
                                                                <div class="right col-xs-5 text-center">
                                                                <?php if($row->employee_image): ?>
                                                                    <div class="profile_img">
                                                                        <div id="crop-avatar">
                                                                            <!-- Current avatar -->
                                                                            <img src="<?php echo $row->employee_image; ?>" alt="" class="img-circle img-responsive">
                                                                        </div>
                                                                    </div>
                                                                <?php endif; ?>
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-12 bottom text-center">
                                                                <div class="col-xs-12 col-sm-6 emphasis">
                                                                </div>
                                                                <div class="col-xs-12 col-sm-6 emphasis">
                                                                <a href='<?php echo base_url("asset_possesions/remove_single_assignment/$asset->asset_id/$row->employee_id") ?>' class="btn btn-danger btn-xs">
                                                                    <i class="fa fa-close"> </i> Remove possession
                                                                </a>
                                                                </div>
                                                            </div>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <h2 class="text-danger">No data available</h2>
                                                <?php endif; ?>
                                            <!-- end user projects -->
                                        </div>
                                        <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                                            <?php if($maintenance_record): ?>
                                                <table id="datatable" class="table table-striped table-bordered table-responsive">
                                                    <thead>
                                                    <tr>
                                                        <th>Unicode</th>
                                                        <th>Date</th>
                                                        <th>Name</th>
                                                        <th>Description</th>
                                                        <th>Cost</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach($maintenance_record as $row): ?>
                                                            <tr>
                                                                <td><?php echo $row->maintenance_id; ?></t>
                                                                <td><?php echo date_format(date_create($row->date), "F d, Y"); ?></td>
                                                                <td><?php echo $row->name; ?></td>
                                                                <td><?php echo $row->description; ?></td>
                                                                <td><?php echo number_format($row->cost, 2, '.', ''); ?> br</td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            <?php else: ?>
                                                <h4 class="text-danger">No data available</h4>
                                            <?php endif; ?>
                                        </div>

                                        <div class="modal fade bs-example-modal1" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-sm">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                                                    </button>
                                                    <h4 class="modal-title" id="myModalLabel2">Dispose asset</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                    <?php echo form_open("asset/dispose/$asset->asset_id"); ?>
                                                        <div class="form-group">
                                                            <label class="control-label">Price <span class="text-danger">*</span></label>
                                                            <?php 
                                                                echo form_input([
                                                                    'name' => 'disposed_price', 
                                                                    'class' => 'form-control input-sm', 
                                                                    'placeholder' => 'Price of disposal', 
                                                                    "required" => "required"
                                                                ]); 
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <?php echo form_submit(['value' => 'Dispose', 'class' => 'btn btn-sm btn-primary']); ?>
                                                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                                                    </div>
                                                <?php echo form_close(); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->
<!-- page footer -->
<?php $this->load->view("Layouts/footer.php"); ?>
<!-- /page footer -->


