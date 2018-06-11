<div class="modal modal-info fade" id="modal-prediccion">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Precipitación Pluvial</h4>
            </div>
            <div class="modal-body">
                <?php echo form_open('prediccion/calcular/media', array('id'=>'frm-prediccion', 'role'=>'form')); ?>
                    <div class="row">
                        <div class="col-md-4">
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
                        <div class="col-md-4">
                            <div class="form-group">
                                <?php echo form_label('Seleccionar Dia:', 'dia'); ?>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <?php echo form_dropdown('dia', $dias, $diaselect, array('id'=>'dia','class'=>'form-control')); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4" style="margin-top: 24px;">
                            <div class="form-group">
                                <div>
                                    <button id="btn-enviar-prediccion" type="button" class="btn btn-outline" fenomeno="">Realizar Predicción</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php echo form_close(); ?>
                <div class="box box-default box-resultado" style="display:none;">
                    <div class="box-header with-border">
                        <h3 class="box-title">Resultado de la predicción</h3>
                    </div>
                    <div class="box-body body-resultado" style="color: black;font-size: 18px;">
                        
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Salir</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->