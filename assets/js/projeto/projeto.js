$("#frmProjetos").submit( function(e){
    e.preventDefault();    
    var data = $(this).serialize();
    data = new FormData($("#frmProjetos").get(0));

    $.ajax({
        type: "POST",
        url: BASE_URL+"Projeto/adiciona_projeto",
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