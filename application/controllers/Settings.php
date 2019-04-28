<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends MY_Controller{

    function __construct() {
        parent::__construct();
             $this->load->model('Setting_M', 'sm');
        }
        
    public function index() {
       $data = $this->sm->GetSettingData();    
       $data['page_title'] = "Settings"; 
       $this->LoadPage('settings', $data);
    }
    
    public function SetSalary(){
        $this->sm->SetSalary();
        redirect('settings');
    }
    
    public function SetAllowedPostType(){
        $this->sm->SetAllowedPostType();
        redirect('settings');
    }
    
    public function SetAllowedRoles(){
        $this->sm->SetAllowedRoles();
        redirect('settings');
    }
    
    public function SetAllowedPostStatus(){
        $this->sm->SetAllowedPostStatus();
        redirect('settings');
    }
    
}



