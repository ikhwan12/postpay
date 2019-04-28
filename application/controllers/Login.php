<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
            $this->load->helper('url');
             $this->load->library('session');
            $this->load->model('Login_M', 'lm');
        }
    public function index() {
        if($this->session->userdata('loggedIn')){
            redirect('home');
        }else{
            $data = array(
                'action' => site_url('login/CheckLogin'),
                'captcha' => $this->recaptcha->getWidget(), 
                'script_captcha' => $this->recaptcha->getScriptTag() 
            );
            $this->load->view('login', $data);
        }
    }
    
    public function CheckLogin(){
        
        $recaptcha = $this->input->post('g-recaptcha-response');
        $response = $this->recaptcha->verifyResponse($recaptcha);
        
        if(!isset($response['success']) || $response['success'] <> true){
            redirect();
        }
        
        $status = $this->lm->CheckLogin(); 
        if($status['status'] == TRUE){
            $this->session->set_userdata(array(
                'loggedIn'=> TRUE,
                'name'=> $status['name'],
                'pict'=> $status['pict']
                ));
            redirect('home');
        }else{
            $this->session->set_flashdata('login_error', 'TRUE');
            $this->session->set_flashdata('login_error_message', $status['message']);
            redirect('login');
        }
    }
    
    function Logout(){
        $this->session->sess_destroy();
        redirect('login');
    }
}



