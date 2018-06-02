<?php
class Fenomenomodel extends CI_Model {

    private $tablename="fenomeno";

    function __construct(){
        parent::__construct();
        $this->load->database();
    }
}
