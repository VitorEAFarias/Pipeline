$(document).ready(function(){

    $("#submit").on("submit", function(e){
        e.preventDefault();

        var cpf = $("#cpf").val();
        var senha = $("#senha").val();
        var colaborador = $("#colaborador");

        if(colaborador.prop("checked") == true)
        {
            usuario = "colaborador";
        }
        else
        usuario = "Superior";

        if(cpf != "")
        {
            if(senha != "")
            {           
                var array = {"cpf": cpf, "senha": senha, "tipo_usuario": usuario};        
                $.ajax({
                    type: "post",
                    url: BASE_URL+"Login/login_acesso",
                    dataSrc: "",
                    dataType: "json",
                    data: array,
                    success: function(data)
                    {
                        if (data.logged === true)   
                        {
                            window.location.href = BASE_URL+"painel";
                        }
                        else if(data.logged === false)
                        {
                            showNotification("info", "Erro ao acessar", data.error, "toast-top-center");
                        }
                    }
                });
            }
            else
            {
                showNotification("error", "Erro no campo", "Campo 'Senha' está vazio", "toast-top-center");
            }
        }
        else
        {
            showNotification("error", "Erro no campo", "Campo 'CPF' está vazio", "toast-top-center");
        }         
    });

    $("#cpf").inputmask({"mask": "999.999.999-99"});        
});