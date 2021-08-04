<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    
class asset_possesions extends CI_Controller{
    
    public function __construct(){
        parent::__construct();
        $this->load->model("membership_model");
        $this->load->model("assets_model");
        $this->load->model("employees_model");
        $this->load->model("asset_possesions_model");
	}

    public function index(){
        if(!$this->session->userdata('user_id')){
            return redirect("auth");
        }else{
            $user = $this->membership_model->get_authenticated_user_by_id($this->session->userdata("user_id"));
            $assets = $this->assets_model->get();
            $this->load->view("asset_possesions/index", ['user' => $user, 'assets' => $assets]);
        }
    }

    public function employee($asset_id){
        if(!$this->session->userdata('user_id')){
            return redirect("auth");
        }else{
            $user = $this->membership_model->get_authenticated_user_by_id($this->session->userdata("user_id"));
            $employees = $this->employees_model->get_all_employees();
            $this->load->view("asset_possesions/assign_to_employee", ['user' => $user, 'employees' => $employees, 'asset_id' => $asset_id]);
        }
    }

    public function assign_to_employees($asset_id, $employee_id){
        if(!$this->session->userdata('user_id')){
            return redirect("auth");
        }else{
            $data['asset_id'] = $asset_id; 
            $data['employee_id'] = $employee_id;
            if($this->asset_possesions_model->save($data)){
                $this->session->set_flashdata("successful_save", "Asset assigned successfully");
            }else{
                $this->session->set_flashdata("failed_save", "Assigning an asset failed");
            }
            return redirect("asset_possesions/employee/$asset_id");
        }
    }

    public function remove_assignments($asset_id){
        if(!$this->session->userdata('user_id')){
            return redirect("auth");
        }else{
            if($this->asset_possesions_model->remove($asset_id)){
                $this->session->set_flashdata("successful_removal", "Asset assignment removed successfully");
            }else{
                $this->session->set_flashdata("failed_removal", "Removing asset assignment failed");
            }
            return redirect("asset_possesions/index");
        }
    }

    public function remove_single_assignment($asset_id, $employee_id){
        if(!$this->session->userdata('user_id')){
            return redirect("auth");
        }else{
            $this->asset_possesions_model->remove_single_assignment($asset_id, $employee_id);
            return redirect("asset/details/$asset_id");
        }
    }
}