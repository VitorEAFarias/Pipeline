<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Painel extends CI_Controller {

	public function __construct() {
        parent::__construct();
        
        $this->dados = $this->session->userdata("dados" . APPNAME);
        $data["dados"] = $this->dados;
        if(!$this->dados)
        {
            redirect(base_url('login'));
        }        
        $this->load->model("PainelModel", "m_painel");
        $this->load->model("ProjetoModel", "m_projetos");
        $this->load->model("PausaAutomaticaModel","m_pausaautomatica");   
    }

    public function index($id = null)
    {   
        $data["usrProjeto"] = $id;   
        $data["usrLogado"] = $this->m_painel->get_usuario_logado(); 
        $data["usrAtividade"] = $this->m_painel->get_usuario_atividade();   
        $data["projetosP"] = $this->m_painel->get_projeto_iniciado($id);
        $data["projetos"] = $this->m_projetos->get_projetos_ativos();
        $data["fases"] = $this->m_painel->get_fases();
        $data["navbar"] = $this->load->view("template/navbar", null, true);
        $data["pageHeader"] = $this->load->view("template/pageHeader", null, true);
        $data["content"] =  $this->load->view('painel/painel', $data, true);
        $data["javascript"] = [
            base_url("assets/js/painel/painel.js")
        ];

        $this->load->view('template/content', $data);
    }

    public function pausa_projeto($id)
    {
        $rst = $this->m_painel->pause_projeto($id);
        echo json_encode($rst);
    }

    public function inicia_projeto()
    {
        $rst = $this->m_painel->start_projeto();
        echo json_encode($rst);
    }

    public function get_projeto()
    {
        $rst = $this->m_painel->get_projeto_iniciado();
        echo json_encode($rst);
    }
}