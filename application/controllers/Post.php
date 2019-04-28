<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post extends MY_Controller{
    
    function __construct() {
        parent::__construct();
            $this->load->model('Payment_M', 'pm');
        }
        
    public function detail($id="",$start_date="",$end_date="") {
       $name = $this->pm->GetUserDetail($id, 'display_name'); 
       $data['page_title'] = 'Post Detail';  
       $data['table_title'] = "Posts by ".  ucwords($name);  
       $data['table_subtitle'] = "From ".$this->FormatDate($start_date, "j F Y")." until ".$this->FormatDate($end_date, "j F Y");  
       $this->LoadPage('post', $data);
    }      


    public function PostDetail($id="",$start_date="",$end_date=""){
        $webpage = "http://nihaoindo.com/";
        $data = array();
        $items =  $this->pm->GetUserPostDetail($id,$start_date,$end_date);
        $i = 0;
        foreach ($items as $item) {
            $i++;
            $row = array();
            $row[]  = $item->ID;
            $row[]  = '<a href="javascript:void(0);" onclick="GoToPost('."'".$webpage."/".$item->post_name."'".')">'.$item->post_title."</a>";
            $row[]  = $this->FormatDate($item->post_date, "j F Y");
            $row[]  = $this->UpperCaseWords($item->post_type);
            $row[]  = $this->UpperCaseWords($item->post_status);
            $data[] = $row;
        }    
        echo json_encode($data);     
    }        
    
}



