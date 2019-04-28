<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends MY_Controller{

    function __construct() {
        parent::__construct();
            $this->load->model('Payment_M', 'pm');
        }
    public function index() {
       $data['page_title'] = "Payment";  
       $this->LoadPage('payment', $data);
    }

    public function IsInAllowedRoles($role, $roles){
        $role = $this->FormatRole($role);
        if(in_array($role, $roles)){
            return TRUE;
        }
        return FALSE;
    }
    
    public function FormatRole($role){
        return str_replace('"',"",explode(';',explode(':', $role)[4])[0]);
    }

    public function GetTableData($start_date="", $end_date=""){
        
        if($this->input->post('range') != NULL){
            $date = explode(";", $this->input->post('range'));
            $start_date = $date[0];
            $end_date = $date[1];
        }
        
        $salary_setting = $this->pm->GetSalarySetting();
        $allowed_roles  = $this->pm->GetAllowedRoles();
        $data = array();
        $items =  $this->pm->CountUserPost($start_date, $end_date);
        $i = 0;
        foreach ($items as $item) {
            if($this->IsInAllowedRoles($item->meta_value, $allowed_roles)){
                $i++;
                $post_salary = $item->post_count*(int)$salary_setting[1]->post_pay_value;
                $row = array();
                $row[] = $i;
                $row[] = '<a href="'.  site_url('post/detail/'.$item->post_author.'/'.$start_date.'/'.$end_date).'">'.$item->display_name."</a>";
                $row[] = ucwords(str_replace("_", " ", $this->FormatRole($item->meta_value)));
                $row[] = $item->user_email;
                $row[] = $this->formatNumber($item->post_count, 0);
                $row[] = $this->formatNumber($post_salary, 2);
                $row[] = $this->formatNumber($post_salary + (int)$salary_setting[0]->post_pay_value, 2);
                $data[] = $row;
            }
        }    
        
        echo json_encode($data);     
    }        
    
    public function GetUserPostDetail(){
        $data = array();
        $items =  $this->pm->GetUserPostDetail();
        $i = 0;
        foreach ($items as $item) {
            $i++;
            $row = array();
            $row[]  = $i;
            $row[]  = $item->ID;
            $row[]  = $item->post_title;
            $row[]  = $item->post_date;
            $row[]  = $item->post_type;
            $row[]  = $item->post_status;
            $data[] = $row;
        }    
        echo json_encode($data);     
    }      
    
}



