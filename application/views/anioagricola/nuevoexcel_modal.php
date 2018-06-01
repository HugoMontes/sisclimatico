<div class="modal fade" id="modal-excel">
   <div class="modal-dialog">
      <?php echo form_open_multipart('anioagricola/subir/excel', array('role'=>'form')); ?>
         <div class="modal-content">
            <div class="modal-header bg-primary">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
               <h4 class="modal-title">Subir Archivo</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                  <?php echo form_label('Año agricola', 'anio'); ?>
                  <?php echo form_input(array(
                                          'id'=>'anio',
                                          'name'=>'anio',
                                          'disabled'=>'true',
                                          'class'=>'form-control'
                                       ), $siguienteanio); ?>
               </div>
               <div class="form-group">
                  <?php echo form_label('Seleccionar archivo', 'excelfile'); ?>
                  <?php echo form_upload(array(
                                          'id'=>'excelfile',
                                          'name'=>'excelfile',
                                          'accept'=>'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                                       )); ?>
                  <p class="help-block">Seleccionar un archivo con extension .xlsx</p>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
               <?php echo form_submit(array(
                                       'value'=>'Subir y Guardar', 
                                       'class'=>'btn btn-primary'
                                    )); ?>
            </div>
         </div>
      <?php echo form_close(); ?>
   </div>
</div>