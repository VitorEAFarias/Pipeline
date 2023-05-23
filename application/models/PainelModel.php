<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PainelModel extends CI_Model{
    
    function __construct() 
    {
        parent::__construct();        
    }   
    
    public function get_projeto_iniciado()
    {
        $dataAgora = date('Y-m-d');

        $this->db->select("a.*, b.nome nome_usuario, c.titulo fase_projeto", false);
        $this->db->join("usuario b", "b.id = a.id_usuario");
        $this->db->join("fases c", "c.id = a.id_fase");
        $this->db->order_by("a.nome_projeto", "asc");
        $rst = $this->db->get_where("usuario_projeto a", "a.data_pause IS NULL AND DATE(a.data_start) = '$dataAgora'")->result();

        foreach($rst as $item)
        {
            $item->data_start = formatar($item->data_start, "bd2dt");
        }

        return $rst;        
    }

    public function get_usuario_logado()
    {
        $rst = $this->db->get_where("usuario", "stats = 'Y'")->result();
        return $rst;
    }

    public function get_usuario_atividade()
    {    
        $this->db->select("b.nome nome_usuario", false);
        $this->db->join("usuario b", "b.id = a.id_usuario");
        $this->db->where("a.data_start != 'null' AND a.data_pause is null AND DATE(a.data_start) = '".date('Y-m-d')."'");
        $usuariosRst = $this->db->get("usuario_projeto a")->result();

        return $usuariosRst;
    }

    public function start_projeto()
    {
        $rst = (object)array("result" => false, "msg" => "");
        $data = (object)$this->input->post(); 
        $dataAgora = date('Y-m-d');
        $dados = $this->session->userdata("dados" . APPNAME);
        
        $this->db->select("id");
        $id_projeto = $this->db->get_where("projetos", "nome = '$data->projetos'")->row();
        
        $this->db->set("id_usuario", $dados->id);
        $this->db->set("nome_projeto", $data->projetos);
        $this->db->set("id_projeto", $id_projeto->id);
        $this->db->set("data_start", "NOW()", false);
        $this->db->set("finalizado", 'N');
        $this->db->set("id_fase", $data->fase_projeto);

        $verificaProjeto = $this->db->get_where("usuario_projeto", "id_usuario = '$dados->nome' AND nome_projeto = '$data->projetos' AND data_pause IS NULL AND DATE(data_start) = '$dataAgora'")->row();
        
        if($verificaProjeto != null)
        {
            $rst->msg = "Projeto ja esta iniciado";
        }
        else
        {
            if($this->db->insert("usuario_projeto"))
            {
                $rst->result = true;
                $rst->msg = "Projeto iniciado com sucesso!!!";
            }
            else
            {
                $rst->msg = "Erro ao iniciar projeto";
            }     
        } 
        
        return $rst;
    }

    public function pause_projeto($id)
    {
        $rst = (object)array("result" => false, "msg" => "");
        $param = $id;
        $usuarioLogado = $this->session->userdata("dados" . APPNAME);  

        $query = $this->db->get_where("usuario_projeto", "id = '$param' AND id_usuario = '$usuarioLogado->id' AND data_pause is null")->result();
        
        $this->db->select("data_pause");
        $this->db->order_by("id", "DESC");
        $verificaPause = $this->db->get_where("usuario_projeto", "id_usuario = '$usuarioLogado->id' AND id = '$param'")->row();        

        if($verificaPause->data_pause == null)
        {        
            $this->db->set("data_pause", "NOW()", false);

            if($query)
            { 
                $this->db->where("id", $param);
                if($this->db->update("usuario_projeto"))
                {
                    $rst->result = true;
                    $rst->msg = "Projeto pausado com sucessoo!!!";
                }
            }
        }
        else
        {
            $rst->msg = "Esse projeto ja esta pausado";
        }

        return $rst;
    }

    public function get_fases()
    {
        $this->db->order_by("ordem", "asc");
        $rst = $this->db->get("fases")->result();
        return $rst;
    }
}