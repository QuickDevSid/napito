<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload_controller extends CI_Controller {

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
            // $dataToInsert = array();
            if (pathinfo($filePath, PATHINFO_EXTENSION) == 'csv') {
                if (($handle = fopen($filePath, 'r')) !== FALSE) {
                    $isHeaderRow = true;
                    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                        if ($isHeaderRow) {
                            $isHeaderRow = false;
                            continue;
                        }

                        $dataToInsert = array(
                            'category'                  => $data[0] != "" ? $data[0] : '',
                            'sub_category'              => $data[1] != "" ? $data[1] : '',
                            'service_name'              => $data[2] != "" ? $data[2] : '',
                            'service_name_marathi'      => $data[3] != "" ? $data[3] : '',
                            'service_duration'          => $data[4] != "" ? $data[4] : '',
                            'gender'                    => $data[5] != "" ? $data[5] : '',
                            'final_price'               => $data[6],
                            'discount_in'               => $data[7] != "" ? $data[7] : '',
                            'discount_type'             => $data[8] != "" ? $data[8] : '',
                            'min'                       => $data[9] != "" ? $data[9] : '',
                            'max'                       => $data[10] != "" ? $data[10] : '',
                            'service_discount'          => $data[11] != "" ? $data[11] : '',
                            'reward_point'              => $data[12] != "" ? $data[12] : '',
                            'reminder_duration'         => $data[13] != "" ? $data[13] : '',
                            'short_description'         => $data[14] != "" ? $data[14] : '',
                            'service_description'       => $data[15] != "" ? $data[15] : '',                           
                            'created_on'                => date('Y-m-d H:i:s')
                        );
                        $this->db->insert('tbl_admin_services', $dataToInsert);
                    } 
                    // echo'<pre>'; print_r($dataToInsert);
                    // exit();
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
