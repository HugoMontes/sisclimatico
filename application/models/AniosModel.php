<?php
class AniosModel extends CI_Model{

    private $tablename = "anios";

    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function findAll(){
        $this->db->select('id, anio_ini, anio_fin');
        $query = $this->db->get($this->tablename);
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return null;
    }

    public function nextAnioAgricola(){
        $this->db->select('anio_ini, anio_fin');
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get($this->tablename);
        if ($query->num_rows() > 0) {
            $anio=$query->row();
            return $anio->anio_fin.' - '.($anio->anio_fin+1);
        }
        return ANIO_INI.' - '.ANIO_FIN;
    }

    public function saveNextAnio(){
        $lastAnio=$this->lastAnioAgricola();
        if(isset($lastAnio)){
            $data['anio_ini']=$lastAnio->anio_fin;
            $data['anio_fin']=$lastAnio->anio_fin+1;
        }else{
            $data['anio_ini']=ANIO_INI;
            $data['anio_fin']=ANIO_FIN;
        }
        $data['created_at']=date('Y-d-m H:i:s');
        $data['updated_at']=date('Y-d-m H:i:s');
        $this->db->insert($this->tablename, $data);
        return $this->db->insert_id();
    }

    public function lastAnioAgricola(){
        $this->db->select('id, anio_ini, anio_fin');
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get($this->tablename);
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return null;
    }
}
