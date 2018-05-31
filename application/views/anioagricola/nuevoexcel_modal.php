<div class="modal fade" id="modal-excel">
   <div class="modal-dialog">
      <?php echo form_open('anioagricola/subir/excel', array('role'=>'form', 'enctype'=>'multipart/form-data')); ?>
         <div class="modal-content">
            <div class="modal-header bg-primary">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
               <h4 class="modal-title">Subir Archivo</h4>
            </div>
            <div class="modal-body">
               <div class="form-group">
                  <label for="grupo">Seleccionar archivo </label>
                  <input type="file" id="excelfile" name="excelfile" />
                  <p class="help-block">Example block-level help text here.</p>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
               <button type="button" class="btn btn-primary">Subir y Guardar</button>
            </div>
         </div>
      <?php echo form_close(); ?>
   </div>
</div>