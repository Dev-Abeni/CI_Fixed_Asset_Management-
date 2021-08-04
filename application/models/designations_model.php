<?php
    class designations_model extends CI_Model{
        public function get_all_designations(){
            $result = $this->db->get('designations');

            if($result->num_rows() > 0){
                return $result->result();
            }
        }

        public function save($data){
            return $this->db->insert("designations", $data);
        }

        public function get_designation($designation_id){
            $result = $this->db->where(['designation_id' => $designation_id])
                               ->get('designations');

            if($result->num_rows() > 0){
                return $result->row();
            }
        } 

        public function update($data, $designation_id){
            return $this->db->where(['designation_id' => $designation_id])
                            ->update('designations', $data);
        }

        public function move_to_trash($designation_id, $data){
            return $this->db->where(['designation_id' => $designation_id])
                            ->update('designations', $data);
        } 

        public function get_deleted_designations(){
            $result = $this->db->get('designations');

            if($result->num_rows() > 0){
                return $result->result();
            }
        }

        public function delete($designation_id){
            return $this->db->where(['designation_id' => $designation_id])
                            ->delete("designations");
        }
    }
?>
