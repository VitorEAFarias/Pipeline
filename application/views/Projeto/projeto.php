<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Novo Projeto</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <form = id="frmProjetos">
            <div class="row">            
                <div class="col-md-6">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Geral</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">                            
                                <label for="inputStatus">Projeto Aprovado</label>
                                <input type="checkbox" name="ativo" value="Y" <?php if(@$carrega->ativo == 'Y'){ echo "checked"; } ?> id="ativo" class="custom-control">                                         
                            </div>                            
                            <div class="form-group">
                                <label for="inputName">Nome do projeto</label>
                                <input type="text" value="<?= $carrega ? $carrega->nome : '' ?>" id="nome_projeto" name="nome_projeto" class="form-control">
                                <input type="hidden" value="<?= $carrega ? $carrega->id : '' ?>" name="id" id="id" />
                            </div> 
                            <div class="form-group">
                                <label for="inputDescription">Requerimento de Projeto</label>
                                <textarea id="requerimento_projeto" name="requerimento_projeto" class="form-control" rows="2"><?= $carrega ? $carrega->requerimento : '' ?></textarea>
                            </div> 
                            <div class="form-group">
                                <label for="inputDate">Data de Solicitação</label>
                                <input id="date" type="date" name="data_solicitacao" class="form-control">
                            </div>  
                            <div class="form-group">
                                <label for="inputName">Departamento designado</label>
                                <select class="custom-select" id="departamento" name="departamento">
                                <option value="0">Todas</option>
                                    <?php foreach($departamento as $item): ?>
                                        <option value="<?= $item->id ?>" <?= (@$carrega->id_departamento == $item->id) ? 'selected' : '' ?> ><?= $item->nome ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="inputStatus">Tipo de projeto</label>
                                <select id="tipo_projeto" name="tipo_projeto" class="form-control custom-select">
                                    <option disabled>Selecione</option>
                                    <option <?= $carrega && $carrega->id_departamento == "Melhoria" ? 'selected' : '' ?>>Novo Projeto</option>
                                    <option <?= $carrega && $carrega->id_departamento == "Novo Projeto" ? 'selected' : '' ?>>Melhoria</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="inputStatus">Recomendação</label>
                                <select id="recomendacao" name="recomendacao" class="form-control custom-select">
                                    <option disabled>Selecione</option>
                                    <option <?= $carrega && $carrega->recomendacao == "Desenvolvimento não prioritário" ? 'selected' : '' ?>>Desenvolvimento não prioritário</option>
                                    <option <?= $carrega && $carrega->recomendacao == "Avaliar conveniência" ? 'selected' : '' ?>>Avaliar conveniência</option>
                                    <option <?= $carrega && $carrega->recomendacao == "Priorizar desenvolvimento" ? 'selected' : '' ?>>Priorizar desenvolvimento</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="inputClientCompany">Area beneficiada</label>
                                <input type="text" id="area_beneficiada" value="<?= $carrega ? $carrega->area_beneficio : '' ?>" name="area_beneficiada" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="inputProjectLeader">Responsável</label>
                                <input type="text" id="responsavel_projeto" value="<?= $carrega ? $carrega->responsavel : '' ?>" name="responsavel_projeto" class="form-control">
                            </div>  
                        </div>                    
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Despesas</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="inputEstimatedBudget">Despesa estimada</label>
                                <input type="text" id="despesa_estimada" value="<?= $carrega ? $carrega->despesa_estimada : '' ?>" name="despesa_estimada" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="inputSpentBudget">Dispêndio de recursos</label>
                                <select id="dispendio_recurso" name="dispendio_recurso" class="form-control custom-select">
                                    <option disabled>Selecione</option>
                                    <option <?= $carrega && $carrega->dispendio_recursos == "Baixo - até 40h" ? 'selected' : '' ?>>Baixo - até 40h</option>
                                    <option <?= $carrega && $carrega->dispendio_recursos == "Médio - até 80h" ? 'selected' : '' ?>>Médio - até 80h</option>
                                    <option <?= $carrega && $carrega->dispendio_recursos == "Alto - acima de 80h" ? 'selected' : '' ?>>Alto - acima de 80h</option>
                                </select>
                            </div>
                            <div class="form-group">
                            <label for="inputStatus">Benefício</label>
                                <select id="beneficio" name="beneficio" class="form-control custom-select">
                                    <option disabled>Selecione</option>
                                    <option <?= $carrega && $carrega->beneficio == "Baixo - Melhora não prioritária de segurança ou automação de baixo impacto" ? 'selected' : '' ?>>Baixo - Melhora não prioritária de segurança ou automação de baixo impacto</option>
                                    <option <?= $carrega && $carrega->beneficio == "Médio - Melhora prioritária de segurança ou automação relevante" ? 'selected' : '' ?>>Médio - Melhora prioritária de segurança ou automação relevante</option>
                                    <option <?= $carrega && $carrega->beneficio == "Alto - Mensurável em $" ? 'selected' : '' ?>>Alto - Mensurável em $</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>                
            </div>        
            <div class="row">
                <div class="col-12">
                    <a href="#" class="btn btn-secondary">Cancelar</a>
                    <input type="submit" value="Salvar" class="btn btn-success float-right">
                </div>
            </div>
        </form>
    </section>
</div>