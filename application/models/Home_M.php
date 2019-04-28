<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_M extends CI_Model {
    
    function __construct() {
        parent::__construct();
            $this->load->database();
        }
    
    function GetAllowedRoles(){
        $this->db->where('post_pay_key', 'allowed_roles');
        $row = $this->db->get('wp_postpay_setting')->row();
        if (isset($row)){
            return explode(';', $row->post_pay_value);
        }
        return array();
    }     
    
    public function GetYears(){
        $this->db->select("DISTINCT(YEAR(`post_date`)) as years");
        $result = $this->db->get("wp_posts");
        return $result->result();
    }

    public function IsInAllowedRoles($role, $roles){
        if(in_array($role, $roles)){
            return TRUE;
        }
        return FALSE;
    }
    
    function GetUserLatestPost(){
        $this->db->where('post_pay_key', 'allowed_post_status');
        $this->db->or_where('post_pay_key', 'allowed_types');
        $result = $this->db->get('wp_postpay_setting');
        
        $allowed_roles  = $this->GetAllowedRoles();
        
        $this->db->select("post_author, post_title, post_name, display_name, user_email, MAX(post_date) as post_date, meta_value, photourl");
        $this->db->join("wp_usermeta m", "p.post_author = m.user_id", 'left');
        $this->db->join("wp_users u", "p.post_author = u.ID", 'left');
        $this->db->join("wp_wslusersprofiles w", "p.post_author = w.user_id", 'left');
        if($result->num_rows()>0){
            $this->PreparePostTypeStatement($result->result());
            $this->PreparePostStatusStatement($result->result());
        }
        $this->db->where("meta_key","wp_capabilities");
        $this->db->group_by("post_author");
        $result = $this->db->get("wp_posts p");
        $data = array();
        foreach ($result->result() as $item) {
            $row = array();
            $role = "";
            foreach ($item as $key => $value) {
                if($key == 'post_date'){
                    $row[$key] = date("M j, Y h:m a", strtotime($value));
                }elseif($key == 'meta_value'){
                    $role = str_replace('"', '', explode(';', explode(":", $value)[4])[0]);
                    $row[$key] = ucwords(str_replace('_',' ', str_replace('wp', '', $role)));
                }elseif($key == 'photourl' && $value==NULL){
                    $row[$key] = base_url('assets/img/default.png');
                }else{
                    $row[$key] = $value;
                }
            }
            if($this->IsInAllowedRoles($role, $allowed_roles)){
                $data[] = $row;
            }
        }
        return $data;
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
    
    function GetMonthlyTotalPostByID(){
        $this->db->where('post_pay_key', 'allowed_post_status');
        $this->db->or_where('post_pay_key', 'allowed_types');
        $result = $this->db->get('wp_postpay_setting');
        
        $this->db->select("post_author, display_name, YEAR(post_date) as year, MONTH(post_date) as month, COUNT(p.ID) as count");
        $this->db->join("wp_users u", "p.post_author = u.ID", "left");
        if($result->num_rows()>0){
            $this->PreparePostTypeStatement($result->result());
            $this->PreparePostStatusStatement($result->result());
        }
        if($this->input->post('id') !=  NULL){
             $this->db->where("post_author", $this->input->post('id'));
        }
        $this->db->where("YEAR(post_date) = ". $this->input->post('year'), NULL, FALSE);
        $this->db->group_by("YEAR(`post_date`), MONTH(`post_date`), `post_author`");
        $this->db->order_by("YEAR(`post_date`), MONTH(`post_date`)", "asc");
        $result2 = $this->db->get("wp_posts p");        
        return $result2->result();
    }
    
    function PreparePostAuthorStatement($ids){
        $size = sizeof($ids);
        $type_where_exp = "(";
        for($i = 0; $i < $size; $i++){
            if($ids[$i] == ""){continue;}
            if($i < $size-1){
                $type_where_exp .= "post_author = '".$ids[$i]."' OR ";    
            }else{
                $type_where_exp .= "post_author = '".$ids[$i]."'";
            }
        }
        $type_where_exp .= ")";
        $this->db->where($type_where_exp, NULL, FALSE);
    }
            
    function GetMonthlyTotalPost(){
        $this->db->where('post_pay_key', 'allowed_post_status');
        $this->db->or_where('post_pay_key', 'allowed_types');
        $result = $this->db->get('wp_postpay_setting');
        
        $this->db->select("post_author, display_name, YEAR(post_date) as year, MONTH(post_date) as month, COUNT(p.ID) as count");
        $this->db->join("wp_users u", "p.post_author = u.ID", "left");
        if($result->num_rows()>0){
            $this->PreparePostTypeStatement($result->result());
            $this->PreparePostStatusStatement($result->result());
            $this->PreparePostAuthorStatement($this->input->post('ids'));
        }
        $this->db->where("YEAR(post_date) = ".  $this->input->post('year'), NULL, FALSE);
        $this->db->group_by("year, month");
        $this->db->order_by("year, month", "asc");
        $result2 = $this->db->get("wp_posts p"); 
        return $result2->result();
    }
    
    function GetDailyTotalPostByID(){
        $this->db->where('post_pay_key', 'allowed_post_status');
        $this->db->or_where('post_pay_key', 'allowed_types');
        $result = $this->db->get('wp_postpay_setting');
        
        $this->db->select("post_author, YEAR(post_date) as year, MONTH(post_date) as month, DAY(post_date) as day, COUNT(p.ID) as count");
        $this->db->join("wp_users u", "p.post_author = u.ID", "left");
        if($result->num_rows()>0){
            $this->PreparePostTypeStatement($result->result());
            $this->PreparePostStatusStatement($result->result());
        }
        $this->db->where("post_author", $this->input->post('ids'));
        $this->db->where("MONTH(post_date) = ". $this->input->post('month'), NULL, FALSE);
        $this->db->where("YEAR(post_date) = ".  $this->input->post('year'), NULL, FALSE);
        $this->db->group_by("year, month, day");
        $this->db->order_by("year, month, day", "asc");
        $result2 = $this->db->get("wp_posts p"); 
        return $result2->result();
    }
    
    function GetDailyTotalPost(){
        $this->db->where('post_pay_key', 'allowed_post_status');
        $this->db->or_where('post_pay_key', 'allowed_types');
        $result = $this->db->get('wp_postpay_setting');
        
        $this->db->select("post_author, YEAR(post_date) as year, MONTH(post_date) as month, DAY(post_date) as day, COUNT(p.ID) as count");
        $this->db->join("wp_users u", "p.post_author = u.ID", "left");
        if($result->num_rows()>0){
            $this->PreparePostTypeStatement($result->result());
            $this->PreparePostStatusStatement($result->result());
            $this->PreparePostAuthorStatement($this->input->post('ids'));
        }
        $this->db->where("MONTH(post_date) = ". $this->input->post('month'), NULL, FALSE);
        $this->db->where("YEAR(post_date) = ".  $this->input->post('year'), NULL, FALSE);
        $this->db->group_by("year, month, day");
        $this->db->order_by("year, month, day", "asc");
        $result2 = $this->db->get("wp_posts p"); 
        return $result2->result();
    }
    
}