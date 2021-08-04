<?php 

class asset_maintenance_model extends CI_Model{
    public function get_maintenance_record($asset_id){
        $result = $this->db->where('asset_id', $asset_id)
                 ->get('asset_maintenance');

        if($result->num_rows() > 0){
            return $result->result();
        }
    }

    public function save($data){
        return $this->db->insert('asset_maintenance', $data);
    }
}