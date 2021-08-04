<?php 

class employees_model extends CI_Model{
    public function get_all_employees(){
        $this->db->select([
            'employees.employee_id',
            'employees.name',
            'employees.designation_id',
            'employees.department_id',
            'employees.email',
            'employees.phone',
            'employees.image_url',
            'employees.is_canceled',
            'designations.designation_id', 
            'designations.name AS designation_name',
            'departments.department_id', 
            'departments.name AS department_name'
        ]);
        $this->db->from('employees');
        $this->db->where('employees.is_canceled', FALSE);
        $this->db->join('designations', 'designations.designation_id = employees.designation_id');
        $this->db->join('departments', 'departments.department_id = employees.department_id');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_number(){
        $result = $this->db->get('employees'); 

        if($result->num_rows() > 0){
            return $result->num_rows();
        }
    }

    public function get_deleted_employees(){
        $this->db->select([
            'employees.employee_id',
            'employees.name',
            'employees.designation_id',
            'employees.department_id',
            'employees.email',
            'employees.phone',
            'employees.image_url',
            'employees.is_canceled',
            'designations.designation_id', 
            'designations.name AS designation_name',
            'departments.department_id', 
            'departments.name AS department_name'
        ]);
        $this->db->from('employees');
        $this->db->where('employees.is_canceled', TRUE);
        $this->db->join('designations', 'designations.designation_id = employees.designation_id');
        $this->db->join('departments', 'departments.department_id = employees.department_id');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_employee($employee_id){
        $this->db->select([
            'employees.employee_id',
            'employees.name',
            'employees.designation_id',
            'employees.department_id',
            'employees.email',
            'employees.phone',
            'employees.image_url',
            'employees.is_canceled',
            'designations.designation_id', 
            'designations.name AS designation_name',
            'departments.department_id', 
            'departments.name AS department_name'
        ]);
        $this->db->from('employees');
        $this->db->where('employees.is_canceled', FALSE);
        $this->db->where('employees.employee_id', $employee_id);
        $this->db->join('designations', 'designations.designation_id = employees.designation_id');
        $this->db->join('departments', 'departments.department_id = employees.department_id');
        $query = $this->db->get();
        return $query->row();
    }

    public function save($data){
        return $this->db->insert('employees', $data);
    }

    public function update($data, $employee_id){
        return $this->db->where('employee_id', $employee_id)
                        ->update('employees', $data);
    }

    public function move_to_trash($employee_id, $data){
        return $this->db->where('employee_id', $employee_id)
                        ->update('employees', $data);
    }

    public function restore($employee_id, $data){
        return $this->db->where('employee_id', $employee_id)
                        ->update('employees', $data);
    }

    public function delete($employee_id){
        return $this->db->delete('employees', ['employee_id' => $employee_id]);
    }
    
}