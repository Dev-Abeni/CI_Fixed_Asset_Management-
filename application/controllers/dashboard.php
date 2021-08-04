<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class dashboard extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('membership_model');
		$this->load->model('assets_model');
		$this->load->model('vendors_model');
		$this->load->model('employees_model');
		$this->load->model('departments_model');
        $this->load->model('asset_depreciation_schedule_model');
	}

	public function index()
	{
		// determines whether the user has logged in or not.
		if(!$this->session->userdata("user_id")){
			return redirect("auth");
		}else{
			$assets = $this->assets_model->get_number();
			$vendors = $this->vendors_model->get_number();
			$employees = $this->employees_model->get_number();
			$departments = $this->departments_model->get_number();
			$user = $this->membership_model->get_authenticated_user_by_id($this->session->userdata("user_id"));
            $asset_depreciation_schedule = $this->asset_depreciation_schedule_model->get_all_depreciation_schedule(); 
			$this->load->view('dashboard/dashboard',
			[
				'user' => $user, 
				'assets' => $assets, 
				'vendors' => $vendors, 
				'employees' => $employees, 
				'departments' => $departments, 
				'asset_depreciation_schedule' => $asset_depreciation_schedule
			]
			);
		}
	}
}
