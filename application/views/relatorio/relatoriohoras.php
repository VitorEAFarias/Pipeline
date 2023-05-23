<section>
    <form id="frmGetColaboradorPeriodo">
        <div class="card card-secondary">
            <div class="row">
                <div class="form-group m-3">
                    <label for="inputStatus">Selecione um Colaborador</label>
                    <select id="colaboradores" name="colaboradores" class="form-control custom-select"> 
                        <option value="0">Todas</option>
                        <?php foreach($colaboradores as $item): ?>
                            <option value="<?= $item->id ?>" <?= (@$carrega->nome == $item->id) ? 'selected' : '' ?> ><?= $item->nome ?></option>
                        <?php endforeach; ?>    
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="form-group m-3">
                    <label for="inputStatus">Data Inicial:</label>
                    <input id="data_inicial" type="date" name="data_inicial" class="form-control">
                </div>
                <div class="form-group m-3">
                    <label for="inputStatus">Data Final:</label>
                    <input id="data_final" type="date" name="data_final" class="form-control">
                </div>                
            </div>
            <div class="row">
                <div class="form-group m-3">
                    <button type="button" id="gerarRelatorio" class="btn btn-block btn-primary btn-sm">Gerar Relatório</button>
                </div>
            </div>
        </div>
    </form>
    <div class="invoice p-3 mb-3" id="conteudo">
        <div class="row">
            <div class="col-12">
                <h4>
                    <img src="assets/dist/img/Logo_RO__210x54-01.png" alt="RO Logo" height="70" width="230" style="opacity: .8">
                    <small class="float-right" ><?php echo date("d/m/Y"); ?></small>
                </h4>
            </div>
        </div>
        <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
                <address><br>
                <strong>Informações do Colaborador:</strong><br>
                Nome: <label id="colaborador"></label> <br>
                CPF: <label id="cpf"></label> <br>
                Matricula: <label id="matricula"></label> <br>
                </address>
            </div>
            <div class="col-sm-4 invoice-col">
                <address><br>
                <strong>Relatório Gerado Por:</strong><br>
                Superior: <label id="superior"></label> <br>
                <br>
                </address>
            </div>     
        </div>
        <div class="row">
            <div class="col-12 table-responsive">
                <table class="table table-striped" id="tbRelatorio">
                    <thead>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row no-print">
            <div class="col-12">
                <br><a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Imprimir</a>
                <div class="float-right">
                    <button type="button" id="btGerarPDF" class="btn btn-primary float-right" style="margin-right: 5px;">
                        <i class="fas fa-download"></i> Gerar PDF
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>