<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PrediccionController extends CI_Controller {

    private $title;

    function __construct(){
        parent::__construct();
        $this->login->verifyUser();
        $this->load->model('anioagricolamodel');
        $this->load->model('aniosmodel');
        $this->load->library('prediccion');
        $this->title="Módulo de Predicción";
    } 

	public function index(){
        $countanios=$this->aniosmodel->countAll();
        if($countanios<MIN_ANIOS){
            $this->session->set_flashdata('warning', 'Para realizar una predicción necesita como minimo los datos de tres años agricolas.');
        }
        $data['meses']=array('JULIO'=>'JULIO','AGOSTO'=>'AGOSTO','SEPTIEMBRE'=>'SEPTIEMBRE','OCTUBRE'=>'OCTUBRE','NOVIEMBRE'=>'NOVIEMBRE','DICIEMBRE'=>'DICIEMBRE','ENERO'=>'ENERO','FEBRERO'=>'FEBRERO','MARZO'=>'MARZO','MARZO'=>'MARZO','ABRIL'=>'ABRIL','MAYO'=>'MAYO','JUNIO'=>'JUNIO');        
        $data['messelect']='JULIO';
        $data['dias_mes']=$this->generarDias();
        $data['title']=$this->title;
        $data['diaselect']=1;
        //print_r($this->generarDias());
        $this->load->view('prediccion/formulario_view', $data);       
    }

    private function generarDias(){
        $dias_mes=array();
        for($i=1; $i<=31; $i++){
            $dias_mes[$i]=$i;
        }
        return $dias_mes;
    }

    public function calcularAction(){
        $countanios=$this->aniosmodel->countAll();
        if($countanios<MIN_ANIOS){
            $this->session->set_flashdata('error', 'Para realizar una predicción necesita como minimo los datos de tres años agricolas.');
        }else{
            $mes_form=$this->input->post('mes');
            $dia_form=$this->input->post('dia');
            // print_r($this->dias);
            $data=$this->prediccion->obtenerValoresPrediccion($this->anioagricolamodel->findByMesDia($mes_form, $dia_form));
        }
        $data['meses']=array('JULIO'=>'JULIO','AGOSTO'=>'AGOSTO','SEPTIEMBRE'=>'SEPTIEMBRE','OCTUBRE'=>'OCTUBRE','NOVIEMBRE'=>'NOVIEMBRE','DICIEMBRE'=>'DICIEMBRE','ENERO'=>'ENERO','FEBRERO'=>'FEBRERO','MARZO'=>'MARZO','MARZO'=>'MARZO','ABRIL'=>'ABRIL','MAYO'=>'MAYO','JUNIO'=>'JUNIO');        
        $data['messelect']=$mes_form;
        $data['dias_mes']=$this->generarDias();
        $data['diaselect']=$dia_form;    
        $data['title']=$this->title;
        $this->load->view('prediccion/formulario_view', $data);    
    }

    
    public function graficarPrediccionAction(){
        $data['meses']=array('JULIO'=>'JULIO','AGOSTO'=>'AGOSTO','SEPTIEMBRE'=>'SEPTIEMBRE','OCTUBRE'=>'OCTUBRE','NOVIEMBRE'=>'NOVIEMBRE','DICIEMBRE'=>'DICIEMBRE','ENERO'=>'ENERO','FEBRERO'=>'FEBRERO','MARZO'=>'MARZO','MARZO'=>'MARZO','ABRIL'=>'ABRIL','MAYO'=>'MAYO','JUNIO'=>'JUNIO');        
        $data['messelect']='JULIO';
        $data['title']='Grafica Predicciones';
        $this->load->view('graficas/predicciones_view', $data);  
    }

    public function graficarDatosAction(){
        $mes_form=$this->input->post('mes');
        echo $mes_form;
        // $result_set=$this->convertToArray($this->anioagricolamodel->findByAnioMes($anio_form, $mes_form));        
        // echo json_encode($result_set);
    }
}