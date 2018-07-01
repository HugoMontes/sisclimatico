<?php $this->load->view('template/header');?>
<!-- Morris charts -->
<link rel="stylesheet" href="<?php echo base_url(); ?>resources/bower_components/morris.js/morris.css">

<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-body">
                <?php echo form_open('prediccion/graficas/datos', array('id' => 'frm-prediccion', 'role' => 'form')); ?>
                    <div class="form-group">
                        <?php echo form_label('Seleccionar Mes:', 'mes'); ?>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <?php echo form_dropdown('mes', $meses, $messelect, array('id' => 'mes', 'class' => 'form-control')); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div style="text-align: right;">
                            <?php echo form_submit(array('id' => 'btn-graficar', 'value' => 'Graficar', 'class' => 'btn btn-primary')); ?>
                        </div>
                    </div>
                <?php echo form_close(); ?>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>

<div id="box-graficas" style="display:none;">
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">PRECIPITACIÓN PLUVIAL</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse">
                    <i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove">
                    <i class="fa fa-times"></i>
                </button>
            </div>
        </div>
        <div id="box-pp" class="box-body chart-responsive">
            <canvas id="line-pp"></canvas>
        </div>
    </div>
    <div class="box box-danger">
        <div class="box-header with-border">
            <h3 class="box-title">GRAFICA DE TEMPERATURA MAXIMA</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse">
                    <i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove">
                    <i class="fa fa-times"></i>
                </button>
            </div>
        </div>
        <div id="box-maxima" class="box-body chart-responsive">
            <canvas id="line-maxima"></canvas>
        </div>
    </div>
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">GRAFICA DE TEMPERATURA MEDIA</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse">
                    <i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove">
                    <i class="fa fa-times"></i>
                </button>
            </div>
        </div>
        <div id="box-media" class="box-body chart-responsive">
            <canvas id="line-media"></canvas>
        </div>
    </div>
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">GRAFICA DE TEMPERATURA MINIMA</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse">
                    <i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove">
                    <i class="fa fa-times"></i>
                </button>
            </div>
        </div>
        <div id="box-minima" class="box-body chart-responsive">
            <canvas id="line-minima"></canvas>
        </div>
    </div>
</div>

<?php $this->load->view('template/footer');?>
<!-- Chart.js charts -->
<script src="<?php echo base_url(); ?>resources/bower_components/chartjs/Chart.bundle.min.js"></script>

