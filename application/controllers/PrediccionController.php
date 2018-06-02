<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PrediccionController extends CI_Controller {

    private $title;

    function __construct(){
        parent::__construct();
        $this->login->verifyUser();
        $this->load->model('fenomenomodel');
        $this->load->model('aniosmodel');
        $this->title="Módulo de Predicción";
    } 

	public function index(){
        $countanios=$this->aniosmodel->countAll();
        if($countanios<MIN_ANIOS){
            $this->session->set_flashdata('warning', 'Para realizar una predicción necesita como minimo los datos de tres años agricolas.');
        }
        $data['hoy']=date("d/m/Y");        
        $data['title']=$this->title;
        $this->load->view('prediccion/formulario_view', $data);       
    }

    public function calcular(){
        $countanios=$this->aniosmodel->countAll();
        if($countanios<MIN_ANIOS){
            $this->session->set_flashdata('error', 'Para realizar una predicción necesita como minimo los datos de tres años agricolas.');
        }else{
            $fecha=$this->input->post('fecha');
            // print_r($fecha);
        }
        $data['hoy']=$fecha;        
        $data['title']=$this->title;
        $this->load->view('prediccion/formulario_view', $data);    
    }
}