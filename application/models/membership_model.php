<?php
    class membership_model extends CI_Model{
        public function get_authenticated_user($username, $password){
            $result = $this->db->where(['username' => $username, 'password' => $password])
                                ->limit(1)
                                ->get('auth_users');

            if($result->num_rows() > 0){
                return $result->row();
            }
        }

        public function get_authenticated_user_by_id($user_id){
            $result = $this->db->where(['user_id' => $user_id])
                                ->limit(1)
                                ->get('auth_users');

            if($result->num_rows() > 0){
                return $result->row();
            }
        }

        public function get_all_active_users(){
            $result = $this->db->where(['is_canceled' => 0])
                               ->get('auth_users');

            if($result->num_rows() > 0){
                return $result->result();
            }
        }

        public function get_all_trashed_users(){
            $result = $this->db->where(['is_canceled' => 1])
                               ->get('auth_users');

            if($result->num_rows() > 0){
                return $result->result();
            }
        }

        public function register($data){
            return $this->db->insert('auth_users', $data);
        }

        public function compare_passwords($old_password){
            $result = $this->db->where(['password' => $old_password, 'user_id' => $this->session->userdata('user_id')])
                                      ->get('auth_users');

            if($result->num_rows() > 0){
                return TRUE;
            }else{
                return FALSE;
            }
        }

        public function change_password($data){
			return $this->db->where('user_id', $this->session->userdata('user_id'))
							->update('auth_users', $data);
		}

        public function change_account_status($user_id, $account_status){
            return $this->db->where('user_id', $user_id)
							->update('auth_users', $account_status);
        }

        public function change_is_canceled($user_id, $is_canceled){
            return $this->db->where('user_id', $user_id)
							->update('auth_users', $is_canceled);
        }

        public function delete($user_id){
            return $this->db->delete("auth_users", ['user_id' => $user_id]);
        }

        public function get_roles(){
            $result = $this->db->get('auth_roles');

            if($result->num_rows() > 0){
                return $result->result();
            }
        }

        public function assign_role($user_id, $data){
            return $this->db->where('user_id', $user_id)
							->update('auth_users', $data);
        }
    }
?>