$(document).ready(function () {
    table = $("#tbPipeline").DataTable({
        language: {
            url: BASE_URL+"assets/DataTables/DataTables-1.10.22/lang/portugues-brasil.json",
            select: { rows: { _: "%d linhas selecionadas", 1: "1 linha selecionada", 0: "" } }
        },
        ajax: {
            url: BASE_URL+"Pipeline/get_pipeline",
            dataSrc: "",
            type: "post",
            dataType: "json"
        },
        order: [[0, "asc"]],       
        paging: true,
        searching: true,
        ordering: true,        
        columns: [
            {                
                data: null,
                title: "Ativo",
                
                render: function (data, x, value) {
                    if (value.ativo == 'Y')
                    {
                        html = '<div class="dropdown">'
                        + '<input type="checkbox" name="ativo" onclick="return false" value="" id="ativo" checked>'
                        + '</div>';
                            
                        return html;
                    } 
                    if(value.ativo == null)
                    {
                        html = '<div class="dropdown">'
                        + '<input type="checkbox"  name="ativo" onclick="return false" value="" id="ativo">'
                        + '</div>';

                        return html;
                    }
                }
            },
            { data: "nome", title: "Nome do Projeto" },
            { 
                data: "requerimento", 
                title: "Desenvolvimento requerido",
                render: function (data, x, value){
                    return '<a title ="Editar" id="editar" onclick="editar(this)" style="cursor: pointer" data-nome="' + value.requerimento + '" data-id="' + value.id + '">' + value.requerimento + '</a>';
                }
            },
            { data: "area_beneficio", title: "Area beneficiada" },
            { data: "dispendio_recursos", title: "Dispêndio de recursos"},
            { data: "tipo_projeto", title: "Tipo"},
            { data: "beneficio", title: "Beneficio"},
            { data: "recomendacao", title: "Recomendação"},
            { data: "data_solicitacao", title: "Data de Solicitação"}            
        ],
        "columnDefs": [
            { "width": "5%", "targets": 0},
            { "width": "15%", "targets": 6},
            { "width": "15%", "targets": 5},
            { "width": "15%", "targets": 1},
            { "width": "10%", "targets": 2},
            { "width": "14%", "targets": 3},
            { "width": "10%", "targets": 7},
            { "width": "7%", "className": "text-left", "targets": 4},
            { "className": "text-center", "targets": "_all" },  
            {
                "data": null,
                "defaultContent": '',
                "orderable": false,
                "className": 'select-checkbox', targets: 0
            }         
        ],
    });    
});

function editar(btn){
    id = $(btn).data("id");
    console.log(btn);
    if (id == 0){
        swal("Ops!", "Projeto não encontrado", "error");
    }
    else
    {
        window.location.href = BASE_URL+"Projeto/index/" + id;   
    }    
}