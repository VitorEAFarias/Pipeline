<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RelatorioHoras extends CI_Controller {

	public function __construct() {
        parent::__construct();
          
        $this->load->model("RelatorioHorasModel", "m_relatorios");
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
        $data["colaboradores"] = $this->m_relatorios->get_colaboradores($id);
        $data["navbar"] = $this->load->view("template/navbar", null, true);
        $data["pageHeader"] = $this->load->view("template/pageHeader", null, true);
        $data["content"] =  $this->load->view('relatorio/relatoriohoras', $data, true);
        $data["javascript"] = [
            base_url("assets/js/relatorio/relatoriohoras.js")
        ];

        $this->load->view('template/content', $data);
    }

    public function get_dados()
    {
        $rst = $this->m_relatorios->get_relatorio();   
        echo json_encode($rst, JSON_UNESCAPED_UNICODE);
    }

    public function get_informacoes()
    {
        $rst = $this->m_relatorios->get_informacoes_colaborador();
        echo json_encode($rst);
    }
}