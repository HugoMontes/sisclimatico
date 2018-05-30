<?php
defined("BASEPATH") or die("El acceso al script no está permitido");
class Login{

    private $CI;
    
    public function __construct(){
        $this->CI =& get_instance();
    }
    
    public function verifyUser(){
        if(!$this->CI->session->userdata('username')){
            redirect('login', 'refresh');
        }
    }
}
