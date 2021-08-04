<?php
    class departments_model extends CI_Model{
        public function get_all_departments(){
            $result = $this->db->get('departments');

            if($result->num_rows() > 0){
                return $result->result();
            }
        }

        public function get_number(){
            $result = $this->db->get('employees'); 
    
            if($result->num_rows() > 0){
                return $result->num_rows();
            }
        }

        public function save($data){
            return $this->db->insert("departments", $data);
        }

        public function get_department($department_id){
            $result = $this->db->where(['department_id' => $department_id])
                               ->get('departments');

            if($result->num_rows() > 0){
                return $result->row();
            }
        } 

        public function update($data, $department_id){
            return $this->db->where(['department_id' => $department_id])
                            ->update('departments', $data);
        }

        public function move_to_trash($department_id, $data){
            return $this->db->where(['department_id' => $department_id])
                            ->update('departments', $data);
        } 

        public function get_deleted_departments(){
            $result = $this->db->get('departments');

            if($result->num_rows() > 0){
                return $result->result();
            }
        }

        public function delete($department_id){
            return $this->db->where(['department_id' => $department_id])
                            ->delete("departments");
        }
    }
?>
