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
        <div class="box-body chart-responsive">
            <div class="chart" id="line-pp" style="height: 300px;"></div>
        </div>
        <!-- /.box-body -->
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
        <div class="box-body chart-responsive">
            <div class="chart" id="line-maxima" style="height: 300px;"></div>
        </div>
        <!-- /.box-body -->
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
        <div class="box-body chart-responsive">
            <div class="chart" id="line-media" style="height: 300px;"></div>
        </div>
        <!-- /.box-body -->
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
        <div class="box-body chart-responsive">
            <div class="chart" id="line-minima" style="height: 300px;"></div>
        </div>
        <!-- /.box-body -->
    </div>
</div>
<?php $this->load->view('template/footer');?>
<!-- Morris.js charts -->
<script src="<?php echo base_url();?>resources/bower_components/raphael/raphael.min.js"></script>
<script src="<?php echo base_url();?>resources/bower_components/morris.js/morris.min.js"></script>

<script>
    $('#btn-graficar').on('click', function(event){
        event.preventDefault();
        $("#line-pp").empty();
        $("#box-graficas").show();
        $("#line-media").empty();
        $("#line-maxima").empty();
        $("#line-minima").empty();
        var url=$('#frm-anioagricola').attr('action');
        $.ajax({
            url: url,
            dataType: 'JSON',
            type: 'POST',
            data: $("#frm-anioagricola").serialize(),
                success: function(response) {
                        var line = new Morris.Line({
                            element: 'line-pp',
                            resize: true,
                            data: response,
                            parseTime: false,
                            xkey: 'dia',
                            ykeys: ['precipitacion_pluvial'],
                            labels: ['Precipitacion Pluvial'],
                            xLabels: 'Dia',
                            lineColors: ['#00c0ef'],
                            hideHover: 'auto'
                        });
                        var line = new Morris.Line({
                            element: 'line-maxima',
                            resize: true,
                            data: response,
                            parseTime: false,
                            xkey: 'dia',
                            ykeys: ['maxima'],
                            labels: ['Maxima'],
                            xLabels: 'Dia',
                            lineColors: ['#dd4b39'],
                            hideHover: 'auto'
                        });
                        var line = new Morris.Line({
                            element: 'line-media',
                            resize: true,
                            data: response,
                            parseTime: false,
                            xkey: 'dia',
                            ykeys: ['media'],
                            labels: ['Media'],
                            xLabels: 'Dia',
                            lineColors: ['#00a65a'],
                            hideHover: 'auto'
                        });
                        var line = new Morris.Line({
                            element: 'line-minima',
                            resize: true,
                            data: response,
                            parseTime: false,
                            xkey: 'dia',
                            ykeys: ['minima'],
                            labels: ['Minima'],
                            xLabels: 'Dia',
                            lineColors: ['#3c8dbc'],
                            hideHover: 'auto'
                        });
            }
        });
    });
</script>