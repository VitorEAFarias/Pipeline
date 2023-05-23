<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pipeline extends CI_Controller {

	public function __construct() {
        parent::__construct();
        
        $this->load->model("PipelineModel", "m_pipeline");
        $this->dados = $this->session->userdata("dados" . APPNAME);
        $data["dados"] = $this->dados;
        if(!$this->dados)
        {
            redirect(base_url('login'));
        }
    }

    public function index()
    {        
        $data["navbar"] = $this->load->view("template/navbar", null, true);
        $data["pageHeader"] = $this->load->view("template/pageHeader", null, true);
        $data["content"] =  $this->load->view('Pipeline/pipeline', $data, true);
        $data["javascript"] = [
            base_url("assets/js/pipeline/pipeline.js")
        ];

        $this->load->view('template/content', $data);
    }

    public function get_pipeline()
    {
        $rst = $this->m_pipeline->lista_pipeline();
        echo json_encode($rst, JSON_UNESCAPED_UNICODE);
    }
}