<script>
    var label=[];
    var pp_esperado=[], pp_mayor=[], pp_menor=[];
    var maxima_esperado=[], maxima_mayor=[], maxima_menor=[];
    var media_esperado=[], media_mayor=[], media_menor=[];
    var minima_esperado=[], minima_mayor=[], minima_menor=[];

    var chartColors = {
        red: 'rgb(255, 99, 132)',
        orange: 'rgb(255, 159, 64)',
        yellow: 'rgb(255, 205, 86)',
        green: 'rgb(75, 192, 192)',
        blue: 'rgb(54, 162, 235)',
        purple: 'rgb(153, 102, 255)',
        grey: 'rgb(231,233,237)'
    };

    function responseToArrays(response){
        label=[];
        pp_esperado=[], pp_mayor=[], pp_menor=[];
        maxima_esperado=[], maxima_mayor=[], maxima_menor=[];
        media_esperado=[], media_mayor=[], media_menor=[];
        minima_esperado=[], minima_mayor=[], minima_menor=[];

        for(var i=0;i<response.length;i++){
            label.push(i+1);
            pp_esperado.push(response[i].esperados.pp);
            pp_mayor.push(response[i].mayores.pp);
            pp_menor.push(response[i].menores.pp);

            maxima_esperado.push(response[i].esperados.max);
            maxima_mayor.push(response[i].mayores.max);
            maxima_menor.push(response[i].menores.max);

            media_esperado.push(response[i].esperados.med);
            media_mayor.push(response[i].mayores.med);
            media_menor.push(response[i].menores.med);

            minima_esperado.push(response[i].esperados.min);
            minima_mayor.push(response[i].mayores.min);
            minima_menor.push(response[i].menores.min);
        }
    }


    $('#btn-graficar').on('click', function(event){
        event.preventDefault();

        $("#box-graficas").show();
        $("#line-pp").remove();
        $('#box-pp').append('<canvas id="line-pp"></canvas>');

        var url=$('#frm-prediccion').attr('action');
        $.ajax({
            url: url,
            dataType: 'JSON',
            type: 'POST',
            data: $("#frm-prediccion").serialize(),
                success: function(response) {
                    responseToArrays(response);
                    var ctx_pp = document.getElementById("line-pp").getContext('2d');
                    var myLineChart = new Chart(ctx_pp, {
                        type: 'line',
                        data: {
                            datasets: [{
                                label: 'Valor Esperado',
                                backgroundColor: chartColors.green,
                                borderColor: chartColors.green,
                                data: pp_esperado
                            },
                            {
                                label: 'Valor Mayor',
                                backgroundColor: chartColors.red,
                                borderColor: chartColors.red,
                                data: pp_mayor
                            },
                            {
                                label: 'Valor Menor',
                                backgroundColor: chartColors.blue,
                                borderColor: chartColors.blue,
                                data: pp_menor
                            }],
                            labels: label
                        },
                        options : {
                        scales: {
                            yAxes: [{
                                scaleLabel: {
                                    display: true,
                                    labelString: 'Precipitacion Pluvial (mm)'
                                }
                            }],
                            xAxes: [{
                                scaleLabel: {
                                    display: true,
                                    labelString: 'días'
                                }
                            }],
                        }
                    }
                });

                var ctx_maxima = document.getElementById("line-maxima").getContext('2d');
                    var myLineChart = new Chart(ctx_maxima, {
                        type: 'line',
                        data: {
                            datasets: [{
                                label: 'Valor Esperado',
                                backgroundColor: chartColors.green,
                                borderColor: chartColors.green,
                                data: maxima_esperado
                            },
                            {
                                label: 'Valor Mayor',
                                backgroundColor: chartColors.red,
                                borderColor: chartColors.red,
                                data: maxima_mayor
                            },
                            {
                                label: 'Valor Menor',
                                backgroundColor: chartColors.blue,
                                borderColor: chartColors.blue,
                                data: maxima_menor
                            }],
                            labels: label
                        },
                        options : {
                        scales: {
                            yAxes: [{
                                scaleLabel: {
                                    display: true,
                                    labelString: 'Temperatura Máxima (°C)'
                                }
                            }],
                            xAxes: [{
                                scaleLabel: {
                                    display: true,
                                    labelString: 'días'
                                }
                            }],
                        }
                    }
                });

                var ctx_media = document.getElementById("line-media").getContext('2d');
                    var myLineChart = new Chart(ctx_media, {
                        type: 'line',
                        data: {
                            datasets: [{
                                label: 'Valor Esperado',
                                backgroundColor: chartColors.green,
                                borderColor: chartColors.green,
                                data: media_esperado
                            },
                            {
                                label: 'Valor Mayor',
                                backgroundColor: chartColors.red,
                                borderColor: chartColors.red,
                                data: media_mayor
                            },
                            {
                                label: 'Valor Menor',
                                backgroundColor: chartColors.blue,
                                borderColor: chartColors.blue,
                                data: media_menor
                            }],
                            labels: label
                        },
                        options : {
                        scales: {
                            yAxes: [{
                                scaleLabel: {
                                    display: true,
                                    labelString: 'Temperatura Media (°C)'
                                }
                            }],
                            xAxes: [{
                                scaleLabel: {
                                    display: true,
                                    labelString: 'días'
                                }
                            }],
                        }
                    }
                });

                var ctx_minima = document.getElementById("line-minima").getContext('2d');
                    var myLineChart = new Chart(ctx_minima, {
                        type: 'line',
                        data: {
                            datasets: [{
                                label: 'Valor Esperado',
                                backgroundColor: chartColors.green,
                                borderColor: chartColors.green,
                                data: minima_esperado
                            },
                            {
                                label: 'Valor Mayor',
                                backgroundColor: chartColors.red,
                                borderColor: chartColors.red,
                                data: minima_mayor
                            },
                            {
                                label: 'Valor Menor',
                                backgroundColor: chartColors.blue,
                                borderColor: chartColors.blue,
                                data: minima_menor
                            }],
                            labels: label
                        },
                        options : {
                        scales: {
                            yAxes: [{
                                scaleLabel: {
                                    display: true,
                                    labelString: 'Temperatura Mínima (°C)'
                                }
                            }],
                            xAxes: [{
                                scaleLabel: {
                                    display: true,
                                    labelString: 'días'
                                }
                            }],
                        }
                    }
                });
            }
        });
    });
</script>