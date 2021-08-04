<?php
    class vendors_model extends CI_Model{
        
        public function save($data){
            return $this->db->insert('vendors', $data);
        }

        public function get(){
            $this->db->select([
                'vendors.vendor_id',
                'vendors.name',
                'vendors.country_id',
                'vendors.city',
                'vendors.email',
                'vendors.phone',
                'vendors.state',
                'vendors.image_url',
                'vendors.is_canceled',
                'country.country_id', 
                'country.nicename',
                'country.phonecode'
            ]);
			$this->db->from('vendors');
            $this->db->where('vendors.is_canceled', FALSE);
			$this->db->join('country', 'country.country_id = vendors.country_id');
			$query = $this->db->get();
			return $query->result();
        }

        public function get_number(){
            $result = $this->db->get('vendors'); 
    
            if($result->num_rows() > 0){
                return $result->num_rows();
            }
        }

        public function get_details($vendor_id){
            $this->db->select([
                'vendors.vendor_id',
                'vendors.name',
                'vendors.country_id',
                'vendors.city',
                'vendors.email',
                'vendors.phone',
                'vendors.state',
                'vendors.image_url',
                'vendors.address',
                'vendors.description',
                'vendors.is_canceled',
                'country.country_id', 
                'country.nicename',
                'country.phonecode'
            ]);
			$this->db->from('vendors');
            $this->db->where('vendors.vendor_id', $vendor_id);
			$this->db->join('country', 'country.country_id = vendors.country_id');
			$query = $this->db->get();
			return $query->row();
        }

        public function update($data, $vendor_id){
            return $this->db->where('vendor_id', $vendor_id)
							->update('vendors', $data);
        }

        public function move_to_trash($vendor_id, $data){
            return $this->db->where('vendor_id', $vendor_id)
							->update('vendors', $data);
        }

        public function get_deleted(){
            $this->db->select([
                'vendors.vendor_id',
                'vendors.name',
                'vendors.country_id',
                'vendors.city',
                'vendors.email',
                'vendors.image_url',
                'vendors.phone',
                'vendors.state',
                'vendors.is_canceled',
                'country.country_id', 
                'country.nicename',
                'country.phonecode'
            ]);
			$this->db->from('vendors');
            $this->db->where('vendors.is_canceled', TRUE);
			$this->db->join('country', 'country.country_id = vendors.country_id');
			$query = $this->db->get();
			return $query->result();
        }

        public function restore($vendor_id, $data){
            return $this->db->where('vendor_id', $vendor_id)
							->update('vendors', $data);
        }

        public function delete($vendor_id){
            return $this->db->delete('vendors', ['vendor_id' => $vendor_id]);
        }
    }
