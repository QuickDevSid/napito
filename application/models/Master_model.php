<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Master_model extends CI_Model {    
	public function salon_close_reason(){
		$data=array(
			'reason_title' 			=> $this->input->post('reason_title'),
			'salon_close_reason' 	=> $this->input->post('salon_close_reason'), 
		);
		if($this->input->post('id') == ""){
			$date=array( 
				'created_on'   => date("Y-m-d H:i:s")
			);
			$new_arr = array_merge($data,$date);
			$this->db->insert('tbl_salon_close_reason',$new_arr);
			return 0;
		}else{
			$this->db->where('id',$this->input->post('id'));
			$this->db->update('tbl_salon_close_reason',$data);
			return 1;
		}
	} 
	public function get_all_reason(){
		$this->db->where('is_deleted','0');
		$this->db->order_by('id','DESC');
		$result = $this->db->get('tbl_salon_close_reason');
		return $result->result();
	} 
    public function get_all_salon_close_reason(){
        $this->db->where('is_deleted','0');
        $this->db->order_by('id','DESC');
        $result = $this->db->get('tbl_salon_close_reason');
        return $result->result();
    }
    public function get_single_reason(){
        $this->db->where('is_deleted','0');
        $this->db->where('id',$this->uri->segment(2));
        $result = $this->db->get('tbl_salon_close_reason');
        return $result->row();
    } 
    public function set_terms_conditions(){
        $data=array(
            'for'        => $this->input->post('for'),
            'text'       => $this->input->post('text'),
            'type'       => '1',
        );
        if($this->input->post('id') == ""){
            $date=array( 
                'created_on' => date("Y-m-d H:i:s")
            );
            $new_arr = array_merge($data,$date);
            $this->db->insert('tbl_privacy_policy_and_terms',$new_arr);
            return 1;
        }else{
            $this->db->where('id',$this->input->post('id'));
            $this->db->update('tbl_privacy_policy_and_terms',$data);
            return 0;
        }
    }
    public function set_privacy_policy(){
        $data=array(
            'for'        => $this->input->post('for'),
            'text'       => $this->input->post('text'),
            'type'       => '0',
        );
        if($this->input->post('id') == ""){
            $date=array( 
                'created_on' => date("Y-m-d H:i:s")
            );
            $new_arr = array_merge($data,$date);
            $this->db->insert('tbl_privacy_policy_and_terms',$new_arr);
            return 1;
        }else{
            $this->db->where('id',$this->input->post('id'));
            $this->db->update('tbl_privacy_policy_and_terms',$data);
            return 0;
        }
    }
    
    public function set_app_support(){
        $data=array(
            'for'        => '0',
            'text'       => $this->input->post('text'),
            'type'       => '2',
        );
        if($this->input->post('id') == ""){
            $date=array( 
                'created_on' => date("Y-m-d H:i:s")
            );
            $new_arr = array_merge($data,$date);
            $this->db->insert('tbl_privacy_policy_and_terms',$new_arr);
            return 1;
        }else{
            $this->db->where('id',$this->input->post('id'));
            $this->db->update('tbl_privacy_policy_and_terms',$data);
            return 0;
        }
    }
    public function get_single_terms_conditions($id){
        $this->db->where('type','1');
        $this->db->where('is_deleted','0');
        $this->db->where('id',$id);
        $result = $this->db->get('tbl_privacy_policy_and_terms');
        return $result->row();
    } 
    public function get_single_privacy_policy($id){
        $this->db->where('type','0');
        $this->db->where('is_deleted','0');
        $this->db->where('id',$id);
        $result = $this->db->get('tbl_privacy_policy_and_terms');
        return $result->row();
    } 
    
    public function get_single_app_support($id){
        $this->db->where('type','2');
        $this->db->where('is_deleted','0');
        $this->db->where('id',$id);
        $result = $this->db->get('tbl_privacy_policy_and_terms');
        return $result->row();
    } 
    public function get_terms_conditions(){
        $this->db->where('type','1');
        $this->db->where('is_deleted','0');
        $this->db->order_by('id','DESC');
        $result = $this->db->get('tbl_privacy_policy_and_terms');
        return $result->result();
    } 
    public function get_privacy_policy(){
        $this->db->where('type','0');
        $this->db->where('is_deleted','0');
        $this->db->order_by('id','DESC');
        $result = $this->db->get('tbl_privacy_policy_and_terms');
        return $result->result();
    } 
    
    public function get_app_support(){
        $this->db->where('type','2');
        $this->db->where('is_deleted','0');
        $this->db->order_by('id','DESC');
        $result = $this->db->get('tbl_privacy_policy_and_terms');
        return $result->result();
    } 
    
    public function add_facility($icon){
        $data=array(
            'facility_name' => $this->input->post('facility_name'), 
            'icon'          => $icon, 
        );

        if($this->input->post('id') == ""){
            $date=array( 
                'created_on'    => date("Y-m-d H:i:s")
            );
            $new_arr = array_merge($data,$date);
            $this->db->insert('tbl_facility_master',$new_arr);
            $primary_table_id = $this->db->insert_id();

            $this->db->where('is_deleted','0');
            $this->db->where('status','1');
            $result = $this->db->get('tbl_branch')->result();
            if(!empty($result)){
                foreach($result as $row){
                    $this->db->where('salon_id',$row->salon_id);
                    $this->db->where('branch_id',$row->id);
                    $this->db->where('is_deleted','0');
                    $this->db->where('LOWER(facility_name)', strtolower($this->input->post('facility_name')));
                    $exist = $this->db->get('tbl_salon_facility_master')->row();
                    if(empty($exist)){
                        $facilities_result = array(
                            'icon'          => $icon, 
                            'facility_name' => $this->input->post('facility_name'), 
                            'salon_id' 		=> $row->salon_id,
                            'branch_id' 	=> $row->id,
                            'primary_table_id'  =>  $primary_table_id,
                            'created_on' 	=> date("Y-m-d H:i:s")
                        );
                        $this->db->insert('tbl_salon_facility_master',$facilities_result);
                    }
                }
            }

            return 0;
        }else{
            $this->db->where('id',$this->input->post('id'));
            $this->db->update('tbl_facility_master',$data);

            $all_data = array(
                'icon'          => $icon, 
                'facility_name' => $this->input->post('facility_name'),
            );
            $this->db->where('primary_table_id',$this->input->post('id'));
            $this->db->where('is_deleted','0');
            $this->db->update('tbl_salon_facility_master',$all_data);

            $this->db->where('is_deleted','0');
            $this->db->where('status','1');
            $result = $this->db->get('tbl_branch')->result();
            if(!empty($result)){
                foreach($result as $row){
                    $this->db->where('salon_id',$row->salon_id);
                    $this->db->where('branch_id',$row->id);
                    $this->db->where('is_deleted','0');
                    $this->db->where('LOWER(facility_name)', strtolower($this->input->post('facility_name')));
                    $exist = $this->db->get('tbl_salon_facility_master')->row();
                    if(empty($exist)){
                        $facilities_result = array(
                            'icon'          => $icon, 
                            'facility_name' => $this->input->post('facility_name'), 
                            'salon_id' 		=> $row->salon_id,
                            'branch_id' 	=> $row->id,
                            'primary_table_id'  =>  $this->input->post('id'),
                            'created_on' 	=> date("Y-m-d H:i:s")
                        );
                        $this->db->insert('tbl_salon_facility_master',$facilities_result);
                    }
                }
            }

            return 1;
        }
    } 
    public function get_all_facility(){
        $this->db->where('is_deleted','0');
        $this->db->order_by('id','DESC');
        $result = $this->db->get('tbl_facility_master');
        return $result->result();
    } 
    public function get_single_facility(){
        $this->db->where('is_deleted','0');
        $this->db->where('id',$this->uri->segment(2));
        $result = $this->db->get('tbl_facility_master');
        return $result->row();
    }
    public function get_unique_facility_name(){ 
        $this->db->where('facility_name',$this->input->post('facility_name'));
        if($this->input->post('id') != "0"){
            $this->db->where('id !=',$this->input->post('id'));
        }
        $this->db->where('is_deleted','0');
        $result = $this->db->get('tbl_facility_master');
        echo $result->num_rows();
    }  
    public function add_tips($tips_photo){
        $add_items = $this->input->post('add_items');
        $item_description = $this->input->post('item_description');
        $item_name = $this->input->post('item_name');

        $data=array(
            'tips' 			=> $this->input->post('tips'), 
            'description' 	=> $this->input->post('description'),
            'add_items'     => $add_items == 'on' ? '1' : '0',
            'tips_photo'    => $tips_photo != "" ? $tips_photo : $this->input->post('old_tips_photo'), 
        );
        if($this->input->post('id') == ""){
            $date=array( 
                'created_on'    => date("Y-m-d H:i:s")
            );
            $new_arr = array_merge($data,$date);
            $this->db->insert('tbl_tips_master',$new_arr);
            $tips_id = $this->db->insert_id();

            if($add_items == 'on' && $item_name != "" && is_array($item_name) && !empty($item_name)){
                for($i=0;$i<count($item_name);$i++){
                    if($item_name[$i] != "" && $item_description[$i] != ""){
                        $title_data = array(
                            'tips_id'       =>  $tips_id,
                            'item_name'     =>  $item_name[$i],
                            'description'   =>  $item_description[$i],
                            'created_on'    =>  date("Y-m-d H:i:s")
                        );
                        $this->db->insert('tbl_tips_titles',$title_data);
                    }
                }
            }

            return 0;
        }else{
            $this->db->where('is_deleted','0');
            $this->db->where('tips_id',$this->input->post('id'));
            $this->db->delete('tbl_tips_titles');

            if($add_items == 'on' && $item_name != "" && is_array($item_name) && !empty($item_name)){
                for($i=0;$i<count($item_name);$i++){
                    if($item_name[$i] != "" && $item_description[$i] != ""){
                        $title_data = array(
                            'tips_id'       =>  $this->input->post('id'),
                            'item_name'     =>  $item_name[$i],
                            'description'   =>  $item_description[$i],
                            'created_on'    =>  date("Y-m-d H:i:s")
                        );
                        $this->db->insert('tbl_tips_titles',$title_data);
                    }
                }
            }

            $this->db->where('id',$this->input->post('id'));
            $this->db->update('tbl_tips_master',$data);
            return 1;
        }
    } 
    public function get_all_tips(){
        $this->db->where('is_deleted','0');
        $this->db->order_by('id','DESC');
        $result = $this->db->get('tbl_tips_master');
        return $result->result();
    } 
    public function get_single_tips(){
        $this->db->where('is_deleted','0');
        $this->db->where('id',$this->uri->segment(2));
        $result = $this->db->get('tbl_tips_master');
        return $result->row();
    }
    public function get_single_tip_titles($id){
        $this->db->where('is_deleted','0');
        $this->db->where('tips_id',$id);
        $result = $this->db->get('tbl_tips_titles');
        return $result->result();
    }
    public function get_unique_tips_name(){ 
        $this->db->where('tips',$this->input->post('tips'));
        if($this->input->post('id') != "0"){
            $this->db->where('id !=',$this->input->post('id'));
        }
        $this->db->where('is_deleted','0');
        $result = $this->db->get('tbl_tips_master');
        echo $result->num_rows();
    }  
    public function add_banner($tips_photo){
        $this->db->empty_table('tbl_mobile_banner');
        $old_banner = array_filter(explode(',', $this->input->post('old_banner')));
        $tips_photo = array_filter($tips_photo);
        $new_array = array_merge($tips_photo, $old_banner);
        for($i=0;$i<count($new_array);$i++){
            $data = array(
                'banner'        => $new_array[$i], 
                'created_on'    => date("Y-m-d H:i:s")
            );
            $this->db->insert('tbl_mobile_banner',$data);
        }
        return '0';
    } 
    public function get_all_banner(){
        $this->db->where('is_deleted','0');
        $this->db->order_by('id','DESC');
        $result = $this->db->get('tbl_mobile_banner');
        return $result->result();
    } 
    public function get_single_banner(){
        $this->db->where('is_deleted','0');
        $result = $this->db->get('tbl_mobile_banner');
        $result = $result->result();
        $single = [];
        if(!empty($result)){
            foreach($result as $data){
                $single[] = $data->banner;
            }
        }
        return implode(',',$single);
    }
	public function set_upload_tips_img() {
		$config = array();
		$config ['upload_path'] = 'admin_assets/images/tips_photo/';
		$config ['allowed_types'] = '*';
		$config ['encrypt_name'] = true;
		return $config;
	} 
	public function set_upload_banner_img() {
		$config = array();
		$config ['upload_path'] = 'admin_assets/images/mobile_banner_photo/';
		$config ['allowed_types'] = '*';
		$config ['encrypt_name'] = true;
		return $config;
	} 
    public function get_backend_setups(){
        $this->db->where('is_deleted', '0');
        $this->db->where('status', '1');
        $all_entries = $this->db->get('tbl_back_end_setups')->row();
        return $all_entries;
    }
    public function set_service_remindner_days(){
        $data=array(
            'service_repeat' => $this->input->post('service_reminder'), 
        );
        if($this->input->post('service_reminder_hidden_id') == ""){
            $date=array( 
                'created_on'    => date("Y-m-d H:i:s")
            );
            $new_arr = array_merge($data,$date);
            $this->db->insert('tbl_back_end_setups',$new_arr);
            return 0;
        }else{
            $this->db->where('id',$this->input->post('service_reminder_hidden_id'));
            $this->db->update('tbl_back_end_setups',$data);
            return 1;
        }
    } 
    public function set_gst_rate(){
        $data=array(
            'gst_rate' => $this->input->post('gst_rate'), 
        );
        if($this->input->post('hidden_id') == ""){
            $date=array( 
                'created_on'    => date("Y-m-d H:i:s")
            );
            $new_arr = array_merge($data,$date);
            $this->db->insert('tbl_back_end_setups',$new_arr);
            return 0;
        }else{
            $this->db->where('id',$this->input->post('hidden_id'));
            $this->db->update('tbl_back_end_setups',$data);
            return 1;
        }
    } 
    public function set_emergency_bill_count(){
        $data=array(
            'emergency_bill_count' => $this->input->post('emergency_bill_count'), 
        );
        if($this->input->post('emergency_bill_count_hidden_id') == ""){
            $date=array( 
                'created_on'    => date("Y-m-d H:i:s")
            );
            $new_arr = array_merge($data,$date);
            $this->db->insert('tbl_back_end_setups',$new_arr);
            return 0;
        }else{
            $this->db->where('id',$this->input->post('emergency_bill_count_hidden_id'));
            $this->db->update('tbl_back_end_setups',$data);
            return 1;
        }
    } 
    public function set_lost_customer_days(){
        $data=array(
            'lost_customer_criteria' => $this->input->post('lost_customer'), 
        );
        if($this->input->post('lost_customer_hidden_id') == ""){
            $date=array( 
                'created_on'    => date("Y-m-d H:i:s")
            );
            $new_arr = array_merge($data,$date);
            $this->db->insert('tbl_back_end_setups',$new_arr);
            return 0;
        }else{
            $this->db->where('id',$this->input->post('lost_customer_hidden_id'));
            $this->db->update('tbl_back_end_setups',$data);
            return 1;
        }
    } 


    
    public function add_location(){
        $data=array(
            'name'  	=> $this->input->post('location'), 
            'city_id' 	=> $this->input->post('city'),
        );
        if($this->input->post('id') == ""){
            $date=array( 
                'created_on'    => date("Y-m-d H:i:s")
            );
            $new_arr = array_merge($data,$date);
            $this->db->insert('tbl_location',$new_arr);
            return 0;
        }else{
            $this->db->where('id',$this->input->post('id'));
            $this->db->update('tbl_location',$data);
            return 1;
        }
    } 
    public function get_all_location(){
        $this->db->select('tbl_location.*,cities.name as city_name,states.name as state_name');
        $this->db->join('cities','cities.id = tbl_location.city_id');
        $this->db->join('states','states.id = cities.state_id');
        $this->db->where('tbl_location.is_deleted','0');
        $this->db->order_by('tbl_location.id','DESC');
        $result = $this->db->get('tbl_location');
        return $result->result();
    } 
    public function get_single_location(){
        $this->db->select('tbl_location.*,cities.state_id, cities.name as city_name,states.name as state_name');
        $this->db->join('cities','cities.id = tbl_location.city_id');
        $this->db->join('states','states.id = cities.state_id');
        $this->db->where('tbl_location.is_deleted','0');
        $this->db->where('tbl_location.id',$this->uri->segment(2));
        $result = $this->db->get('tbl_location');
        return $result->row();
    }
    public function get_unique_location_name(){ 
        $this->db->where('name',$this->input->post('location'));
        if($this->input->post('id') != "0"){
            $this->db->where('id !=',$this->input->post('id'));
        }
        $this->db->where('is_deleted','0');
        $result = $this->db->get('tbl_location');
        echo $result->num_rows();
    }  


    
	public function set_upload_catalogue_img() {
		$config = array();
		$config ['upload_path'] = 'admin_assets/images/catalogue/';
		$config ['allowed_types'] = '*';
		$config ['encrypt_name'] = true;
		return $config;
	} 
    public function add_catalogue($tips_photo){
        for($i=0;$i<count($tips_photo);$i++){
            $data = array(
                'branch_id' 	=> $this->session->userdata('branch_id'),
                'salon_id' 		=> $this->session->userdata('salon_id'),
                'banner'        => $tips_photo[$i], 
                'gender'        => $this->input->post('gender'), 
                'created_on'    => date("Y-m-d H:i:s")
            );
            $this->db->insert('tbl_catalogue',$data);
        }
        return '1';
    } 
    public function get_all_catlogue(){
        $this->db->where('tbl_catalogue.salon_id ',null);
        $this->db->where('tbl_catalogue.branch_id',null);
        $this->db->where('tbl_catalogue.is_deleted','0');
        $this->db->order_by('tbl_catalogue.id','DESC');
        $result = $this->db->get('tbl_catalogue');
        return $result->result();
    } 
    public function get_all_salon_catlogue(){
        $this->db->where('tbl_catalogue.salon_id',$this->session->userdata('salon_id'));
        $this->db->where('tbl_catalogue.branch_id',$this->session->userdata('branch_id'));
        $this->db->where('tbl_catalogue.is_deleted','0');
        $this->db->order_by('tbl_catalogue.id','DESC');
        $result = $this->db->get('tbl_catalogue');
        return $result->result();
    } 
    public function get_single_catlogue(){
        $this->db->where('tbl_catalogue.is_deleted','0');
        $this->db->where('tbl_catalogue.id',$this->uri->segment(2));
        $result = $this->db->get('tbl_catalogue');
        return $result->row();
    }
    public function get_tips_other_titles_ajx(){
        $id = $this->input->post('id');
        $this->db->where('is_deleted','0');
        $this->db->where('tips_id',$id);
        $row = $this->db->get('tbl_tips_titles')->result();
        if(!empty($row)){
        ?>
            <table id="title_example_<?=$id;?>" class="table table-striped">
                <thead>
                    <tr>
                        <th style="width:10%;">Sr. No.</th>
                        <th style="width:30%;">Title</th>
                        <th style="width:60%;">Description</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if(!empty($row)){
                        $k=1;
                        foreach($row as $single_title_details_result){
                    ?>
                    <tr>
                        <td style="width:10%;" scope="row"><?=$k++?></td>
                        <td style="width:30%;"><?=$single_title_details_result->item_name;?></td>
                        <td style="width:60%;"><p><?=$single_title_details_result->description;?></p></td>
                    </tr>
                <?php }}?>
                </tbody>
            </table>
        <?php
        }else{
        ?>
        <div style="text-align:center;">
            <label class="error">Data Not Available</label>
        </div>
        <?php
        }
    }
    
    public function set_money_back_value($value){
        $data = array(
            'money_back_' . $value . '_value' => $this->input->post('money_back_' . $value . '_value'), 
        );
        if($this->input->post('money_back_' . $value . '_value_hidden_value') == ""){
            $date = array( 
                'created_on'    => date("Y-m-d H:i:s")
            );
            $new_arr = array_merge($data,$date);
            $this->db->insert('tbl_back_end_setups',$new_arr);
            return 0;
        }else{
            $this->db->where('id',$this->input->post('money_back_' . $value . '_value_hidden_value'));
            $this->db->update('tbl_back_end_setups',$data);
            return 1;
        }
    } 



    
    //app help management

	public function set_help_section()
	{
		$data = array(
			'help_title'     		=> $this->input->post('help_title'),
			'website_type'     		=> $this->input->post('website_type'),
			'help_description'      => $this->input->post('help_description'),
		);
		if ($this->input->post('id') == "") {
			$date = array(
				'created_on'    => date("Y-m-d H:i:s")
			);
			$new_arr = array_merge($data, $date);
			$this->db->insert('tbl_help_management', $new_arr);
			return 0;
		} else {
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('tbl_help_management', $data);
			return 1;
		}
	}
	public function get_help_section()
	{
		$this->db->where('is_deleted', '0');
		$this->db->where('id', $this->uri->segment(2));
		$result = $this->db->get('tbl_help_management');
		return $result->row();
	}
	public function get_all_help_management_data()
	{
		$this->db->select('tbl_help_management.*');
		$this->db->where('tbl_help_management.is_deleted', '0');
		$this->db->where('tbl_help_management.status', '1');
		$this->db->order_by('tbl_help_management.id', 'DESC');
		$result = $this->db->get('tbl_help_management');
		return $result->result();
	}
	public function get_all_help_management_list_ajax($length, $start, $search)
	{
		$this->db->select('tbl_help_management.*');
		if ($search != "") {
			$this->db->group_start();
			$this->db->or_like('tbl_help_management.help_title', $search);
			$this->db->or_like('tbl_help_management.help_description', $search);
			$this->db->group_end();
		}
		$this->db->where('tbl_help_management.is_deleted', '0');
		$this->db->order_by('tbl_help_management.id', 'DESC');
		$this->db->limit($length, $start);
		$result = $this->db->get('tbl_help_management');
		return $result->result();
	}
	public function get_all_help_management_list_ajax_count($search)
	{
		$this->db->select('tbl_help_management.*');
		if ($search != "") {
			$this->db->group_start();
			$this->db->or_like('tbl_help_management.help_title', $search);
			$this->db->or_like('tbl_help_management.help_description', $search);
			$this->db->group_end();
		}
		$this->db->where('tbl_help_management.is_deleted', '0');
		$this->db->order_by('tbl_help_management.id', 'DESC');
		$result = $this->db->get('tbl_help_management');
		return $result->num_rows();
	}

	public function get_unique_help_title()
	{
		if ($this->input->post('id') != "0") {
			$this->db->where('id !=', $this->input->post('id'));
		}
		$this->db->where('help_title', $this->input->post('help_title'));
		$this->db->where('is_deleted', '0');
		$result = $this->db->get('tbl_help_management');
		echo $result->num_rows();
	}
}    