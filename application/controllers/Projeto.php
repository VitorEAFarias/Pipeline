<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Projeto extends CI_Controller {

	public function __construct() {
        parent::__construct();
        
        $this->load->model("ProjetoModel", "m_projetos");
        $this->load->model("UsuarioModel", "m_usuarios");
        $this->dados = $this->session->userdata("dados" . APPNAME);
        $data["dados"] = $this->dados; 
        if(!$this->dados)
        {
            redirect(base_url('login'));
        }      
    }

    public function index($id = null)
    {    
        $data["id"] = $id;
        $data["carrega"] = $this->m_projetos->get_projeto($id);
        $data["departamento"] = $this->m_usuarios->get_departamento(); 
        $data["navbar"] = $this->load->view("template/navbar", null, true);
        $data["pageHeader"] = $this->load->view("template/pageHeader", null, true);
        $data["content"] =  $this->load->view('Projeto/projeto', $data, true);
        $data["javascript"] = [
            base_url("assets/js/Projeto/projeto.js")
        ];

        $this->load->view('template/content', $data);
    }

    public function adiciona_projeto()
    {
        $rst = $this->m_projetos->cadastra_projeto();        
        echo json_encode($rst, JSON_UNESCAPED_UNICODE);
    }
}