<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model{
    
    function __construct() 
    {
        parent::__construct();        
    }

    private $login = array(        
        "logged" => false,
        "error" => "",
        "tipo" => "",
        "nome" => "",
        "id" => 0,
        "cpf" => "",
        "matricula" => "",
    );    
    
    public function login()
    {        
        $data = (object)$this->input->post();
        $login = (object)$this->login;

        if(!empty($data))
        {   
            $query = $this->db->get_where("usuario", "cpf = '".$data->cpf."'")->row();
            
            if($query)
            {
                $this->db->set("stats", 'Y');
                $this->db->where("id = $query->id");
                $this->db->update("usuario");

                $login->id = $query->id;
                
                if($query->senha == $data->senha)
                {
                    $login->nome = $query->nome;
                    $login->cpf = $query->cpf;
                    $login->tipo = $query->tipo_usuario;
                    $login->matricula = $query->matricula;
                    $login->logged = true;
                }
                else
                {
                    $login->error = "A senha está incorreta";
                }
            }            
            else
            {
                $login->error = "O CPF está incorreto";
            }
        }
        return $login;
    }  
    
    public function loggout($redir = true)
    {
        $dados = $this->session->userdata("dados" . APPNAME);
        $query = $this->db->get_where("usuario", "id = '".$dados->id."'")->row();
    
        if($query)
        {    
            $this->db->set("stats", 'N');
            $this->db->where("id = $query->id");
            if($this->db->update("usuario"))
            {
                $this->session->unset_userdata(array("is_logged", "dados" . APPNAME));
                if ($redir) 
                {
                    $this->session->set_flashdata("message", "<div class='alert alert-info'>Até logo $dados->login.</div>");
                    redirect(base_url("login"));
                }
            }            
        }        
    }
}