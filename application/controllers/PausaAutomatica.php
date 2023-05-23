<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PausaAutomatica extends CI_Controller {

	public function __construct() {
        parent::__construct();
                        
        $this->load->model("PausaAutomaticaModel", "m_pausaautomatica");   
    }

    public function verificaHoraFim()
    {
        $rst = $this->m_pausaautomatica->verificaHoraFim();
        echo json_encode($rst);
    }
}