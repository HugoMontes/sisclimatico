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
        $data['meses']=array('JULIO'=>'JULIO','AGOSTO'=>'AGOSTO','SEPTIEMBRE'=>'SEPTIEMBRE','OCTUBRE'=>'OCTUBRE','NOVIEMBRE'=>'NOVIEMBRE','DICIEMBRE'=>'DICIEMBRE','ENERO'=>'ENERO','FEBRERO'=>'FEBRERO','MARZO'=>'MARZO','MARZO'=>'MARZO','ABRIL'=>'ABRIL','MAYO'=>'MAYO','JUNIO'=>'JUNIO');        
        $data['messelect']='JULIO';
        $data['dias']=$this->generarDias();
        $data['diaselect']=1;
        $data['fecha']=date('d/m/Y');
        $data['title']=$this->title;
        $this->load->view('panel', $data);
    }

    private function generarDias(){
        $dias_mes=array();
        for($i=1; $i<=31; $i++){
            $dias_mes[$i]=$i;
        }
        return $dias_mes;
    }
}
