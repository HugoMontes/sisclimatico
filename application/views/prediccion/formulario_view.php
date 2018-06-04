<?php $this->load->view('template/header');?>
<div class="box box-primary">
    <div class="box-body">
        <?php echo form_open('prediccion/calcular', array('role'=>'form')); ?>
        <div class="row">
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
            <div class="col-md-6">
                <div class="form-group">
                    <?php echo form_label('Seleccionar Dia:', 'dia'); ?>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <?php echo form_dropdown('dia', $dias_mes, $diaselect, array('id'=>'dia','class'=>'form-control')); ?>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <div style="text-align: right;">
                        <?php echo form_submit(array('value'=>'Realizar Predicción','class'=>'btn btn-primary')); ?>
                    </div>
                </div>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
    <!-- /.box-body -->
</div>


<?php if(isset($menores) and isset($esperados) and isset($mayores)){ ?>
<div class="row">
    <div class="col-md-12">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title">Resultados de Predicción</h3>
            </div>
            <div class="box-header with-border">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th></th>
                            <th style="text-align:center;">VALOR MENOR</th>
                            <th style="text-align:center;">VALOR ESPERADO</th>
                            <th style="text-align:center;">VALOR MAYOR</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>PRECIPITACIÓN</th>
                            <td style="text-align:right;">
                                <?php echo number_format($menores['pp'], 1); ?>
                            </td>
                            <td style="text-align:right;">
                                <?php echo number_format($esperados['pp'], 1); ?>
                            </td>
                            <td style="text-align:right;">
                                <?php echo number_format($mayores['pp'], 1); ?>
                            </td>
                        </tr>
                        <tr>
                            <th>TEMPERATURA MAXIMA</th>
                            <td style="text-align:right;">
                                <?php echo number_format($menores['max'], 1); ?>
                            </td>
                            <td style="text-align:right;">
                                <?php echo number_format($esperados['max'], 1); ?>
                            </td>
                            <td style="text-align:right;">
                                <?php echo number_format($mayores['max'], 1); ?>
                            </td>
                        </tr>
                        <tr>
                            <th>TEMPERATURA MEDIA</th>
                            <td style="text-align:right;">
                                <?php echo number_format($menores['med'], 1); ?>
                            </td>
                            <td style="text-align:right;">
                                <?php echo number_format($esperados['med'], 1); ?>
                            </td>
                            <td style="text-align:right;">
                                <?php echo number_format($mayores['med'], 1); ?>
                            </td>
                        </tr>
                        <tr>
                            <th>TEMPERATURA MINIMA</th>
                            <td style="text-align:right;">
                                <?php echo number_format($menores['min'], 1); ?>
                            </td>
                            <td style="text-align:right;">
                                <?php echo number_format($esperados['min'], 1); ?>
                            </td>
                            <td style="text-align:right;">
                                <?php echo number_format($mayores['min'], 1); ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<?php $this->load->view('template/footer');?>
<script>
    //Date picker
    $('#fecha').datepicker({
        autoclose: true,
        language: 'es'
    });
</script>