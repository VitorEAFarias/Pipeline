<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {

	public function __construct() {
        parent::__construct();

        $this->load->model("UsuarioModel", "m_usuarios");         
        $this->dados = $this->session->userdata("dados" . APPNAME);
        $data["dados"] = $this->dados;
        if(!$this->dados)
        {
            redirect(base_url('login'));
        }
    }

    public function index()
    { 
        // $data["id"] = $id;
        // $data["carrega"] = $this->m_usuarios->get_usuarios($id);
        $data["departamento"] = $this->m_usuarios->get_departamento();
        // echo '<pre>';
        // print_r($data["departamento"]);
        // echo '</pre>';
        // exit;
        $data["navbar"] = $this->load->view("template/navbar", null, true);
        $data["pageHeader"] = $this->load->view("template/pageHeader", null, true);
        $data["content"] =  $this->load->view('Usuario/usuario', $data, true);
        $data["javascript"] = [
            base_url("assets/js/usuario/usuario.js")
        ];

        $this->load->view('template/content', $data);
    }

    public function get_usuarios()
    {        
        $rst = $this->m_usuarios->get_usuarios();
        echo json_encode($rst, JSON_UNESCAPED_UNICODE);
    }

    public function insere_usuario()
    {
        $rst = $this->m_usuarios->novo_usuario();
        echo json_encode($rst);
    }
}