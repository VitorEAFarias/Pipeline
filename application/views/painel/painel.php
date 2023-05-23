<section>
    <div class="row">
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-info">
                <div class="info-box-content">
                    <span class="info-box-text">Usuários Logados</span> 
                    <label><?= count($usrLogado) ?></label>                   
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-success">
                <div class="info-box-content">
                    <span class="info-box-text">Projetos Ativos</span>  
                    <label><?= count($projetos) ?></label>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-warning">
                <div class="info-box-content">
                    <span class="info-box-text">Horas Totais Em Desenvolvimento</span>                    
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-danger">
                <div class="info-box-content">
                    <span class="info-box-text">Usuários em Atividade</span> 
                    <label><?= count($usrAtividade) ?></label>                
                </div>
            </div>
        </div>          
        <div class="col-lg-12 col-sm-12 col-xs-12">                   
            <div class="card">
                <form id="frmPainel"> 
                    <div class="card-header border-transparent">
                        <h3 class="card-title"><b>Monitor de Projetos</b></h3>           
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <button type="submit" class="btn bg-secondary btn-flat m-2">Iniciar Projeto</button>
                            <input type="hidden" id="usrProject" name="usrProject">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="inputName">Selecione um projeto para iniciar</label>
                                    <select class="custom-select" id="projetos" name="projetos" required>                                    
                                    <option value="0">Todas</option>
                                        <?php foreach($projetos as $item): ?>
                                            <option value="<?= $item->nome ?>" <?= (@$carrega->nome == $item->id) ? 'selected' : '' ?> ><?= $item->nome ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="col-md-2">
                                <div class="form-group">                                
                                    <label for="inputStatus">Fase do Projeto</label>
                                    <select class="custom-select" id="fase_projeto" name="fase_projeto" required>
                                        <option value="0">Selecione</option>
                                        <?php foreach($fases as $item): ?>
                                        <option value="<?= $item->id ?>"><?= $item->titulo ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div> 
                            </div>
                        </div>                         
                    </div> 
                </form>
                <form id="pausaProjeto">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <button type="submit" class="btn bg-secondary btn-flat m-2">Pausar Projeto</button>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="inputName">Selecione um projeto para pausar</label>
                                    <select class="custom-select" id="projetosP" name="projetosP" required>                                    
                                    <option value="0">Todas</option>
                                        <?php foreach($projetosP as $item): ?>
                                            <option value="<?= $item->id ?>" <?= (@$carrega->nome_projeto == $item->id) ? 'selected' : '' ?> ><?= $item->nome_projeto ?> - <?= $item->nome_usuario ?> </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div> 
                </form>                   
                <div class="card-body p-0 m-2">
                    <div class="table-responsive">
                        <table class="table m-0" id="tbMonitoramento">
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
</section>