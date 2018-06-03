<?php $this->load->view('template/header');?>

<div class="row">
   <div class="col-md-6">
      <div class="box box-primary">
         <div class="box-body">
            <?php echo form_open('prediccion/calcular', array('role'=>'form')); ?>
            <div class="form-group">
               <?php echo form_label('Seleccionar fecha:', 'fecha'); ?>
               <div class="input-group date">
                  <div class="input-group-addon">
                     <i class="fa fa-calendar"></i>
                  </div>
                  <?php echo form_input(array('id'=>'fecha',
                                             'name'=>'fecha',
                                             'value'=>set_value('fecha',$fecha),
                                             'placeholder'=>'dd/mm/aa',
                                             'class'=>'form-control pull-right')); ?>
               </div>
            </div>
            <div class="form-group">
               <div style="text-align: right;">
                  <?php echo form_submit(array('value'=>'Realizar Predicción',
                                                        'class'=>'btn btn-primary')); ?>
               </div>
            </div>
            <?php echo form_close(); ?>
         </div>
         <!-- /.box-body -->
      </div>
      <!-- /.box -->
   </div>
</div>

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
                     <td></td>
                     <td></td>
                     <td></td>
                  </tr>
                  <tr>
                     <th>TEMPERATURA MAXIMA</th>
                     <td></td>
                     <td></td>
                     <td></td>
                  </tr>
                  <tr>
                     <th>TEMPERATURA MEDIA</th>
                     <td></td>
                     <td></td>
                     <td></td>
                  </tr>
                  <tr>
                     <th>TEMPERATURA MINIMA</th>
                     <td></td>
                     <td></td>
                     <td></td>
                  </tr>
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>
<?php $this->load->view('template/footer');?>
<script>
   //Date picker
   $('#fecha').datepicker({
      autoclose: true,
      language: 'es'
   });
</script>