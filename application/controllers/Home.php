<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller{

    function __construct() {
        parent::__construct();
            $this->load->model('Home_M', 'hm');
        }
    public function index() {
       $data['latest_post'] = $this->hm->GetUserLatestPost(); 
       $data['list_year'] = $this->hm->GetYears(); 
       $data['page_title'] = "Dashboard"; 
       $data['authors'] = array();
       foreach ($data['latest_post'] as $row) {
           $data['authors'][$row['post_author']] = $row['display_name'];
       }
       
       
       $this->LoadPage('home', $data);
    }
    
    public function GetStatValue($date_num, $data){
        foreach ($data as $value) {
            if($date_num == (int)$value->month){
                return (int)$value->count;
            }
        }
        return 0;
    }

    public function GetMonthlyTotalPostByID(){
        $data = $this->hm->GetMonthlyTotalPostByID();
        $chartData = array();
        for($i=1;$i<=12;$i++){
            $row = array();
            $row['y'] = date('F', mktime(0, 0, 0, $i, 10));
            $row['a'] = $this->GetStatValue($i, $data);
            $chartData[] = $row;        
        }
        echo json_encode($chartData);
    }
    
    public function GetMonthlyTotalPost(){
        $data = $this->hm->GetMonthlyTotalPost();
        $chartData = array();
        for($i=1;$i<=12;$i++){
            $row = array();
            $row['y'] = date('F', mktime(0, 0, 0, $i, 10));
            $row['a'] = $this->GetStatValue($i, $data);
            $chartData[] = $row;        
        }
        echo json_encode($chartData);
    }
    
    public function GetDailyTotalPostByID(){
        $numDays = cal_days_in_month(CAL_GREGORIAN, $this->input->post('month'), date("Y"));
        $chartData = array();
        $data = $this->hm->GetDailyTotalPostByID();
        for($i=1;$i<=$numDays;$i++){
            $row = array();
            $row['y'] = (string)$i;
            $row['a'] = $this->GetDailyStatValue($i, $data);
            $chartData[] = $row; 
        }
        echo json_encode($chartData);
    } 
    
    public function GetDailyStatValue($day, $days){
        foreach ($days as $value) {
            if($day == (int)$value->day){
                return (int)$value->count;
            }
        }
        return 0;
    }
    
    public function GetDailyTotalPost(){
        $numDays = cal_days_in_month(CAL_GREGORIAN, $this->input->post('month'), date("Y"));
        $chartData = array();
        $data = $this->hm->GetDailyTotalPost();
        for($i=1;$i<=$numDays;$i++){
            $row = array();
            $row['y'] = (string)$i;
            $row['a'] = $this->GetDailyStatValue($i, $data);
            $chartData[] = $row; 
        }
        echo json_encode($chartData);
    } 
    
}



