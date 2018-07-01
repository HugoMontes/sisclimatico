<?php $this->load->view('template/header'); ?>
<!-- Small boxes (Stat box) -->
<div class="row">
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-aqua">
      <div class="inner">
        <p style="margin:0px; font-weight: 800;">PRECITACIÓN</p>
        <p style="margin:0px;">se espera</p>
        <h3 style="margin:0px;">1.1 mm</h3>
        <p style="margin:0px;">para hoy <?php echo $fecha; ?></p>
      </div>
      <div class="icon">
        <i class="wi wi-night-rain-mix"></i>
      </div>
      <a href="#" class="small-box-footer btn-precitacion">Realizar Predicción
        <i class="fa fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-green">
      <div class="inner">
          <p style="margin:0px; font-weight: 800;">TEMPERATURA MINIMA</p>
          <p style="margin:0px;">se espera</p>
          <h3 style="margin:0px;">-1.6 °C</h3>
          <p style="margin:0px;">para hoy <?php echo $fecha; ?></p>
      </div>
      <div class="icon" style="margin-top: 10px;">
        <i class="wi wi-thermometer"></i>
      </div>
      <a href="#" class="small-box-footer btn-minima">Realizar Predicción
        <i class="fa fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-yellow">
      <div class="inner">
        <p style="margin:0px; font-weight: 800;">TEMPERATURA MEDIA</p>
        <p style="margin:0px;">se espera</p>
        <h3 style="margin:0px;">8.7 °C</h3>
        <p style="margin:0px;">para hoy <?php echo $fecha; ?></p>
      </div>
      <div class="icon" style="margin-top: 10px;">
        <i class="wi wi-thermometer"></i>
      </div>
      <a href="#" class="small-box-footer btn-media">Realizar Predicción
        <i class="fa fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-red">
      <div class="inner">
        <p style="margin:0px; font-weight: 800;">TEMPERATURA MÁXIMA</p>
        <p style="margin:0px;">se espera</p>
        <h3 style="margin:0px;">17.4 °C</h3>
        <p style="margin:0px;">para hoy <?php echo $fecha; ?></p>
      </div>
      <div class="icon" style="margin-top: 10px;">
        <i class="wi wi-thermometer"></i>
      </div>
      <a href="#" class="small-box-footer btn-maxima">Realizar Predicción
        <i class="fa fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>
  <!-- ./col -->
</div>
<?php $this->load->view('prediccion_modal');?>
<?php $this->load->view('template/footer'); ?>
<script>
  var unidad;
  function abrirModal(){
    $('.box-resultado').hide();
    $('#modal-prediccion').modal({
      backdrop: 'static',
      keyboard: false 
    });
  }
  $('.btn-precitacion').on('click', function(event){
    event.preventDefault();
    $('#modal-prediccion').attr('class','modal modal-info fade');
    $('.modal-title').text('Precipitación Pluvial');
    $('#btn-enviar-prediccion').attr('fenomeno','1');
    unidad='mm';
    abrirModal();
  });
  $('.btn-media').on('click', function(event){
    event.preventDefault();
    $('#modal-prediccion').attr('class','modal modal-warning fade');
    $('.modal-title').text('Temperatura Media');
    $('#btn-enviar-prediccion').attr('fenomeno','3');
    unidad='°C';
    abrirModal();
  });
  $('.btn-maxima').on('click', function(event){
    event.preventDefault();
    $('#modal-prediccion').attr('class','modal modal-danger fade');
    $('.modal-title').text('Temperatura Maxima');
    $('#btn-enviar-prediccion').attr('fenomeno','4');
    unidad='°C';
    abrirModal();
  });
  $('.btn-minima').on('click', function(event){
    event.preventDefault();
    $('#modal-prediccion').attr('class','modal modal-success fade');
    $('.modal-title').text('Temperatura Minima');
    $('#btn-enviar-prediccion').attr('fenomeno','2');
    unidad='°C';
    abrirModal();
  });

  $('#btn-enviar-prediccion').on('click', function(event){
    event.preventDefault();
    var url=$('#frm-prediccion').attr('action');
    var data=$("#frm-prediccion").serialize()+'&fenomeno='+$(this).attr('fenomeno');
    $.ajax({
          url: url,
          dataType: 'JSON',
          type: 'POST',
          data: data,
                success: function(response) {
                  $('.box-resultado').show();
                  var title=$('.modal-title').text();
                  $('.body-resultado').html('La mejor predicción es con promedio de '+response.cuantos_anios+' años. Se espera una '+title+' de '+response.esperado+unidad+' variando desde '+response.menor+unidad+' hasta '+response.mayor+unidad+'.');       
                }
    });
  });
</script>