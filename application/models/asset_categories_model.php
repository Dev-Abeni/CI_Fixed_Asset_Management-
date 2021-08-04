<?php 

class asset_categories_model extends CI_Model{
    public function get(){
        $result = $this->db->get('asset_category');

        if($result->num_rows() > 0){
            return $result->result();
        }
    }

    public function save($data){
        return $this->db->insert('asset_category', $data);
    }

    public function get_category($category_id){
        $result = $this->db->where(['category_id' => $category_id])
                           ->get('asset_category');

        if($result->num_rows() > 0){
            return $result->row();
        }
    }

    public function update($category_id, $data){
        return $this->db->where(['category_id' => $category_id])
                        ->update('asset_category', $data);
    }

    public function delete($category_id){
        return $this->db->where('category_id', $category_id)
                        ->delete('asset_category');
    }
}