<?php $this->load->view('template/header');?>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <div class="container-fluid form-inline">
                    <div class="row">
                        <div class="col-sm-6">
                            <form>
                                <div class="form-group">
                                    <label for="grupo">Año Agricola </label>
                                    <select class="form-control">
                                        <option>2008 - 2009</option>
                                        <option>2009 - 2010</option>
                                        <option>2010 - 2011</option>
                                        <option>2011 - 2012</option>
                                        <option>2013 - 2014</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                        <div class="col-sm-6">
                            <div style="text-align: right;">
                                <button class="btn btn-social btn-success" data-toggle="modal" data-target="#modal-excel"><i class="fa fa-upload"></i>Nuevo año agricola</button>
                            </div>
                        </div>
                    </div>
                </div>
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
                        <tr>
                            <td>2010</td>
                            <td>JULIO</td>
                            <td>1</td>
                            <td>0</td>
                            <td>7.5</td>
                            <td>18.2</td>
                            <td>-3.2</td>
                            <td>0</td>
                            <td>7.5</td>
                            <td>18.2</td>
                            <td>-3.2</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('anioagricola/nuevoexcel_modal');?>
<?php $this->load->view('template/footer');?>
