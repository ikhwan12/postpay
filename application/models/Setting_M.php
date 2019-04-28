<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting_M extends CI_Model {

    function __construct() {
        parent::__construct();
            $this->load->database();
        }

    function GetSettingData(){
        $data = array();
        $result = $this->db->get('wp_postpay_setting');
        foreach ($result->result() as $row) {
            if($row->post_pay_key == 'allowed_post_status'){
                $data[$row->post_pay_key] = $this->BuildPostStatusCheckBox($row->post_pay_value);
            }elseif($row->post_pay_key == 'allowed_types'){
                $data[$row->post_pay_key] = $this->BuildPostTypeCheckBox($row->post_pay_value);
            }elseif($row->post_pay_key == 'allowed_roles'){
                $data[$row->post_pay_key] = $this->BuildUserRoleCheckBox($row->post_pay_value);
            }else{
                $data[$row->post_pay_key] = $row->post_pay_value;
            }
        }
        return $data;
    } 
       
    function BuildPostTypeCheckBox($value){
        $checkBox = array();
        $selected = explode(';', $value);
        $types = $this->GetAllPostTypes();
        foreach ($types as $type) {
            if(in_array($type->post_type, $selected)){
                $checkBox[$type->post_type] = TRUE;
            }else{
                $checkBox[$type->post_type] = FALSE;
            }
        }    
        return $checkBox;
    }
    
    function BuildUserRoleCheckBox($value){
        $checkBox = array();
        $selected = explode(';', $value);
        $types = $this->GetAllUserRoles();
        foreach ($types as $type) {
            if(in_array($type, $selected)){
                $checkBox[$type] = TRUE;
            }else{
                $checkBox[$type] = FALSE;
            }
        }    
        return $checkBox;
    }
    
   function BuildPostStatusCheckBox($value){
        $checkBox = array();
        $selected = explode(';', $value);
        $types = $this->GetAllPostStatus();
        foreach ($types as $type) {
            if(in_array($type->post_status, $selected)){
                $checkBox[$type->post_status] = TRUE;
            }else{
                $checkBox[$type->post_status] = FALSE;
            }
        }    
        return $checkBox;
    }
    
    function GetAllPostTypes(){
        $this->db->select('DISTINCT(post_type)');
        $this->db->order_by('post_type','asc');
        $result = $this->db->get('wp_posts');
        return $result->result();
    }
    
     function GetAllUserRoles(){
        $roles = array(); 
        $this->db->select('DISTINCT(meta_value)');
        $this->db->where('meta_key', 'wp_capabilities');
        $result = $this->db->get('wp_usermeta');
        foreach ($result->result() as $value) {
            $temp = explode(":",$value->meta_value)[4];
            array_push($roles, str_replace('"','',explode(';',$temp)[0]));
        }
        return $roles;
    }
    
    function GetAllPostStatus(){
        $this->db->select('DISTINCT(post_status)');
        $this->db->order_by('post_status','asc');
        $result = $this->db->get('wp_posts');
        return $result->result();
    }
    
    function SetSalary(){
        $post = $this->input->post();
        if(sizeof($post) > 0){
            foreach ($post as $key => $value) {
                $this->db->where('post_pay_key', $key);
                $this->db->update('wp_postpay_setting', array('post_pay_value' => $value));
            }
        }
    }
    
    function SetAllowedPostType(){
        $post = $this->input->post('allowed_types');
        if(sizeof($post) > 0){
            $types = "";
            for($i=0;$i<sizeof($post);$i++){
                if($i < sizeof($post)-1){
                    $types .= $post[$i].";";
                }else{
                    $types .= $post[$i];
                }
            }
            if($types != ""){
                $this->db->where('post_pay_key', 'allowed_types');
                $this->db->update('wp_postpay_setting', array('post_pay_value' => $types));
            }
        }
    }
    
    function SetAllowedRoles(){
        $post = $this->input->post('allowed_roles');
        if(sizeof($post) > 0){
            $types = "";
            for($i=0;$i<sizeof($post);$i++){
                if($i < sizeof($post)-1){
                    $types .= $post[$i].";";
                }else{
                    $types .= $post[$i];
                }
            }
            if($types != ""){
                $this->db->where('post_pay_key', 'allowed_roles');
                $this->db->update('wp_postpay_setting', array('post_pay_value' => $types));
            }
        }
    }
    
    function SetAllowedPostStatus(){
        $post = $this->input->post('allowed_post_status');
        if(sizeof($post) > 0){
            $types = "";
            for($i=0;$i<sizeof($post);$i++){
                if($i < sizeof($post)-1){
                    $types .= $post[$i].";";
                }else{
                    $types .= $post[$i];
                }
            }
            if($types != ""){
                $this->db->where('post_pay_key', 'allowed_post_status');
                $this->db->update('wp_postpay_setting', array('post_pay_value' => $types));
            }
        }
    }
    
}