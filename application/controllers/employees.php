<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class employees extends CI_Controller{
    public function __construct(){
		parent::__construct();
		$this->load->model("membership_model");
        $this->load->model("employees_model");
        $this->load->model("designations_model");
        $this->load->model("departments_model");
    }
    
    public function index(){
        if(!$this->session->userdata("user_id")){
            return redirect("auth");
        }else{
            $employees = $this->employees_model->get_all_employees();
            $user = $this->membership_model->get_authenticated_user_by_id($this->session->userdata("user_id"));
			$this->load->view('employees/index', ['user' => $user, 'employees' => $employees]);
        }
    }

    public function create(){
        // determines whether the user has logged in or not.
		if(!$this->session->userdata("user_id")){
			return redirect("auth");
		}else{
            $designations = $this->designations_model->get_all_designations();
            $departments = $this->departments_model->get_all_departments();
			$user = $this->membership_model->get_authenticated_user_by_id($this->session->userdata("user_id"));
			$this->load->view('employees/create', ['user' => $user, 'designations' => $designations, 'departments' => $departments]);
        }
    }

	public function add(){
		// determines whether the user has logged in or not.
		if(!$this->session->userdata("user_id")){
			return redirect("auth");
		}else{
			$this->form_validation->set_rules("name", "name", "required");
			$this->form_validation->set_rules("designation_id", "Designation", "required");
			$this->form_validation->set_rules("department_id", "Department", "required");
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
				if($this->employees_model->save($data)){
					$this->session->set_flashdata("successful_registration", "employee successfully added.");
				}else{
					$this->session->set_flashdata("failed_registration", "employee registration failed. Please try again later.");
				}
				return redirect("employees");
			}else{
				$designations = $this->designations_model->get_all_designations();
                $departments = $this->departments_model->get_all_departments();
                $user = $this->membership_model->get_authenticated_user_by_id($this->session->userdata("user_id"));
                $this->load->view('employees/create', ['user' => $user, 'designations' => $designations, 'departments' => $departments]);
			}
        }
	}

	public function change($employee_id){
		// determines whether the user has logged in or not.
		if(!$this->session->userdata("user_id")){
			return redirect("auth");
		}else{
            $designations = $this->designations_model->get_all_designations();
            $departments = $this->departments_model->get_all_departments();
            $employee = $this->employees_model->get_employee($employee_id);
            $user = $this->membership_model->get_authenticated_user_by_id($this->session->userdata("user_id"));
            $this->load->view('employees/edit', ['user' => $user, 'designations' => $designations, 'departments' => $departments, 'employee' => $employee]);
		}
	}

	public function update($employee_id){
		if(!$this->session->userdata("user_id")){
			return redirect("auth");
		}else{
			$this->form_validation->set_rules("name", "name", "required");
			$this->form_validation->set_rules("designation_id", "Designation", "required");
			$this->form_validation->set_rules("department_id", "Department", "required");
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
				if($this->employees_model->update($data, $employee_id)){
					$this->session->set_flashdata("successful_update", "Employee successfully updated.");
				}else{
					$this->session->set_flashdata("failed_update", "Updating employee failed. Please try again later.");
				}
				return redirect("employees");
			}else{
				$designations = $this->designations_model->get_all_designations();
                    $departments = $this->departments_model->get_all_departments();
                    $employee = $this->employees_model->get_employee($employee_id);
                    $user = $this->membership_model->get_authenticated_user_by_id($this->session->userdata("user_id"));
                    $this->load->view('employees/edit', ['user' => $user, 'designations' => $designations, 'departments' => $departments, 'employee' => $employee]);
			}
        }
	}

	public function move_to_trash($employee_id){
		if(!$this->session->userdata("user_id")){
			return redirect("auth");
		}else{
			$data['is_canceled'] = 1;
			if($this->employees_model->move_to_trash($employee_id, $data)){
				$this->session->set_flashdata("successful_cancel", "employee moved to the recycle bin.");
			}else{
				$this->session->set_flashdata("failed_cancel", "Moving employee to the recycle bin failed. Please try again later.");
			}
			return redirect("employees");
		}
	}

	public function recycle_bin(){
		// determines whether the user has logged in or not.
		if(!$this->session->userdata("user_id")){
			return redirect("auth");
		}else{
			$deleted_employees = $this->employees_model->get_deleted_employees();
            $user = $this->membership_model->get_authenticated_user_by_id($this->session->userdata("user_id"));
			$this->load->view('employees/recycle_bin', ['user' => $user, 'deleted_employees' => $deleted_employees]);
		}
	}

	public function restore($employee_id){
		if(!$this->session->userdata("user_id")){
			return redirect("auth");
		}else{
			$data['is_canceled'] = 0;
			if($this->employees_model->restore($employee_id, $data)){
				$this->session->set_flashdata("successful_restore", "employee successfully restored.");
			}else{
				$this->session->set_flashdata("failed_restore", "Restoring employee failed. Please try again later.");
			}
			return redirect("employees/recycle_bin");
		}
	}

	public function delete($employee_id){
		if(!$this->session->userdata("user_id")){
			return redirect("auth");
		}else{
			if($this->employees_model->delete($employee_id)){
				$this->session->set_flashdata("successful_delete", "employee deleted permanently.");
			}else{
				$this->session->set_flashdata("failed_delete", "Permanent deleting of employee failed. Please try again later.");
			}
			return redirect("employees/recycle_bin");
		}
	}
}