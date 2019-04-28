<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
       
    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('Wizard_M', 'wm');
        if(!$this->session->userdata('loggedIn')){
            redirect('login');
        }
        if($this->wm->IsSettingTableCreated() == FALSE && $this->uri->segment(1) != 'wizard' ){
            redirect('wizard');
        }
    }
    
    function LoadPage($page, $data=array()){
        $this->load->view('inc/head',$data);
        $this->load->view('inc/header');
        $this->load->view('inc/nav');
        $this->load->view($page);
        $this->load->view('inc/footer');
        $this->load->view('inc/javascript');
    }
    
    function UpperCaseWords($words){
        return ucwords($words);
    }
    
    function FormatDate($date, $format){
        return date($format, strtotime( $date ));
    }
    
    function formatNumber($value, $decimal_place){
        return number_format($value, $decimal_place, '.', ',');
    }

}
