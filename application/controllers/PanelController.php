<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PanelController extends CI_Controller {

    private $title;

    function __construct(){
        parent::__construct();
        $this->login->verifyUser();
        $this->title="Panel de Control";
     } 

	public function index(){
        $data['title']=$this->title;
        $this->load->view('panel', $data);
    }
}
