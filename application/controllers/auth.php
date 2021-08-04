<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class auth extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('membership_model');
	}

	public function index()
	{
		// determines whether the user has logged in or not.
		if($this->session->userdata("user_id")){
			return redirect("dashboard");
		}else{
			$this->load->view('auth/login');
		}
	}

	public function login(){
		$this->form_validation->set_rules('username', 'username', 'required');
		$this->form_validation->set_rules('password', 'password', 'required');

		if($this->form_validation->run() == FALSE){
			$this->load->view('auth/login');
		}else{
			$username = $this->input->post('username');
			$password = md5($this->input->post('password'));
			$user = $this->membership_model->get_authenticated_user($username, $password);
			if($user){
				if($user->is_canceled == 0){
					if($user->account_status == 1){
					$this->session->set_userdata(["user_id" => $user->user_id]);
					return redirect("dashboard");
					}else{
						$this->session->set_flashdata("inactive_account", "Account is not active.");
						return redirect("auth");
					}
				}else{
					$this->session->set_flashdata("user_removed", "Sorry this user has been removed from the system. Contact the admin");
					return redirect("auth");
				}
			}else{
				$this->session->set_flashdata("failed_login", "Incorrect username | password combination.");
				return redirect("auth");
			}
		}
	}

	public function logout(){
		$this->session->unset_userdata("user_id");
		return redirect("auth");
	}

	public function register(){
		$this->load->view("auth/register");
	}

	public function create_account(){
		$this->form_validation->set_rules("first_name", "first name", "required");
		$this->form_validation->set_rules("last_name", "last name", "required");
		$this->form_validation->set_rules("username", "username", "required|is_unique[auth_users.username]");
		$this->form_validation->set_rules("password", "password", "required");

		if(!$this->form_validation->run()){
			$this->load->view("auth/register");
		}else{
			$data = $this->input->post();
			$data['password'] = md5($this->input->post('password'));
			unset($data['submit']);
			if($this->membership_model->register($data)){
					$this->session->set_flashdata("successful_registration", "User registration successful. Please wait for the account to be activated.");
				}else{
					$this->session->set_flashdata("failed_registration", "User registration failed. Please try again later.");
			}
			return redirect("auth");
		}
	}

	public function change_password(){
		// determines whether the user has logged in or not.
		if(!$this->session->userdata("user_id")){
			return redirect("auth");
		}else{
			$user = $this->membership_model->get_authenticated_user_by_id($this->session->userdata("user_id"));
			$this->load->view('auth/change_password', ['user' => $user]);
		}
	}

	public function update_password(){
		if(!$this->session->userdata("user_id")){
			return redirect("auth");
		}else{
			$this->form_validation->set_rules('old_password', 'old password', 'required');
			$this->form_validation->set_rules('password', 'new password', 'required');
			if($this->form_validation->run()){
				$old_password = md5($this->input->post('old_password'));
				if($this->membership_model->compare_passwords($old_password)){
					$data['password'] = md5($this->input->post('password'));
					if($this->membership_model->change_password($data)){
						$this->session->set_flashdata("password_changed", "Password successfully changed.");
					}else{
						$this->session->set_flashdata("failed_password_change", "Password change failed.");
					}
					return redirect("auth/change_password");
				}else{
					$this->session->set_flashdata("incorrect_password", "Incorrect confirmation password.");
					return redirect("auth/change_password");
				}
			}else{
				$user = $this->membership_model->get_authenticated_user_by_id($this->session->userdata("user_id"));
				$this->load->view('auth/change_password',['user' => $user]);
			}
		}
	}

	public function users(){
		if(!$this->session->userdata("user_id")){
			return redirect("auth");
		}else{
			$user = $this->membership_model->get_authenticated_user_by_id($this->session->userdata("user_id"));
			$users = $this->membership_model->get_all_active_users();
			$this->load->view('auth/users',['user' => $user, 'users' => $users]);
		}
	}

	public function change_account_status($user_id, $account_status){
		if(!$this->session->userdata("user_id")){
			return redirect("auth");
		}else{
			if($account_status == 0){
			$data['account_status'] = 1;
			$this->membership_model->change_account_status($user_id, $data);
			}else{
				$data['account_status'] = 0;
				$this->membership_model->change_account_status($user_id, $data);
			}
			return redirect("auth/users");
		}
	}

	public function change_is_canceled($user_id, $is_canceled){
		if(!$this->session->userdata("user_id")){
			return redirect("auth");
		}else{
			if($is_canceled == 0){
			$data['is_canceled'] = 1;
			$this->membership_model->change_is_canceled($user_id, $data);
			return redirect("auth/users");
			}else{
				$data['is_canceled'] = 0;
				$this->membership_model->change_is_canceled($user_id, $data);
				return redirect("auth/recycle_bin");
			}
			
		}
	}

	public function recycle_bin(){
		if(!$this->session->userdata("user_id")){
			return redirect("auth");
		}else{
			$user = $this->membership_model->get_authenticated_user_by_id($this->session->userdata("user_id"));
			$trashed_users = $this->membership_model->get_all_trashed_users();
			$this->load->view('auth/recycle_bin',['user' => $user, 'trashed_users' => $trashed_users]);
		}
	}
	public function delete($user_id){
		if(!$this->session->userdata("user_id")){
			return redirect("auth");
		}else{
			if($this->membership_model->delete($user_id)){
				$this->session->set_flashdata("successful_delete", "User permanently deleted.");
			}else{
				$this->session->set_flashdata("failed_delete", "Deleting user failed. Try again later.");
			}
			return redirect("auth/recycle_bin");
		}
	}

	public function user_role($user_id){
		if(!$this->session->userdata("user_id")){
			return redirect("auth");
		}else{
			$user = $this->membership_model->get_authenticated_user_by_id($this->session->userdata("user_id"));
			$roles = $this->membership_model->get_roles();
			$this->load->view('auth/user_role',['user' => $user, 'user_id' => $user_id, 'roles' => $roles]);
		}
	}

	public function assign_role($user_id){
		if(!$this->session->userdata("user_id")){
			return redirect("auth");
		}else{
			$this->form_validation->set_rules('role_id', "Role", "required");

			if($this->form_validation->run()){
				$data['role_id'] = $this->input->post('role_id'); 
				if($this->membership_model->assign_role($user_id, $data)){
					$this->session->set_flashdata("successful_assignment", "User role updated.");
				}else{
					$this->session->set_flashdata("failed_assignment", "Failed to assign user role.");
				}
				return redirect("auth/users");

			}else{
				$user = $this->membership_model->get_authenticated_user_by_id($this->session->userdata("user_id"));
				$roles = $this->membership_model->get_roles();
				$this->load->view('auth/user_role',['user' => $user, 'user_id' => $user_id, 'roles' => $roles]);
			}
		}
	}
}
