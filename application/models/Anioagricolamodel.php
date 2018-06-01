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
}
