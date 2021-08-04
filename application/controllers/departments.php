<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class departments extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model("membership_model");
		$this->load->model("departments_model");
	}

    public function index(){
        if(!$this->session->userdata('user_id')){
            return redirect("auth");
        }else{
            $departments = $this->departments_model->get_all_departments();
            $user = $this->membership_model->get_authenticated_user_by_id($this->session->userdata("user_id"));
			$this->load->view('departments/index', ['user' => $user, 'departments' => $departments]);
        }
    }

    public function create(){
        if(!$this->session->userdata('user_id')){
            return redirect("auth");
        }else{
            $user = $this->membership_model->get_authenticated_user_by_id($this->session->userdata("user_id"));
			$this->load->view('departments/create', ['user' => $user]);
        }
    }
	
    public function add(){
        if(!$this->session->userdata('user_id')){
            return redirect("auth");
        }else{
            $this->form_validation->set_rules("name", "name", "required");
            if($this->form_validation->run()){
                $data = $this->input->post();
                unset($data['submit']);
                if($this->departments_model->save($data)){
                    $this->session->set_flashdata("successful_save", "Department saved successfully.");
                }else{
                    $this->session->set_flashdata("failed_save", "Saving department failed.");
                }
                return redirect("departments");
            }else{
                $user = $this->membership_model->get_authenticated_user_by_id($this->session->userdata("user_id"));
			    $this->load->view('departments/create', ['user' => $user]);
            }
        }
    }

    public function change($department_id){
        if(!$this->session->userdata('user_id')){
            return redirect("auth");
        }else{
            $department = $this->departments_model->get_department($department_id);
            $user = $this->membership_model->get_authenticated_user_by_id($this->session->userdata("user_id"));
			$this->load->view('departments/edit', ['user' => $user, 'department' => $department]);
        }
    }

    public function update($department_id){
        if(!$this->session->userdata('user_id')){
            return redirect("auth");
        }else{
            $this->form_validation->set_rules("name", "name", "required");

            if($this->form_validation->run() > 0){
                $data = $this->input->post();
                unset($data['submit']);
                if($this->departments_model->update($data, $department_id)){
                    $this->session->set_flashdata("successful_update", "Department successfully updated.");
                }else{
                    $this->session->set_flashdata("failed_update", "Updating department failed.");
                }
                return redirect("departments");
            }else{
                $department = $this->departments_model->get_department($department_id);
                $user = $this->membership_model->get_authenticated_user_by_id($this->session->userdata("user_id"));
			    $this->load->view('departments/edit', ['user' => $user, 'department' => $department]);
            }
        }
    }

    public function delete($department_id){
        if(!$this->session->userdata('user_id')){
            return redirect("auth");
        }else{
            if($this->departments_model->delete($department_id)){
                $this->session->set_flashdata("successful_delete", "Department deleted.");
            }else{
                $this->session->set_flashdata("failed_delete", "Deleting department failed.");
            }
            return redirect("departments");
        }
    }
}
