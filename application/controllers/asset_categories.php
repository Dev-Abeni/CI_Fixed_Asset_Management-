<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    
class asset_categories extends CI_Controller{
    
    public function __construct(){
		parent::__construct();
		$this->load->model('membership_model');
        $this->load->model('asset_categories_model');
	}

    public function index(){
        if(!$this->session->userdata('user_id')){
            return redirect("auth");
        }else{
            $user = $this->membership_model->get_authenticated_user_by_id($this->session->userdata("user_id"));
            $asset_categories = $this->asset_categories_model->get();
            $this->load->view("asset_categories/index", 
                [
                    'user' => $user, 
                    'asset_categories' => $asset_categories
                ]);
        }
    }

    public function create(){
        if(!$this->session->userdata('user_id')){
            return redirect("auth");
        }else{
            $user = $this->membership_model->get_authenticated_user_by_id($this->session->userdata("user_id"));
            $this->load->view("asset_categories/create", ['user' => $user]);
        }
    }

    public function add(){
        if(!$this->session->userdata('user_id')){
            return redirect("auth");
        }else{
            $this->form_validation->set_rules('name', 'name', 'required');
            $this->form_validation->set_rules('depreciation_percent', 'depreciation percent', 'required');
            if($this->form_validation->run()){
                $data = $this->input->post();
                unset($data['submit']);

                if($this->asset_categories_model->save($data)){
                    $this->session->set_flashdata("successful_save", "Category saved successfully");
                }else{
                    $this->session->set_flashdata("failed_save", "Saving category failed");
                }
                return redirect("asset_categories/index");
            }else{
                $user = $this->membership_model->get_authenticated_user_by_id($this->session->userdata("user_id"));
                $this->load->view("asset_categories/create", ['user' => $user]);
            }
        }
    }

    public function change($category_id){
        if(!$this->session->userdata('user_id')){
            return redirect("auth");
        }else{
            $user = $this->membership_model->get_authenticated_user_by_id($this->session->userdata("user_id"));
            $category = $this->asset_categories_model->get_category($category_id);
            $this->load->view("asset_categories/update", ['user' => $user, 'category' => $category]);
        }
    }

    public function update($category_id){
        if(!$this->session->userdata('user_id')){
            return redirect("auth");
        }else{
            $this->form_validation->set_rules('name', 'name', 'required');
            $this->form_validation->set_rules('depreciation_percent', 'depreciation percent', 'required');
            if($this->form_validation->run()){
                $data = $this->input->post();
                unset($data['submit']);

                if($this->asset_categories_model->update($category_id, $data)){
                    $this->session->set_flashdata("successful_update", "Category updated successfully.");
                }else{
                    $this->session->set_flashdata("failed_update", "Failed to save category");
                }

                return redirect("asset_categories/index");
            }else{
                $user = $this->membership_model->get_authenticated_user_by_id($this->session->userdata("user_id"));
                $category = $this->asset_categories_model->get_category($category_id);
                $this->load->view("asset_categories/update", ['user' => $user, 'category' => $category]);
            }
        }
    }

    public function delete($category_id){
        if(!$this->session->userdata('user_id')){
            return redirect("auth");
        }else{
            if($this->asset_categories_model->delete($category_id)){
                $this->session->set_flashdata("successful_delete", "Category deleted successfully");
            }else{
                $this->session->set_flashdata("failed_delete", "Failed to delete category");
            }

            return redirect("asset_categories/index");
        }
    }
}