<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PanelController extends CI_Controller {

    function __construct(){
        parent::__construct();
		$this->login->verifyUser();
     } 

	public function index(){
        $this->load->view('panel');
    }
}
