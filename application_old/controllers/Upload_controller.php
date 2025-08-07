<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload_controller extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->is_login();   
	}
	public function is_login(){
		if($this->session->userdata('admin_id') == ""){
			$this->session->set_flashdata('message','Please login to continue');
			redirect('login');   
		}
	}	

    public function upload_services_ajax() {
        $this->load->library('upload');
        $this->load->helper('url');

        $config['upload_path'] = './admin_assets/';
        $config['allowed_types'] = 'xlsx|xls|csv';
        $config['max_size'] = 1024;
        $config['file_name'] = 'services_data';
        
        $this->upload->initialize($config);
        if ($this->upload->do_upload('file')) {
            $fileData = $this->upload->data();
            $filePath = './admin_assets/' . $fileData['file_name'];
            if (pathinfo($filePath, PATHINFO_EXTENSION) == 'csv') {
                if (($handle = fopen($filePath, 'r')) !== FALSE) {
                    $isHeaderRow = true;
                    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                        if ($isHeaderRow) {
                            $isHeaderRow = false;
                            continue;
                        }

                        $this->db->where('gender',trim($data[0]));
                        $this->db->where('sup_category',trim($data[1]));
                        $this->db->where('is_deleted','0');
                        $this->db->order_by('id','desc');
                        $this->db->limit(1);
                        $exist_category = $this->db->get('tbl_admin_service_category')->row();
                        if(empty($exist_category)){                            
                            $this->db->where('gender',trim($data[0]));
                            $this->db->where('is_deleted','0');
                            $total_cat = $this->db->get('tbl_admin_service_category')->num_rows();

                            $cat_data = array(
                                'admin_id'      =>  $this->session->userdata('admin_id'),
                                'order'         =>  $total_cat + 1,
                                'gender'        =>  trim($data[0]),                          
                                'sup_category'  =>  trim($data[1]),                          
                                'created_on'    =>  date('Y-m-d H:i:s')
                            );
                            $this->db->insert('tbl_admin_service_category',$cat_data);
                            $category = $this->db->insert_id();
                        }else{
                            $category = $exist_category->id;
                        }

                        $this->db->where('gender',trim($data[0]));
                        $this->db->where('sup_category',$category);
                        $this->db->where('sub_category',trim($data[2]));
                        $this->db->where('is_deleted','0');
                        $this->db->order_by('id','desc');
                        $this->db->limit(1);
                        $exist_subcategory = $this->db->get('tbl_admin_sub_category')->row();
                        if(empty($exist_subcategory)){           
                            $this->db->where('gender',trim($data[0]));
                            $this->db->where('is_deleted','0');
                            $total_subcat = $this->db->get('tbl_admin_sub_category')->num_rows();

                            $subcat_data = array(
                                'order'         =>  $total_subcat + 1,
                                'gender'        =>  trim($data[0]), 
                                'sup_category'  =>  $category,
                                'sub_category'  =>  trim($data[2]),                          
                                'created_on'    =>  date('Y-m-d H:i:s')
                            );
                            $this->db->insert('tbl_admin_sub_category',$subcat_data);
                            $subcategory = $this->db->insert_id();
                        }else{
                            $subcategory = $exist_subcategory->id;
                        }        

                        $this->db->where('gender',trim($data[0]));
                        $this->db->where('is_deleted','0');
                        $total_service = $this->db->get('tbl_admin_services')->num_rows();

                        $dataToInsert = array(
                            'order'                     => $total_service + 1,
                            'category'                  => $category,
                            'sub_category'              => $subcategory,
                            'service_name'              => $data[3] != "" ? trim($data[3]) : '',
                            'service_name_marathi'      => $data[4] != "" ? trim($data[4]) : '',
                            'service_duration'          => $data[5] != "" ? trim($data[5]) : '',
                            'gender'                    => $data[0] != "" ? trim($data[0]) : '',
                            'final_price'               => trim($data[6]),
                            'reminder_duration'         => $data[7] != "" ? trim($data[7]) : '',
                            'short_description'         => $data[8] != "" ? trim($data[8]) : '',
                            'service_description'       => $data[9] != "" ? trim($data[9]) : '',                           
                            'created_on'                => date('Y-m-d H:i:s')
                        );

                        $this->db->insert('tbl_admin_services', $dataToInsert);
                    } 
                    fclose($handle);
                }
                echo '<p style="color: green;">Data imported successfully!</p>';
            } else {
                echo '<p style="color: red;">Invalid file format. Please upload a CSV file.</p>';
            }
        } else {
            echo '<p style="color: red;">' . $this->upload->display_errors() . '</p>';
        }
    }

    public function upload_services() {
        $this->load->view("upload_services");
    }
}
