$(document).ready(function () {
    var post = {colaborador:'', data_inicio:'', data_fim:''}
    table = $("#tbRelatorio").DataTable({   
        language: {
            url: BASE_URL+"assets/DataTables/DataTables-1.10.22/lang/portugues-brasil.json",
            select: { rows: { _: "%d linhas selecionadas", 1: "1 linha selecionada", 0: "" } }
        },    
        ajax: {
            url: BASE_URL+"RelatorioHoras/get_dados",
            dataSrc: "",
            type: "post",
            dataType: "json",
            data: function (d){
                return post;
            }
        },
        order: [[0, "asc"]],        
        searching: false,
        columns: [
            { data: "nome", title: "Projeto" },
            { data: "horas", title: "Tempo em Projeto" },
            { data: "fase_projeto", title: "Fase Do Projeto"}           
        ],
        "columnDefs": [
        ],
    });  

    $("#gerarRelatorio").on("click", function(){
        
        post.colaborador = $("#colaboradores").val();
        post.data_inicio = $("#data_inicial").val();
        post.data_fim = $("#data_final").val();

        var data = $(this).serialize();
        data = new FormData($("#frmGetColaboradorPeriodo").get(0));
        $.ajax({
            type: "POST",
            url: BASE_URL+"RelatorioHoras/get_informacoes",
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            data: data,
            success: function (result){
                $("#colaborador").html(result.nome);
                $("#cpf").html(result.cpf);
                $("#matricula").html(result.matricula);
                $("#superior").html(result.nome_superior);                
            }
        });         

        table.ajax.reload();
    });

});

$("#btGerarPDF").on('click', function genScreenshotgraph(){
    html2canvas($('#conteudo'), {
        
      onrendered: function(canvas) {
        var imgData = canvas.toDataURL("image/jpeg");
        var pdf = new jsPDF();
        pdf.addImage(imgData, 'JPEG', 0, 0, -180, -180);
        pdf.save("download.pdf");
            }
     })
});

    // $("#btGerarPDF").on('click', function(){
    //     html2canvas($("#conteudo"), {
    //         onrendered: function (canvas) {
    //             var url = canvas.toDataURL();
    //             var triggerDownload = $("<a>").attr("href", url).attr("download", getNowFormatDate()+"电子签名详细信息.jpeg").appendTo("body");
    //             triggerDownload[0].click();
    //             triggerDownload.remove();
    //         }
    //     })
    // });

// getScreenshotOfElement($("#conteudo").get(0), 0, 0, 100, 100, function(data) {
//     $("img#captured").attr("src", "data:image/png;base64,"+data);
// });

// function getScreenshotOfElement(element, posX, posY, width, height, callback) {
//     html2canvas(element, {
//         onrendered: function (canvas) {
//             var context = canvas.getContext('2d');
//             var imageData = context.getImageData(posX, posY, width, height).data;
//             var outputCanvas = document.createElement('canvas');
//             var outputContext = outputCanvas.getContext('2d');
//             outputCanvas.width = width;
//             outputCanvas.height = height;

//             var idata = outputContext.createImageData(width, height);
//             idata.data.set(imageData);
//             outputContext.putImageData(idata, 0, 0);
//             callback(outputCanvas.toDataURL().replace("data:image/png;base64,", ""));
//         },
//         width: width,
//         height: height,
//         useCORS: true,
//         taintTest: false,
//         allowTaint: false
//     });
// }