<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    
class asset extends CI_Controller{
    
    public function __construct(){
		parent::__construct();
		$this->load->model('membership_model');
        $this->load->model('assets_model');
        $this->load->model('asset_categories_model');
        $this->load->model('vendors_model');
        $this->load->model('asset_possesions_model');
        $this->load->model('asset_maintenance_model');
        $this->load->model('asset_depreciation_schedule_model');
	}

    public function index(){
        if(!$this->session->userdata('user_id')){
            return redirect("auth");
        }else{
            $user = $this->membership_model->get_authenticated_user_by_id($this->session->userdata("user_id"));
            $assets = $this->assets_model->get();
            $this->load->view("assets/index", 
                [
                    'user' => $user, 
                    'assets' => $assets
                ]);
        }
    }

    public function create(){
        if(!$this->session->userdata('user_id')){
            return redirect("auth");
        }else{
            $user = $this->membership_model->get_authenticated_user_by_id($this->session->userdata("user_id"));
            $categories = $this->asset_categories_model->get();
            $vendors = $this->vendors_model->get();
            $this->load->view("assets/create", ['user' => $user, 'categories' => $categories, 'vendors' => $vendors]);
        }
    }

    public function add(){
        if(!$this->session->userdata('user_id')){
            return redirect("auth");
        }else{
            $this->form_validation->set_rules('unicode', 'unicode', 'required|is_unique[asset.unicode]');
            $this->form_validation->set_rules('name', 'name', 'required');
            $this->form_validation->set_rules('category_id', 'category', 'required');
            $this->form_validation->set_rules('date_of_acquisition', 'date of acquisition', 'required');
            $this->form_validation->set_rules('original_price', 'price', 'required|numeric');

            $config['upload_path'] = './assets/images';
            $config['allowed_types'] = 'jpg|gif|png|jpeg';

            $this->load->library('upload', $config);

            if($this->form_validation->run()){
                $data = $this->input->post();
                if($this->upload->do_upload('image_url')){
                    $upload_info = $this->upload->data();
                    $path = base_url('assets/images/'.$upload_info['raw_name'].$upload_info['file_ext']);
                    $data['image_url'] = $path;
				}
                unset($data['submit']);
                if($this->assets_model->save($data)){
                    $this->session->set_flashdata("successful_save", "Asset saved successfully");
                }else{
                    $this->session->set_flashdata("failed_save", "Saving asset failed");
                }
                return redirect("asset/index");
            }else{
                $user = $this->membership_model->get_authenticated_user_by_id($this->session->userdata("user_id"));
                $categories = $this->asset_categories_model->get();
                $vendors = $this->vendors_model->get();
                $this->load->view("assets/create", ['user' => $user, 'categories' => $categories, 'vendors' => $vendors]);
            }
        }
    }

    public function change($asset_id){
        if(!$this->session->userdata('user_id')){
            return redirect("auth");
        }else{
            $user = $this->membership_model->get_authenticated_user_by_id($this->session->userdata("user_id"));
            $categories = $this->asset_categories_model->get();
            $vendors = $this->vendors_model->get();
            $asset = $this->assets_model->get_asset($asset_id);
            $this->load->view("assets/edit", ['user' => $user, 'categories' => $categories, 'vendors' => $vendors, 'asset' => $asset]);
        }
    }

    public function update($asset_id){
        if(!$this->session->userdata('user_id')){
            return redirect("auth");
        }else{
            $this->form_validation->set_rules('name', 'name', 'required');
            $this->form_validation->set_rules('category_id', 'category', 'required');
            $this->form_validation->set_rules('date_of_acquisition', 'date of acquisition', 'required');
            $this->form_validation->set_rules('original_price', 'price', 'required|numeric');

            $config['upload_path'] = './assets/images';
            $config['allowed_types'] = 'jpg|gif|png|jpeg';

            $this->load->library('upload', $config);

            if($this->form_validation->run()){
                $data = $this->input->post();
                if($this->upload->do_upload('image_url')){
                    $upload_info = $this->upload->data();
                    $path = base_url('assets/images/'.$upload_info['raw_name'].$upload_info['file_ext']);
                    $data['image_url'] = $path;
				}
                unset($data['submit']);
                if($this->assets_model->update($asset_id, $data)){
                    $this->session->set_flashdata("successful_update", "Asset updated successfully.");
                }else{
                    $this->session->set_flashdata("failed_update", "Failed to update asset");
                }
                return redirect("asset/index");
            }else{
                $user = $this->membership_model->get_authenticated_user_by_id($this->session->userdata("user_id"));
                $categories = $this->asset_categories_model->get();
                $vendors = $this->vendors_model->get();
                $asset = $this->assets_model->get_asset($asset_id);
                $this->load->view("assets/edit", ['user' => $user, 'categories' => $categories, 'vendors' => $vendors, 'asset' => $asset]);
            }
        }
    }

    public function move_to_trash($asset_id){
        if(!$this->session->userdata('user_id')){
            return redirect("auth");
        }else{
            $data['is_canceled'] = 1;
			if($this->assets_model->move_to_trash($asset_id, $data)){
				$this->session->set_flashdata("successful_cancel", "Asset moved to the recycle bin.");
			}else{
				$this->session->set_flashdata("failed_cancel", "Moving asset to the recycle bin failed. Please try again later.");
			}
			return redirect("asset");
        }
    }

    public function recycle_bin(){
        if(!$this->session->userdata('user_id')){
            return redirect("auth");
        }else{
            $user = $this->membership_model->get_authenticated_user_by_id($this->session->userdata("user_id"));
            $assets = $this->assets_model->get_deleted();
            $this->load->view("assets/recycle_bin", 
                [
                    'user' => $user, 
                    'assets' => $assets
                ]);
        }
    }

    public function restore($asset_id){
        if(!$this->session->userdata('user_id')){
            return redirect("auth");
        }else{
            $data['is_canceled'] = 0;
			if($this->assets_model->move_to_trash($asset_id, $data)){
				$this->session->set_flashdata("successful_restore", "Asset restored.");
			}else{
				$this->session->set_flashdata("failed_restore", "Restoring asset failed. Please try again later.");
			}
			return redirect("asset");
        }
    }

    public function delete($asset_id){
        if(!$this->session->userdata('user_id')){
            return redirect("auth");
        }else{
            if($this->assets_model->delete($asset_id)){
				$this->session->set_flashdata("successful_delete", "Asset deleted.");
			}else{
				$this->session->set_flashdata("failed_delete", "Deleting asset failed. Please try again later.");
			}
			return redirect("asset");
        } 
    }

    public function details($asset_id){
        if(!$this->session->userdata('user_id')){
            return redirect('auth');
        }else{
            $user = $this->membership_model->get_authenticated_user_by_id($this->session->userdata("user_id"));
            $asset = $this->assets_model->get_asset($asset_id);
            $disposed_price = $asset->disposed_price;
            $asset_possessions = $this->asset_possesions_model->get_all_assignments($asset_id);
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
            $this->load->view("assets/details", [
                'asset' => $asset, 
                'user' => $user, 
                'asset_possessions' => $asset_possessions, 
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

    public function dispose($asset_id){
        if(!$this->session->userdata('user_id')){
            return redirect('auth');
        }else{
            $data = $this->input->post();
            $data['is_disposed'] = 1; 
            unset($data['submit']);
            if($this->assets_model->dispose($asset_id, $data)){
                if($this->asset_possesions_model->remove($asset_id)){
                    return redirect("asset/details/$asset_id");
                }
            }
        }
    }
}