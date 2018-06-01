<?php $this->load->view('template/header');?>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <div class="container-fluid form-inline">
                    <div class="row">
                        <div class="col-sm-6">
                            <?php if(isset($anios)){ ?>
                            <form>
                                <div class="form-group">
                                    <label for="grupo">Año Agricola </label>
                                    <?php echo form_dropdown('anio', $anios, '1',array('class'=>'form-control')); ?>
                                </div>
                            </form>
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
                                <td style="text-align:right;"><?php echo $dia->precipitacion_pluvial; ?></td>
                                <td style="text-align:right;"><?php echo $dia->media; ?></td>
                                <td style="text-align:right;"><?php echo $dia->maxima; ?></td>
                                <td style="text-align:right;"><?php echo $dia->minima; ?></td>
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
