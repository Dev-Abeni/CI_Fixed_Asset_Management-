<?php 
class assets_model extends CI_Model{
    public function get(){
        $this->db->select([
                'asset.asset_id',
                'asset.unicode',
                'asset.name',
                'asset.vendor_id',
                'asset.category_id',
                'asset.date_of_acquisition',
                'asset.original_price',
                'asset.image_url',
                'asset.is_disposed',
                'asset.disposed_price',
                'asset.is_canceled',
                'asset_category.category_id', 
                'asset_category.name AS category_name',
                'vendors.vendor_id',
                'vendors.name AS vendor_name' 
            ]);
        $this->db->from('asset');
        $this->db->where('asset.is_canceled', FALSE);
        $this->db->join('asset_category', 'asset_category.category_id = asset.category_id');
        $this->db->join('vendors', 'vendors.vendor_id = asset.vendor_id');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_number(){
        $result = $this->db->get('asset'); 

        if($result->num_rows() > 0){
            return $result->num_rows();
        }
    }

    public function save($data){
        return $this->db->insert('asset', $data);
    }

    public function get_asset($asset_id){
        $this->db->select([
                'asset.asset_id','asset.unicode','asset.name','asset.vendor_id',
                'asset.category_id','asset.date_of_acquisition','asset.original_price',
                'asset.image_url','asset.is_canceled','asset.is_disposed','asset.disposed_price',
                
                'asset_category.category_id', 'asset_category.name AS category_name', 
                'asset_category.depreciation_percent',
                
                'vendors.vendor_id','vendors.name AS vendor_name', 
                'vendors.image_url AS vendor_image',
            ]);
        $this->db->from('asset');
        $this->db->where('asset.is_canceled', FALSE);
        $this->db->where('asset.asset_id', $asset_id);
        $this->db->join('asset_category', 'asset_category.category_id = asset.category_id');
        $this->db->join('vendors', 'vendors.vendor_id = asset.vendor_id');
        $query = $this->db->get();
        return $query->row();
    }

    public function update($asset_id, $data){
        return $this->db->where('asset_id', $asset_id)
                        ->update('asset', $data);
    }

    public function move_to_trash($asset_id, $data){
        return $this->db->where('asset_id', $asset_id)
                        ->update('asset', $data);
    }

    public function get_deleted(){
        $this->db->select([
                'asset.asset_id',
                'asset.unicode',
                'asset.name',
                'asset.vendor_id',
                'asset.category_id',
                'asset.date_of_acquisition',
                'asset.original_price',
                'asset.image_url',
                'asset.is_disposed',
                'asset.disposed_price',
                'asset.is_canceled',
                'asset_category.category_id', 
                'asset_category.name AS category_name',
                'vendors.vendor_id',
                'vendors.name AS vendor_name' 
            ]);
        $this->db->from('asset');
        $this->db->where('asset.is_canceled', TRUE);
        $this->db->join('asset_category', 'asset_category.category_id = asset.category_id');
        $this->db->join('vendors', 'vendors.vendor_id = asset.vendor_id');
        $query = $this->db->get();
        return $query->result();
    }

    public function delete($asset_id){
        return $this->db->where('asset_id', $asset_id)
                        ->delete('asset');
    }

    public function dispose($asset_id, $data){
        return $this->db->where('asset_id', $asset_id)
                        ->update('asset', $data);
    }
}