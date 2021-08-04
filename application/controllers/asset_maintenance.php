<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    
class asset_maintenance extends CI_Controller{
    
    public function __construct(){
		parent::__construct();
		$this->load->model('membership_model');
        $this->load->model('assets_model');
        $this->load->model('asset_categories_model');
        $this->load->model('vendors_model');
        $this->load->model('asset_possesions_model');
        $this->load->model('asset_maintenance_model');
        $this->load->model('asset_depreciation_schedule_model');
    }
    
    public function save($asset_id){
        if(!$this->session->userdata('user_id')){
            return redirect("auth");
        }else{
            $data = $this->input->post();
            $data['asset_id'] = $asset_id;
            unset($data['submit']);
            if($this->asset_maintenance_model->save($data)){
                $this->session->set_flashdata("successful_save", "Maintenance record successfully added."); 
            }else{
                $this->session->set_flashdata("successful_save", "Failed to add maintenance record."); 
            }
            return redirect("asset/details/$asset_id");
        }
    }
}