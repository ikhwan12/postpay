<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment_M extends CI_Model {

    function __construct() {
        parent::__construct();
            $this->load->database();
        }

    function GetSalarySetting(){
        $this->db->where('post_pay_key', 'base_salary');
        $this->db->or_where('post_pay_key', 'salary_per_post');
        $result = $this->db->get('wp_postpay_setting');
        return $result->result();
    } 
    
    function GetAllowedRoles(){
        $this->db->where('post_pay_key', 'allowed_roles');
        $row = $this->db->get('wp_postpay_setting')->row();
        if (isset($row)){
            return explode(';', $row->post_pay_value);
        }
        return array();
    } 
                
    function CountUserPost($start_date="", $end_date=""){
        $this->db->where('post_pay_key', 'allowed_post_status');
        $this->db->or_where('post_pay_key', 'allowed_types');
        $result = $this->db->get('wp_postpay_setting');
        
        $this->db->select("post_author, display_name, user_email, COUNT(p.ID) as post_count, meta_value");
        $this->db->join("wp_usermeta m", "p.post_author = m.user_id", 'left');
        $this->db->join("wp_users u", "p.post_author = u.ID", 'left');
        if($result->num_rows()>0){
            $this->PreparePostTypeStatement($result->result());
            $this->PreparePostStatusStatement($result->result());
        }
        $this->db->where("meta_key","wp_capabilities");
        if($start_date != "" && $end_date != ""){
             $this->db->where("DATE_FORMAT(post_date, '%Y-%m-%d') BETWEEN '".$start_date."' AND '".$end_date."' ", NULL, FALSE);
        } 
        $this->db->group_by("post_author");
        $result = $this->db->get("wp_posts p");
        return $result->result();
    } 
    
    function GetUserPostDetail($id="",$start_date="",$end_date=""){
        
        $this->db->where('post_pay_key', 'allowed_post_status');
        $this->db->or_where('post_pay_key', 'allowed_types');
        $result = $this->db->get('wp_postpay_setting');
        
        $this->db->select("ID, post_date, post_name, post_title, post_status, post_type");
        if($result->num_rows()>0){
            $this->PreparePostTypeStatement($result->result());
            $this->PreparePostStatusStatement($result->result());
        }
        $this->db->where("post_author", $id);
        if($start_date != "" && $end_date != ""){
             $this->db->where("DATE_FORMAT(post_date, '%Y-%m-%d') BETWEEN '".$start_date."' AND '".$end_date."' ", NULL, FALSE);
        } 
        $result = $this->db->get("wp_posts");
        return $result->result();
    }
            
    function PreparePostTypeStatement($result){
        $types = explode(';', $result[1]->post_pay_value);
        $size = sizeof($types);
        if($size > 0){
            $type_where_exp = "(";
            for($i = 0; $i < $size; $i++){
                if($i < $size-1){
                    $type_where_exp .= "post_type = '".$types[$i]."' OR ";    
                }else{
                    $type_where_exp .= "post_type = '".$types[$i]."'";
                }
            }
            $type_where_exp .= ")";
            $this->db->where($type_where_exp, NULL, FALSE);
        }
    }
    
    function PreparePostStatusStatement($result){
        $status = explode(';', $result[0]->post_pay_value);
        $size = sizeof($status);
        if($size > 0){
            $status_where_exp = "(";
            for($i = 0; $i < $size; $i++){
                if($i < $size-1){
                    $status_where_exp .= "post_status = '".$status[$i]."' OR ";    
                }else{
                    $status_where_exp .= "post_status = '".$status[$i]."'";
                }
            }
            $status_where_exp .= ")";
            $this->db->where($status_where_exp, NULL, FALSE);
        }
    }
    
    public function GetUserDetail($id, $field){
        $this->db->select($field);
        $this->db->where('ID', $id);
        $row = $this->db->get('wp_users')->row();
        if(isset($row)){
            return $row->$field;
        }
        return "";
    }
    
}