<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AnioAgricolaController extends CI_Controller {

    private $title;

    function __construct(){
        parent::__construct();
        $this->login->verifyUser();
        $this->load->model('anioagricolamodel');
        $this->load->model('aniosmodel');
        $this->title="Año Agricola";
    } 

	public function index(){
        $idanio=1;
        redirect(base_url('anioagricola/buscar/anio/'.$idanio));
    }

    public function cargarAnioAgricolaAction($idanio){
        $data['anios']=$this->aniosRangeToItems($this->aniosmodel->findAll());
        $data['diasagricolas']=$this->anioagricolamodel->findByAnio($idanio);
        $data['siguienteanio']=$this->aniosmodel->nextAnioAgricola();
        $data['title']=$this->title;
        $data['anioselect']=$idanio;
        $this->load->view('anioagricola/listado_view', $data);
    }

    public function subirExcelAction(){
        $config['upload_path'] = './resources/uploads/';
        $config['allowed_types'] = 'xlsx|xls';
        $config['max_size'] = '1024'; // 1 MB
        $config['file_name'] = 'upload_' . time();
        $this->load->library('upload', $config);
        if(!$this->upload->do_upload('excelfile')) {
            $this->session->set_flashdata('error', $this->upload->display_errors()); 
        }else {
            $array_data=$this->excelToArray();
            if($this->validaExcel($array_data)){
                $array_data=$this->calcularAcumuladas($array_data);
                if($this->anioagricolamodel->saveArray($array_data)){
                    $anio=$this->aniosmodel->lastAnioAgricola();
                    $this->session->set_flashdata('success', 'Los datos para el año agricola '.$anio->anio_ini.' - '.$anio->anio_fin.' fueron registrados exitosamente.');
                }else{
                    $this->session->set_flashdata('error', 'Los datos no fueron cargados correctamente, favor intetelo mas tarde.');
                }
            }
        } 
        redirect(base_url('anioagricola/buscar/anio/1'));
    }

    private function excelToArray(){
        // Abriendo archivo que se ha subido al servidor
        $file_info = $this->upload->data();
        $filepath = "./resources/uploads/" . $file_info['file_name'];
        $this->load->library('excel');
        // Identificando el tipo de archivo
        $inputFileType = PHPExcel_IOFactory::identify($filepath);
        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
        $objPHPExcel  = $objReader->load($filepath);
        // get only the Cell Collection
        $cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
        // extract to a PHP readable array format
        foreach ($cell_collection as $cell) {
            $column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
            $row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
            $data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();
            //header will/should be in row 1 only. of course this can be modified to suit your need.
            if ($row == 1) {
                $header[$row][$column] = $data_value;
            } else {
                // $arr_data[$row][$column] = $data_value;
                switch($column){
                    case 'A':
                        $arr_data[$row]['anio'] = $data_value;
                    break;
                    case 'B':
                        $arr_data[$row]['mes'] = $data_value;
                    break;
                    case 'C':
                        $arr_data[$row]['dia'] = $data_value;
                    break;
                    case 'D':
                        $arr_data[$row]['precipitacion_pluvial'] = $data_value;
                    break;
                    case 'E':
                        $arr_data[$row]['media'] = $data_value;
                    break;
                    case 'F':
                        $arr_data[$row]['maxima'] = $data_value;
                    break;
                    case 'G':
                        $arr_data[$row]['minima'] = $data_value;
                    break;
                }
            }
        }
        //print_r($header);
        //echo '<br/><br/>';
        //print_r($arr_data);
        return $arr_data;
    }

    private function calcularAcumuladas($array_data){
        $pp_acum=0;
        $med_acum=0;
        $max_acum=0;
        $min_acum=0;
        for($i=2;$i<=count($array_data)+1;$i++){
            $pp_acum=$this->acumulada($pp_acum, $array_data[$i]['precipitacion_pluvial']);
            $med_acum=$this->acumulada($med_acum, $array_data[$i]['media']);
            $max_acum=$this->acumulada($max_acum, $array_data[$i]['maxima']);
            $min_acum=$this->acumulada($min_acum, $array_data[$i]['minima']);
            $array_data[$i]['pp_acum']=$pp_acum;
            $array_data[$i]['media_acum']=$med_acum;
            $array_data[$i]['max_acum']=$max_acum;
            $array_data[$i]['min_acum']=$min_acum;
        }        
        return $array_data;
    }

    private function acumulada($acum, $valor){
        if($acum==0){
            $acum=$valor;
        }else{
            $acum+=$valor;
        }
        return $acum;
    }

    private function aniosRangeToItems($anios){
        if($anios!=null){
            $options=array();
            foreach($anios as $anio){
                $options[$anio->id] = $anio->anio_ini.' - '.$anio->anio_fin;
            }       
            return $options;
        }
        return null;
    }

    private function validaExcel($array_data){
        $ultimo_anio=$this->aniosmodel->lastAnioAgricola();
        $ultimo_registro=count($array_data)+1;
        if($ultimo_anio==null){
            if(!($array_data[2]['anio']==ANIO_INI and $array_data[2]['mes']=='JULIO' and
                $array_data[$ultimo_registro]['anio']==ANIO_FIN and $array_data[$ultimo_registro]['mes']=='JUNIO')){
                $message='El documento que desea subir al sistema, tiene valores que no corresponden al ';
                $message.='año agricola '.ANIO_INI.' - '.ANIO_FIN;
                $message.=' o no cumple con el formato requerido. Por favor revise los datos del documento en excel.';
                $this->session->set_flashdata('error', $message);
                return false;
            }
        }elseif(!($array_data[2]['anio']==($ultimo_anio->anio_fin) and $array_data[2]['mes']=='JULIO' and 
           $array_data[$ultimo_registro]['anio']==($ultimo_anio->anio_fin+1) and $array_data[$ultimo_registro]['mes']=='JUNIO')){
            $message='El documento que desea subir al sistema, tiene valores que no corresponden al ';
            $message.='año agricola '.$ultimo_anio->anio_fin.' - '.($ultimo_anio->anio_fin+1);
            $message.=' o no cumple con el formato requerido. Por favor revise los datos del documento en excel.';
            $this->session->set_flashdata('error', $message);
            return false;
        }
        return true;
    }

    public function graficarAnioAgricolaAction(){
        $data['anios']=$this->aniosToItems($this->aniosmodel->findAll());
        $data['anioselect']=1;
        $data['meses']=array('JULIO'=>'JULIO','AGOSTO'=>'AGOSTO','SEPTIEMBRE'=>'SEPTIEMBRE','OCTUBRE'=>'OCTUBRE','NOVIEMBRE'=>'NOVIEMBRE','DICIEMBRE'=>'DICIEMBRE','ENERO'=>'ENERO','FEBRERO'=>'FEBRERO','MARZO'=>'MARZO','MARZO'=>'MARZO','ABRIL'=>'ABRIL','MAYO'=>'MAYO','JUNIO'=>'JUNIO');        
        $data['messelect']='JULIO';
        $data['title']=$this->title;
        //print_r($this->generarDias());
        $this->load->view('graficas/anioagricola_view', $data);  
    }

    private function aniosToItems($anios){
        if($anios!=null){
            $options=array();
            foreach($anios as $anio){
                $options[$anio->anio_ini] = $anio->anio_ini;
            }       
            return $options;
        }
        return null;
    }
}