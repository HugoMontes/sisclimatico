<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AnioAgricolaController extends CI_Controller {

    private $title;

    function __construct(){
        parent::__construct();
        $this->login->verifyUser();
        $this->title="Año Agricola";
     } 

	public function index(){
        $data['title']=$this->title;
        $this->load->view('anioagricola/listado_view', $data);
    }
}