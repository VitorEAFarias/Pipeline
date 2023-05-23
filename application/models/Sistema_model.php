<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Sistema_model extends CI_Model {

    public function &__get($key) {
        $CI = & get_instance();
        return $CI->$key;
    }

    public function get_metodo($classe, $metodo) {
        $this->db->where("classe = '$classe' AND metodo = '$metodo'");
        $rst = $this->db->get("inventario_metodos")->row();
        return $rst;
    }    

    public function get_permissoes($metodo, $usuario) {
        $prm["checked"] = false;
        $prm["error"] = "Usuário não tem permissão nesta página.";

        /* verifica se um dos grupos do usuario tem acesso a funcionalidade */
        $this->db->select("GP.*");
        $this->db->from('inventario_grupos G');
        $this->db->join('inventario_usuarios U', "U.id_grupo = G.Id");
        $this->db->join('inventario_grupos_permissoes GP', "GP.id_grupo = G.Id");
        $this->db->where("U.Id = $usuario AND GP.id_metodo = $metodo");
        $rst = $this->db->get()->result();
        if ($rst) {
            // Encontrou métodos, verifica se tem permissão no selecionado
            foreach ($rst as $item) {
                $prm["checked"] = true;
                $prm["alteracao"] = $item->alteracao;
                $prm["inclusao"] = $item->inclusao;
                $prm["exclusao"] = $item->exclusao;
                $prm["consulta"] = $item->consulta;
                $prm["error"] = "";
            }
        }

        return (object) $prm;
    }

    public function set_primeiro_acesso($classe, $metodo) {
        $this->db->set("classe", $classe);
        $this->db->set("metodo", $metodo);
        $this->db->set("descricao", "$classe/$metodo");
        $this->db->set("privado", 1);
        $this->db->insert('inventario_metodos');
    }

    public function get_metodo_by_id($id) {
        $rst = $this->db->get_where("inventario_metodos", "id = $id")->row();
        if ($rst)
            return $rst;
        else {
            $arr = array("classe" => "principal", "descricao" => "#", "privado" => "0", "metodo" => "painel");
            return (object) $arr;
        }
    }

    private function temFilho($id) {
        $rst = $this->db->get_where("inventario_menu", "id_pai = $id")->result();
        if ($rst) {
            return true;
        }
        return false;
    }

    public function get_menu() {
        $dados = $this->session->userdata("dados" . APPNAME);
        $this->db->order_by("id_pai", "ASC");
        $this->db->order_by("ordem", "ASC");
        $rst = $this->db->get_where("inventario_menu", "status = 1")->result();
        $arr_menu = array();

        if($rst)
        {
            foreach($rst as $item)
            {
                if($item->id_metodo == 0)
                    $arr_menu[$item->id_pai][$item->id] = array(
                        "titulo" => $item->titulo,
                        "metodo" => 0, //$this->get_metodo_by_id($item->id_metodo)
                        "classe" => $item->classe
                    );
                else 
                {                    
                    // Recupera os dados do método
                    $met = $this->get_metodo_by_id("$item->id_metodo");

                    //Verifica se o usuário é externo (técnico ou revenda)
                    if ($dados->type == "RO" or $dados->type == "REV")
                    {
                        $this->db->select("GP.id_metodo, GP.alteracao, GP.inclusao, GP.exclusao");
                        $this->db->from('inventario_grupos_permissoes GP');
                        $this->db->join('inventario_grupos G', "G.id = GP.id_grupo");
                        $this->db->where("GP.id_grupo = $dados->group_id AND GP.id_metodo = $item->id_metodo");
                        $grp = $this->db->get()->row();
                    } else {
                        /* verifica se um dos grupos do usuario tem acesso a funcionalidade */
                        $this->db->select("GP.id_metodo, GP.alteracao, GP.inclusao, GP.exclusao");
                        $this->db->from('inventario_grupos G');
                        $this->db->join('inventario_usuarios U', "U.id_grupo = G.id");
                        $this->db->join('inventario_grupos_permissoes GP', "GP.id_grupo = G.id and GP.id_metodo = $item->id_metodo");
                        $this->db->where("U.id = $dados->user_id");
                        $this->db->group_by("G.id");
                        $grp = $this->db->get()->row();
                    }
                    
                    // Verifica se tem permissao exclusiva no metodo
                    $this->db->select("UP.id_metodo, UP.alteracao, UP.inclusao, UP.exclusao");
                    $this->db->where("UP.id_usuario = $dados->user_id AND UP.id_metodo = $item->id_metodo");
                    $usu = $this->db->get("inventario_usuarios_permissoes UP")->row();

                    if ($grp || $usu || $met->privado == 0) {
                        $arr_menu[$item->id_pai][$item->id] = array(
                            "titulo" => $item->titulo,
                            "metodo" => $met, //$this->get_metodo_by_id($item->id_metodo),
                            "permissoes" => array_merge((array) $grp, (array) $usu),
                            "classe" => $item->classe
                        );
                    }
                }
            }
            
            // Limpa os pricipais sem filhos
            foreach($rst as $item) {
                if($item->id_metodo == 0)
                {
                    if(!isset($arr_menu[$item->id]))
                    {
                        unset($arr_menu[$item->id_pai][$item->id]);
                    }
                }
            }
        }
        
        return $arr_menu;
    }
    
    public function show_menu($arr_menu, $id_pai = 0) 
    {   
        if ($id_pai == 0)
            $menu = "<ul class='list' style='overflow: hidden; width: auto; height: 791px;'><li class='header'>MENU DE NAVEGAÇÃO</li>";
        else
            $menu = "<ul class='ml-menu'>";
        
        if($arr_menu)
        {
            foreach ($arr_menu[$id_pai] as $id_menu => $item) 
            {                
                if(isset($arr_menu[$id_menu]) && !empty($arr_menu[$id_menu]))
                {       
                    $icone = "";
                    $titulo = $item['titulo'];
                    if(strpos($titulo, "::"))
                        list($icone, $titulo) = explode("::", $titulo);
                        
                    $info = end($arr_menu[$id_menu]);
                    $classe = $item['classe'];
                    $show_icon = (strlen($icone) > 0) ? "<i class='material-icons'>$icone</i>" : "";
                    $menu .= "  <li id='menu_$classe'>
                                    <a href='javascript:void(0)' class='menu-toggle'>
                                        $show_icon
                                        <span>$titulo</span>
                                    </a>";                                        
                    $menu .= $this->show_menu($arr_menu, $id_menu);
                                        
                    //$menu .= "</ul>";
                }
                else
                {
                    if($id_menu == 2 && $this->router->class == "cliente")
                    {
                        $icone = "";
                        $titulo = $item['titulo'];
                        if(strpos($titulo, "::"))
                            list($icone, $titulo) = explode("::", $titulo);

                        $dados = $this->session->userdata("dados" . APPNAME);
                        
                        if($dados->type = "CLI" && $dados->group_id == 3 && $dados->id_licenca != 0)
                        {
                            $link = base_url("cliente/index/$dados->id_licenca");
                        }
                        else
                        {
                            $link = base_url(uri_string());
                        }
                        $classe = $item['classe'];
                        $show_icon = (strlen($icone) > 0) ? "<i class='material-icons'>$icone</i>" : "";
                        $menu .= "  <li id='menu_{$classe}'>
                                        <a href='$link'>
                                            $show_icon
                                            <span>$titulo</span>                                        
                                        </a>";
                    }                    
                    elseif($id_menu != 2 && $item['metodo'])
                    {
                        $icone = "";
                        $titulo = $item['titulo'];
                        if(strpos($titulo, "::"))
                            list($icone, $titulo) = explode("::", $titulo);

                        $caminho = "{$item['metodo']->classe}/{$item['metodo']->metodo}";
                        $link = base_url($caminho);
                        $classe = $item['classe'];
                        $show_icon = (strlen($icone) > 0) ? "<i class='material-icons'>$icone</i>" : "";
                        $menu .= "  <li id='menu_{$classe}'>
                                        <a href='$link'>
                                            $show_icon
                                            <span>$titulo</span>                                        
                                        </a>";
                    }
                }
                
                $menu .= "</li>";                
            }
            $menu .= "</ul>";
        }
        
        return $menu;
    }
    
    public function show_menu1($arr_menu, $id_pai = 0) 
    {               
        $menu = "<ul class='list'><li class='header'>MENU DE NAVEGAÇÃO</li>";
        if($arr_menu)
        {
            foreach ($arr_menu[$id_pai] as $id_menu => $item) 
            {                
                if(isset($arr_menu[$id_menu]))
                {       
                    $icone = "circle";
                    $titulo = $item['titulo'];
                    if(strpos($titulo, "::"))
                        list($icone, $titulo) = explode("::", $titulo);
                        
                    $info = end($arr_menu[$id_menu]);
                    $classe = (isset($info['metodo']->classe)) ? $info['metodo']->classe : strtolower($titulo);
                    $menu .= "  <li id='menu_$classe'>
                                    <a href='javascript:void(0)' class='menu-toggle'>
                                        <i class='fa fa-$icone'></i>
                                        <span>$titulo</span>
                                    </a>";                                        
                    $menu .= "<ul class='ml-menu'>";

                    foreach ($arr_menu[$id_menu] as $filho)
                    {
                        $icone = "circle-o";
                        $titulo = $filho['titulo'];
                        if(strpos($titulo, "::"))
                            list($icone, $titulo) = explode("::", $titulo);
                        
                        $link = (isset($filho['metodo']->classe)) ? base_url("{$filho['metodo']->classe}/{$filho['metodo']->metodo}") : "javascript:vois(0)";
                        $classe = (isset($filho['metodo']->classe)) ? $filho['metodo']->classe."_".$filho['metodo']->metodo : strtolower($filho["titulo"]) ;
                        $menu .= "<li id='menu_$classe'>
                                    <a href='{$link}'>
                                        <i class='fa fa-$icone'></i>
                                        <span>$titulo</span>
                                    </a>
                                </li>";
                    }
                    
                    $menu .= "</ul>";
                }
                else
                {
                    $icone = "circle";
                    $titulo = $item['titulo'];
                    if(strpos($titulo, "::"))
                        list($icone, $titulo) = explode("::", $titulo);
                    
                    $caminho = "{$item['metodo']->classe}/{$item['metodo']->metodo}";
                    $link = base_url($caminho);
                    $menu .= "  <li id='menu_{$item['metodo']->classe}_{$item['metodo']->metodo}'>
                                    <a href='$link'>
                                        <i class='fa fa-$icone'></i>
                                        <span>$titulo</span>                                        
                                    </a>";
                }
                
                $menu .= "</li>";                
            }
            $menu .= "</ul>";
        }
        
        echo $menu;
        exit;
        
        return $menu;
    }

    public function get_item_menu($menu) {
        $dados = $this->data["dados"];

        return true;
    }
    
    public function get_default_method() {
        $dados = $this->session->userdata("dados" . APPNAME);
        $this->db->join("inventario_metodos", "menu.id_metodo = metodos.id");
        $this->db->join("inventario_grupos_permissoes", "menu.id_metodo = metodos.id");
        $rst = $this->db->get_where("inventario_menu", "padrao = 1")->row();
        if ($rst) {
            return $rst->classe . "/" . $rst->metodo;
        }
        return false;
    }

}
