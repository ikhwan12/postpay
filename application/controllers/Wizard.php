<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wizard extends MY_Controller{

    function __construct() {
        parent::__construct();
            
        }
    public function index() {
       $data['isAdded'] = $this->wm->IsSettingTableCreated();   
       $data['page_title'] = "Wizard"; 
       $this->LoadPage('wizard', $data);
    }
    
    public function CreateAdditionalTable(){
        $status = $this->wm->CreateAdditionalTable();
        if($status){
            redirect('wizard');
        }
    }
    
}



