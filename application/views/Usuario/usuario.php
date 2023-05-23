<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Cadastro de Usuário</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <form = id="frmUsuario">
            <div class="row">           
                <div class="col-md-6">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Usuário</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>                        
                        <div class="card-body" >
                            <div class="form-group">
                                <label for="inputStatus">Tipo de Usuário</label>
                                <select id="tipo_usuario" name="tipo_usuario" class="form-control custom-select">                                    
                                    <option>Colaborador</option>
                                    <option>Superior</option>
                                </select>
                            </div> 
                            <div class="form-group nomeusuario">
                                <label for="inputName">Nome</label>
                                <input type="text" id="nome_usuario" name="nome_usuario" class="form-control">
                                <input type="hidden" value="" name="id" id="id" />
                            </div>
                            <div class="form-group">
                                <label for="inputName">Matricula</label>
                                <input type="text" id="matricula_usuario" name="matricula_usuario" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="inputName">Senha</label>
                                <input type="text" id="senha_usuario" name="senha_usuario" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="inputName">CPF</label>
                                <input type="text" id="cpf" name="cpf" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="inputName">Departamento</label>
                                <select class="custom-select" id="departamento" name="departamento">
                                <option value="0">Todas</option>
                                    <?php foreach($departamento as $item): ?>
                                        <option value="<?= $item->id ?>"><?= $item->nome ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>                                                        
                            <div class="form-group superior">
                                <label for="inputName">Superior</label>
                                <input type="text" id="superior" name="superior" class="form-control">
                            </div>                                                                                       
                        </div>
                        <div class="card-footer"> 
                            <div class="row">                                
                                <div class="col-12">
                                    <a href="#" class="btn btn-secondary">Cancelar</a>
                                    <input type="submit" value="Salvar" class="btn btn-success float-right">
                                </div>
                            </div>
                        </div>                   
                    </div>                    
                </div> 
                <div class="col-lg-6 col-sm-8 col-xs-6">
                    <div class="card">                
                        <div class="card-header border-0">
                        <h3 class="card-title">Usuários</h3>
                            <div class="card-tools">
                                <a href="#" class="btn btn-tool btn-sm">
                                    <i class="fas fa-bars"></i>
                                </a>
                            </div>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <div class="col-xs-12">
                                <table class="table table-striped table-valign-middle" id="tbUsuarios">
                                    <thead>
                                    </thead>
                                    <tbody>  
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>             
        </form>
    </section>
</div>
