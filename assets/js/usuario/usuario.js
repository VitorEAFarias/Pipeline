$(document).ready(function () {
    table = $("#tbUsuarios").DataTable({
        ajax: {
            url: BASE_URL+"Usuario/get_usuarios",
            dataSrc: "",
            type: "post",
            dataType: "json"
        },
        order: [[0, "asc"]],
        paging: true,
            lengthChange: false,
            searching: true,
            ordering: true,
            info: true,
            fixedColumns: true,
            responsive: false,
            autoWidth: true,
            pageLength: 100,
            processing: true,
        columns: [
            { data: "matricula", title: "Matrícula" },
            { 
                data: "nome", 
                title: "Nome",
                render: function (data, x, value){
                    return '<a title ="Editar" id="editar" onclick="editar(this)" style="cursor: pointer" data-nome="' + value.nome + '" data-id="' + value.id + '">' + value.nome + '</a>';
                } 
            },
            { data: "departamento", title: "Departamento" }, 
            { data: "nome_superior", title: "Superior"}      
        ],
        "columnDefs": [
            { "width": "10%", "targets": 0}
        ],
    });    
});

$("#tipo_usuario").click(function () {
    var cbo = $("#tipo_usuario").val();
    if (cbo == 'Superior')
    {
        $(".superior").hide();
        $("#superior").val();
    }
    else if (cbo == 'Colaborador') 
    {
        $(".superior").show();       
    }    
        
});

$("#frmUsuario").submit( function(e){
    e.preventDefault();    
    var data = $(this).serialize();
    data = new FormData($("#frmUsuario").get(0));

    $.ajax({
        type: "POST",
        url: BASE_URL+"Usuario/insere_usuario",
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

function editar(btn){
    id = $(btn).data("id");
    console.log(btn);
    if (id == 0){
        swal("Ops!", "Usuário não encontrado", "error");
    }
    else
    {
        window.location.href = BASE_URL+"usuario/index/" + id;   
    }    
}