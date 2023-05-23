<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProjetoModel extends CI_Model{
    
    function __construct() 
    {
        parent::__construct();        
    }
    public function get_projetos_ativos()
    {
        $this->db->order_by("nome", "asc");
        $rst = $this->db->get_where("projetos", "ativo = 'Y'")->result();

        return $rst;
    }
    
    public function get_projeto($id)
    {
        if($id != null)
        {
            $rst = $this->db->get_where("projetos", "id = $id")->row();
            
            return $rst;
        }
        else
        {
            return array();
        }
    }

    public function cadastra_projeto()
    {
        $rst = (object)array("result" => false, "msg" => "");
        $data = (object)$this->input->post();   
                
        if(isset($data->ativo))
        {
            $this->db->set("ativo", $data->ativo);
        }
        else
        {
            $this->db->set("ativo", null);
        }            
        $this->db->set("nome", $data->nome_projeto);
        $this->db->set("id_departamento", $data->departamento);
        $this->db->set("requerimento", $data->requerimento_projeto);
        $this->db->set("tipo_projeto", $data->tipo_projeto);
        $this->db->set("area_beneficio", $data->area_beneficiada);
        $this->db->set("responsavel", $data->responsavel_projeto);
        $this->db->set("despesa_estimada", $data->despesa_estimada);
        $this->db->set("dispendio_recursos", $data->dispendio_recurso);
        $this->db->set("recomendacao", $data->recomendacao);
        $this->db->set("beneficio", $data->beneficio);
        $this->db->set("data_solicitacao", $data->data_solicitacao);
    
        if($data->id)
        {
            $this->db->where("id", $data->id );
            
            if($this->db->update("projetos"))
            {
                $rst->result = true;
                $rst->msg = "Projeto atualizado com sucesso!!!";
            }
            else
            {
                $rst->msg = "Erro ao atualizar projeto";
            }
        }
        else
        {
            if($this->db->insert("projetos"))
            {
                $rst->result = true;
                $rst->msg = "Projeto inserido com sucesso!!!";
            }
            else
            {
                $rst->msg = "Erro ao cadastrar novo projeto";
            }     
        } 
        
        return $rst;
    }
}