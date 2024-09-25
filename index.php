<!DOCTYPE html>
<html>
<head>
    <title>Gerador de Rifas</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="public/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="public/js/respond.js"></script>
    <![endif]-->
    <script src="public/js/jquery.min.js"></script>
    <script src="public/js/jquery-migrate.min.js"></script>
    <script src="public/js/bootstrap.min.js"></script>
    <link rel="shortcut icon" href="public/favicon.ico" type="image/x-icon" />
    <style>
        html, body { height: 100%; }
        #wrap { min-height: 100%; height: auto !important; height: 100%; margin: 0 auto -60px; padding: 0 0 60px; }
        #footer { height: 60px; background-color: #f5f5f5; }
        .container { width: auto; padding: 0 15px; }
        .container .credit { margin: 20px 0; }
    </style>
</head>
<body>
<div id="wrap">
    <nav class="navbar navbar-inverse" role="navigation">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">
                Gerador de Rifas
            </a>
        </div>
    </nav>
    <div class="container">
        <form id="formulario" class="form-horizontal">
            <fieldset>
                <legend>Geração de Bilhetes para rifa</legend>
                <div class="col-md-12">
                    <input type="hidden" name="relatorio" id="relatorio" value="quantitativo">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Cotas / Blocos</label>
                                <div class="col-md-8">
                                    <input type="number" id="participantes" name="participantes" placeholder="Número de Participantes" class="form-control numeros" value="25">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Quant. Números</label>
                                <div class="col-md-8">
                                    <input type="text" id="quantidade" name="quantidade" placeholder="Universo dos números de sorteio" class="form-control numeros" value="1000">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Bilhetes por Cotas</label>
                                <div class="col-md-8">
                                    <input type="text" id="pbilhetes" name="pbilhetes" placeholder="Quantidade de Bilhetes" class="form-control numeros" value="10">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Nº por Bilhetes</label>
                                <div class="col-md-8">
                                    <!--2-->
                                    <input type="text" id="nbilhetes" name="nbilhetes" placeholder="Quantos Números por bilhete" class="form-control numeros" value="4">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Título</label>
                                <div class="col-md-8">
                                    <input type="text" id="titulo" name="titulo" placeholder="Título da rifa" class="form-control" value="Ação entre Amigos">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Prêmio</label>
                                <div class="col-md-8">
                                    <input type="text" id="premio" name="premio" placeholder="Prêmio da Rifa" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Data do Sorteio</label>
                                <div class="col-md-8">
                                    <input type="text" id="data" name="data" placeholder="Data do Sorteio" class="form-control" value="<?php echo date('d/m/Y'); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Valor</label>
                                <div class="col-md-8">
                                    <input type="text" id="valor" name="valor" placeholder="Valor da Rifa" class="form-control" value="R$ 10,00">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="col-md-4"></div>
                                <div class="col-md-8">
                                    <button type="submit" class="btn btn-primary">
                                        <span class="glyphicon glyphicon-list-alt disabled"></span> Gerar Rifas
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>
<div id="footer">
    <div class="container">
        <p class="text-muted credit">
            Copyleft - <?php echo date('Y') ?> - Gerador de Rifas v0.9.1
        </p>
    </div>
</div>
</body>
</html>

<script src="public/js/jquery.maskedinput.min.js"></script>
<script src="public/js/jquery.maskMoney.min.js"></script>
<script src="public/js/jquery.validate.min.js"></script>

<script>
    jQuery(function() {
        $('#data').mask('99/99/9999');
        $("#valor").maskMoney({prefix: 'R$ ', allowNegative: true, thousands: '.', decimal: ',', affixesStay: false});

        $(".numeros").keyup(function() {
            var valor = $(this).val().replace(/[^0-9]+/g, '');
            $(this).val(valor);
        });

        $.validator.setDefaults({
            highlight: function(input) {
                $(input).parent().parent().addClass("has-error");
                if ($('.form-group').hasClass('has-error') && $('#alerta').hasClass('alert-success'))
                    $('#msg').html('');

                if ($('#msg').html() !== '')
                    $('#alerta').fadeIn();
            },
            unhighlight: function(input) {
                $(input).parent().parent().removeClass("has-error");

                if (!$('.form-group').hasClass('has-error'))
                    $('#alerta').fadeOut();
            },
            errorPlacement: function(error, element) {
                return true;
            }
        });

        $('#formulario').validate({
            submitHandler: function() {
                abrirPopup('imprimir.php?participantes=' + $('#participantes').val() + '&quantidade=' + $('#quantidade').val() + '&nbilhetes=' + $('#nbilhetes').val() + '&pbilhetes=' + $('#pbilhetes').val() + '&premio=' + $('#premio').val() + '&titulo=' + $('#titulo').val() + '&data=' + $('#data').val() + '&valor=' + $('#valor').val());

                return false;
            },
            rules: {
                participantes: 'required',
                quantidade: 'required',
                bilhetes: 'required',
                nbilhetes: 'required'
            }
        });
    });

    function abrirPopup(URL) {
        var width = 800;
        var height = 600;
        var left = 99;
        var top = 99;
        window.open(URL, '', 'width=' + width + ', height=' + height + ', top=' + top + ', left=' + left + ', scrollbars=yes, status=no, toolbar=no, location=no, directories=no, menubar=no, resizable=no, fullscreen=no');
    }
</script>