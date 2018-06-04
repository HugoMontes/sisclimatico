<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PrediccionController extends CI_Controller {

    private $title;

    function __construct(){
        parent::__construct();
        $this->login->verifyUser();
        $this->load->model('anioagricolamodel');
        $this->load->model('aniosmodel');
        $this->title="Módulo de Predicción";
    } 

	public function index(){
        $countanios=$this->aniosmodel->countAll();
        if($countanios<MIN_ANIOS){
            $this->session->set_flashdata('warning', 'Para realizar una predicción necesita como minimo los datos de tres años agricolas.');
        }
        $data['fecha']=date("d/m/Y");        
        $data['title']=$this->title;
        $this->load->view('prediccion/formulario_view', $data);       
    }

    private $dias;
    // private $deanios=array(2,3,4,5,6,7);
    private $prom_pp=array();
    private $prom_med=array();
    private $prom_max=array();
    private $prom_min=array();

    private $abs_pp=array();
    private $abs_med=array();
    private $abs_max=array();
    private $abs_min=array();

    public function calcularAction(){
        $countanios=$this->aniosmodel->countAll();
        $fecha=date("d/m/Y");
        if($countanios<MIN_ANIOS){
            $this->session->set_flashdata('error', 'Para realizar una predicción necesita como minimo los datos de tres años agricolas.');
        }else{
            // $fecha=$this->input->post('fecha');
            $this->dias=$this->anioagricolamodel->findByMesDia('JULIO', 1);
            // print_r($this->dias);
            $this->calcularPromedios(1, 0, 0, 0, 0);
            //print_r($this->deanios); echo '<br/>';
            
            print_r($this->abs_pp); 
            $minimo_pp=min($this->abs_pp);
            echo ' ---- '.$minimo_pp.'<br/>';

            print_r($this->abs_med); 
            $minimo_med=min($this->abs_med);
            echo ' ---- '.$minimo_med.'<br/>';
            
            print_r($this->abs_max); 
            $minimo_max=min($this->abs_max);
            echo ' ---- '.$minimo_max.'<br/>';
            
            print_r($this->abs_min); 
            $minimo_min=min($this->abs_min);
            echo ' ---- '.$minimo_min.'<br/>';

            $ca_pp=$this->cuantosAnios($this->abs_pp, 0, $minimo_pp, count($this->abs_pp));
            $ca_med=$this->cuantosAnios($this->abs_med, 0, $minimo_med, count($this->abs_med));
            $ca_max=$this->cuantosAnios($this->abs_max, 0, $minimo_max, count($this->abs_max));
            $ca_min=$this->cuantosAnios($this->abs_min, 0, $minimo_min, count($this->abs_min));

            echo '<br/>';
            echo 'TEMP. PP - CUANTOS AÑOS: '.$ca_pp;
            echo '<br/>';
            echo 'TEMP. MEDIA - CUANTOS AÑOS: '.$ca_med;
            echo '<br/>';
            echo 'TEMP. MAX - CUANTOS AÑOS: '.$ca_max;
            echo '<br/>';
            echo 'TEMP. MIN - CUANTOS AÑOS: '.$ca_min;
            

            $esperado_pp=$this->esperado($this->prom_pp, 0, $ca_pp, count($this->prom_pp));
            $esperado_med=$this->esperado($this->prom_med, 0, $ca_med, count($this->prom_med));
            $esperado_max=$this->esperado($this->prom_max, 0, $ca_max, count($this->prom_max));
            $esperado_min=$this->esperado($this->prom_min, 0, $ca_min, count($this->prom_min));

            echo '<br/><br/>';
            echo 'TEMP. PP - ESPERADO: '.$esperado_pp;
            echo '<br/>';
            echo 'TEMP. MEDIA - ESPERADO: '.$esperado_med;
            echo '<br/>';
            echo 'TEMP. MAX - ESPERADO: '.$esperado_max;
            echo '<br/>';
            echo 'TEMP. MIN - ESPERADO: '.$esperado_min;        

            echo '<br/><br/>';
            echo 'TEMP. PP - VALOR MENOR: '.($esperado_pp-$minimo_pp);
            echo '<br/>';
            echo 'TEMP. MEDIA - VALOR MENOR: '.($esperado_med-$minimo_med);
            echo '<br/>';
            echo 'TEMP. MAX - VALOR MENOR: '.($esperado_max-$minimo_max);
            echo '<br/>';
            echo 'TEMP. MIN - VALOR MENOR: '.($esperado_min-$minimo_min);       

            echo '<br/><br/>';
            echo 'TEMP. PP - VALOR MAYOR: '.($esperado_pp+$minimo_pp);
            echo '<br/>';
            echo 'TEMP. MEDIA - VALOR MAYOR: '.($esperado_med+$minimo_med);
            echo '<br/>';
            echo 'TEMP. MAX - VALOR MAYOR: '.($esperado_max+$minimo_max);
            echo '<br/>';
            echo 'TEMP. MIN - VALOR MAYOR: '.($esperado_min+$minimo_min);     
        }
        //$data['fecha']=$fecha;        
        //$data['title']=$this->title;
        //$this->load->view('prediccion/formulario_view', $data);    
    }
/*
    private function calcularPromedios($i, $sum_pp, $sum_med, $sum_max, $sum_min){
        if($i<count($this->dias)){
            $sum_pp+=$this->dias[$i]->precipitacion_pluvial;
            $sum_med+=$this->dias[$i]->media;
            $sum_max+=$this->dias[$i]->maxima;
            $sum_min+=$this->dias[$i]->minima;
            if($i!=1){
                array_push($this->prom_pp, round($sum_pp/$i, 1));
                array_push($this->prom_med, round($sum_med/$i, 1));
                array_push($this->prom_max, round($sum_max/$i, 1));
                array_push($this->prom_min, round($sum_min/$i, 1));
            }
            $i++;
            $this->calcularPromedios($i, $sum_pp, $sum_med, $sum_max, $sum_min);
        }
    }
*/

    private function calcularPromedios($i, $sum_pp, $sum_med, $sum_max, $sum_min){
        if($i<count($this->dias)){
            $sum_pp+=$this->dias[$i]->precipitacion_pluvial;
            $sum_med+=$this->dias[$i]->media;
            $sum_max+=$this->dias[$i]->maxima;
            $sum_min+=$this->dias[$i]->minima;
            if($i!=1){
                $round_pp=round($sum_pp/$i, 1);
                $round_med=round($sum_med/$i, 1);
                $round_max=round($sum_max/$i, 1);
                $round_min=round($sum_min/$i, 1);

                array_push($this->prom_pp, $round_pp);
                array_push($this->prom_med, $round_med);
                array_push($this->prom_max, $round_max);
                array_push($this->prom_min, $round_min);

                array_push($this->abs_pp, abs($round_pp-$this->dias[0]->precipitacion_pluvial));
                array_push($this->abs_med, abs($round_med-$this->dias[0]->media));
                array_push($this->abs_max, abs($round_max-$this->dias[0]->maxima));
                array_push($this->abs_min, abs( $round_min-$this->dias[0]->minima));
            }
            $i++;
            $this->calcularPromedios($i, $sum_pp, $sum_med, $sum_max, $sum_min);
        }
    }

    private function cuantosAnios($array_abs, $index, $min, $size){
        if($array_abs[$index]==$min or $index==$size-1){
            return $index+2;
        }
        $index++;
        return $this->cuantosAnios($array_abs, $index, $min, $size);
    }

    private function esperado($array_prom, $index, $cuantos_anios, $size){
        if($cuantos_anios==$index+2 or $index==$size-1){
            return $array_prom[$index];
        }
        $index++;
        return $this->esperado($array_prom, $index, $cuantos_anios, $size);
    }
}