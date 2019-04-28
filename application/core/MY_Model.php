<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Model extends CI_Model {
    
    protected $_tabel = '';
    
            
    function __construct() {
        parent::__construct();
        $this->load->database();
       
    }
    
    function get(){
        $result = $this->db->get($this->_tabel);
        return $result->result();
    }
    
    function get_list($key, $value, $empty_selection) {
        
        $query = $this->db->get($this->_tabel);
        $list = array();
        $list[''] = $empty_selection;
        if($query->result()){
           
            foreach ($query->result() as $item) {
                $list[$item->$key] = $item->$value;
            }
          
        } 

        return $list;
      
    }
    
    function add($data){
        $inserted = $this->db->insert($this->_tabel, $data);     
        return $inserted;
    }
    
    function detail($kolom, $id){
        $this->db->where($kolom, $id);
        $result = $this->db->get($this->_tabel);
        $data = array();
        if($result->result()){
            $data = $result->row();
        }
        return $data;
    }
    
     function update($kolom, $id, $data){
       
        $this->db->where($kolom, $id);
        $this->db->update($this->_tabel, $data);
        $jum_ubah = $this->db->affected_rows();
        
        if($jum_ubah == 1){
            return TRUE;
        }else{
            return TRUE;
        }
        
        
    }
   
    function delete($kolom, $id){
        
        $this->db->delete($this->_tabel, array($kolom => $id));
        $jum_hapus = $this->db->affected_rows();
        
        if($jum_hapus == 1){
            return TRUE;
        }
        
        return FALSE;
        
    }
    
}
