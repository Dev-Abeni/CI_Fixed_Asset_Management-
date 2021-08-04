<?php 

class asset_depreciation_schedule_model extends CI_Model{
    public function save($data){
        return $this->db->insert('asset_depreciation_schedule', $data);
    }

    public function get_depreciation_schedule($asset_id){
        $result = $this->db->where('asset_id', $asset_id)
                            ->get('asset_depreciation_schedule');

        if($result->num_rows() > 0){
            return $result->result();
        }
    }

    public function get_all_depreciation_schedule(){
        $this->db->select([
                'asset_depreciation_schedule.depreciation_id', 'asset_depreciation_schedule.asset_id', 
                'asset_depreciation_schedule.date', 'asset_depreciation_schedule.book_value', 
                'asset_depreciation_schedule.depreciation_expense', 
                'asset.asset_id', 'asset.unicode', 'asset.name', 'asset.date_of_acquisition', 
                'asset.original_price', 'asset.category_id', 
                'asset_category.category_id', 'asset_category.depreciation_percent',  
            ]);
        $this->db->from('asset_depreciation_schedule');
        $this->db->order_by('asset_depreciation_schedule.date', 'DESC');
        $this->db->join('asset', 'asset.asset_id = asset_depreciation_schedule.asset_id');
        $this->db->join('asset_category', 'asset_category.category_id = asset.category_id');
        $query = $this->db->get();
        return $query->result();
    }
}