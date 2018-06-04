<?php $this->load->view('template/header');?>
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



<div class="row">
    <div class="col-md-12">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title">Grafica de Año Agricola</h3>
            </div>
            <div class="box-header with-border">
               
            </div>
        </div>
    </div>
</div>


<?php $this->load->view('template/footer');?>