<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class vendors extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model("membership_model");
		$this->load->model("countries_model");
		$this->load->model("vendors_model");
	}

	public function index(){
		// determines whether the user has logged in or not.
		if(!$this->session->userdata("user_id")){
			return redirect("auth");
		}else{
			$vendors = $this->vendors_model->get();
			$user = $this->membership_model->get_authenticated_user_by_id($this->session->userdata("user_id"));
			$this->load->view('vendors/index',['user' => $user, 'vendors' => $vendors]);
		}
	}

    public function create(){
        // determines whether the user has logged in or not.
		if(!$this->session->userdata("user_id")){
			return redirect("auth");
		}else{
			$countries = $this->countries_model->get_countries();
			$user = $this->membership_model->get_authenticated_user_by_id($this->session->userdata("user_id"));
			$this->load->view('vendors/create', ['user' => $user, 'countries' => $countries]);
        }
    }

	public function add(){
		// determines whether the user has logged in or not.
		if(!$this->session->userdata("user_id")){
			return redirect("auth");
		}else{
			$this->form_validation->set_rules("name", "name", "required");
			$this->form_validation->set_rules("country_id", "country", "required");
			$this->form_validation->set_rules("city", "city", "required");
			$this->form_validation->set_rules("email", "email", "required|valid_email");
			$this->form_validation->set_rules("phone", "phone", "required|numeric");

			$config['upload_path'] = './assets/images';
            $config['allowed_types'] = 'jpg|gif|png|jpeg';

            $this->load->library('upload', $config);

			if($this->form_validation->run()){
				$data = $this->input->post();
				if($this->upload->do_upload('image_url')){
					$upload_info = $this->upload->data();
					$path = base_url('assets/images/'.$upload_info['raw_name'].$upload_info['file_ext']);
					$data['image_url'] = $path;
				}
				unset($data['submit']);
				if($this->vendors_model->save($data)){
					$this->session->set_flashdata("successful_registration", "Vendor successfully added.");
				}else{
					$this->session->set_flashdata("failed_registration", "Vendor registration failed. Please try again later.");
				}
				return redirect("vendors");
			}else{
				$countries = $this->countries_model->get_countries();
				$user = $this->membership_model->get_authenticated_user_by_id($this->session->userdata("user_id"));
				$this->load->view('vendors/create', ['user' => $user, 'countries' => $countries]);
			}
        }
	}

	public function details($vendor_id){
		// determines whether the user has logged in or not.
		if(!$this->session->userdata("user_id")){
			return redirect("auth");
		}else{
			$vendor_details = $this->vendors_model->get_details($vendor_id);
			$user = $this->membership_model->get_authenticated_user_by_id($this->session->userdata("user_id"));
			$this->load->view('vendors/details', ['user' => $user, 'vendor_details' => $vendor_details]);
        }
	}

	public function change($vendor_id){
		// determines whether the user has logged in or not.
		if(!$this->session->userdata("user_id")){
			return redirect("auth");
		}else{
			$vendor = $this->vendors_model->get_details($vendor_id);
			$user = $this->membership_model->get_authenticated_user_by_id($this->session->userdata("user_id"));
			$countries = $this->countries_model->get_countries();
			$this->load->view('vendors/edit', [
				'user' => $user, 
				'vendor' => $vendor, 
				'countries' => $countries
			]);
		}
	}

	public function update($vendor_id){
		if(!$this->session->userdata("user_id")){
			return redirect("auth");
		}else{
			$this->form_validation->set_rules("name", "name", "required");
			$this->form_validation->set_rules("country_id", "country", "required");
			$this->form_validation->set_rules("city", "city", "required");
			$this->form_validation->set_rules("email", "email", "required|valid_email");
			$this->form_validation->set_rules("phone", "phone", "required|numeric");

			$config['upload_path'] = './assets/images';
            $config['allowed_types'] = 'jpg|gif|png|jpeg';

            $this->load->library('upload', $config);

			if($this->form_validation->run()){
				$data = $this->input->post();
				if($this->upload->do_upload('image_url')){
					$upload_info = $this->upload->data();
					$path = base_url('assets/images/'.$upload_info['raw_name'].$upload_info['file_ext']);
					$data['image_url'] = $path;
				}
				unset($data['submit']);
				if($this->vendors_model->update($data, $vendor_id)){
					$this->session->set_flashdata("successful_update", "Vendor successfully updated.");
				}else{
					$this->session->set_flashdata("failed_update", "Vendor update failed. Please try again later.");
				}
				return redirect("vendors");
			}else{
				$vendor = $this->vendors_model->get_details($vendor_id);
				$user = $this->membership_model->get_authenticated_user_by_id($this->session->userdata("user_id"));
				$countries = $this->countries_model->get_countries();
				$this->load->view('vendors/edit', [
					'user' => $user, 
					'vendor' => $vendor, 
					'countries' => $countries
				]);
			}
		}
	}

	public function move_to_trash($vendor_id){
		if(!$this->session->userdata("user_id")){
			return redirect("auth");
		}else{
			$data['is_canceled'] = 1;
			if($this->vendors_model->move_to_trash($vendor_id, $data)){
				$this->session->set_flashdata("successful_cancel", "Vendor moved to the recycle bin.");
			}else{
				$this->session->set_flashdata("failed_cancel", "Moving vendor to the recycle bin failed. Please try again later.");
			}
			return redirect("vendors");
		}
	}

	public function recycle_bin(){
		// determines whether the user has logged in or not.
		if(!$this->session->userdata("user_id")){
			return redirect("auth");
		}else{
			$deleted_vendors = $this->vendors_model->get_deleted();
			$user = $this->membership_model->get_authenticated_user_by_id($this->session->userdata("user_id"));
			$this->load->view('vendors/recycle_bin',['user' => $user, 'deleted_vendors' => $deleted_vendors]);
		}
	}

	public function restore($vendor_id){
		if(!$this->session->userdata("user_id")){
			return redirect("auth");
		}else{
			$data['is_canceled'] = 0;
			if($this->vendors_model->restore($vendor_id, $data)){
				$this->session->set_flashdata("successful_restore", "Vendor successfully restored.");
			}else{
				$this->session->set_flashdata("failed_restore", "Restoring vendor failed. Please try again later.");
			}
			return redirect("vendors/recycle_bin");
		}
	}

	public function delete($vendor_id){
		if(!$this->session->userdata("user_id")){
			return redirect("auth");
		}else{
			if($this->vendors_model->delete($vendor_id)){
				$this->session->set_flashdata("successful_delete", "Vendor deleted permanently.");
			}else{
				$this->session->set_flashdata("failed_delete", "Permanent deleting of vendor failed. Please try again later.");
			}
			return redirect("vendors/recycle_bin");
		}
	}
}
