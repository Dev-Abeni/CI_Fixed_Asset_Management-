<?php 

class asset_possesions_model extends CI_Model{
    public function save($data){
        return $this->db->insert('asset_possession', $data);
    }

    public function remove($asset_id){
        return $this->db->where('asset_id', $asset_id)
                        ->delete('asset_possession');
    }

    public function remove_single_assignment($asset_id, $employee_id){
        return $this->db->where(['asset_id' => $asset_id, 'employee_id' => $employee_id])
                        ->delete('asset_possession');
    }

    public function get_all_assignments($asset_id){
        $this->db->select([
            'asset_possession.possession_id', 'asset_possession.asset_id', 'asset_possession.employee_id', 
            'asset.asset_id',
            'employees.employee_id', 'employees.name AS employee_name', 'employees.image_url AS employee_image', 'employees.designation_id', 'employees.department_id', 'employees.phone', 'employees.email', 
            'designations.designation_id', 'designations.name AS designation_name',
            'departments.department_id', 'departments.name AS department_name',
        ]);
        $this->db->from('asset_possession');
        $this->db->where('asset_possession.asset_id', $asset_id);
        $this->db->join('employees', 'employees.employee_id = asset_possession.employee_id');
        $this->db->join('asset', 'asset.asset_id = asset_possession.asset_id');
        $this->db->join('designations', 'designations.designation_id = employees.designation_id');
        $this->db->join('departments', 'departments.department_id = employees.department_id');
        $query = $this->db->get();
        return $query->result();
    }
}