<?php $this->load->view('template/header');?>
<!-- Morris charts -->
<link rel="stylesheet" href="<?php echo base_url();?>resources/bower_components/morris.js/morris.css">

<div class="box box-primary">
    <div class="box-body">
        <?php echo form_open('anioagricola/graficas/datos', array('id'=>'frm-anioagricola','role'=>'form')); ?>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <?php echo form_label('Seleccionar Año:', 'anio'); ?>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <?php echo form_dropdown('anio', $anios, $anioselect, array('id'=>'anio','class'=>'form-control')); ?>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <?php echo form_label('Seleccionar Mes:', 'mes'); ?>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <?php echo form_dropdown('mes', $meses, $messelect, array('id'=>'mes','class'=>'form-control')); ?>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <div style="text-align: right;">
                        <?php echo form_submit(array('id'=>'btn-graficar','value'=>'Graficar','class'=>'btn btn-primary')); ?>
                    </div>
                </div>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
    <!-- /.box-body -->
</div>

<div id="box-graficas" style="display:none;">
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">GRAFICA DE PRECIPITACION PLUVIAL</h3>
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
<script src="<?php echo base_url();?>resources/bower_components/chartjs/Chart.bundle.min.js"></script>

<script>
    var label=[], pp=[], max=[], min=[], med=[];

    var chartColors = {
        precipitacion: 'rgb(0,192,239)',
        precipitacion_fill: 'rgb(204,229,255)',
        maxima: 'rgb(221,75,57)',
        maxima_fill: 'rgb(248,215,218)',
        media: 'rgb(0,166,90)',
        media_fill: 'rgb(212,237,218)',
        minima: 'rgb(60,141,188)',
        minima_fill: 'rgb(161,204,228)',
    };

    function responseToArrays(response){
        label=[], pp=[], max=[], min=[], med=[];
        for(var i=0;i<response.length;i++){
            label.push(response[i].dia+' / '+response[i].mes);
            pp.push(response[i].precipitacion_pluvial);
            max.push(response[i].maxima);
            min.push(response[i].minima);
            med.push(response[i].media);
        }
    }


    $('#btn-graficar').on('click', function(event){
        event.preventDefault();

        $("#box-graficas").show(); 
        $("#line-pp").remove();
        $('#box-pp').append('<canvas id="line-pp"></canvas>');
        $("#line-media").remove();
        $('#box-media').append('<canvas id="line-media"></canvas>');
        $("#line-maxima").remove();
        $('#box-maxima').append('<canvas id="line-maxima"></canvas>');
        $("#line-minima").remove();
        $('#box-minima').append('<canvas id="line-minima"></canvas>');

        var url=$('#frm-anioagricola').attr('action');
        $.ajax({
            url: url,
            dataType: 'JSON',
            type: 'POST',
            data: $("#frm-anioagricola").serialize(),
                success: function(response) {
                        responseToArrays(response);
                        var ctx_pp = document.getElementById("line-pp").getContext('2d');
                        var myLineChart = new Chart(ctx_pp, {
                            type: 'line',
                            data: {
                                datasets: [{
                                    label: 'Precipitación Pluvial',
                                    backgroundColor: chartColors.precipitacion_fill,
                                    borderColor: chartColors.precipitacion,
                                    data: pp
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
                                    label: 'Temperatura Máxima',
                                    backgroundColor: chartColors.maxima_fill,
                                    borderColor: chartColors.maxima,
                                    data: max
                                }],
                                labels: label
                            }, 
                            options : {
                            scales: {
                                    yAxes: [{
                                    scaleLabel: {
                                        display: true,
                                        labelString: 'Temperatura (°C)'
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
                                    label: 'Temperatura Media',
                                    backgroundColor: chartColors.media_fill,
                                    borderColor: chartColors.media,
                                    data: med
                                }],
                                labels: label
                            }, 
                            options : {
                            scales: {
                                    yAxes: [{
                                    scaleLabel: {
                                        display: true,
                                        labelString: 'Temperatura (°C)'
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
                                    label: 'Temperatura Mínima',
                                    backgroundColor: chartColors.minima_fill,
                                    borderColor: chartColors.minima,
                                    data: min
                                }],
                                labels: label
                            }, 
                            options : {
                            scales: {
                                    yAxes: [{
                                    scaleLabel: {
                                        display: true,
                                        labelString: 'Temperatura (°C)'
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