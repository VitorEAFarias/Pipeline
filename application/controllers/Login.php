<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    public function __construct() {
        parent::__construct();
        
        $this->load->model("Login_model", "m_login");
    }

    public function index()
    {
        $data["loginPage"] = true;
        $data["navbar"] = $this->load->view("template/navbar", null, true);
        $data["pageHeader"] = $this->load->view("template/pageHeader", null, true);
        $data["content"] =  $this->load->view('Login/login', $data, true);
        $data["javascript"] = [
            base_url("assets/js/login/login.js")
        ];

        $this->load->view('template/content', $data);
    }
    public function login_acesso()
    {        
        $rst = $this->m_login->login();
        
        if($rst->logged)
            $this->session->set_userdata(array("is_logged" => true, "dados" . APPNAME => $rst));  

        echo json_encode($rst, JSON_UNESCAPED_UNICODE);    
    }

    public function logout($redir = true)
    {
        $rst = $this->m_login->loggout($redir);
        echo json_encode($rst);
    }

    public function redirecionamento() 
    {
        $dados = $this->session->userdata("dados" . APPNAME);        
        $this->session->unset_userdata("destino" . APPNAME);
        if ($dados)
        {            
            redirect(base_url("Login"));
        }        
    }
}