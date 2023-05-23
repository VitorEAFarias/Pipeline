<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UsuarioModel extends CI_Model{
    
    function __construct() 
    {
        parent::__construct();        
    }
    
    public function novo_usuario()
    {
        $rst = (object)array("result" => false, "msg" => "");
        $data = (object)$this->input->post();

        $this->db->set("id", $data->id);    
        $this->db->set("nome", $data->nome_usuario);
        $this->db->set("matricula", $data->matricula_usuario);
        $this->db->set("cpf", $data->cpf);
        $this->db->set("senha", $data->senha_usuario);
        $this->db->set("id_departamento", $data->departamento);
        $this->db->set("nome_superior", $data->superior);
        $this->db->set("tipo_usuario", $data->tipo_usuario);  
        
        if($data->id)
        {
            $this->db->where("id", $data->id);

            if($this->db->update("usuario"))
            {
                $rst->result = true;
                $rst->msg = "Usuário atualizado com sucesso";
            }
            else
            {
                $rst->msg = "Erro ao atualizar usuário";
            }
        }
        else
        {
            if($this->db->insert("usuario"))
            {
                $rst->result = true;
                $rst->msg = "Usuário inserido com sucesso";    
            }
            else
            {
                $rst->msg = "Erro ao inserir usuário";
            }
        }

        return $rst;
    } 

    public function get_usuarios()
    {        
        $rst = (object)array();

        $this->db->select("usr.nome, usr.matricula, usr.nome_superior, dep.nome as departamento");
        $this->db->join("departamento dep", "usr.id_departamento = dep.id");
        $rst = $this->db->get_where("usuario usr")->result();
        // echo "<pre>";
        // print_r($rst);
        // echo "</pre>";
        // exit;
        return $rst;
    }
    
    public function get_departamento()
    {
        $rst = $this->db->get("departamento")->result();    
        return $rst;        
    }
}