$(document).ready(function () {
    table = $("#tbMonitoramento").DataTable({
        language: {
            url: BASE_URL+"assets/DataTables/DataTables-1.10.22/lang/portugues-brasil.json",
            select: { rows: { _: "%d linhas selecionadas", 1: "1 linha selecionada", 0: "" } }
        },
        ajax: {
            url: BASE_URL+"painel/get_projeto",
            dataSrc: "",
            type: "post",
            dataType: "json",
        },
        order: [[0, "asc"]],        
        searching: false,
        columns: [            
            { data: "nome_usuario", title: "Membro" },
            { data: "nome_projeto", title: "Nome do Projeto" },
            { data: "data_start", title: "Hora Start" },
            { data: "fase_projeto", title: "Fase do Projeto" }           
        ],
        "columnDefs": [
        ],
    });
    
    setTimeout(function () {
        window.location.reload(1);
    }, 1500000);
    $("#frmPainel").on("click", function(){
        
        table.ajax.reload();
    });
});

$("#frmPainel").submit( function(e){
    e.preventDefault();    
    var data = $(this).serialize();
    data = new FormData($("#frmPainel").get(0));
    
    
    $.ajax({
        type: "POST",
        url: BASE_URL+"Painel/inicia_projeto",
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        data: data,
        success: function (rst){
            if(rst.result === false)
            {
                swal.fire({                    
                    title: "Atenção",
                    icon: "warning",
                    confirmButtonText: "Ok",
                    html: rst.msg,
                })
            }
            else
            {
                swal.fire({                    
                    title: "Sucesso",
                    icon: "success",
                    confirmButtonText: "Ok",
                    html: rst.msg,
                }).then((data) => {
                    window.location.reload();
                })                          
            }
        }
    });
});

$("#pausaProjeto").submit( function(e){
    e.preventDefault();    
    var data = $(this).serialize();
    data = new FormData($("#pausaProjeto").get(0));
    
    var negocio = $("#projetosP").val();

    $.ajax({
        type: "POST",
        url: BASE_URL+"Painel/pausa_projeto/" + negocio,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        data: data,
        success: function (rst){
            if(rst.result === false)
            {
                swal("Erro!", rst.msg, "warning");
            }
            else
            {
                swal.fire({                    
                    title: "Sucesso",
                    icon: "success",
                    confirmButtonText: "Ok",
                    html: rst.msg,
                }).then((data) => {
                    window.location.reload();
                })                          
            }
        }
    });
});