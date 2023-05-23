<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Tarifador</title>
        <link rel="icon" href="<?= base_url("assets/img/logo.png") ?>" type="image/x-icon">
        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" type="text/css" href="<?= base_url("assets/plugins/fontawesome-free/css/all.min.css") ?>">
        <!-- icheck bootstrap -->
        <link rel="stylesheet" type="text/css" href="<?= base_url("assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css") ?>">
        <!-- DataTables -->
        <!-- <link rel="stylesheet" type="text/css" href="<?= base_url("assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css") ?>">
        <link rel="stylesheet" type="text/css" href="<?= base_url("assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css") ?>">
        <link rel="stylesheet" type="text/css" href="<?= base_url("assets/plugins/datatables-select/css/select.bootstrap4.min.css") ?>">
        <link rel="stylesheet" type="text/css" href="<?= base_url("assets/plugins/datatables-buttons/Buttons-1.6.5/css/buttons.dataTables.min.css") ?>"> -->

        <link rel="stylesheet" type="text/css" href="<?= base_url("assets/DataTables/DataTables-1.10.22/css/dataTables.bootstrap4.min.css") ?>">
        <link rel="stylesheet" type="text/css" href="<?= base_url("assets/DataTables/Buttons-1.6.5/css/buttons.bootstrap4.min.css") ?>">
        <link rel="stylesheet" type="text/css" href="<?= base_url("assets/DataTables/Responsive-2.2.6/css/responsive.bootstrap4.min.css") ?>">
        <link rel="stylesheet" type="text/css" href="<?= base_url("assets/DataTables/Select-1.3.1/css/select.bootstrap4.min.css") ?>">

        <!-- Theme style -->
        <link rel="stylesheet" type="text/css" href="<?= base_url("assets/css/adminlte.min.css") ?>">
        <!-- daterange picker -->
        <link rel="stylesheet" type="text/css" href="<?= base_url("assets/plugins/daterangepicker/daterangepicker.css") ?>">
        <!-- Toastr -->
        <link rel="stylesheet" type="text/css" href="<?= base_url("assets/plugins/toastr/build/toastr.min.css") ?>">
        <!-- Sweetalert Css -->
        <link href="<?= base_url("assets/plugins/sweetalert2/sweetalert2.min.css") ?>" rel="stylesheet">
    </head>
    <body class="<?= (isset($loginPage)) ? "hold-transition login-page" : "hold-transition layout-top-nav" ?>">
        <?php if(isset($loginPage)): ?>
            <?= (isset($content)) ? $content : "" ?>
        <?php else: ?>
            <!-- Site wrapper -->
            <div class="wrapper">
                <!-- Navbar -->
                <?= (isset($navbar) ? $navbar : "") ?>
                <!-- /.navbar -->

                <!-- Content Wrapper. Contains page content -->
                <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <?= (isset($pageHeader) ? $pageHeader : "<br/>") ?>
                <!-- /.content-header -->

                <!-- Main content -->
                <?= (isset($content) ? $content : "") ?>
                <!-- /.content -->
                </div>
                <!-- /.content-wrapper -->

                <footer class="main-footer text-sm">
                    <div class="float-right d-none d-sm-block">
                        <b>Versão</b> 1.0
                    </div>
                    <strong><a href="https://www.reisoffice.com.br">RR Soluções Ltda.</a> &copy; 2021.</strong> Todos os direitos reservados.
                </footer>
                <!-- /.control-sidebar -->
            </div>
        <!-- ./wrapper -->
        <?php endif; ?>

        <!-- jQuery -->
        <script type="text/javascript" src="<?= base_url("assets/plugins/jquery/jquery.min.js") ?>"></script>
        <!-- Bootstrap 4 -->
        <script type="text/javascript" src="<?= base_url("assets/plugins/bootstrap/js/bootstrap.bundle.min.js") ?>"></script>
        <!-- DataTables -->
        <script type="text/javascript" src="<?= base_url("assets/DataTables/JSZip-2.5.0/jszip.min.js") ?>"></script>
        <script type="text/javascript" src="<?= base_url("assets/DataTables/pdfmake-0.1.36/pdfmake.min.js") ?>"></script>
        <script type="text/javascript" src="<?= base_url("assets/DataTables/pdfmake-0.1.36/vfs_fonts.js") ?>"></script>
        <script type="text/javascript" src="<?= base_url("assets/DataTables/DataTables-1.10.22/js/jquery.dataTables.min.js") ?>"></script>
        <script type="text/javascript" src="<?= base_url("assets/DataTables/DataTables-1.10.22/js/dataTables.bootstrap4.min.js") ?>"></script>
        <script type="text/javascript" src="<?= base_url("assets/DataTables/Buttons-1.6.5/js/dataTables.buttons.min.js") ?>"></script>
        <script type="text/javascript" src="<?= base_url("assets/DataTables/Buttons-1.6.5/js/buttons.bootstrap4.min.js") ?>"></script>
        <script type="text/javascript" src="<?= base_url("assets/DataTables/Buttons-1.6.5/js/buttons.colVis.min.js") ?>"></script>
        <script type="text/javascript" src="<?= base_url("assets/DataTables/Buttons-1.6.5/js/buttons.html5.js") ?>"></script>
        <script type="text/javascript" src="<?= base_url("assets/DataTables/Responsive-2.2.6/js/dataTables.responsive.min.js") ?>"></script>
        <script type="text/javascript" src="<?= base_url("assets/DataTables/Responsive-2.2.6/js/responsive.bootstrap4.min.js") ?>"></script>
        <script type="text/javascript" src="<?= base_url("assets/DataTables/Select-1.3.1/js/dataTables.select.min.js") ?>"></script>        
        <!-- AdminLTE App -->
        <script type="text/javascript" src="<?= base_url("assets/js/adminlte.min.js") ?>"></script>
        <!-- InputMask -->
        <script type="text/javascript" src="<?= base_url("assets/plugins/moment/moment.min.js")?>"></script>
        <script type="text/javascript" src="<?= base_url("assets/plugins/inputmask/min/jquery.inputmask.bundle.min.js") ?>"></script>
        <!-- date-range-picker -->
        <script type="text/javascript" src="<?= base_url("assets/plugins/daterangepicker/daterangepicker.js") ?>"></script>
        <!-- Toastr -->
        <script type="text/javascript" src="<?= base_url("assets/plugins/toastr/build/toastr.min.js") ?>"></script>
        <!-- SweetAlert Plugin Js -->
        <script type="text/javascript" src="<?= base_url("assets/plugins/sweetalert2/sweetalert2.min.js") ?>"></script>
        <!-- Chats Js -->
        <script src="<?= base_url("assets/plugins/chart.js/Chart.min.js") ?> "></script>
        <!--html2canvas-->
        <script src="<?= base_url("assets\plugins\html2canvas\html2canvas.js") ?> "></script>    
        <script src="<?= base_url("assets\plugins\html2canvas\html2canvas.min.js") ?> "></script>    


        <script type="text/javascript">
            var BASE_URL = "<?= base_url() ?>";
            var ID_GRUPO = "<?= isset($dados) ? $dados->group_id : "" ?>";

            function showNotification(colorName, title, text, positionClass) {
                if (colorName === null || colorName === '') { colorName = 'info'; }
                if (text === null || text === '') { text = 'Deixe sua mensagem aqui'; }
                if (title === null || title === '') { title = 'Titulo'; }
                if (positionClass === null || positionClass === '') { positionClass = 'toast-top-center'; }

                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": true,
                    "positionClass": positionClass,
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }

                Command: toastr[colorName](text, title)
            }

            function TestaCPF(strCPF) {
                var Soma;
                var Resto;
                Soma = 0;
                strCPF = strCPF.replace(/[^\d]+/g,'');
                if (strCPF == "00000000000") return false;

                for (i=1; i<=9; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (11 - i);
                Resto = (Soma * 10) % 11;

                if ((Resto == 10) || (Resto == 11))  Resto = 0;
                if (Resto != parseInt(strCPF.substring(9, 10)) ) return false;

                Soma = 0;
                for (i = 1; i <= 10; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (12 - i);
                Resto = (Soma * 10) % 11;

                if ((Resto == 10) || (Resto == 11))  Resto = 0;
                if (Resto != parseInt(strCPF.substring(10, 11) ) ) return false;

                return true;
            }
        </script>
        <?php if(isset($javascript) && !empty($javascript)): ?>
            <?php foreach($javascript as $js): ?>
                <script src="<?= $js . "?v=" . time() ?>"></script>
            <?php endforeach; ?>
        <?php endif; ?>
    </body>
</html>