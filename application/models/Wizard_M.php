<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wizard_M extends CI_Model {
    
    function __construct() {
        parent::__construct();
            $this->load->database();
        }
    
    function IsSettingTableCreated(){
        if ($this->db->table_exists('wp_postpay_setting')) {
            return TRUE;
        }
        return FALSE;
    } 
    
    function CreateAdditionalTable(){
        $this->load->dbforge();
        $attributes = array('ENGINE' => 'InnoDB');  
        $base_salary = $this->input->post('base-salary');
        $salary_per_post = $this->input->post('salary-per-post');
        
         //CREATE POST_PAY_SETTING TABLE 
        $pp = array(
          'post_pay_key' => array(
            'type' => 'VARCHAR',
            'constraint' => 255
          ),
          'post_pay_value' => array(
            'type' => 'VARCHAR',
            'constraint' => 255
          )
        );
        $this->dbforge->add_field($pp);
        $this->dbforge->add_key('post_pay_key',TRUE);
        $this->dbforge->create_table('wp_postpay_setting',TRUE,$attributes);
        
        $data = array(
            'base_salary' => $base_salary,
            'salary_per_post' => $salary_per_post,
            'allowed_types' => "post",
            'allowed_post_status' => "publish",
            'allowed_roles' => "author"
        );
        
        foreach ($data as $key => $value) {
             $pairs = array(
                 'post_pay_key' => $key,
                 'post_pay_value' => $value,
             );    
             $this->db->insert('wp_postpay_setting', $pairs);
        }
        return TRUE;
    }
    
}