    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENU PRINCIPAL</li>
        <li><a href="<?php echo site_url('panel');?>"><i class="fa fa-dashboard"></i> <span>Panel de Control</span></a></li>
        <li><a href="<?php echo site_url('prediccion');?>"><i class="fa fa-calculator"></i> <span>Predicción</span></a></li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Graficas</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu active">
            <li><a href="<?php echo site_url('anioagricola/graficas');?>"><i class="fa fa-circle-o"></i> Año Agricola</a></li>
            <li><a href="<?php echo site_url('prediccion/graficas');?>"><i class="fa fa-circle-o"></i> Predicciones</a></li>
          </ul>
        <li><a href="<?php echo site_url('anioagricola');?>"><i class="fa fa-leaf"></i> <span>Año Agricola</span></a></li>
        <li><a href="#"><i class="fa fa-book"></i> <span>Documentación</span></a></li>
        <li><a href="<?php echo site_url('logout');?>"><i class="fa fa-power-off"></i> <span>Cerrar Sesión</span></a></li>
    </ul>