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
    }
}
