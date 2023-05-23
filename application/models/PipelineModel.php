<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PipelineModel extends CI_Model{
    
    function __construct() 
    {
        parent::__construct();        
    } 
    
    public function lista_pipeline()
    {     
        $this->db->select("id, ativo, nome, requerimento, area_beneficio, dispendio_recursos, tipo_projeto, beneficio, recomendacao, data_solicitacao");
        $rst = $this->db->get("projetos")->result();

        foreach($rst as $item)
        {
            $item->data_solicitacao = formatar($item->data_solicitacao, "bd2dt");
        }

        return $rst;
    }
}