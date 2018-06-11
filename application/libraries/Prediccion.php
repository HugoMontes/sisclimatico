<?php
defined("BASEPATH") or die("El acceso al script no está permitido");

class Prediccion{

    private $dias;
    private $prom;
    private $prom_pp;
    private $prom_med;
    private $prom_max;
    private $prom_min;
    private $abs;
    private $abs_pp;
    private $abs_med;
    private $abs_max;
    private $abs_min;

    public function __construct(){
    }
    
    public function obtenerValoresPrediccion($dias){
        $this->dias=$dias;
        $this->prom_pp=array();
        $this->prom_med=array();
        $this->prom_max=array();
        $this->prom_min=array();
        $this->abs_pp=array();
        $this->abs_med=array();
        $this->abs_max=array();
        $this->abs_min=array();
        $this->calcularPromedios(1, 0, 0, 0, 0);
            //print_r($this->deanios); echo '<br/>';
            
        $minimo_pp=min($this->abs_pp);
        $minimo_med=min($this->abs_med);
        $minimo_max=min($this->abs_max);
        $minimo_min=min($this->abs_min);

        $ca_pp=$this->cuantosAnios($this->abs_pp, 0, $minimo_pp, count($this->abs_pp));
        $ca_med=$this->cuantosAnios($this->abs_med, 0, $minimo_med, count($this->abs_med));
        $ca_max=$this->cuantosAnios($this->abs_max, 0, $minimo_max, count($this->abs_max));
        $ca_min=$this->cuantosAnios($this->abs_min, 0, $minimo_min, count($this->abs_min));

            
        //echo '<br/>';
        //echo 'TEMP. PP - CUANTOS AÑOS: '.$ca_pp;
        //echo '<br/>';
        //echo 'TEMP. MEDIA - CUANTOS AÑOS: '.$ca_med;
        //echo '<br/>';
        //echo 'TEMP. MAX - CUANTOS AÑOS: '.$ca_max;
        //echo '<br/>';
        //echo 'TEMP. MIN - CUANTOS AÑOS: '.$ca_min;
            
        $esperado_pp=$this->esperado($this->prom_pp, 0, $ca_pp, count($this->prom_pp));
        $esperado_med=$this->esperado($this->prom_med, 0, $ca_med, count($this->prom_med));
        $esperado_max=$this->esperado($this->prom_max, 0, $ca_max, count($this->prom_max));
        $esperado_min=$this->esperado($this->prom_min, 0, $ca_min, count($this->prom_min));
  
        $data['esperados']=array(
            'pp'=>$esperado_pp,
            'med'=>$esperado_med,
            'max'=>$esperado_max,
            'min'=>$esperado_min,
        );           

        $data['menores']=array(
            'pp'=>($esperado_pp-$minimo_pp),
            'med'=>($esperado_med-$minimo_med),
            'max'=>($esperado_max-$minimo_max),
            'min'=>($esperado_min-$minimo_min),
        );
            
        $data['mayores']=array(
            'pp'=>($esperado_pp+$minimo_pp),
            'med'=>($esperado_med+$minimo_med),
            'max'=>($esperado_max+$minimo_max),
            'min'=>($esperado_min+$minimo_min),
        );
        return $data;
    }

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

    public function obtenerValoresPrediccionPorFenomeno($dias){
        $this->dias=$dias;
        $this->prom=array();
        $this->abs=array();
        $this->calcularPromedioFenomeno(1, 0);
        $minimo=min($this->abs);
        $ca=$this->cuantosAnios($this->abs, 0, $minimo, count($this->abs));            
        $esperado=$this->esperado($this->prom, 0, $ca, count($this->prom));
        $data['cuantos_anios'] = $ca;           
        $data['esperado'] = $esperado;           
        $data['menor'] = $esperado - $minimo;
        $data['mayor'] = $esperado + $minimo;
        return $data;
    }

    private function calcularPromedioFenomeno($i, $sum){
        if($i<count($this->dias)){
            $sum+=$this->dias[$i]->fenomeno;
            if($i!=1){
                $round=round($sum/$i, 1);
                array_push($this->prom, $round);
                array_push($this->abs, abs($round - $this->dias[0]->fenomeno));
            }
            $i++;
            $this->calcularPromedioFenomeno($i, $sum);
        }
    }
}