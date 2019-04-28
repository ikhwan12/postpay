<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_M extends CI_Model {

    function __construct() {
        parent::__construct();
            $this->load->database();
            $this->load->helper('passwordhash');
        }

    function IsAdmin($id){
        $this->db->where('(meta_key = "wp_capabilities" OR meta_key = "wp_user_level")', NULL, FALSE);
        $this->db->where('user_id', $id);
        $results = $this->db->get('wp_usermeta');
        
        if($results->num_rows() > 0){
            $capability = NULL;        
            $user_level = -1;    
            foreach ($results->result_array() as $result) {
                if ($result['meta_key'] == 'wp_capabilities'){
                    $temp = explode(":", $result['meta_value']);
                    $capability = explode(";", $temp[4])[0];
                }elseif ($result['meta_key'] == 'wp_user_level'){
                    $user_level = $result['meta_value'];
                }
            }
            return $capability == '"administrator"' && $user_level == 10;
        }
        return FALSE;
    } 
                
    function CheckLogin(){
        $data = array();
        $wp_hasher = new PasswordHash(16, true); 
        $login_id = $this->input->post('login-id');
        $login_password = $this->input->post('login-password');
        
        $this->db->select('ID, user_pass, display_name');
        $this->db->where('user_login', $login_id);
        $this->db->or_where('user_email', $login_id);
        $result = $this->db->get('wp_users');
        
        if($result->num_rows() == 1){ 
            if($wp_hasher->CheckPassword($login_password, $result->row(0)->user_pass) == TRUE){
                if ($this->IsAdmin($result->row(0)->ID) == TRUE){
                    $data['status']  = TRUE;
                    $data['message'] = "Login";
                    $data['name'] = $result->row(0)->display_name;
                    $data['pict'] = $this->GetProfilePict($result->row(0)->ID);
                }else{
                    $data['status']  = False;
                    $data['message'] = "Sorry you're not an Administrator.";
                }
            }else{
                $data['status']  = False;
                $data['message'] = "Wrong Password";
            }
        }else{
            $data['status']  = False;
            $data['message'] = "User Not Exist";
        }
        return $data;
        
    }
        
    function GetProfilePict($id){
        $this->db->select('photourl');
        $this->db->where('user_id', $id);
        $result = $this->db->get('wp_wslusersprofiles');
        if($result->num_rows() == 1){
            return $result->row(0)->photourl;
        }
        return base_url('assets/img/default.png');
    }   
    
    
}