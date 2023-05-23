<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PausaAutomaticaModel extends CI_Model{
    
    function __construct() 
    {
        parent::__construct();        
    }

    public function verificaHoraFim()
    {
        $rst = $this->db->get_where("usuario_projeto", "data_pause is null")->result();
        
        if($rst)
        {
            $this->db->set("data_pause", "NOW()", false);
            $this->db->where("data_pause is null");
            $this->db->update("usuario_projeto");
            return true;
        }
        else
        {
            return false;
        }
    }
}  