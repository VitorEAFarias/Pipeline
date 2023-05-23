<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Sistema {

    /**
     * Classe de validacao do sistema
     *
     * Autores
     * 		fagnervalerio at gmail dot com
     */
    private $CI;

    // -- Construtor
    public function __construct() {
        $this->CI = & get_instance();
        $this->CI->load->model("sistema_model", "m_sistema");
    }

    function check_logged($classe, $metodo) {
        /**
         * Buscando a classe e metodo da tabela sys_metodos
         */
        $result = $this->CI->m_sistema->get_metodo($classe, $metodo);

        // Se este metodo ainda não existir na tabela sera cadastrado
        if (!$result) {
            $this->CI->m_sistema->set_primeiro_acesso($classe, $metodo);
            redirect(base_url("$classe/$metodo"), 'refresh');
        }
        //Se ja existir tras as informacoes de publico ou privado
        else {
            if ($result->privado == 0) {
                // Escapa da validacao e mostra o metodo.
                return false;
            } else {
                // Se for privado, verifica o login
                $dados = $this->CI->session->userdata("dados" . APPNAME);
                $logged = $this->CI->session->userdata('is_logged');
                $id_metodo = $result->id;

                // Se o usuario estiver logado vai verificar se tem permissao na tabela.
                if ($logged) {
                    // Verifica as permissoes do usuario
                    $permissoes = $this->CI->m_sistema->get_permissoes($id_metodo, $dados->user_id);
                    if ($permissoes->checked) {
                        return $permissoes;
                    } else {
                        $this->CI->session->set_flashdata("message", "<div class='alert alert-danger'>$permissoes->error</div>");
                        redirect(base_url("login/privado"), "refresh");
                    }
                }
                // Se não estiver logado, sera redirecionado para o login.
                else {
                    $this->CI->session->set_flashdata("message", "<div class='alert alert-danger'>Acesso Negado. Por favor, identifique-se.</div>");
                    redirect(base_url("login"));
                }
            }
        }
    }

    function check_logged_old($classe, $metodo, $usuario) {
        $this->CI->load->model("sistema_model");

        /**
         * Buscando a classe e metodo da tabela de metodos
         */
        $result = $this->CI->sistema_model->get_metodo_by_name($classe, $metodo);

        // Se este metodo ainda não existir na tabela sera cadastrado
        if (!$result) {
            $this->CI->sistema_model->set_primeiro_acesso($classe, $metodo);
            redirect(base_url("$classe/$metodo"), 'refresh');
        }
        //Se ja existir tras as informacoes de publico ou privado
        else {
            if ($result->privado == 2) {
                // Escapa da validacao e mostra o metodo.
                return false;
            } elseif ($result->privado == 0) {
                // Verifica se esta logado
                $logged = $this->CI->session->userdata('is_logged');
                if ($logged) {
                    // Escapa da validacao e mostra o metodo.
                    return false;
                }
                // Se não estiver logado, sera redirecionado para o login.
                else {
                    $this->CI->session->set_flashdata("message", "<div class='alert alert-danger'>Acesso Negado. Por favor, identifique-se.</div>");
                    redirect(base_url("login"), "refresh");
                }
            } else {
                // Se for privado, verifica o login
                $logged = $this->CI->session->userdata('is_logged');
                $id_metodo = $result->id;

                // Se o usuario estiver logado vai verificar se tem permissao na tabela.
                if ($logged) {
                    // Verifica as permissoes do usuario
                    $permissoes = $this->CI->sistema_model->get_permissoes($id_metodo, $usuario);
                    if ($permissoes->checked) {
                        // Grava LOG
                        //$this->log("ACS", json_encode(array("msg"=>"Acesso a pagina", "id_metodo"=>$id_metodo)));

                        return $permissoes;
                    } else {
                        // Grava LOG
                        //$this->log("ACS", json_encode(array("msg"=>$permissoes->error, "id_metodo"=>$id_metodo)));

                        $this->CI->session->set_flashdata("message", "<div class='alert alert-danger'>$permissoes->error</div>");
                        redirect(base_url("login/privado"), "refresh");
                    }
                }
                // Se não estiver logado, sera redirecionado para o login.
                else {
                    $this->CI->session->set_flashdata("message", "<div class='alert alert-danger'>Acesso Negado. Por favor, identifique-se.</div>");
                    redirect(base_url("login"), "refresh");
                }
            }
        }
    }

    function check_one_permission($classe, $metodo, $usuario) {
        $result = $this->CI->m_sistema->get_metodo_by_name($classe, $metodo);
        if ($result != null) {
            $id_metodo = $result->id;
            $permissoes = $this->CI->sistema_model->get_permissoes($id_metodo, $usuario);
            if ($permissoes->checked || $result->privado == 0) {
                return true;
            }
            return false;
        }
        return false;
    }

    public function show_menu() {
        $menu = $this->CI->m_sistema->get_menu();
        return $this->CI->m_sistema->show_menu($menu);
    }

    public function encrypt_decrypt($action, $string) {
        $output = false;

        $encrypt_method = "AES-256-CBC";
        $secret_key = '!Controle@ReisOffice#';
        $secret_iv = '#ReisOffice@Colegio!';

        // hash
        $key = hash('sha256', $secret_key);

        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);

        if ($action == 'encrypt') {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
        } else if ($action == 'decrypt') {
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }

        return rtrim($output, "=");
    }

    public function enviar_email($remetente, $destinatario) {
       
        $this->CI->load->library('email');
        
        $mail_config["protocol"] = "smtp";
        $mail_config["smtp_host"] = "mail.reisoffice.com.br";
        $mail_config["smtp_user"] = "spamtrap";
        $mail_config["smtp_pass"] = "Ro1233332144";
        $mail_config["smtp_port"] = "587";
        $mail_config["mailtype"] = "html";
        $mail_config['crlf'] = "\r\n";
        $mail_config['newline'] = "\r\n";
        $this->CI->email->initialize($mail_config);

        $this->CI->email->from($remetente->email, "Reis Office");
        $this->CI->email->to($destinatario->email);
        
        $this->CI->email->subject(html_entity_decode($destinatario->assunto));
        $msg = $this->CI->load->view("email", $destinatario->mensagem, TRUE);
        $this->CI->email->message($msg);
        if (isset($destinatario->anexos)) {
            foreach ($destinatario->anexos as $anexo)
                $this->CI->email->attach($anexo);
        }

        if ($this->CI->email->send(false)) {
            //echo $this->CI->email->print_debugger();
            //exit;
            return TRUE;
        } else {
            //echo $this->CI->email->print_debugger();
            //exit;
            return FALSE;
        }
    }

    public function gerar_senha() {
        $str = md5(date("sYmdHi"));
        $sen = substr($str, rand(0, 15), 6);
        return $sen;
    }

}
