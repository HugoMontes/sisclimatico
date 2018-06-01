<?php
class AnioAgricolaModel extends CI_Model {

    private $tablename="anio_agricola";

    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function saveArray($array_data, $id_clasificacion){
        $this->db->trans_start();
        foreach($array_data as $data){
            $data['id_clasificacion']=$id_clasificacion;
            $data['created_at']=date('Y-d-m H:i:s');
            $data['updated_at']=date('Y-d-m H:i:s');
            $this->db->insert($this->tablename, $data);
        }
        $this->db->trans_complete();
        return $this->db->trans_status();
    }
}
