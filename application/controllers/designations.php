<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class designations extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model("membership_model");
		$this->load->model("designations_model");
	}

    public function index(){
        if(!$this->session->userdata('user_id')){
            return redirect("auth");
        }else{
            $designations = $this->designations_model->get_all_designations();
            $user = $this->membership_model->get_authenticated_user_by_id($this->session->userdata("user_id"));
			$this->load->view('designations/index', ['user' => $user, 'designations' => $designations]);
        }
    }

    public function create(){
        if(!$this->session->userdata('user_id')){
            return redirect("auth");
        }else{
            $user = $this->membership_model->get_authenticated_user_by_id($this->session->userdata("user_id"));
			$this->load->view('designations/create', ['user' => $user]);
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
                if($this->designations_model->save($data)){
                    $this->session->set_flashdata("successful_save", "designation saved successfully.");
                }else{
                    $this->session->set_flashdata("failed_save", "Saving designation failed.");
                }
                return redirect("designations");
            }else{
                $user = $this->membership_model->get_authenticated_user_by_id($this->session->userdata("user_id"));
			    $this->load->view('designations/create', ['user' => $user]);
            }
        }
    }

    public function change($designation_id){
        if(!$this->session->userdata('user_id')){
            return redirect("auth");
        }else{
            $designation = $this->designations_model->get_designation($designation_id);
            $user = $this->membership_model->get_authenticated_user_by_id($this->session->userdata("user_id"));
			$this->load->view('designations/edit', ['user' => $user, 'designation' => $designation]);
        }
    }

    public function update($designation_id){
        if(!$this->session->userdata('user_id')){
            return redirect("auth");
        }else{
            $this->form_validation->set_rules("name", "name", "required");

            if($this->form_validation->run() > 0){
                $data = $this->input->post();
                unset($data['submit']);
                if($this->designations_model->update($data, $designation_id)){
                    $this->session->set_flashdata("successful_update", "designation successfully updated.");
                }else{
                    $this->session->set_flashdata("failed_update", "Updating designation failed.");
                }
                return redirect("designations");
            }else{
                $designation = $this->designations_model->get_designation($designation_id);
                $user = $this->membership_model->get_authenticated_user_by_id($this->session->userdata("user_id"));
			    $this->load->view('designations/edit', ['user' => $user, 'designation' => $designation]);
            }
        }
    }

    public function delete($designation_id){
        if(!$this->session->userdata('user_id')){
            return redirect("auth");
        }else{
            if($this->designations_model->delete($designation_id)){
                $this->session->set_flashdata("successful_delete", "designation deleted.");
            }else{
                $this->session->set_flashdata("failed_delete", "Deleting designation failed.");
            }
            return redirect("designations");
        }
    }
}
