<?php $this->load->view('template/header');?>
<!-- Morris charts -->
<link rel="stylesheet" href="<?php echo base_url();?>resources/bower_components/morris.js/morris.css">

<div class="box box-primary">
    <div class="box-body">
        <?php echo form_open('prediccion/calcular', array('role'=>'form')); ?>
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
                        <?php echo form_submit(array('value'=>'Graficar','class'=>'btn btn-primary')); ?>
                    </div>
                </div>
            </div>
        </div>
        <?php echo form_close(); ?>
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
        <div class="chart" id="line-chart" style="height: 300px;"></div>
    </div>
    <!-- /.box-body -->
</div>
<?php $this->load->view('template/footer');?>
<!-- Morris.js charts -->
<script src="<?php echo base_url();?>resources/bower_components/raphael/raphael.min.js"></script>
<script src="<?php echo base_url();?>resources/bower_components/morris.js/morris.min.js"></script>

<script>
    // LINE CHART
    var line = new Morris.Line({
      element: 'line-chart',
      resize: true,
      data: [
        {y: '2011 Q1', item1: 2666},
        {y: '2011 Q2', item1: 2778},
        {y: '2011 Q3', item1: 4912},
        {y: '2011 Q4', item1: 3767},
        {y: '2012 Q1', item1: 6810},
        {y: '2012 Q2', item1: 5670},
        {y: '2012 Q3', item1: 4820},
        {y: '2012 Q4', item1: 15073},
        {y: '2013 Q1', item1: 10687},
        {y: '2013 Q2', item1: 8432}
      ],
      xkey: 'y',
      ykeys: ['item1'],
      labels: ['Item 1'],
      lineColors: ['#3c8dbc'],
      hideHover: 'auto'
    });
</script>