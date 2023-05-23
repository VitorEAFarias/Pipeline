<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RelatorioHorasModel extends CI_Model{
    
    function __construct() 
    {
        parent::__construct();        
    }
    
    public function get_colaboradores()
    {
        $rst = $this->db->get_where("usuario", "tipo_usuario = 'colaborador'")->result();    
        return $rst;
    }
    
    public function get_relatorio()
    {
        $data = (object)$this->input->post();

        $projetos = array();

        if(empty($data->colaborador))
        {
            return $projetos;
        }

        $data->data_inicio = $data->data_inicio.' 08:00:00';
        $data->data_fim = $data->data_fim.' 18:00:00';

        // $colaboradorRelatorio = $this->db->get_where("usuario", "id = $data->colaborador")->row();
        // $relatorio = $this->db->get_where("usuario_projeto", "nome_usuario = '$colaboradorRelatorio->nome' AND data_start > '$data->data_inicio' AND data_pause < '$data->data_fim'")->result();
        $sql = "SELECT b.nome, c.titulo fase_projeto,
                SUM(TIMESTAMPDIFF(MINUTE, a.data_start, a.data_pause) - (60 * 14 * DATEDIFF(a.data_pause, a.data_start))) minutos
                FROM usuario_projeto a
                JOIN projetos b ON a.id_projeto = b.id
                JOIN fases c ON a.id_fase = c.id
                WHERE a.data_start BETWEEN '$data->data_inicio' AND '$data->data_fim'
                AND id_usuario = $data->colaborador
                GROUP BY b.nome, a.nome_projeto, c.titulo
                HAVING SUM(TIMESTAMPDIFF(MINUTE, a.data_start, a.data_pause) - (60 * 14 * DATEDIFF(a.data_pause, a.data_start))) > 0
                ORDER BY a.id_usuario, c.ordem";
        $relatorio = $this->db->query($sql)->result();
         
        $horas_total = 0;

        foreach($relatorio as $key => $item)
        {  
            // $item->horas = gmdate('H:i', $item->minutos * 60);
            $item->horas = convertToHoursMins($item->minutos);
            $horas_total += $item->minutos;

            // $start_date = new DateTime($item->data_start);
            // $since_start = $start_date->diff(new DateTime($item->data_pause));

            // $projetoUnico = $this->db->get_where("usuario_projeto", "nome_projeto = '$item->nome_projeto' AND nome_usuario = '$colaboradorRelatorio->nome' AND fase_projeto = '$item->fase_projeto'")->result();
 
            // foreach($projetoUnico as $fase)
            // {   
            //     if(!isset($projetos["$item->nome_projeto"]))
            //     {
            //         $projetos["$item->nome_projeto"] = (object)array("nome" => $item->nome_projeto, "horas" => "00:00:00", "fase_projeto" => $item->fase_projeto);
            //     }

            //     $projetos["$item->nome_projeto"]->horas = date('H:i:s', strtotime( $projetos["$item->nome_projeto"]->horas." + {$since_start->h} hours" ));                           
            //     $projetos["$item->nome_projeto"]->horas = date('H:i:s', strtotime( $projetos["$item->nome_projeto"]->horas." + {$since_start->i} minutes" ));
            //     $projetos["$item->nome_projeto"]->horas = date('H:i:s', strtotime( $projetos["$item->nome_projeto"]->horas." + {$since_start->s} seconds" ));
                
            //     $horas_total = date('H:i:s', strtotime( "$horas_total + {$since_start->h} hours" ));
            //     $horas_total = date('H:i:s', strtotime( "$horas_total + {$since_start->i} minutes" ));
            //     $horas_total = date('H:i:s', strtotime( "$horas_total + {$since_start->s} seconds" ));
                
            //     $item->horas = $horas_total;
            // }

            // unset($relatorio[$key]);
        }   

        $relatorio[] = (object)array("nome" => "Total de Horas Programando", "horas" => convertToHoursMins($horas_total), "fase_projeto" => "", "minutos" => $horas_total);
        
        return $relatorio;        
    }

    public function get_informacoes_colaborador()
    {     
        $data = (object)$this->input->post();         
        $query = $this->db->get_where("usuario", "id = '$data->colaboradores'")->row();

        return $query;       
    }
}