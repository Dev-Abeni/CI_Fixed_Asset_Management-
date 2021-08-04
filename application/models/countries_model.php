<?php
    class countries_model extends CI_Model{
        public function get_countries(){
            $result = $this->db->get('country');

            if($result->num_rows() > 0){
                return $result->result();
            }
        }
    }