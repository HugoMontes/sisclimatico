<?php $this->load->view('template/header');?>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <div class="container-fluid form-inline">
                    <div class="row">
                        <div class="col-sm-6">
                            <?php if(isset($anios)){ ?>
                                <?php echo form_open('anioagricola/buscar/anio/', array('id'=>'frm-anio', 'role'=>'form', 'method'=>'get')); ?>
                                    <div class="form-group">
                                        <label for="grupo">Año Agricola </label>
                                        <?php echo form_dropdown('anio', $anios, $anioselect,array('id'=>'anio','class'=>'form-control')); ?>
                                    </div>
                                <?php echo form_close(); ?>
                            <?php } ?>
                        </div>
                        <div class="col-sm-6">
                            <div style="text-align: right;">
                                <button class="btn btn-social btn-success" data-toggle="modal" data-target="#modal-excel"><i class="fa fa-upload"></i>Nuevo año agricola</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if(isset($diasagricolas)){ ?>
                    <br/>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>AÑO</th>
                                <th>MES</th>
                                <th>DIA</th>
                                <th>P.P.</th>
                                <th>MEDIA</th>
                                <th>MAXIMA</th>
                                <th>MINIMA</th>
                                <th>P.P. ACUM.</th>
                                <th>MEDIA ACUM.</th>
                                <th>MAXIM. ACUM.</th>
                                <th>MINIM. ACUM.</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($diasagricolas as $dia){ ?>
                            <tr>
                                <td><?php echo $dia->anio; ?></td>
                                <td><?php echo $dia->mes; ?></td>
                                <td style="text-align:center;"><?php echo $dia->dia; ?></td>
                                <td style="text-align:right;"><?php echo number_format($dia->precipitacion_pluvial, 2); ?></td>
                                <td style="text-align:right;"><?php echo number_format($dia->media, 2); ?></td>
                                <td style="text-align:right;"><?php echo number_format($dia->maxima, 2); ?></td>
                                <td style="text-align:right;"><?php echo number_format($dia->minima, 2); ?></td>
                                <td style="text-align:right;"><?php echo number_format($dia->pp_acum, 2); ?></td>
                                <td style="text-align:right;"><?php echo number_format($dia->media_acum, 2); ?></td>
                                <td style="text-align:right;"><?php echo number_format($dia->max_acum, 2); ?></td>
                                <td style="text-align:right;"><?php echo number_format($dia->min_acum, 2); ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('anioagricola/nuevoexcel_modal');?>
<?php $this->load->view('template/footer');?>
<script>
    $('#anio').change(function() {
        var idanio=$(this).val();
        var url=$('#frm-anio').attr('action')+idanio;
        window.location = $(this).val();
    });
</script>