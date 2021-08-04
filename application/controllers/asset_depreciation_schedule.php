<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    
class asset_depreciation_schedule extends CI_Controller{
    public function __construct(){
		parent::__construct();
        $this->load->model('asset_depreciation_schedule_model');
        $this->load->model('membership_model');
        $this->load->model('assets_model');
        $this->load->model('asset_possesions_model');
        $this->load->model('asset_maintenance_model');
    }

    public function index(){
        if(!$this->session->userdata('user_id')){
            return redirect("auth");
        }else{
            $user = $this->membership_model->get_authenticated_user_by_id($this->session->userdata("user_id"));
            $asset_depreciation_schedule = $this->asset_depreciation_schedule_model->get_all_depreciation_schedule(); 
            $this->load->view("asset_depreciation_schedule/index", [
                'user' => $user, 
                'asset_depreciation_schedule' => $asset_depreciation_schedule
                ]
            );
        }
    }
    
    public function download(){
        if(!$this->session->userdata('user_id')){
            return redirect("auth");
        }else{
            $data = $this->input->post();
            unset($data['submit']); 

            if($this->asset_depreciation_schedule_model->save($data)){
                $asset_id = $this->input->post('asset_id');
                return redirect("asset/details/$asset_id");
            }else{
                $asset_id = $this->input->post('asset_id');
                $this->session->set_flashdata("failed_download", "Downloading asset data failed");
                $user = $this->membership_model->get_authenticated_user_by_id($this->session->userdata("user_id"));
                $asset = $this->assets_model->get_asset($asset_id);
                $asset_possessions = $this->asset_possesions_model->get_all_assignments($asset_id);
                $asset_depreciation_schedule = $this->asset_depreciation_schedule_model->get_depreciation_schedule($asset_id); 
                $original_price = $asset->original_price; 
                $acquisition_date = strtotime($asset->date_of_acquisition);
                $today = strtotime(date("Y-m-d"));
                $difference = $today - $acquisition_date;
                $days_difference = floor($difference/(60*60*24));
                $depreciation_percent = $asset->depreciation_percent;
                $daily_depreciation_charge = ($original_price*$depreciation_percent/100/365);
                $book_value = $original_price - ($days_difference) * $daily_depreciation_charge;
                $this->load->view("assets/details", [
                    'asset' => $asset, 
                    'user' => $user, 
                    'asset_possessions' => $asset_possessions, 
                    'asset_depreciation_schedule' => $asset_depreciation_schedule, 
                    'original_price' => $original_price, 
                    'depreciation_percent' => $depreciation_percent, 
                    'daily_depreciation_charge' => $daily_depreciation_charge, 
                    'days_difference' => $days_difference, 
                    'book_value' => $book_value
                    ]
                );
            }    
        }
    }

    public function report(){
        $this->load->library('Pdf');
        $asset_depreciation_schedule = $this->asset_depreciation_schedule_model->get_all_depreciation_schedule(); 
        $this->load->view('asset_depreciation_schedule/report.php', ['asset_depreciation_schedule' => $asset_depreciation_schedule]);
    }

    public function single_report($asset_id){
            $this->load->library('Pdf');

            $user = $this->membership_model->get_authenticated_user_by_id($this->session->userdata("user_id"));
            $asset = $this->assets_model->get_asset($asset_id);
            $disposed_price = $asset->disposed_price;
            $asset_depreciation_schedule = $this->asset_depreciation_schedule_model->get_depreciation_schedule($asset_id); 
            $original_price = $asset->original_price; 
            $acquisition_date = strtotime($asset->date_of_acquisition);
            $today = strtotime(date("Y-m-d"));
            $difference = $today - $acquisition_date;
            $days_difference = floor($difference/(60*60*24));
            $depreciation_percent = $asset->depreciation_percent;
            $daily_depreciation_charge = ($original_price * $depreciation_percent/100/365);
            $book_value = $original_price - ($days_difference) * $daily_depreciation_charge;
            $maintenance_record = $this->asset_maintenance_model->get_maintenance_record($asset_id);
            $this->load->view("asset_depreciation_schedule/single_report", [
                'asset' => $asset, 
                'user' => $user, 
                'asset_depreciation_schedule' => $asset_depreciation_schedule, 
                'original_price' => $original_price, 
                'depreciation_percent' => $depreciation_percent, 
                'daily_depreciation_charge' => $daily_depreciation_charge, 
                'days_difference' => $days_difference, 
                'book_value' => $book_value, 
                'maintenance_record' => $maintenance_record, 
                'disposed_price' => $disposed_price
                ]
            );
    }
}