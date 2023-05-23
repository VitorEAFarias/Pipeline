<nav class="main-header navbar navbar-expand navbar-dark navbar-black">
    <a href="<?= base_url("painel") ?>" class="navbar-brand">
        <img src="<?= base_url("assets/img/logo.png") ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-bold">Tarifador</span>
    </a>
    <ul class="navbar-nav">
        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?= base_url("painel") ?>" class="nav-link">Painel</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?= base_url("usuario") ?>" class="nav-link">Novo Usuário</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?= base_url("projeto") ?>" class="nav-link">Novo Projeto</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?= base_url("relatoriohoras") ?>" class="nav-link">Relatório de Horas</a>
        </li>         
        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?= base_url("pipeline") ?>" class="nav-link">Pipeline de Projetos</a>
        </li>       
        <?php if(@$dados->group_id == 1): ?>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="<?= base_url("Usuario") ?>" class="nav-link">Usuario</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Configuracao</a>
                <div class="dropdown-menu" aria-labelledby="dropdown">
                    <a class="dropdown-item" href="<?= base_url("Configuracao/index") ?>">Categoria e Tipo de Ativo</a>
                    <a class="dropdown-item" href="<?= base_url("Configuracao/propriedade") ?>">Propriedade</a>
                    <a class="dropdown-item" href="<?= base_url("Configuracao/tipo_ativo_propriedade") ?>">Vinculo Tipo Ativo e Propriedade</a>
                    <a class="dropdown-item" href="<?= base_url("Configuracao/fabricante") ?>">Fabricante e Modelo</a>
                </div>
            </li>
        <?php endif; ?>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item d-none d-sm-inline-block navbar-brand">
        <span class="font-weight-light"><?= @$dados->nome ?></span>
        </li>
        <li class="nav-item d-none d-sm-inline-block navbar-brand">
        </li>
        <li class="nav-item d-none d-sm-inline-block navbar-brand">
        <a class="dropdown-item" href="<?= base_url("Login/logout") ?>"><i class="fas fa-sign-out-alt"></i> Sair</a>
        </li>
    </ul>
</nav>