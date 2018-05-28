<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginController extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('usuariomodel');
     } 

	public function index(){
        $this->load->view('login');
    }

    public function loginAction(){
        $dataform=$this->input->post();
        $usuario=$this->usuariomodel->findByUsernamePassword($dataform['username'], $dataform['password']);
        if($usuario!=null){
            $this->session->set_userdata('username', $usuario->nombre.' '.$usuario->pellido);
            redirect(base_url('panel'));
        }else{
            $this->session->set_flashdata('error', 'Favor verificar su nombre de usuario y/o password');
            redirect(base_url('/'));
        }        
    }
    
    public function logoutAction(){
		$this->session->unset_userdata('username');
        $this->session->sess_destroy();
        $this->session->set_flashdata('info', 'Sesión cerrada correctamente.');
        redirect(base_url('/'));
	}
}
