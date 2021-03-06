<?php
class Anioagricolamodel extends CI_Model {

    private $tablename="anio_agricola";

    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function findByAnio($id_anio){
        $this->db->select('id, anio, mes, dia, precipitacion_pluvial, media, maxima, minima, pp_acum, media_acum, max_acum, min_acum');
        $this->db->where('id_anio',$id_anio);
        $query = $this->db->get($this->tablename);
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    public function saveArray($array_data){
        $this->db->trans_start();
        $this->load->model('aniosmodel');
        $id_anio=$this->aniosmodel->saveNextAnio();
        foreach($array_data as $data){
            $data['id_anio']=$id_anio;
            $data['created_at']=date('Y-d-m H:i:s');
            $data['updated_at']=date('Y-d-m H:i:s');
            $this->db->insert($this->tablename, $data);
        }
        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    public function findByMesDia($mes, $dia){
        $this->db->select('id, anio, mes, dia, precipitacion_pluvial, media, maxima, minima, pp_acum, media_acum, max_acum, min_acum');
        $this->db->where('mes',$mes);
        $this->db->where('dia',$dia);
        $this->db->order_by('anio', 'DESC');
        $query = $this->db->get($this->tablename);
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return null;
    }

    public function findByAnioMes($anio, $mes){
        $this->db->select('id, anio, mes, dia, precipitacion_pluvial, media, maxima, minima');
        $this->db->where('anio',$anio);
        $this->db->where('mes',$mes);
        $this->db->order_by('anio', 'DESC');
        $query = $this->db->get($this->tablename);
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return null;
    }

    public function findByMesDiaFenomeno($mes, $dia, $fenomeno){
        if($fenomeno==PRECIPITACION_PLUVIAL){
            $this->db->select('id, anio, mes, dia, precipitacion_pluvial as fenomeno');
        }elseif($fenomeno==TEMPERATURA_MEDIA){
            $this->db->select('id, anio, mes, dia, media as fenomeno');
        }elseif($fenomeno==TEMPERATURA_MAXIMA){
            $this->db->select('id, anio, mes, dia, maxima as fenomeno');
        }elseif($fenomeno==TEMPERATURA_MINIMA){
            $this->db->select('id, anio, mes, dia, minima as fenomeno');
        }
        $this->db->where('mes',$mes);
        $this->db->where('dia',$dia);
        $this->db->order_by('anio', 'DESC');
        $query = $this->db->get($this->tablename);
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return null;
    }
}
