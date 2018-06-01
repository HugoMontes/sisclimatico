<?php
class UsuarioModel extends CI_Model {

    private $tablename="usuario";

    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function findByUsernamePassword($username, $password){
        $this->db->where('username', $username);
        $this->db->where('password', md5($password));
        $query=$this->db->get($this->tablename);
        if($query->num_rows() > 0){
          return $query->row();
        }
        return null;
    }
    
}
